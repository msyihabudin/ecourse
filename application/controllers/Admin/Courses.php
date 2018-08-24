<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('coursemodel');
        $this->load->model('questmodel');
        //$this->load->library('mybreadcrumb');
    }

	public function index() {
        is_login();
        $data['title'] = "Courses Path";
        $data['data_courses'] = $this->coursemodel->getAllCourses()->result();
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Courses', base_url('admin/courses'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

		$this->template->load('base_admin', 'admin/courses/courses', $data);
    }

    public function path() {
        is_login();
        $id_course = $this->uri->segment(4);

        $data['title'] = "Courses Path";
        $data['course'] = $this->coursemodel->getCourses($id_course)->row_array();
        $data['data_path'] = $this->coursemodel->getAllPath($id_course)->result();
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Courses', base_url('admin/courses'));
        $this->mybreadcrumb->add('Courses Path', base_url('admin/courses/path/'.$id_course));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
                
        $this->template->load('base_admin', 'admin/courses/path', $data);
    }

    public function lesson() {
        is_login();
        $id_path = $this->uri->segment(5);

        $data['title'] = "Lessons";
        $data['path'] = $this->coursemodel->getPath($id_path)->row_array();
        $data['data_lesson'] = $this->coursemodel->getAllCourse($id_path)->result();
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Courses', base_url('admin/courses'));
        $this->mybreadcrumb->add('Courses Path', base_url('admin/courses/path/'.$data['path']['id_course']));
        $this->mybreadcrumb->add('Lessons', base_url('admin/courses/path/lesson/'.$id_path));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        
        $this->template->load('base_admin', 'admin/courses/lesson', $data);
    }

    public function add_course() {
        is_login();
        $data['title'] = "Add New Course";
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Courses', base_url('admin/courses'));
        $this->mybreadcrumb->add('Add New Courses', base_url('admin/courses/add'));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        $data['quest'] = $this->questmodel->getAllQuest()->result();

        $this->template->load('base_admin', 'admin/courses/add_course', $data);
    }

    public function add_path(){
        is_login();
        $id_course = $this->uri->segment(5);
        $data['title'] = "Add New Path";
        $data['course'] = $this->coursemodel->getCourses($id_course)->row_array();
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Courses', base_url('admin/courses'));
        $this->mybreadcrumb->add('Courses Path', base_url('admin/courses/path/'.$id_course));
        $this->mybreadcrumb->add('Add New Path', base_url('admin/courses/path/add/'.$id_course));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->template->load('base_admin', 'admin/courses/add_path', $data);
    }

    public function add_lesson(){
        is_login();
        $id_path = $this->uri->segment(6);
        $data['title'] = "Add Lesson";
        $data['path'] = $this->coursemodel->getPath($id_path)->row_array();
        $data['data_lesson'] = $this->coursemodel->getAllCourse($id_path)->result();
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Courses', base_url('admin/courses'));
        $this->mybreadcrumb->add('Courses Path', base_url('admin/courses/path/'.$data['path']['id_course']));
        $this->mybreadcrumb->add('Lessons', base_url('admin/courses/path/lesson/'.$id_path));
        $this->mybreadcrumb->add('Add Lesson', base_url('admin/courses/path/lesson/add/'.$id_path));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->template->load('base_admin', 'admin/courses/add_lesson', $data);
    }

    public function save_course() {
        is_login();
        if (isset($_POST['add_course'])) {
            $config['upload_path'] = './assets/image/Badge/';
            $config['allowed_types'] = 'png|jpg';
            $config['max_size'] = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $data_course = array();
            if ($this->upload->do_upload('course_badge')) {
                $upload_data = $this->upload->data();

                $data_course['course_name'] = $this->input->post('name');
                $data_course['description'] = $this->input->post('description');
                $data_course['price'] = $this->input->post('price');
                $data_course['id_quest'] = $this->input->post('id_quest');
                $data_course['course_badge'] = site_url().$config['upload_path'].$upload_data['file_name'];
                $data_course['enroll_url'] = 'courses/'.$this->input->post('enroll_url');

                if ($this->db->insert('course', $data_course)) {
                    $insert_id = $this->db->insert_id();
                    $data_badge = array(
                        'id' => $insert_id,
                        'nama_badge' => $this->input->post('name').' Badge',
                        'img' => site_url().$config['upload_path'].$upload_data['file_name']
                    );

                    $this->db->insert('badge', $data_badge);

                    $this->session->set_flashdata('messagePr', 'Your data added Successfully..');
                    redirect( base_url().'admin/courses', 'refresh');
                }else{
                    $this->session->set_flashdata('messagePr', 'Cannot save data!');
                    redirect( base_url().'admin/courses', 'refresh');
                }
            }else{
                $error = array('error' => $this->upload->display_errors());
                //$this->template->load('base_admin', 'admin/courses/courses', $error);
                foreach ($error as $value) {
                    $this->session->set_flashdata('messagePr', $value);    
                }
                
                redirect( base_url().'admin/courses', 'refresh'); 
            }                      
        }
        else {
            $this->session->set_flashdata('messagePr', 'Error save data!');
            redirect( base_url().'admin/courses', 'refresh'); 
        }
    }

    public function upload() {
        if (isset($_POST['upload_file'])) {
            $config['upload_path'] = 'assets/image/Images/';
            $config['allowed_types'] = 'png|jpg ';
            $config['max_size'] = '1000';
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('file')) {
                $upload_data = $this->upload->data();
            }

            $url = $this->input->post('url');
            redirect('quest');
        }
        else {
            redirect('quest');
        }
    }

    public function edit_course() {
        is_login();
        $id_course = $this->uri->segment(4);
        $data['title'] = "Edit course";
        $data['course'] = $this->coursemodel->getCourses($id_course)->row_array();
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Courses', base_url('admin/courses'));
        $this->mybreadcrumb->add('Edit Courses', base_url('admin/courses/edit/'.$id_course));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();
        $data['quest'] = $this->questmodel->getAllQuest()->result();

        $this->template->load('base_admin', 'admin/courses/edit_course', $data);
    }

    public function save_edit_course() {
        is_login();

        if (isset($_POST['save_edit'])) {
            $config['upload_path'] = './assets/image/Badge/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['max_size'] = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            $data_course = array();
            if ($this->upload->do_upload('course_badge') || $_FILES['course_badge']['size'] == 0) {
                $upload_data = $this->upload->data();
                $id = $this->input->post('id_course');

                $checkbadge = $this->coursemodel->getCourses($id)->row_array();

                $data_course = array(
                    'course_name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'price' => $this->input->post('price'),
                    'id_quest' => $this->input->post('id_quest'),
                    'course_badge' => ($_FILES['course_badge']['size'] == 0) ? $checkbadge['course_badge'] : site_url().$config['upload_path'].$upload_data['file_name'],
                    'enroll_url' => 'courses/'.$this->input->post('enroll_url')
                );
        
                $this->db->where('id_course', $id);
                if ($this->db->update('course', $data_course)) {
                    $data_badge = array(
                        'nama_badge' => $this->input->post('name').' Badge',
                        'img' => ($_FILES['course_badge']['size'] == 0) ? $checkbadge['course_badge'] : site_url().$config['upload_path'].$upload_data['file_name']
                    );
                    $this->db->where('id', $id);
                    $this->db->update('badge', $data_badge);

                    $this->session->set_flashdata('messagePr', 'Your data updated Successfully..');
                    redirect( base_url().'admin/courses', 'refresh');
                } else {
                    $this->session->set_flashdata('messagePr', 'Cannot update data!');
                    redirect( base_url().'admin/courses', 'refresh');
                }
            }else{
                $error = array('error' => $this->upload->display_errors());
                //$this->template->load('base_admin', 'admin/courses/courses', $error);
                foreach ($error as $value) {
                    $this->session->set_flashdata('messagePr', $value);    
                }
                
                redirect( base_url().'admin/courses', 'refresh'); 
            }        
        }
        else {
            $this->session->set_flashdata('messagePr', 'Error update data!');
            redirect( base_url().'admin/courses', 'refresh');
        }
    }

    public function save_path() {
        is_login();
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
        is_login();
        $id_course_path = $this->uri->segment(5);
        $data['title'] = "Edit Course Path";
        $data['path'] = $this->coursemodel->getPath($id_course_path)->row_array();
        //rint_r($data['path']);
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Courses', base_url('admin/courses'));
        $this->mybreadcrumb->add('Courses Path', base_url('admin/courses/path/'.$data['path']['id_course']));
        $this->mybreadcrumb->add('Edit Course Path', base_url('admin/courses/path/edit/'.$id_course_path));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->template->load('base_admin', 'admin/courses/edit_path', $data);
    }

    public function save_edit_path() {
        is_login();
        if (isset($_POST['save_edit_path'])) {
            $id = $this->input->post('id_course_path');
            $data_path = array(
                'title_path' => $this->input->post('title'),
                'description' => $this->input->post('description')
            );
            print_r($id);
    
            $this->db->where('id_course_path', $id);
            if ($this->db->update('course_path', $data_path)) {
                $this->session->set_flashdata('messagePr', 'Your data updated Successfully..');
                redirect( base_url().'admin/courses/path/'.$this->input->post('id_course'), 'refresh');
            } else {
                $this->session->set_flashdata('messagePr', 'Cannot update data!');
                redirect( base_url().'admin/courses/path/'.$this->input->post('id_course'), 'refresh');
            }            
        } else {
            $this->session->set_flashdata('messagePr', 'Error update data!');
            redirect( base_url().'admin/courses/path/'.$this->input->post('id_course'), 'refresh');
        }            
    }

    public function save_lesson() {
        is_login();
        if (isset($_POST['add_lesson'])) {
            $config['upload_path'] = 'uploads/file/';
            $config['allowed_types'] = 'doc|docx|pdf|ppt|pptx';
            $config['max_size'] = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $id = $this->input->post('id_course_path');
            $data_lesson = array();
            if ($this->upload->do_upload('course_lesson_file')) {
                $upload_data = $this->upload->data();
                
                $data_lesson['id_course_path'] = $id;
                $data_lesson['name_lesson'] = $this->input->post('name');
                $data_lesson['description'] = $this->input->post('description');
                $data_lesson['course_lesson_url'] = $this->input->post('course_lesson_url');
                $data_lesson['course_lesson_file'] = site_url().$config['upload_path'].$upload_data['file_name'];

                if ($this->db->insert('course_lesson', $data_lesson)) {
                    $this->session->set_flashdata('messagePr', 'Your data added Successfully..');
                    redirect( base_url().'admin/courses/path/lesson/'.$id, 'refresh'); 
                }else{
                    $this->session->set_flashdata('messagePr', 'Cannot save data!');
                    redirect( base_url().'admin/courses/path/lesson/'.$id, 'refresh'); 
                }
            }else{
                $error = array('error' => $this->upload->display_errors());
                foreach ($error as $value) {
                    $this->session->set_flashdata('messagePr', $value);    
                }                
                redirect( base_url().'admin/courses/path/lesson/'.$id, 'refresh'); 
            }
        } else {
            $this->session->set_flashdata('messagePr', 'Error save data!');
            redirect( base_url().'admin/courses/path/lesson/'.$id, 'refresh'); 
        }        
    }

    public function edit_lesson() {
        is_login();
        $id_course_lesson = $this->uri->segment(6);
        $data['title'] = "Edit Lesson";
        $data['lesson'] = $this->coursemodel->getLesson($id_course_lesson)->row_array();
        $data['path'] = $this->coursemodel->getPath($data['lesson']['id_course_path'])->row_array();
        $this->mybreadcrumb->add('Home', base_url('admin'));
        $this->mybreadcrumb->add('Courses', base_url('admin/courses'));
        $this->mybreadcrumb->add('Courses Path', base_url('admin/courses/path/'.$data['path']['id_course']));
        $this->mybreadcrumb->add('Lessons', base_url('admin/courses/path/lesson/'.$data['lesson']['id_course_path']));
        $this->mybreadcrumb->add('Edit Lesson', base_url('admin/courses/path/lesson/edit/'.$id_course_lesson));
        $data['breadcrumbs'] = $this->mybreadcrumb->render();

        $this->template->load('base_admin', 'admin/courses/edit_lesson', $data);
    }

    public function save_edit_lesson() {
        is_login();
        $id_lesson = $this->input->post('id_course_lesson');
        if (isset($_POST['save_edit_lesson'])) {
            $config['upload_path'] = 'uploads/file/';
            $config['allowed_types'] = 'doc|docx|pdf|ppt|pptx';
            $config['max_size'] = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $id = $this->input->post('id_course_path');
            $data_lesson = array();
            if ($this->upload->do_upload('course_lesson_file') || $_FILES['course_lesson_file']['size'] == 0) {
                $upload_data = $this->upload->data();                

                $file = $this->coursemodel->getLesson($id_lesson)->row_array();

                $data_lesson = array(
                    'name_lesson' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'course_lesson_url' => $this->input->post('course_lesson_url'),
                    'course_lesson_file' => ($_FILES['course_lesson_file']['size'] == 0) ? $file['course_lesson_file'] : site_url().$config['upload_path'].$upload_data['file_name']
                );
        
                $this->db->where('id_course_lesson', $id_lesson);                

                if ($this->db->update('course_lesson', $data_lesson)) {
                    $this->session->set_flashdata('messagePr', 'Your data updated Successfully..');
                    redirect('admin/courses/path/lesson/'.$id);
                }else{
                    $this->session->set_flashdata('messagePr', 'Cannot save data!');
                    redirect('admin/courses/path/lesson/'.$id);
                }
             }else{
                $error = array('error' => $this->upload->display_errors());
                foreach ($error as $value) {
                    $this->session->set_flashdata('messagePr', $value);    
                }                
                redirect( base_url().'admin/courses/path/lesson/'.$id, 'refresh'); 
            }
        } else {
            $this->session->set_flashdata('messagePr', 'Error save data!');
            redirect( base_url().'admin/courses/path/lesson/'.$id, 'refresh'); 
        }
    }

    public function remove_course($id)
    {
        // remove the nav
        if ($this->coursemodel->remove_course($id))
        {
            //it worked
            $this->session->set_flashdata('messagePr', 'Course removed Successfully');
            redirect( base_url().'admin/courses', 'refresh');
        }
        // failed to remove
        $this->session->set_flashdata('messagePr', 'Unable to remove Course item. Please try again.');
        redirect( base_url().'admin/courses', 'refresh');
    }

    public function remove_path($id)
    {
        $idprev = $this->coursemodel->getPath($id)->row_array();
        //print_r($idprev['id_course']);
        // remove the nav
        if ($this->coursemodel->remove_path($id))
        {
            //it worked
            $this->session->set_flashdata('messagePr', 'Course Path removed Successfully');
            redirect( base_url().'admin/courses/path/'.$idprev['id_course'], 'refresh');
        }
        // failed to remove
        $this->session->set_flashdata('messagePr', 'Unable to remove Course Path item. Please try again.');
        redirect( base_url().'admin/courses/path/'.$idprev['id_course'], 'refresh');
    }

    public function remove_lesson($id)
    {
        $idprev = $this->coursemodel->getLesson($id)->row_array();
        print_r($idprev['id_course_path']);
        // remove the nav
        if ($this->coursemodel->remove_lesson($id))
        {
            //it worked
            $this->session->set_flashdata('messagePr', 'Lesson removed Successfully');
            redirect( base_url().'admin/courses/path/lesson/'.$idprev['id_course_path'], 'refresh');
        }
        // failed to remove
        $this->session->set_flashdata('messagePr', 'Unable to remove Lesson item. Please try again.');
        redirect( base_url().'admin/courses/path/lesson/'.$idprev['id_course_path'], 'refresh');
    }
}