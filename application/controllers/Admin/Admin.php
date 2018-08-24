<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('adminmodel');
        // form helper
        $this->load->helper('form');

        // form validation
        $this->load->library('form_validation');
        $this->user_id = isset($this->session->get_userdata()['user_details'][0]->id)?$this->session->get_userdata()['user_details'][0]->users_id:'1';
    }

	public function index() {
        if(is_login()){
            redirect(base_url().'admin/dashboard', 'refresh');
        }
    }
    
    public function dashboard($id = '') {
        is_login();
        if(!isset($id) || $id == '') {
            $id = $this->session->get_userdata()['user_details'][0]->users_id;
        }
        $data['user_data'] = $this->adminmodel->getUsers($id);
        $data['title'] = "Dashboard";
        $data['dashboard'] = $this->adminmodel->getDashboard();
        
        $this->template->load('base_admin', 'admin/dashboard', $data);
    }

    public function account($id='') {
        is_login();
        $data['title'] = "Admin Account";
        is_login();
        if(!isset($id) || $id == '') {
            $id = $this->session->userdata('user_details')[0]->users_id;
        }

        $data['account'] = $this->adminmodel->getUsers($id);
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Users', base_url('admin/user'));
        $this->mybreadcrumb->add('Admin Account', base_url('admin/user/account'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->template->load('base_admin', 'admin/account', $data);
    }

    public function signin() {
        if(isset($_SESSION['user_details'])){
            redirect(base_url().'admin/dashboard', 'refresh');
        }   
        $data['title'] = "Admin Site";

        $this->template->load('base_sign', 'admin/index', $data);
    }

    public function auth_user($page =''){ 
        $return = $this->adminmodel->auth_user();
        if(empty($return)) { 
            $this->session->set_flashdata('messagePr', 'Invalid username or password!');  
            redirect(base_url().'admin/signin', 'refresh');  
        } else { 
            if($return == 'not_varified') {
                $this->session->set_flashdata('messagePr', 'This accout is not varified. Please contact to your admin..');
                redirect( base_url().'admin/signin', 'refresh');
            } elseif ($return == 'invalid_user') {
                $this->session->set_flashdata('messagePr', 'Invalid user. Please try again.');
                redirect( base_url().'signin', 'refresh');
            } else {
                $this->session->set_userdata('user_details',$return);
            }
            redirect(base_url().'admin/dashboard', 'refresh');
        }
    }

    public function signout() {
        is_login();
        $this->session->unset_userdata('user_details');               
        redirect(base_url().'admin', 'refresh');
    }

    public function forgetpassword(){
        $page['title'] = 'Forgot Password';
        if($this->input->post()){
            $setting = settings();
            $res = $this->adminmodel->getDataBy('users', $this->input->post('email'), 'email',1);
            if(isset($res[0]->users_id) && $res[0]->users_id != '') { 
                $var_key = $this->getVarificationCode(); 
                $this->adminmodel->updateRow('users', 'users_id', $res[0]->users_id, array('var_key' => $var_key));
                $sub = "Reset password";
                $email = $this->input->post('email');      
                $data = array(
                    'user_name' => $res[0]->name,
                    'action_url' =>base_url(),
                    'sender_name' => $setting['company_name'],
                    'website_name' => $setting['website'],
                    'varification_link' => base_url().'admin/mailVerify?code='.$var_key,
                    'url_link' => base_url().'user/mailVerify?code='.$var_key,
                    );
                $body = $this->adminmodel->getTemplate('forgot_password');
                $body = $body->html;
                foreach ($data as $key => $value) {
                    $body = str_replace('{var_'.$key.'}', $value, $body);
                }
                if($setting['mail_setting'] == 'php_mailer') {
                    $this->load->library("send_mail");         
                    $emm = $this->send_mail->email($sub, $body, $email, $setting);
                } else {
                    // content-type is required when sending HTML email
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: '.$setting['EMAIL'] . "\r\n";
                    $emm = mail($email,$sub,$body,$headers);
                }
                if($emm) {
                    $this->session->set_flashdata('messagePr', 'To reset your password, link has been sent to your email');
                    redirect( base_url().'admin/signin','refresh');
                }
            } else {    
                $this->session->set_flashdata('forgotpassword', 'This account does not exist');//die;
                redirect(base_url()."admin/forgetpassword");
            }
        }
    }

    public function mailVerify(){
        $return = $this->adminmodel->mailVerify();         
        $this->load->view('include/script');
        if($return){          
            $data['email'] = $return;
            $this->load->view('set_password', $data);        
        } else { 
            $data['email'] = 'allredyUsed';
            $this->load->view('set_password', $data);
        } 
    }

    public function add_edit($id='') {   
        $data = $this->input->post();
        $profile_pic = 'user.png';
        if($this->input->post('users_id')) {
            $id = $this->input->post('users_id');
        }
        if(isset($this->session->userdata('user_details')[0]->users_id)) {
            if($this->input->post('users_id') == $this->session->userdata ('user_details')[0]->users_id){
                $redirect = 'account';
            } else {
                $redirect = 'user';
            }
        } else {
            $redirect = 'signin';
        }
        if($this->input->post('fileOld')) {  
            $newname = $this->input->post('fileOld');
            $profile_pic =$newname;
        } else {
            //$data[$name]='';
            $profile_pic ='user.png';
        }
        foreach($_FILES as $name => $fileInfo)
        { 
             if(!empty($_FILES[$name]['name'])){
                $newname=$this->upload(); 
                $data[$name]=$newname;
                $profile_pic =$newname;
             } else {  
                if($this->input->post('fileOld')) {  
                    $newname = $this->input->post('fileOld');
                    $data[$name]=$newname;
                    $profile_pic =$newname;
                } else {
                    $data[$name]='';
                    $profile_pic ='user.png';
                } 
            } 
        }
        if($id != '') {
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
                            redirect( base_url().'admin/'.$redirect, 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('messagePr', 'Your Current Password is Invalid!');
                        redirect( base_url().'admin/'.$redirect, 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('messagePr', 'Current password is required!');
                    redirect( base_url().'admin/'.$redirect, 'refresh');
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
            $this->adminmodel->updateRow('users', 'users_id', $id, $data);
            $this->session->set_flashdata('messagePr', 'Your data updated Successfully..');
            redirect(base_url().'admin/'.$redirect, 'refresh');
        } else { 
            if($this->input->post('user_type') != 'admin') {
                $data = $this->input->post();
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $checkValue = $this->adminmodel->check_exists('users','email',$this->input->post('email'));
                if($checkValue==false)  {  
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
                $data['profile_pic'] = $profile_pic;
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
                $this->session->set_flashdata('messagePr', 'You Don\'t have this authority ' );
                redirect( base_url().'admin/signup', 'refresh');
            }
        }    
    }

    function getDataByid($tableName='',$columnValue='',$colume='')
    {  
        $CI = get_instance();
        $CI->db->select('*');
        $CI->db->from($tableName);
        $CI->db->where($colume , $columnValue);
        $query = $CI->db->get();
        return $result = $query->row();
    }

    function upload() {
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

    /*20180731*/

    /*public function change_photo() {
        if (isset($_POST['change_photo'])) {
            $config['upload_path'] = 'assets/image/user/';
            $config['allowed_types'] = 'jpg|png';
            $this->load->library('upload', $config);

            $id = $this->input->post('id_admin');

            $data_account = array();
            if ($this->upload->do_upload('url')) {
                $upload_data = $this->upload->data();

                $data_account['photo_url'] = site_url().$config['upload_path'].$upload_data['file_name'];

                $this->db->where('id_admin', $id);
                $this->db->update('admin', $data_account);
            }
            redirect('admin/account');
        }
        else {
            redirect('admin/account');
        }
    }

    public function save_account() {
        if (isset($_POST['save_account'])) {
            $id = $this->input->post('id_admin');

            $data_account = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email')
            );

            $this->db->where('id_admin', $id);
            $this->db->update('admin', $data_account);

            redirect('admin/account');
        }
        else {
            redirect('admin/account');
        }
    }

    public function change_password() {
        if (isset($_POST['change_password'])) {
            $id = $this->input->post('id_admin');
            $current_pass = $this->input->post('current_password');

            $result = $this->adminmodel->checkPass($id, $current_pass)->row_array();

            $data_account = array();
            if ($result == TRUE) {
                $data_account['password'] = $this->input->post('new_password');

                $this->db->where('id_admin', $id);
                $this->db->update('admin', $data_account);
            }

            redirect('admin/account');
        }
        else {
            redirect('admin/account');
        }
    }*/

    public function getVarificationCode(){        
        $pw = $this->randomString();   
        return $varificat_key = password_hash($pw, PASSWORD_DEFAULT); 
    }

    public function settings()
    {
        is_login();

        $data['title'] = "Settings";
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Settings', base_url('admin/settings'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

        // do we have a submitted form?
        if ($this->input->post())
        {
            // some fields aren't required, so we get the
            // ones that are, and set form_validation
            foreach ($this->adminmodel->get_required_settings() as $item)
            {
                $this->form_validation->set_rules($item->name, ucfirst($item->tab) . ' Tab - ' . ucwords(humanize($item->name)), 'required');
            }

            // form validation failed, send them back to 
            // the form to fix whatever it was.
            if ($this->form_validation->run() === FALSE)
            {
                // get the list of settings
                $data = $this->adminmodel->get_settings_list();
                $this->template->load('base_admin', 'admin/settings/index', $data);
            }
            // form_validation succeeded
            // let's insert the new values
            // and move on.
            if ($this->adminmodel->update_settings())
            {
                $this->session->set_flashdata('success', 'Settings Updated Successfully');
                redirect('admin/settings');
            }
            else
            {
                $data['message'] = "Settings Failed to Update.  Please try again.";
                // get the list of settings
                $data = $this->adminmodel->get_settings_list();
                $this->template->load('base_admin', 'admin/settings/index', $data);
            }
        }
        else
        {
            // get the list of settings
            $data = $this->adminmodel->get_settings_list();

            $this->template->load('base_admin', 'admin/settings/index', $data);
        }
    }
}
