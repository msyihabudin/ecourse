<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// load models et al
		$this->load->model('NavigationModel');
		$this->load->helper('form');
		$this->load->library('form_validation');

		// form validation
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
	}

	public function index()
	{
		is_login();
		// get a list of the nav items
		$data['navs'] = $this->NavigationModel->get_navs();

		// get the list of redirects
		$data['redirects']	= $this->NavigationModel->get_redirects();
		$data['title'] = "Navigation";
		$this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Navigation', base_url('admin/navigation'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

		// off you go sonnie
		$this->template->load('base_admin', 'admin/navigation/index', $data);
	}

	public function add_nav()
	{	
		is_login();
		// default empty array
		$data = [];

		$data['title'] = "Add Navigation Item";
		$this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Navigation', base_url('admin/navigation'));
        $this->mybreadcrumb->add('Add Navigation Item', base_url('admin/navigation/add_nav'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

		// get page slugs...
		$data['page_slugs'] = $this->NavigationModel->get_page_slugs();

		// get post slugs
		$data['post_slugs'] = $this->NavigationModel->get_post_slugs();

		// form submit attempt?
		if ($this->input->post())
		{
			// indeed, set rules
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');

			/* For simplicity this has been removed
			   from the RC. If you're a developer and
			   would like to be able to manually create
			   url links, you can uncomment below and
			   uncomment the form field in add_nav.php
			*/
			//if ($this->input->post('url'))
			//{	
				// yup, so lets validate that...
			//	$this->form_validation->set_rules('url', lang('nav_form_url_text'), 'required|alpha_dash|is_unique[navigation.url]');
			//}
		}

		// did they pass validations?
		if ($this->form_validation->run() == TRUE)
        {
        	// yes, so we'll start.
        	$nav_data = $this->input->post();

        	// do the insert
        	if ($this->NavigationModel->add_nav($nav_data))
        	{
        		// succeeded
        		$this->session->set_flashdata('success', 'Navigation added Successfully');
				redirect('admin/navigation');
        	}
        	// failed
        	$data['message'] = 'Unable to add item. Please try again.';
			$this->template->load('base_admin', 'admin/navigation/add_nav', $data); 
        }

        // no love for forms... build the form
        $this->template->load('base_admin', 'admin/navigation/add_nav', $data);       
	}

	public function edit_nav($id)
	{
		// get nav items
		$data['nav'] = $this->NavigationModel->get_nav($id);

		$data['title'] = "Edit Navigation Item";
		$this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Navigation', base_url('admin/navigation'));
        $this->mybreadcrumb->add('Edit Navigation Item', base_url('admin/navigation/edit/'.$id));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

		// get page slugs
		$data['page_slugs'] = $this->NavigationModel->get_page_slugs();

		// get post slugs
		$data['post_slugs'] = $this->NavigationModel->get_post_slugs();

		// form submit attempt?
		if ($this->input->post())
		{
			// sì, set validation rules
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			
			// does the old url_title match the one from the form?
			// For developers who wish to allow manual uri entries.
			if ($this->input->post('url') && $this->input->post('url') != $data['nav']['url'])
			{
				$this->form_validation->set_rules('url', 'URI', 'required|alpha_dash|is_unique[navigation.url]');
				$this->form_validation->set_rules('redirection', 'Redirection', 'required|in_list[none,301,302]');
			}
		}

		// did they pass validations?
		if ($this->form_validation->run() == TRUE)
        {
        	// yes, so we'll start updating.
        	$nav_data = $this->input->post();

        	// do the update
        	if ($this->NavigationModel->update_nav($id, $nav_data))
        	{
        		// succeeded
        		$this->session->set_flashdata('success', 'Updated Navigation Item Successfully');
				redirect('admin/navigation');
        	}
        	// failed
        	$data['message'] = 'Unable to update navigation item. Please try again.';
			$this->template->load('base_admin', 'admin/navigation/edit_nav', $data); 
        }
        $this->template->load('base_admin', 'admin/navigation/edit_nav', $data);    

	}

	public function remove_nav($id)
	{
		// remove the nav
		if ($this->NavigationModel->remove_nav($id))
		{
			//it worked
			$this->session->set_flashdata('success', 'Navigation removed Successfully');
			redirect('admin/navigation');
		}
		// failed to remove
		$this->session->set_flashdata('error', 'Unable to remove Navigation item. Please try again.');
		redirect('admin/navigation');
	}

	/*

	AJAX STUFF

 	*/
 
	public function update_nav_order()
	{
		if ($this->NavigationModel->update_nav_order($this->input->post()))
		{
			echo json_encode(['status' => 'true']);
		}
		echo json_encode(['status' => 'false']);
	}

	/*
	
	Redirects

	 */

	public function edit_redirect($id)
	{
		// init emplty array
		$data = [];

		// get the single redirect item
		$data['redir'] = $this->NavigationModel->get_redirect($id);

		// form submit attempt?
		if ($this->input->post())
		{
			// yup, set rules
			$this->form_validation->set_rules('old_slug', 'From', 'required');
			$this->form_validation->set_rules('new_slug', 'To', 'required');
			$this->form_validation->set_rules('type', 'Type', 'required');
			$this->form_validation->set_rules('code', 'HTTP Redirect Type', 'required|in_list[301,302]');
		}

		// did they pass validations?
		if ($this->form_validation->run() == TRUE)
        {
        	// do the update
        	if ($this->NavigationModel->update_redirect($id, $this->input->post()))
        	{
        		// succeeded
        		$this->session->set_flashdata('success', 'Updated Redirection Successfully');
				redirect('admin/navigation');
        	}
        	// failed
        	$data['message'] = 'Unable to update Redirection item. Please try again.';
			$this->template->load('base_admin', 'admin/navigation/edit_redir', $data); 
        }

		$this->template->load('base_admin', 'admin/navigation/edit_redir', $data);
	}

	public function remove_redirect($id)
	{
		// remove the nav
		if ($this->NavigationModel->remove_redirect($id))
		{
			//it worked
			$this->session->set_flashdata('success', lang('nav_redirect_removed_success_resp'));
			redirect('admin/navigation');
		}
		// failed to remove
		$this->session->set_flashdata('error', lang('nav_redirect_removed_fail_resp'));
		redirect('admin/navigation');
	}

}
