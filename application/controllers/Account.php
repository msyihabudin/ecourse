<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usersmodel');
        $this->load->model('accountmodel');
        $this->load->model('adminmodel');
        $this->load->model('coursemodel');
        $this->user_id = isset($this->session->get_userdata()['user_details'][0]->id)?$this->session->get_userdata()['user_details'][0]->users_id:'1';
    }

	public function index() {
        if ($this->session->userdata('user_details')) {
            $data['title'] = "Account";
            
            $email = $this->session->userdata('user_details')[0]->email;
            $user = $this->usersmodel->getUser($email)->row_array();
            $data['enroll_course'] = json_decode($this->accountmodel->getKeepPlayingCourses($user['users_id']));
            $data['enroll_lesson'] = json_decode($this->accountmodel->getKeepPlayingQuest($user['users_id']));
            $data['badges'] = json_decode($this->accountmodel->getBadges($user['users_id']));
            $data['account'] = $this->usersmodel->getUser($email)->row_array();
            $data['orders'] = $this->coursemodel->getOrder($user['users_id']);
            $data['total'] = 0;
            $data['bank'] = $this->db->get_where('settings', array('name' => 'bank_account'))->row_array();

            $this->template->load('base', 'account/index', $data);
        }
        else {
            redirect('signin');
        }
    }
    
    /*public function history() {
        if ($this->session->userdata('user_details')) {
            $data['title'] = "History";
            
            $this->template->load('base', 'account/history', $data);
        }
        else {
            redirect('signin');
        }
    }

    public function rewards() {
        if ($this->session->userdata('user_details')) {
            $data['title'] = "Rewards";

            $email = $this->session->userdata('user_details')[0]->email;
            $user = $this->usersmodel->getUser($email)->row_array();
            $data['badges'] = json_decode($this->accountmodel->getBadges($user['users_id']));
            
            $this->template->load('base', 'account/rewards', $data);   
        }
        else {
            redirect('signin');
        }
    }

    public function profile() {
        if ($this->session->userdata('user_details')) {
            $email = $this->session->userdata('user_details')[0]->email;

            $data['title'] = "Profile";
            
            
            $this->template->load('base', 'account', $data);   
        }
        else {
            redirect('signin');
        }
    }

    public function report() {
        if ($this->session->userdata('user_details')) {
            $data['title'] = "Report Card";
            
            $this->template->load('base', 'account/report', $data);   
        }
        else {
            redirect('signin');
        }
    }*/

    public function change_photo() {
        if (isset($_POST['change_photo'])) {
            $config['upload_path'] = 'assets/image/User/';
            $config['allowed_types'] = 'jpg|png';
            $this->load->library('upload', $config);

            $id = $this->input->post('users_id');

            $data_account = array();
            if ($this->upload->do_upload('url')) {
                $upload_data = $this->upload->data();

                $data_account['profile_pic'] = site_url().$config['upload_path'].$upload_data['file_name'];

                $this->db->where('users_id', $id);
                $this->db->update('users', $data_account);
            }
            redirect('account');
        }
        else {
            redirect('account');
        }
    }

    public function save_account() {
        if (isset($_POST['save_account'])) {
            $id = $this->input->post('users_id');

            $data_account = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username')
            );

            $this->db->where('users_id', $id);
            $this->db->update('users', $data_account);

            redirect('account');
        }
        else {
            redirect('account');
        }
    }

    public function change_password() {
        if (isset($_POST['change_password'])) {
            $id = $this->input->post('users_id');
            $current_pass = $this->input->post('current_password');

            $result = $this->accountmodel->checkPass($id, $current_pass)->row_array();

            $data_account = array();
            if ($result == TRUE) {
                $data_account['password'] = $this->input->post('new_password');

                $this->db->where('users_id', $id);
                $this->db->update('users', $data_account);
            }

            redirect('account');
        }
        else {
            redirect('account');
        }
    }

    public function delete_account() {
        if (isset($_POST['delete_account'])) {
            $id = $this->input->post('users_id');
            $current_pass = $this->input->post('current_password');

            $result = $this->accountmodel->checkPass($id, $current_pass)->row_array();

            if ($result == TRUE) {
                $this->db->where('users_id', $id);
                $this->db->delete('users');
        
                $this->session->unset_userdata('user_details');
                redirect('/');
            }
        }
        else {
            redirect('account');
        }
    }

    public function add_edit($id='') {   
        $data = $this->input->post();
        
        if($this->input->post('users_id')) {
            $id = $this->input->post('users_id');
        }
        
        if($id != '') {
            if($this->input->post('password') != '') {
                if($this->input->post('currentpassword') != '') {
                    $old_row = getDataByid('users', $this->input->post('users_id'), 'users_id');
                    if(password_verify($this->input->post('currentpassword'), $old_row->password)){
                        if($this->input->post('password') == $this->input->post('confirmPassword')){
                            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                            $data['password']= $password;     
                        } else {
                            $this->session->set_flashdata('messagePr', 'New Password and Confirm Password should be same...');
                            redirect( base_url().'account', 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('messagePr', 'Enter Valid Current Password...');
                        redirect( base_url().'account', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('messagePr', 'Current password is required');
                    redirect( base_url().'account', 'refresh');
                }
            }
            $id = $this->input->post('users_id');
            
            unset($data['currentpassword']);
            unset($data['confirmPassword']);
            unset($data['users_id']);
            unset($data['user_type']);
            unset($data['profile_pic']);
            if(isset($data['edit'])){
                unset($data['edit']);
            }
            if($data['password'] == ''){
                unset($data['password']);
            }
            
            if ($this->adminmodel->updateRow('users', 'users_id', $id, $data)) {
                $this->session->set_flashdata('messagePr', 'Your data updated Successfully..');
                redirect(base_url().'account', 'refresh');
            } else {
                $this->session->set_flashdata('messagePr', 'Cannot save edit data!');
                redirect(base_url().'account', 'refresh');
            }
        }
    }
}
