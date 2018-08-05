<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PageModel extends CI_Model
{
	// Protected or private properties
	protected $_table;
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get_pages()
	{
		return $this->db->get('pages')->result();
	}

	public function get_page($id)
	{
		return $this->db->where('id', $id)->limit(1)->get('pages')->row_array();
	}

	public function add_page($data)
	{
		return $this->db->insert('pages', $data);
	}

	public function update_page($id, $data)
	{
		if ($data['is_home'] == 1)
		{
			// brute force all page records to is_home = 0
			// there can be only one!
			if ( ! $this->db->set('is_home', '0')->update('pages'))
			{
				return false;
			}
		}
		// update the cuurent record.
		return $this->db->where('id', $id)->update('pages', $data);
	}

	public function remove_page($id)
	{
		// get the outgoing page information
		$page = $this->db->where('id', $id)->limit(1)->get('pages')->row();

		// does this page have redirects that need
		// to be removed as well?
		$this->obcore->remove_redirects($page->url_title);
		
		return $this->db->delete('pages', ['id' => $id]);
	}
}
