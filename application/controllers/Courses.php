<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('coursemodel');
    }

	public function index() {
		$data['title'] = "Courses Path";

		$data['courses'] = json_decode($this->coursemodel->getMainPage());

		$this->template->load('base', 'courses/index', $data);
	}

	public function content() {
		$this->load->model('usersmodel');
		$title = str_replace("courses/", "", uri_string());

		$data['title'] = $title;

		$newurl = explode(base_url(), current_url())[1];

		$data['content'] = json_decode($this->coursemodel->getCourseContent($newurl));
		//print_r($newurl);

		if (isset($this->session->userdata['user_signed_in'])) {
			$email = $this->session->userdata['user_signed_in']['email'];
			$user = $this->usersmodel->getUser($email)->row_array();
			$user_data = $this->coursemodel->getEnrollStatus($user['id_user'], $data['content'][0]->idcourse)->row_array();
			$users = array(
				'id_user' => $user['id_user'],
				'id_course' => $data['content'][0]->idcourse
			);
			$data['user'] = $users;
			$data['enroll'] = $user_data;
		}

		$this->template->load('base', 'courses/course-content', $data);
	}

	public function enroll($id_user, $id_course) {
		$enroll_data = array(
			'id_course' => $id_course,
			'id_user' => $id_user,
			'enroll_status' => true
		);
		$enroll_course = $this->coursemodel->getEnrollStatus($id_user, $id_course)->row_array();

		if ($enroll_course != null) {
			$this->db->where('id_enroll_course', $enroll_course['id_enroll_course']);
			$this->db->update('enroll_course', $enroll_data);
		}
		else {
			$data = array(
				'id_badge' => $id_course,
				'id_user' => $id_user
			);
			$this->db->insert('enroll_course', $enroll_data);
			$this->db->insert('badgenuser', $data);
		}
		$result = $this->coursemodel->getCourses($id_course)->row_array();

		redirect($result['enroll_url']);
	}

	public function unenroll($id, $id_course, $status) {
		$enroll_data = array(
			'enroll_status' => false
		);

		$this->db->where('id_enroll_course', $id);
		$this->db->update('enroll_course', $enroll_data);
		$result = $this->coursemodel->getCourse($id_course)->row_array();

		redirect($result['enroll_url']);
	}

	public function download($content) {
		force_download('uploads/file/'.$content, NULL);
	}
}