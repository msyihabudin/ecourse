<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CatModel extends CI_Model
{
	// Protected or private properties
	protected $_table;
	
	public function __construct()
	{
		parent::__construct();	
	}

	public function get_cats()
	{
		return $this->db->get('categories')->result();
	}

	public function get_cat($id)
	{
		return $this->db->where('id', $id)->limit(1)->get('categories')->row_array();
	}

	public function add_cat($data)
	{
		return $this->db->insert('categories', $data);
	}

	public function update_cat($id, $data)
	{
		return $this->db->where('id', $id)->update('categories', $data);
	}

	public function remove_cat($id)
	{
		return $this->db->delete('categories', ['id' => $id]);
	}
}
