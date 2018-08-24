<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('coursemodel');
        $this->load->model('navigationmodel');
        $this->load->model('usersmodel');
        $this->load->model('questmodel');
        $this->load->model('postmodel');
        $this->load->library('email');
    }

	public function index() {
		$data['title'] = "ECourse";

		$data['courses'] = json_decode($this->coursemodel->getHomeMainPage());
		$data['lessons'] = $this->coursemodel->getAllLessons()->result();
		$data['curr'] = $this->coursemodel->getAllLessons()->result();
		$data['students'] = $this->usersmodel->getUserStudent();
		$data['navs'] = $this->navigationmodel->get_navs();
		$data['quest'] = $this->questmodel->getAllQuest()->result();
		$data['site_name'] = $this->db->get_where('settings', array('name' => 'site_name'))->row_array();
		$data['site_description'] = $this->db->get_where('settings', array('name' => 'site_description'))->row_array();
		$data['site_info1'] = $this->db->get_where('settings', array('name' => 'site_info1'))->row_array();
		$data['site_info2'] = $this->db->get_where('settings', array('name' => 'site_info2'))->row_array();
		$data['site_info3'] = $this->db->get_where('settings', array('name' => 'site_info3'))->row_array();
		$data['site_info4'] = $this->db->get_where('settings', array('name' => 'site_info4'))->row_array();
		$data['popular_course'] = $this->db->get_where('settings', array('name' => 'popular_course'))->row_array();
		$data['register_now'] = $this->db->get_where('settings', array('name' => 'register_now'))->row_array();
		$data['upcoming_events'] = $this->db->get_where('settings', array('name' => 'upcoming_events'))->row_array();
		$data['latest_news'] = $this->db->get_where('settings', array('name' => 'latest_news'))->row_array();

		$bignews = $this->postmodel->get_home_bignews();
		$news = $this->postmodel->get_home_news();
		$events = $this->postmodel->get_home_events();

		//print_r($news);

		$data['bignews']= ($bignews && $bignews->posts)? $bignews->posts : '';
		$data['news']= ($news && $news->posts)? $news->posts : '';
		$data['events']= ($events && $events->posts)? $events->posts : '';

		$this->template->load('base', 'main/index', $data);
	}

	public function about() {
		$data['title'] = "About";

		$data['site_name'] = $this->db->get_where('settings', array('name' => 'site_name'))->row_array();
		$data['site_description'] = $this->db->get_where('settings', array('name' => 'site_description'))->row_array();
		$data['our_stories'] = $this->db->get_where('settings', array('name' => 'our_stories'))->row_array();
		$data['our_vision'] = $this->db->get_where('settings', array('name' => 'our_vision'))->row_array();
		$data['our_mision'] = $this->db->get_where('settings', array('name' => 'our_mision'))->row_array();

		$this->template->load('base', 'main/about', $data);
		//$this->load->view('main/about', $data);
	}

	public function contact() {
		$data['title'] = "Contact";

		$this->template->load('base', 'main/contact', $data);
		//$this->load->view('main/about', $data);
	}

	public function blog() {
		$data['title'] = "Blogs";

		$blogs = $this->postmodel->get_blogs();

		$data['blogs']= ($blogs && $blogs->posts)? $blogs->posts : '';

		$this->template->load('base', 'main/blog', $data);
	}

	public function blog_view($url = NULL) {
		$data['title'] = "News Details";

		$data['blog']= $this->postmodel->get_blogs_details($url);
		$data['courses'] = json_decode($this->coursemodel->getHomeMainPage());

		$this->template->load('base', 'main/blog_details', $data);	
	}

	public function news() {
		$data['title'] = "News";

		$news = $this->postmodel->get_news();

		$data['news']= ($news && $news->posts)? $news->posts : '';

		$this->template->load('base', 'main/news', $data);
	}

	public function news_view($url = NULL) {
		$data['title'] = "News Details";

		$data['news']= $this->postmodel->get_news_details($url);
		$data['courses'] = json_decode($this->coursemodel->getHomeMainPage());

		$this->template->load('base', 'main/news_details', $data);	
	}

	public function event_view($url = NULL) {
		$data['title'] = "Event Details";

		$data['event']= $this->postmodel->get_event_details($url);
		$data['courses'] = json_decode($this->coursemodel->getHomeMainPage());

		$this->template->load('base', 'main/event_details', $data);	
	}

	// send information
    public function send() {
        $this->load->library('form_validation');

        $admin_email = $this->db->get_where('settings', array('name' => 'admin_email'))->row_array();
        $site_name = $this->db->get_where('settings', array('name' => 'site_name'))->row_array();

        // field name, error message, validation rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required');     
        $this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('comment', 'Message', 'trim|required');
                   
        if($this->form_validation->run() == FALSE) {
          $this->index();
        } else {        
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $comment = $this->input->post('comment');            
            if(!empty($email)) {
                // send mail
                $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                );
                $message='';
                $bodyMsg = '<p style="font-size:14px;font-weight:normal;margin-bottom:10px;margin-top:0;">'.$comment.'</p>';   
                $delimeter = $name."<br>".$email;
                $dataMail = array('topMsg'=>'Hi Team', 'bodyMsg'=>$bodyMsg, 'thanksMsg'=>'Best regards,', 'delimeter'=> $delimeter);
 
                $this->email->initialize($config);
                $this->email->from($email, $name);
                $this->email->to($admin_email['value']);
                $this->email->subject('Contact Form');
                $message = $this->load->view('mail/contactForm', $dataMail, TRUE);
                $this->email->message($message);
                $this->email->send();
 
                // confirm mail
                $bodyMsg = '<p style="font-size:14px;font-weight:normal;margin-bottom:10px;margin-top:0;">Thank you for contacting us.</p>';                 
                $dataMail = array('topMsg'=>'Hi '.$name, 'bodyMsg'=>$bodyMsg, 'thanksMsg'=>'Best regards,', 'delimeter'=> 'Team '.$site_name['value']);
 
                $this->email->initialize($config);
                $this->email->from($admin_email['value'], $site_name['value']);
                $this->email->to($email);
                $this->email->subject('Contact Form Confimation');
                $message = $this->load->view('mail/contactForm', $dataMail, TRUE);
                $this->email->message($message);
                $this->email->send();                
            }
            $this->session->set_flashdata('msg', 'Thank you for your message. It has been sent.');
            redirect('/contact');
        }
    }
}
