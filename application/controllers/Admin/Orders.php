<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('coursemodel');
        $this->load->model('questmodel');
        //$this->load->library('mybreadcrumb');
    }

    public function index() {
        is_login();
        $data['title'] = "Orders";
        $data['orders'] = $this->coursemodel->getAllOrder();
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('List Orders', base_url('admin/orders'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->template->load('base_admin', 'admin/orders/list_order', $data);
    }

    public function view_order($order_id) {
        is_login();
        $data['title'] = "View Order";
        $data['orders'] = $this->coursemodel->getOrderId($order_id)->row_array();
        $data['payment'] = $this->coursemodel->getPaymentInfo($order_id)->row_array();
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('View Order', base_url('admin/orders/view'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->db->set('is_edited', 1);
        $this->db->where('order_id', $order_id);
        $this->db->update('order_items');

        $this->template->load('base_admin', 'admin/orders/view_order', $data);   
    }

    public function update() {
        is_login();
        $users_id = $this->input->post('user_id');
        $id_course = $this->input->post('course_id');
        if ($this->input->post()) {
            if ($this->input->post('status') == "Completed") {
                $enroll_course = $this->coursemodel->getEnrollStatus($users_id, $id_course)->row_array();

                if ($enroll_course != null) {
                    $this->db->where('id_enroll_course', $enroll_course['id_enroll_course']);
                    $this->db->update('enroll_course', $enroll_data);
                }
                else {
                    $data = array(
                        'id_badge' => $id_course,
                        'id_user' => $users_id
                    );

                    $enroll_data = array(
                        'id_course' => $id_course,
                        'id_user' => $users_id,
                        'enroll_status' => true
                    );
                    $this->db->insert('enroll_course', $enroll_data);
                    $this->db->insert('badgenuser', $data);
                }
            }

            $this->db->set('status', $this->input->post('status'));
            $this->db->where('order_id', $this->input->post('order_id'));
            
            if ($this->db->update('order_items')) {
                $this->session->set_flashdata('messagePr', 'Your data updated Successfuly');
                redirect(base_url().'admin/orders','refresh');
            }else{
                $this->session->set_flashdata('messagePr', 'Unable to update order. Please try again.');
                redirect(base_url().'admin/orders','refresh');
            }
        }else{
            $this->session->set_flashdata('messagePr', 'Error update data!');
            redirect(base_url('admin/orders'),'refresh');
        }
    }
}