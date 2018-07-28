<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('coursemodel');
    }

	public function index() {
        $data['title'] = "Courses Path";
        $data['data_courses'] = $this->coursemodel->getAllCourses()->result();

		$this->template->load('base_admin', 'admin/courses/courses', $data);
    }

    public function path() {
        $id_course = $this->uri->segment(4);

        $data['title'] = "Courses Path";
        $data['course'] = $this->coursemodel->getCourses($id_course)->row_array();
        $data['data_path'] = $this->coursemodel->getAllPath($id_course)->result();
        
        $this->template->load('base_admin', 'admin/courses/path', $data);
    }

    public function lesson() {
        $id_path = $this->uri->segment(5);

        $data['title'] = "Path Lesson";
        $data['path'] = $this->coursemodel->getPath($id_path)->row_array();
        $data['data_lesson'] = $this->coursemodel->getAllCourse($id_path)->result();
        
        $this->template->load('base_admin', 'admin/courses/lesson', $data);
    }

    public function add_course() {
        if (isset($_POST['add_course'])) {
            $config['upload_path'] = 'assets/image/Badge/';
            $config['allowed_types'] = 'png|jpg ';
            $config['max_size'] = '1000';
            $this->load->library('upload', $config);

            $data_course = array();
            if ($this->upload->do_upload('course_badge')) {
                $upload_data = $this->upload->data();
                
                $data_course['course_name'] = $this->input->post('name');
                $data_course['description'] = $this->input->post('description');
                $data_course['course_badge'] = site_url().$config['upload_path'].$upload_data['file_name'];
                $data_course['enroll_url'] = $this->input->post('enroll_url');

                $this->db->insert('course', $data_course);
            }

            redirect('admin/courses');
        }
        else {
            redirect('admin/courses');
        }
    }

    public function edit_course() {
        $id_course = $this->uri->segment(4);
        $data['title'] = "Edit course";
        $data['course'] = $this->coursemodel->getCourses($id_course)->row_array();

        $this->template->load('base_admin', 'admin/courses/edit_course', $data);
    }

    public function save_edit_course() {
        if (isset($_POST['save_edit'])) {
            $id = $this->input->post('id_course');
            $data_course = array(
                'course_name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'enroll_url' => $this->input->post('enroll_url')
            );
    
            $this->db->where('id_course', $id);
            $this->db->update('course', $data_course);
            redirect('admin/courses');
        }
        else {
            redirect('admin/courses');
        }
    }

    public function add_path() {
        if (isset($_POST['add_path'])) {
            $id = $this->input->post('id_course');

            $data_path = array(
                'id_course' => $id,
                'title_path' => $this->input->post('title'),
                'description' => $this->input->post('description')
            );
            
            $this->db->insert('course_path', $data_path);

            redirect('admin/courses/path/'.$id);
        }
        else {
            redirect('admin/courses/path/'.$id);
        }
    }

    public function edit_path() {
        $id_course_path = $this->uri->segment(5);
        $data['title'] = "Edit Course Path";
        $data['path'] = $this->coursemodel->getPath($id_course_path)->row_array();

        $this->template->load('base_admin', 'admin/courses/edit_path', $data);
    }

    public function save_edit_path() {
        if (isset($_POST['save_edit_path'])) {
            $id = $this->input->post('id_course_path');
            $data_path = array(
                'title_path' => $this->input->post('title'),
                'description' => $this->input->post('description')
            );
    
            $this->db->where('id_course_path', $id);
            $this->db->update('course_path', $data_path);
            redirect('admin/courses/path/'.$this->input->post('id_course'));
        }
        else {
            redirect('admin/courses/path/'.$this->input->post('id_course'));
        }
    }

    public function add_lesson() {
        if (isset($_POST['add_lesson'])) {
            $config['upload_path'] = 'assets/image/Course/';
            $config['allowed_types'] = 'png|jpg ';
            $config['max_size'] = '1000';
            $this->load->library('upload', $config);

            $id = $this->input->post('id_course_path');
            $data_lesson = array();
            if ($this->upload->do_upload('course_lesson_badge')) {
                $upload_data = $this->upload->data();
                
                $data_lesson['id_course_path'] = $id;
                $data_lesson['course_name'] = $this->input->post('name');
                $data_lesson['description'] = $this->input->post('description');
                $data_lesson['course_lesson_url'] = $this->input->post('course_lesson_url');
                $data_lesson['course_lesson_badge'] = site_url().$config['upload_path'].$upload_data['file_name'];

                $this->db->insert('course_lesson', $data_lesson);
            }

            redirect('admin/courses/path/lesson/'.$id);
        }
        else {
            redirect('admin/courses/path/lesson/'.$id);
        }
    }

    public function edit_lesson() {
        $id_course_lesson = $this->uri->segment(6);
        $data['title'] = "Edit Lesson Path";
        $data['lesson'] = $this->coursemodel->getLesson($id_course_lesson)->row_array();

        $this->template->load('base_admin', 'admin/courses/edit_lesson', $data);
    }

    public function save_edit_lesson() {
        if (isset($_POST['save_edit_course'])) {
            $id = $this->input->post('id_course_lesson');
            $data_course = array(
                'name_course' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'course_lesson_url' => $this->input->post('course_lesson_url')
            );
    
            $this->db->where('id_course_lesson', $id);
            $this->db->update('course_lesson', $data_course);
            redirect('admin/courses/path/lesson/'.$this->input->post('id_course_path'));
        }
        else {
            redirect('admin/courses/path/lesson/'.$this->input->post('id_course_path'));
        }
    }
}