<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('PostModel');
		//$this->load->model('ion_auth_model');

		$this->template->set('active_link', 'posts');

		$this->load->helper('form');

		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');


	}

	public function index()
	{
        is_login();
        $data['title'] = "Posts";
        $data['posts'] = $this->PostModel->get_posts();
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Posts', base_url('admin/posts'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->template->load('base_admin', 'admin/posts/index', $data);
	}

	public function add_post()
	{
        $data['title'] = "Add New Post";
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Posts', base_url('admin/posts'));
        $this->mybreadcrumb->add('Add New Post', base_url('admin/posts/add_post'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
		$data['cats'] = $this->PostModel->get_cats_form();
		
		if ($this->input->post())
		{

			$this->form_validation->set_rules('title', 'Post Title', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[draft,published]');
			$this->form_validation->set_rules('content', 'Post Content', 'required');
			$this->form_validation->set_rules('excerpt', 'Post Excerpt', 'required');
			$this->form_validation->set_rules('cats[]', 'Categories', 'required');
			
			$build_slug = true;
			// Did an advanced user enter the url_title/slug?
			if ($this->input->post('url_title'))
			{	
				// yup, so lets validate that...
				$this->form_validation->set_rules('url_title', 'Post Title', 'required|alpha_dash|is_unique[posts.url_title]');
				$build_slug = false;
			}
		}

		// did they pass validations?
		if ($this->form_validation->run() == TRUE)
        {
        		
        	// yes, so we'll start.
        	$post_data = $this->input->post();

        	// did they upload a feature image?
        	if ($_FILES['feature_image'])
        	{
        		$config['upload_path']          = './assets/image/posts/';
                $config['allowed_types']        = 'gif|jpg|png|mp4|mpeg|mpg';
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('feature_image'))
                {
                	$data['message'] = $this->upload->display_errors();

                    $this->template->load('base_admin', 'admin/posts/add_post', $data);  
                }
                else
                {
                    $img_data = $this->upload->data();

                    $post_data['feature_image'] = $img_data['file_name'];
                	
                }
        	}

        	// do we need to build the slug/url_title?
        	if ($build_slug)
        	{
        		$config = [
				    'field' => 'url_title',
				    'title' => $post_data['title'],
				    'table' => 'posts'
				];
        		$this->load->library('slug', $config);

        		$post_data['url_title'] = $this->slug->create_uri($post_data['title']);
        		
        	}

        	// get author info
        	$post_data['author'] 	= $this->session->userdata('user_details')[0]->users_id;

        	// the date
        	$post_data['date_posted']		= date('Y-m-d');

        	// do the insert
        	if ($this->PostModel->add_post($post_data))
        	{
        		// add the categories
        		
        		// succeeded
        		$this->session->set_flashdata('success', 'Post added successfully');
				redirect('admin/posts');
        	}
        	// failed
        	$data['message'] = 'Could not add post.  Please try again.';
            redirect('admin/posts/add_post');
			$this->template->load('base_admin', 'admin/posts/add_post', $data); 
        }
        $this->template->load('base_admin', 'admin/posts/add_post', $data);       
	}

	public function edit_post($id)
	{
		$data['post'] = $this->PostModel->get_post($id);
        $data['title'] = "Edit Post";
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Posts', base_url('admin/posts'));
        $this->mybreadcrumb->add('Edit Post', base_url('admin/posts/edit_post/'.$id));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

		if ($this->input->post())
		{

			// set default for changing url_title
			$new_slug = false;

			$this->form_validation->set_rules('title', 'Post Title', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required|in_list[draft,published]');
            $this->form_validation->set_rules('content', 'Post Content', 'required');
            $this->form_validation->set_rules('excerpt', 'Post Excerpt', 'required');
			
			// does the old url_title match the one from the form?
			if ($this->input->post('url_title') != $data['post']['url_title'])
			{	
				// they do not, set $new_slug true
				// and validation rules.
				$new_slug = true;
				$this->form_validation->set_rules('url_title', 'Post Title', 'required|alpha_dash|is_unique[posts.url_title]');
				$this->form_validation->set_rules('redirection', 'Redirection', 'required|in_list[none,301,302]');
			}
		}

		// did they pass validations?
		if ($this->form_validation->run() == TRUE)
        {
        	// yes, so we'll start updating.
        	$post_data = $this->input->post();


        	// did they upload a feature image?
        	if ($_FILES['feature_image'])
        	{
        		$config['upload_path']          = './assets/image/posts/';
                $config['allowed_types']        = 'gif|jpg|png|mp4|mpeg|mpg';
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('feature_image'))
                {
                	$data['message'] = $this->upload->display_errors();

                    $this->template->load('base_admin', 'admin/posts/edit_post', $data);  
                }
                else
                {
                    $img_data = $this->upload->data();

                    $post_data['feature_image'] = $img_data['file_name'];
                	
                }
        	}

        	// get the redirect out of the update data
        	$redirect_val = $this->input->post('redirection');
        	unset($post_data['redirection']);

        	// determine if we're doing the new_slug/url_title thing
        	// and redirection...
        	if ($new_slug)
        	{
        		// determine what they want to do about the old
        		// slug and if we should redirect.
        		switch ($redirect_val) {
        			case 'none':
        				// they're don't want redirection... bounce
        				break;
        			case '301' || '302':
        				// set_redirect($old_slug, $new_slug, type=posts|post, $code)
        				$this->ecore->set_redirect($data['post']['url_title'], $post_data['url_title'], 'post', $redirect_val);
        				break;
        			default:
        				// set_redirect($old_slug, $new_slug, type=posts|post, $code)
        				$this->ecore->set_redirect($data['post']['url_title'], $post_data['url_title'], 'post', '301');
        				break;
        		}
        	}

        	// do the update
        	if ($this->PostModel->update_post($id, $post_data))
        	{
        		// succeeded
        		$this->session->set_flashdata('success', 'post updated successfully');
				redirect('admin/posts');
        	}
        	// failed
        	$data['message'] = 'Could not update post.  Please try again.';
			$this->template->load('base_admin', 'admin/posts/edit_post', $data); 
        }
        $this->template->load('base_admin', 'admin/posts/edit_post', $data);    

	}

	public function remove_post($id)
	{
		// remove the post
		if ($this->PostModel->remove_post($id))
		{
			//it worked
			$this->session->set_flashdata('success', 'Post removed successfully');
			redirect('admin/posts');
		}
		// failed to remove
		$this->session->set_flashdata('error', 'Could not remove post.  Please try again.');
		redirect('admin/posts');
	}
}