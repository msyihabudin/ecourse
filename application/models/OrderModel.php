<?php 

class OrderModel extends CI_Model {
    function __construct(){            
        parent::__construct();
        $this->user_id =isset($this->session->get_userdata()['user_details'][0]->id)?$this->session->get_userdata()['user_details'][0]->users_id:'1';
    }
}