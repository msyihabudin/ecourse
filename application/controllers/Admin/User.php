<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('adminmodel');
    }

	public function index() {
		is_login();
        if(CheckPermission("users", "own_read")){
            $data['title'] = "User";
			$data['data_users'] = $this->adminmodel->getAllUser()->result();

			$this->template->load('base_admin', 'admin/user', $data);
        } else {
            $this->session->set_flashdata('messagePr', 'You don\'t have permission to access.');
            redirect(base_url().'admin/user', 'refresh');
        }		
    }

    public function addEdit($id = '') {
        is_login();
        if(!empty($id)){
        	$data['title'] = "Edit User";
            $data['userData'] = getDataByid('users',$id,'users_id');
            $this->template->load('base_admin', 'admin/add_user', $data);
        } else {
        	$data['title'] = "Add User";
            $this->template->load('base_admin', 'admin/add_user', $data);
        }
        //exit;
    }

    public function dataTable(){
        is_login();
	    $table = 'users';
    	$primaryKey = 'users_id';
    	$columns = array(
           array( 'db' => 'users_id', 'dt' => 0 ),array( 'db' => 'status', 'dt' => 1 ),
					array( 'db' => 'name', 'dt' => 2 ),
					array( 'db' => 'email', 'dt' => 3 ),
					array( 'db' => 'users_id', 'dt' => 4 )
		);

        $sql_details = array(
			'user' => $this->db->username,
			'pass' => $this->db->password,
			'db'   => $this->db->database,
			'host' => $this->db->hostname
		);
		$where = array("user_type != 'admin'");
		$output_arr = SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where);
		foreach ($output_arr['data'] as $key => $value) {
			$id = $output_arr['data'][$key][count($output_arr['data'][$key])  - 1];
			$output_arr['data'][$key][count($output_arr['data'][$key])  - 1] = '';
			if(CheckPermission($table, "all_update")){
			$output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a id="btnEditRow" class="modalButtonUser mClass"  href="javascript:;" type="button" data-src="'.$id.'" title="Edit"><i class="fa fa-pencil" data-id=""></i></a>';
			}else if(CheckPermission($table, "own_update") && (CheckPermission($table, "all_update")!=true)){
				$user_id =getRowByTableColomId($table,$id,'users_id','user_id');
				if($user_id==$this->user_id){
			$output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a id="btnEditRow" class="modalButtonUser mClass"  href="javascript:;" type="button" data-src="'.$id.'" title="Edit"><i class="fa fa-pencil" data-id=""></i></a>';
				}
			}
			
			if(CheckPermission($table, "all_delete")){
			$output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a style="cursor:pointer;" data-toggle="modal" class="mClass" onclick="setId('.$id.', \'user\')" data-target="#cnfrm_delete" title="delete"><i class="fa fa-trash-o" ></i></a>';}
			else if(CheckPermission($table, "own_delete") && (CheckPermission($table, "all_delete")!=true)){
				$user_id =getRowByTableColomId($table,$id,'users_id','user_id');
				if($user_id==$this->user_id){
			$output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a style="cursor:pointer;" data-toggle="modal" class="mClass" onclick="setId('.$id.', \'user\')" data-target="#cnfrm_delete" title="delete"><i class="fa fa-trash-o" ></i></a>';
				}
			}
            $output_arr['data'][$key][0] = '<input type="checkbox" name="selData" value="'.$output_arr['data'][$key][0].'">';
		}
		echo json_encode($output_arr);
    }



    public function get_modal() {
        
    }
}
