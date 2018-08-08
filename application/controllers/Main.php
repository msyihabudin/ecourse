<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('coursemodel');
    }

	public function index() {
		$data['title'] = "Role Playing Code";

		$data['courses'] = json_decode($this->coursemodel->getMainPage());

		$this->template->load('base', 'main/index', $data);
	}

	public function about() {
		$data['title'] = "About";

		$this->template->load('base', 'main/about', $data);
		//$this->load->view('main/about', $data);
	}

	public function contact() {
		$data['title'] = "Contact";

		$this->template->load('base', 'main/contact', $data);
		//$this->load->view('main/about', $data);
	}
}
