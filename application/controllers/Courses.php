<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('coursemodel');
		$this->load->model('questmodel');
		$this->load->model('usersmodel');
    }

	public function index() {
		$data['title'] = "Courses Path";

		$data['courses'] = json_decode($this->coursemodel->getMainPage());
		$data['quest'] = $this->questmodel->getAllQuest()->result();

		$this->template->load('base', 'courses/index', $data);
	}

	public function content() {
		$this->load->model('usersmodel');
		$title = str_replace("courses/", "", uri_string());

		$data['title'] = $title;

		$newurl = explode(base_url(), current_url())[1];

		$data['content'] = json_decode($this->coursemodel->getCourseContent($newurl));
		//print_r($newurl);

		if ($this->session->userdata('user_details')) {
			$email = $this->session->userdata('user_details')[0]->email;
			$user = $this->usersmodel->getUser($email)->row_array();
			$user_data = $this->coursemodel->getEnrollStatus($user['users_id'], $data['content'][0]->idcourse)->row_array();
			$users = array(
				'users_id' => $user['users_id'],
				'id_course' => $data['content'][0]->idcourse
			);
			$data['user'] = $users;
			$data['enroll'] = $user_data;
		}

		$this->template->load('base', 'courses/course-content', $data);
	}

	public function enroll($users_id, $id_course) {
		$enroll_data = array(
			'id_course' => $id_course,
			'id_user' => $users_id,
			'enroll_status' => true
		);

		$price = $this->coursemodel->getCourses($id_course)->row_array();

		if ($price['price']>0) {
			$courses = $this->coursemodel->getCourses($id_course)->row_array();
			
			$user_items = array(
				'user_id' => $users_id,
				'item_id' => $courses['id_course'],
				'flag' => "cart"
			);
			
			$this->db->insert('user_items', $user_items);

			redirect(base_url().'checkout/'.$users_id,'refresh');
		} else {
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
				$this->db->insert('enroll_course', $enroll_data);
				$this->db->insert('badgenuser', $data);
			}
			$result = $this->coursemodel->getCourses($id_course)->row_array();

			redirect($result['enroll_url']);
		}
	}

	public function unenroll($id, $id_course, $status) {
		$enroll_data = array(
			'enroll_status' => false
		);

		$this->db->where('id_enroll_course', $id);
		$this->db->update('enroll_course', $enroll_data);
		$result = $this->coursemodel->getCourses($id_course)->row_array();

		redirect($result['enroll_url']);
	}

	public function download($content) {
		force_download('uploads/file/'.$content, NULL);
	}

	public function search() {
		if (isset($_POST['search'])) {

			$search_data = array();
			$search_data['keyword'] = $this->input->post('keyword');
			$search_data['id_quest'] = $this->input->post('id_quest');
	        $query = $this->coursemodel->getSearchItems($search_data);

	        //print_r(count($query));/*

	        if (!empty(json_decode($query))) {
                $data['courses'] = json_decode($query);
                $data['quest'] = $this->questmodel->getAllQuest()->result();
                $this->template->load('base', 'courses/index', $data);
            }else{
            	$this->session->set_flashdata('messagePr', 'Couldn’t find any courses..');
                redirect( base_url().'courses', 'refresh');
            }           
        }
        else {
            $this->session->set_flashdata('messagePr', 'Error search data!');
            redirect( base_url().'courses', 'refresh'); 
        }
	}

	public function checkout($id_user) {
		$data['title'] = "Your Order";
		$data['courses'] = $this->coursemodel->getCheckout($id_user);
		$data['bank'] = $this->db->get_where('settings', array('name' => 'bank_account'))->row_array();
		$data['total'] = 0;
		
		if ($this->session->userdata('user_details')) {
			$this->template->load('base', 'courses/checkout', $data);
		} else {
			redirect(base_url().'signin', 'refresh');
		}
	}

	public function proccess_checkout($id_user) {
		if ($this->input->post()) {
			$checkout = $this->coursemodel->getCheckout($id_user);
			$data['bank'] = $this->db->get_where('settings', array('name' => 'bank_account'))->row_array();
			$data['total'] = 0;

			$order_items = array(
				'order_item_id' => $checkout[0]['user_item_id'],
				'order_item_name' => $checkout[0]['course_name'],
				'status' => "Pending Payment",
				'total' => $this->input->post('total')
			);

	        if ($this->db->insert('order_items', $order_items)) {
	        	//array_push($data, $order_items);
	        	//print_r($data);
	        	$data['orders'] = $checkout;
	        	
	        	$this->db->set('flag', "delete");
	        	$this->db->where('user_id', $id_user);
	        	$this->db->update('user_items');
	        	
	            $this->template->load('base', 'courses/proccess_checkout', $data);
	        }else{
	            $this->session->set_flashdata('messagePr', 'Unable to place order. Please try again.');
	            redirect(base_url().'checkout/'.$id_user,'refresh');
	        }	
		}else{
            redirect(base_url('account'),'refresh');
        }
	}

	public function delete_checkout($id, $user_id) {
		$delete = $this->coursemodel->deleteCart($id);

		if ($delete) {
			$this->session->set_flashdata('messagePr', 'Item removed Successfully..');
			redirect(base_url().'checkout/'.$user_id,'refresh');
		} else {
			$this->session->set_flashdata('messagePr', 'Unable to remove item. Please try again.');
			redirect(base_url().'checkout/'.$user_id,'refresh');
		}
	}

	public function confirm($order_id) {
		$data['title'] = "Your Order";
		$data['orders'] = $this->coursemodel->getOrderId($order_id)->row_array();
		$data['bank'] = $this->db->get_where('settings', array('name' => 'bank_account'))->row_array();
		$data['total'] = 0;
		
		if ($this->session->userdata('user_details')) {
			$this->template->load('base', 'courses/confirm_payment', $data);
		} else {
			redirect(base_url().'signin', 'refresh');
		}
	}

	public function save_confirm(){
		if (isset($_POST['submit1'])) {
            $config['upload_path'] = './assets/image/';
            $config['allowed_types'] = 'png|jpg';
            $config['max_size'] = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $data_course = array();
            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();

                $data['order_id'] = $this->input->post('order_id');
                $data['no_rekening'] = $this->input->post('norek');
                $data['atas_nama'] = $this->input->post('atasnama');
                $data['jumlah'] = $this->input->post('jumlah');
                $data['image'] = site_url().$config['upload_path'].$upload_data['file_name'];

                if ($this->db->insert('order_confirm', $data)) {
                	//update status
                	$this->db->set('status', "Processing");
		        	$this->db->where('order_id', $this->input->post('order_id'));
		        	$this->db->update('order_items');

                    $this->session->set_flashdata('messagePr', 'Your data added Successfully..');
                    redirect( base_url().'account', 'refresh');
                }else{
                    $this->session->set_flashdata('messagePr', 'Cannot save data!');
                    redirect( base_url().'account', 'refresh');
                }
            }else{
                $error = array('error' => $this->upload->display_errors());
                //$this->template->load('base_admin', 'admin/courses/courses', $error);
                foreach ($error as $value) {
                    $this->session->set_flashdata('messagePr', $value);    
                }
                
                redirect( base_url().'account', 'refresh'); 
            }                      
        }
        else {
            $this->session->set_flashdata('messagePr', 'Error save data!');
            redirect( base_url().'account', 'refresh'); 
        }
	}
}