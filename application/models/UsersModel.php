<?php 

class UsersModel extends CI_Model {

    function __construct(){            
        parent::__construct();
        $this->user_id =isset($this->session->get_userdata()['user_details'][0]->id)?$this->session->get_userdata()['user_details'][0]->users_id:'1';
    }

    function signin($data) {
        return $this->db->get_where('users', array('email' => $data['email'], 'password' => $data['password']));
    }

    function getUser($email) {
        return $this->db->get_where('users', array('email' => $email));
    }

    function getUserId($id) {
        return $this->db->get_where('users', array('users_id' => $id));
    }

    function getUserStudent() {
        return $this->db->get_where('users', array('user_type' => 'student'))->result();
    }

    function checkPass($id, $password) {
        return $this->db->get_where('users', array('id_user'=>$id, 'password'=>$password));
    }

    public function signup($data) {
        $check_email =  $this->db->get_where('users', array('email'=>$data['email']))->result();

        if ($check_email) {
            return false;
        }
        else {
            $check_username = $this->db->get_where('users', array('name'=>$data['name']))->result();

            if ($check_username) {
                return false;
            }
            else {
                $this->db->insert('users', $data);
                if ($this->db->affected_rows() > 0) {
                    return true;
                }
            }
        }
    }

    function auth_user() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->db->where("is_deleted='0' AND (name='$email' OR email='$email')");
        $result = $this->db->get('users')->result();
        if(!empty($result)){       
            if (password_verify($password, $result[0]->password)) {       
                if($result[0]->status != 'active') {
                    return 'not_varified';
                }
                return $result;
            }
            else {             
                return false;
            }
        } else {
            return false;
        }
    }

}