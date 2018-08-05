<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

     public function __construct()
     {
          parent::__construct();

          $this->load->model('PageModel');
          
          $this->load->helper('form');

          $this->load->library('form_validation');

          $this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');


     }

     public function index()
     {
          is_login();
          $data['title'] = "Pages";
          // get all pages
          $data['pages'] = $this->PageModel->get_pages();

          $this->mybreadcrumb->add('Home', base_url('admin'));
          $this->mybreadcrumb->add('Pages', base_url('admin/pages'));
          $data['breadcrumbs'] = $this->mybreadcrumb->render();
          
          $this->template->load('base_admin', 'admin/pages/index', $data);
     }

     public function add_page()
     {    
          $data['title'] = "Add New Page";
          // get all pages
          $data['pages'] = $this->PageModel->get_pages();

          $this->mybreadcrumb->add('Home', base_url('admin'));
          $this->mybreadcrumb->add('Pages', base_url('admin/pages'));
          $this->mybreadcrumb->add('Add New Page', base_url('admin/pages/add_page'));
          $data['breadcrumbs'] = $this->mybreadcrumb->render();
          
          // submitting attempt of the form?
          if ($this->input->post())
          {

               $this->form_validation->set_rules('title', 'Page Title', 'required');
               $this->form_validation->set_rules('status', 'Status', 'required|in_list[active,inactive]');
               $this->form_validation->set_rules('content', 'Page Content', 'required');
               
               // default, we need to build the
               // url_title (slug) for them
               $build_slug = true;

               // Did an advanced user enter the url_title/slug?
               if ($this->input->post('url_title'))
               {    
                    // yup, so lets validate that...
                    $this->form_validation->set_rules('url_title', 'URL Title', 'required|alpha_dash|is_unique[pages.url_title]');
                    $build_slug = false;
               }
          }

          // did they pass validations?
          if ($this->form_validation->run() == TRUE)
          {
          // yes, so we'll start.
          $post_data = $this->input->post();

          // do we need to build the slug/url_title?
          if ($build_slug)
          {
               $config = [
                        'field' => 'url_title',
                        'title' => $post_data['title'],
                        'table' => 'pages'
                    ];

                    // since we're building it here
                    // load the slug library
               $this->load->library('slug', $config);

               // create the slug
               $post_data['url_title'] = $this->slug->create_uri($post_data['title']);
               
          }

          // determine if is_home should be set to 1 or 0
          // default is 0
          // 
          $post_data['is_home'] = 0;
          if ($this->input->post('is_home'))
          {
               $post_data['is_home'] = 1;
          }

          // get author info
          $post_data['author']     = $this->session->userdata('user_details')[0]->users_id;

          // the date
          $post_data['date']       = date('Y-m-d');

          // do the insert
          if ($this->PageModel->add_page($post_data))
          {
               // succeeded
               $this->session->set_flashdata('success', 'Page added successfully');
               redirect('admin/pages');
          }
          // failed
          $data['message'] = 'Could not add Page.  Please try again.';
          $this->template->load('base_admin', 'admin/pages/add_page', $data); 
          }

        // not submit attempt, build the page...
        $this->template->load('base_admin', 'admin/pages/add_page', $data);       
     }

     public function edit_page($id)
     {
          // get the current information
          // set in the page
          $data['page'] = $this->PageModel->get_page($id);

          $data['title'] = "Edit Page";

          $this->mybreadcrumb->add('Home', base_url('admin'));
          $this->mybreadcrumb->add('Pages', base_url('admin/pages'));
          $this->mybreadcrumb->add('Edit Page', base_url('admin/pages/edit_page/'.$id));
          $data['breadcrumbs'] = $this->mybreadcrumb->render();

          // form submit attempt?
          if ($this->input->post())
          {
               // yes

               // set default for changing url_title
               $new_slug = false;

               $this->form_validation->set_rules('title', 'Page Title', 'required');
               $this->form_validation->set_rules('status', 'Status', 'required|in_list[active,inactive]');
               $this->form_validation->set_rules('content', 'Page Content', 'required');
               
               // does the old url_title match the one from the form?
               if ($this->input->post('url_title') != $data['page']['url_title'])
               {    
                    // they do not, set $new_slug true
                    // and validation rules.
                    $new_slug = true;
                    $this->form_validation->set_rules('url_title', 'URL Title', 'required|alpha_dash|is_unique[pages.url_title]');
                    $this->form_validation->set_rules('redirection', 'Redirection', 'required|in_list[none,301,302]');
               }
          }

          // did they pass validations?
          if ($this->form_validation->run() == TRUE)
        {
          // yes, so we'll start updating.
          $post_data = $this->input->post();

          // get the redirect out of the update data
          $redirect_val = $this->input->post('redirection');
          unset($post_data['redirection']);

          // determine if is_home should be set to 1 or 0
          // default is 0
          $post_data['is_home'] = 0;
          if ($this->input->post('is_home'))
          {
               $post_data['is_home'] = 1;
          }

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
                         // set_redirect($old_slug, $new_slug, type=pages|post, $code)
                         $this->obcore->set_redirect($data['page']['url_title'], $post_data['url_title'], 'pages', $redirect_val);
                         break;
                    default:
                         // set_redirect($old_slug, $new_slug, type=pages|post, $code)
                         $this->obcore->set_redirect($data['page']['url_title'], $post_data['url_title'], 'pages', '301');
                         break;
               }
          }

          // do the update
          if ($this->PageModel->update_page($id, $post_data))
          {
               // succeeded
               $this->session->set_flashdata('success', 'Page updated successfully');
                    redirect('admin/pages');
          }
          // failed
          $data['message'] = 'Could not update Page.  Please try again.';
               $this->template->load('base_admin', 'admin/pages/edit_page', $data); 
        }
        $this->template->load('base_admin', 'admin/pages/edit_page', $data);    

     }

     public function remove_page($id)
     {
          // remove the page
          if ($this->PageModel->remove_page($id))
          {
               //it worked
               $this->session->set_flashdata('success', 'Page removed successfully');
               redirect('admin/pages');
          }
          // failed to remove
          $this->session->set_flashdata('error', 'Could not remove Page.  Please try again.');
          redirect('admin/pages');
     }

}
