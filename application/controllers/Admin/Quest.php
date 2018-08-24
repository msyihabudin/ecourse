<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quest extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('questmodel');
        //$this->load->library('mybreadcrumb');
    }

	public function index() {
		is_login();
		$data['title'] = "Quest Courses";
		$data['quests'] = $this->questmodel->getAllQuest()->result();
		$this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Quest Courses', base_url('admin/quest'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

		$this->template->load('base_admin', 'admin/quest/quest', $data);
    }

    public function add_quest() {
        is_login();
        $data['title'] = "Add New Quest";
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Quest', base_url('admin/quest'));
        $this->mybreadcrumb->add('Add New Quest', base_url('admin/quest/add'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->template->load('base_admin', 'admin/quest/add_quest', $data);
    }

    public function save_quest() {
        is_login();
        if (isset($_POST['add_quest'])) {
            $config['upload_path'] = './assets/image/Badge/';
            $config['allowed_types'] = 'png|jpg';
            $config['max_size'] = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $data_quest = array();
            if ($this->upload->do_upload('img')) {
                $upload_data = $this->upload->data();

                $data_quest['quest_name'] = $this->input->post('name');
                $data_quest['description'] = $this->input->post('description');
                $data_quest['img'] = site_url().$config['upload_path'].$upload_data['file_name'];

                if ($this->db->insert('quest', $data_quest)) {
                    $this->session->set_flashdata('messagePr', 'Your data added Successfully..');
                    redirect( base_url().'admin/quest', 'refresh');
                }else{
                    $this->session->set_flashdata('messagePr', 'Cannot save data!');
                    redirect( base_url().'admin/quest', 'refresh');
                }
            }else{
                $error = array('error' => $this->upload->display_errors());
                //$this->template->load('base_admin', 'admin/quest/quest', $error);
                foreach ($error as $value) {
                    $this->session->set_flashdata('messagePr', $value);    
                }
                
                redirect( base_url().'admin/quest', 'refresh'); 
            }                      
        }
        else {
            $this->session->set_flashdata('messagePr', 'Error save data!');
            redirect( base_url().'admin/quest', 'refresh'); 
        }
    }

    public function edit_quest() {
        is_login();
        $id_quest = $this->uri->segment(4);
        $data['title'] = "Edit Quest";
        $data['quest'] = $this->questmodel->getQuest($id_quest)->row_array();
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Quest', base_url('admin/quest'));
        $this->mybreadcrumb->add('Edit Quest', base_url('admin/quest/edit/'.$id_quest));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->template->load('base_admin', 'admin/quest/edit_quest', $data);
    }

    public function save_edit_quest() {
        is_login();
        if (isset($_POST['save_edit'])) {
            $id = $this->input->post('id_quest');
            $data_quest = array(
                'quest_name' => $this->input->post('name'),
                'description' => $this->input->post('description')
            );
    
            $this->db->where('id', $id);
            if ($this->db->update('quest', $data_quest)) {
                $this->session->set_flashdata('messagePr', 'Your data updated Successfully..');
                redirect( base_url().'admin/quest', 'refresh');
            } else {
                $this->session->set_flashdata('messagePr', 'Cannot update data!');
                redirect( base_url().'admin/quest', 'refresh');
            }            
        }
        else {
            $this->session->set_flashdata('messagePr', 'Error update data!');
            redirect( base_url().'admin/quest', 'refresh');
        }
    }

    public function remove_quest($id)
    {
        // remove the nav
        if ($this->questmodel->remove_quest($id))
        {
            //it worked
            $this->session->set_flashdata('messagePr', 'Course removed Successfully');
            redirect( base_url().'admin/quest', 'refresh');
        }
        // failed to remove
        $this->session->set_flashdata('messagePr', 'Unable to remove Course item. Please try again.');
        redirect( base_url().'admin/quest', 'refresh');
    }
}
