<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('adminmodel');
        $this->user_id = isset($this->session->get_userdata()['user_details'][0]->id)?$this->session->get_userdata()['user_details'][0]->users_id:'1';
    }

	public function index() {
		is_login();
        if(CheckPermission("users", "own_read")){
            $data['title'] = "User";
			$data['data_users'] = $this->adminmodel->getAllUser()->result();
            $this->mybreadcrumb->add('Home', base_url('admin'));
            $this->mybreadcrumb->add('Users', base_url('admin/user'));
            $data['breadcrumbs'] = $this->mybreadcrumb->render();

			$this->template->load('base_admin', 'admin/user', $data);
        } else {
            $this->session->set_flashdata('messagePr', 'You don\'t have permission to access.');
            redirect(base_url().'admin/user', 'refresh');
        }		
    }

    public function addUser() {
        is_login();
        $data['title'] = "Add User";
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Users', base_url('admin/user'));
        $this->mybreadcrumb->add('Add User', base_url('admin/user/add'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->template->load('base_admin', 'admin/add_user', $data);
    }

    public function editUser() {
        is_login();
        $id = $this->uri->segment(4);
        $data['title'] = "Edit User";
        $data['userData'] = getDataByid('users',$id,'users_id');
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Users', base_url('admin/user'));
        $this->mybreadcrumb->add('Edit User', base_url('admin/user/edit/'.$id));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        $this->template->load('base_admin', 'admin/edit_user', $data);
    }

    public function add_edit($id = '') {   
        $data = $this->input->post();
        $profile_pic = 'user.png';
        if($this->input->post('users_id')) {
            $id = $this->input->post('users_id');
        }

        $newname = $this->input->post('profilepic');
        $profile_pic = $newname;
        
        $config['upload_path'] = './assets/image/user/';
        $config['allowed_types'] = 'png|jpg';
        $config['max_size'] = '1000';

        $this->upload->initialize($config);

        if ($this->upload->do_upload()) {
             //do nothing!
        } else {
            $error = array('error' => $this->upload->display_errors());
            foreach ($error as $value) {
                $this->session->set_flashdata('messagePr', $value);    
            }
            redirect(base_url().'admin/user', 'refresh');
        }

        if(!empty($this->input->post('profilepic'))) {  
            
        } else {
            //$data[$name]='';
            $profile_pic ='user.png';
        }

        if(!empty($id)) {
            $data = $this->input->post();
            if($this->input->post('status') != '') {
                $data['status'] = $this->input->post('status');
            }
            if($this->input->post('users_id') == 1) { 
                $data['user_type'] = 'admin';
            }
            if($this->input->post('password') != '') {
                if($this->input->post('currentpassword') != '') {
                    $old_row = getDataByid('users', $this->input->post('users_id'), 'users_id');
                    if(password_verify($this->input->post('currentpassword'), $old_row->password)){
                        if($this->input->post('password') == $this->input->post('confirmPassword')){
                            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                            $data['password']= $password;     
                        } else {
                            $this->session->set_flashdata('messagePr', 'Password and confirm password should be same...');
                            //redirect( base_url().'admin/user', 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('messagePr', 'Enter Valid Current Password...');
                        //redirect( base_url().'admin/user', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('messagePr', 'Current password is required');
                    //redirect( base_url().'admin/user', 'refresh');
                }
            }
            $id = $this->input->post('users_id');
            
            unset($data['fileOld']);
            unset($data['currentpassword']);
            unset($data['confirmPassword']);
            unset($data['users_id']);
            unset($data['user_type']);
            if(isset($data['edit'])){
                unset($data['edit']);
            }
            if($data['password'] == ''){
                unset($data['password']);
            }
            $data['profile_pic'] = $profile_pic;
            if ($this->adminmodel->updateRow('users', 'users_id', $id, $data)) {
                $this->session->set_flashdata('messagePr', 'Your data updated Successfully..');
                //redirect(base_url().'admin/user', 'refresh');
            } else {
                $this->session->set_flashdata('messagePr', 'Cannot save edit data!');
                redirect(base_url().'admin/user', 'refresh');
            }
        } else { 
            if($this->input->post('user_type') != 'admin') {
                $data = $this->input->post();
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $checkValue = $this->adminmodel->check_exists('users','email', $this->input->post('email'));
                if($checkValue == false)  {  
                    $this->session->set_flashdata('messagePr', 'This Email Already Registered with us..');
                    redirect( base_url().'admin/user', 'refresh');
                }
                $checkValue1 = $this->adminmodel->check_exists('users','name',$this->input->post('name'));
                if($checkValue1==false) {  
                    $this->session->set_flashdata('messagePr', 'Username Already Registered with us..');
                    redirect( base_url().'admin/user', 'refresh');
                }
                $data['status'] = 'active';
                if(setting_all('admin_approval') == 1) {
                    $data['status'] = 'deleted';
                }
                
                if($this->input->post('status') != '') {
                    $data['status'] = $this->input->post('status');
                }
                //$data['token'] = $this->generate_token();
                $data['user_id'] = $this->user_id;
                $data['password'] = $password;
                $data['profilepic'] = $profile_pic;
                $data['is_deleted'] = 0;
                if(isset($data['password_confirmation'])){
                    unset($data['password_confirmation']);    
                }
                if(isset($data['call_from'])){
                    unset($data['call_from']);    
                }
                unset($data['submit']);
                $this->adminmodel->insertRow('users', $data);
                redirect( base_url().'admin/'.$redirect, 'refresh');
            } else {
                $this->session->set_flashdata('messagePr', 'You Don\'t have this autherity ' );
                redirect( base_url().'admin/signup', 'refresh');
            }
        }
    }

    function upload() {
    	print_r($_FILES);
        foreach($_FILES as $name => $fileInfo)
        {
            $filename=$_FILES[$name]['name'];
            $tmpname=$_FILES[$name]['tmp_name'];
            $exp=explode('.', $filename);
            $ext=end($exp);
            $newname=  $exp[0].'_'.time().".".$ext; 
            $config['upload_path'] = 'assets/image/user/';
            $config['upload_url'] =  base_url().'assets/image/user/';
            $config['allowed_types'] = "gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp";
            $config['max_size'] = '2000000'; 
            $config['file_name'] = $newname;
            $this->load->library('upload', $config);
            move_uploaded_file($tmpname,"assets/image/user/".$newname);
            return $newname;
        }
    }
}
