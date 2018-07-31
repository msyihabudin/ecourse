<?php 

class AdminModel extends CI_Model {
    function __construct(){            
        parent::__construct();
        $this->user_id =isset($this->session->get_userdata()['user_details'][0]->id)?$this->session->get_userdata()['user_details'][0]->users_id:'1';
    }

    function signin($data) {
        return $this->db->get_where('admin', array('email' => $data['email'], 'password' => $data['password']));
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

    /*function getAdmin($email) {
        return $this->db->get_where('admin', array('email' => $email));
    }*/

    function getUsers($userID = '') {
        $this->db->where('is_deleted', '0');                  
        if(isset($userID) && $userID !='') {
            $this->db->where('users_id', $userID); 
        } else if($this->session->userdata('user_details')[0]->user_type == 'admin') {
            $this->db->where('user_type', 'admin'); 
        } else {
            $this->db->where('users.users_id !=', '1'); 
        }
        $result = $this->db->get('users')->result();
        return $result;
    }

    function checkPass($id, $password) {
        return $this->db->get_where('admin', array('id_admin'=>$id, 'password'=>$password));
    }

    function getAllUser() {
        return $this->db->get('users');
    }

    function getAllLecture() {
        return $this->db->get('lecture');
    }

    function getDashboard() {
        $select = array(
            'count(user.id_user) as numUser'
        );
        $user = $this->db
                        ->select($select)
                        ->from('user')
                        ->get()
                        ->row_array();

        $select = array(
            'count(course.id_course) as numcourse'
        );
        $course = $this->db
                        ->select($select)
                        ->from('course')
                        ->get()
                        ->row_array();

        $select = array(
            'count(lesson.id) as numQuest'
        );
        $quest = $this->db
                        ->select($select)
                        ->from('lesson')
                        ->get()
                        ->row_array();

        $select = array(
            'count(lecture.id_lecture) as numLecture'
        );
        $lecture = $this->db
                        ->select($select)
                        ->from('lecture')
                        ->get()
                        ->row_array();

        $result = [$user, $course, $quest, $lecture];
        return $result;
    }

    function getDataBy($tableName='', $value='', $colum='',$condition='') {   
        if((!empty($value)) && (!empty($colum))) { 
            $this->db->where($colum, $value);
        }
        $this->db->select('*');
        $this->db->from($tableName);
        $query = $this->db->get();
        return $query->result();
    }

    public function updateRow($table, $col, $colVal, $data) {
        $this->db->where($col,$colVal);
        $this->db->update($table,$data);
        return true;
    }

    public function insertRow($table, $data){
        $this->db->insert($table, $data);
        return  $this->db->insert_id();
    }

    function mailVerify() {    
        $ucode = $this->input->get('code');     
        $this->db->select('email as e_mail');        
        $this->db->from('users');
        $this->db->where('var_key',$ucode);
        $query = $this->db->get();     
        $result = $query->row();   
        if(!empty($result->e_mail)){      
            return $result->e_mail;         
        }else{     
            return false;
        }
    }

    function check_exists($table='', $colom='',$colomValue=''){
        $this->db->where($colom, $colomValue);
        $res = $this->db->get($table)->row();
        if(!empty($res)){ return false;} else{ return true;}
    }

    function getTemplate($code){
        $this->db->where('code', $code);
        return $this->db->get('templates')->row();
    }
}