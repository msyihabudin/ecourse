<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usersmodel');
        $this->load->model('adminmodel');
        $this->user_id = isset($this->session->get_userdata()['user_details'][0]->id)?$this->session->get_userdata()['user_details'][0]->users_id:'1';
    }

    public function signin(){
        $data['title'] = "Sign In";

        $this->template->load('base_sign', 'users/signin', $data);
    }

    public function signup(){
        $data['title'] = "Sign Up";
        
        $this->template->load('base_sign', 'users/signup', $data);
    }

    public function auth_signin() {
		//echo "masuk..";
        /*if (isset($_POST['auth_signin'])) {
            if (isset($this->session->userdata['user_signed_in'])) {
                redirect('account');
            }
            else {
                redirect('signin');
            }
        }
        else {
        $data = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );

        $result = $this->usersmodel->signin($data)->row_array();

        if ($result == TRUE) {
            $email = $this->input->post('email');
            $result = $this->usersmodel->getUser($email)->row_array();

            if ($result != FALSE) {
                $session_data = array(
                    'id' => $result['users_id'],
                    'email' => $result['email'],
                    'profile_pic' => $result['profile_pic']
                );
                
                $this->session->set_userdata('user_signed_in', $session_data);

                redirect('account');
            }
        }
        else {
			echo "Error";
            //redirect('signin');
        }
        //}*/
        $return = $this->usersmodel->auth_user();
        if(empty($return)) { 
            $this->session->set_flashdata('messagePr', 'Invalid username or password!');  
            redirect(base_url('signin'), 'refresh');  
        } else { 
            if($return == 'not_varified') {
                $this->session->set_flashdata('messagePr', 'This accout is not varified. Please contact to your admin..');
                redirect(base_url('signin'), 'refresh');
            } else {
                $this->session->set_userdata('user_details',$return);
            }
            redirect(base_url(), 'refresh');
        }
    }

    public function auth_signup() {
        /*if (isset($_POST['auth_signup'])) {
            if (isset($this->session->userdata['user_signed_in'])) {
                redirect('account');
            }
            else {
                redirect('signup');
            }
        }
        else {
        $data = array(
            'user_type' => 'student',
            'fullname' => $this->input->post('name'),
            'email' => strtolower($this->input->post('email')),
            'name' => strtolower($this->input->post('username')),
            'password' => $this->input->post('password'),
            'profile_pic' => base_url().'assets/image/user/user.png'
        );
        $result = $this->usersmodel->signup($data);

        if ($result == TRUE) {
            redirect('signin');
        } 
        else {
			echo "Error";
            redirect('signup');
        }*/
        //}

        $data = $this->input->post();
        $profile_pic = 'user.png';
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $checkValue = $this->adminmodel->check_exists('users','email', $this->input->post('email'));
        if($checkValue == false)  {  
            $this->session->set_flashdata('messagePr', 'This Email Already Registered with us..');
            redirect( base_url(), 'refresh');
        }
        $checkValue1 = $this->adminmodel->check_exists('users','name',$this->input->post('name'));
        if($checkValue1==false) {  
            $this->session->set_flashdata('messagePr', 'Username Already Registered with us..');
            redirect( base_url(), 'refresh');
        }
        $data['status'] = 'active';
                
        if($this->input->post('status') != '') {
            $data['status'] = $this->input->post('status');
        }
        //$data['token'] = $this->generate_token();
        $data['user_id'] = $this->user_id;
        $data['fullname'] = $this->input->post('fullname');
        $data['password'] = $password;
        $data['profile_pic'] = $profile_pic;
        $data['is_deleted'] = 0;
        
        unset($data['submit']);
        unset($data['terms']);
        $this->adminmodel->insertRow('users', $data);
        redirect( base_url('signin'), 'refresh');
    }

    public function signout() {
        $this->session->unset_userdata('user_details');               
        redirect( base_url(), 'refresh');
    }
}