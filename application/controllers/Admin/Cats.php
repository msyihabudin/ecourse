<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cats extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

				// load all the things
		$this->load->model('CatModel');
		$this->load->helper('form');
		$this->load->library('form_validation');

		// set validation error
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
	}

	public function index()
	{
		$data['title'] = "Categories";
		// get the categories
		$data['cats'] = $this->CatModel->get_cats();
		$this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Categories', base_url('admin/cats'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

		//build it
		$this->template->load('base_admin', 'admin/cats/index', $data);
	}

	public function add_cat()
	{
		$data['title'] = "Add Category";
		$this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Categories', base_url('admin/cats'));
        $this->mybreadcrumb->add('Add Category', base_url('admin/cats/add_cat'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

		// do we have a form submit?
		if ($this->input->post())
		{
			// yup, set rules
			$this->form_validation->set_rules('name', 'Category Name', 'required');
			$this->form_validation->set_rules('url_name', 'URL Name', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
		}

		// pass vaidation?
		if ($this->form_validation->run() == TRUE)
        {
        	// yep.  Add it.
        	if ($this->CatModel->add_cat($this->input->post()))
        	{
        		// succeeded
        		$this->session->set_flashdata('success', 'Category added successfully');
				redirect('admin/cats');
        	}
        	// failed
        	$data['message'] = 'Could not add Category.  Please try again.';
			$this->template->load('base_admin', 'admin/cats/add_cat', $data); 
        }
        // no form submit, show the form
        $this->template->load('base_admin', 'admin/cats/add_cat', $data);       
	}

	public function edit_cat($id)
	{
		// get the category we're editing
		$data['cat'] = $this->CatModel->get_cat($id);
		$data['title'] = "Edit Category";
		$this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Categories', base_url('admin/cats'));
        $this->mybreadcrumb->add('Edit Category', base_url('admin/cats/edit_cat/'.$id));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

		// did we have a form submit?
		if ($this->input->post())
		{
			// yup, set validation rules
			$this->form_validation->set_rules('name', 'Category Name', 'required');
			$this->form_validation->set_rules('url_name', 'URL Name', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
		}

		// did validation pass?
		if ($this->form_validation->run() == TRUE)
        {
        	// yup, update the category
        	if ($this->CatModel->update_cat($id, $this->input->post()))
        	{
        		// succeeded
        		$this->session->set_flashdata('success', 'Category updated successfully');
				redirect('admin/cats');
        	}
        	// failed
        	$data['message'] = 'Could not update Category.  Please try again.';
			$this->template->load('base_admin', 'admin/cats/edit_cat', $data); 
        }
        // no form submit, show the form
        $this->template->load('base_admin', 'admin/cats/edit_cat', $data);    

	}

	public function remove_cat($id)
	{
		// remove the cat
		if ($this->CatModel->remove_cat($id))
		{
			//it worked
			$this->session->set_flashdata('success', lang('cat_removed_success_resp'));
			redirect('admin_cats');
		}
		// failed to remove
		$this->session->set_flashdata('error', lang('cat_removed_fail_resp'));
		redirect('admin_cats');
	}
}
