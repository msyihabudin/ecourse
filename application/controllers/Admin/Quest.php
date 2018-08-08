<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quest extends CI_Controller {

	public function index() {
		is_login();
		$this->load->model('questmodel');
		$data['title'] = "Quest Courses";
		$data['quests'] = $this->questmodel->getAllQuest()->result();
		$this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Quest Courses', base_url('admin/quest'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

		$this->template->load('base_admin', 'admin/quest/quest', $data);
    }
}
