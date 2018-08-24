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
                } elseif ($result[0]->user_type == 'student') {
                   return 'invalid_user';
                } else {
                    return $result;
                }
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

    function getDashboard() {
        $select = array(
            'count(users.users_id) as numUser'
        );
        $user = $this->db
                        ->select($select)
                        ->from('users')
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
            'count(course_lesson.id_course_lesson) as numQuest'
        );
        $quest = $this->db
                        ->select($select)
                        ->from('course_lesson')
                        ->get()
                        ->row_array();

        $result = [$user, $course, $quest];
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
        if(!empty($res)){ return false;} else { return true;}
    }

    function getTemplate($code){
        $this->db->where('code', $code);
        return $this->db->get('templates')->row();
    }

    public function delete_user($id)
    {       
        return $this->db->delete('users', ['users_id' => $id]);
    }

    public function get_required_settings()
    {
        return $this->db->where('required', 1)->get('settings')->result();
    }

    public function get_settings_list()
    {
        // init data obj
        $data = new stdClass();

        // sort tabs
        $tabs = $this->db->select('tab')->distinct()->get('settings')->result();

        // foreach of those tabs, we get all
        // options in that tab
        foreach ($tabs as &$tab)
        {
            // get the list for the tab
            $tab->list = $this->db->where('tab', $tab->tab)->get('settings')->result();

            // foreach of the list items
            foreach ($tab->list as &$item)
            {
                // we build the form field so we can just echo it 
                // in the view
                $item->input = $this->ecore->build_form_field($item->field_type, $item->name, $item->value, $item->options);
            }
        }

        // load up the object with the info
        $data->settings = $tabs;
        $data->title = "Settings";
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Settings', base_url('admin/settings'));
        $data->breadcrumbs = $this->mybreadcrumb->render();

        // send it off
        return $data;
    }

    public function update_settings()
    {
        // is there actually any post data?
        if (!$this->input->post())
        {
            // nope, fail
            return FALSE;
        }

        // there is, so we'll check the db for that $k
        foreach ($this->input->post() as $k => $v)
        {
            // does $k exist in the db?
            // if so, update it.
            if (! $this->db->where('name', $k)->update('settings', ['value' => $v]))
            {
                // no, someone adding stuff to the
                // post()?  fail and bail!
                return false;
            }
        }

        // something's gone wrong, fail and bail
        return false;
    }
}