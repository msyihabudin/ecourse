<?php 

class CourseModel extends CI_Model {

    function getCourses($id_course) {
        return $this->db->get_where('course', array('id_course'=>$id_course));
    }

    function getAllCourses() {
        return $this->db->get('course');
    }

    function getAllPath($id_course) {
        return $this->db->get_where('course_path', array('id_course'=>$id_course));
    }

    function getPath($id_course_path) {
        return $this->db->get_where('course_path', array('id_course_path'=>$id_course_path));
    }

    function getAllCourse($id_course_path) {
        return $this->db->get_where('course_lesson', array('id_course_path'=>$id_course_path));
    }

    function getLesson($id_course_lesson) {
        return $this->db->get_where('course_lesson', array('id_course_lesson'=>$id_course_lesson));
    }

    function getEnrollStatus($id_user, $id_course) {
        return $this->db->get_where('enroll_course', array('id_course'=>$id_course ,'id_user'=>$id_user));
    }

    function getNumOfLesson() {
        $select = array(
            'course.id_course',
            'count(course_lesson.id_course_lesson) as NumOfLesson'
        );
        $result = $this->db
                        ->select($select)
                        ->from('course, course_path, course_lesson')
                        ->where('course.id_course = course_path.id_course and course_path.id_course_path = course_lesson.id_course_path')
                        ->group_by('course.id_course')
                        ->get()
                        ->result_array();

        $NumOfLesson = array();
        foreach ($result as $num) {
            $NumOfLesson[$num['id_course']] = $num['NumOfLesson'];
        }

        return $NumOfLesson;
    }

    function getMainPage() {
        $courses =  $this->getAllCourses()->result();
        $NumOfLesson = $this->getNumOfLesson();        

        $data = array();
        foreach ($courses as $key=>$Course) {
            $idNumOfLesson = (!empty($NumOfLesson[$Course->id_course])) ? $NumOfLesson[$Course->id_course] : 0;
            $row = array(
                'id' => $Course->id_course,
                'name' => $Course->course_name,
                'NumOfLesson' => $idNumOfLesson,
                'description' => $Course->description,
                'enrollUrl' => $Course->enroll_url,
                'courseBadge' => $Course->course_badge
            );
            array_push($data, $row);
            $row = array();            
        }

        return json_encode($data);
    }

    function getCourseContent($url) {
        $data = array();
        $data_course = array();
        $data_path = array();
        //print_r($url);
        $Course = $this->db->get_where('course', array('enroll_url'=>$url))->row_array();
        //print_r($course);
        
        $NumOfLesson = $this->getNumOfLesson();
        $path = $this->db->get_where('course_path', array('id_course'=>$Course['id_course']))->result();
        $course = $this->db->get_where('course_lesson', array('id_course_path'=>(!empty($path[0]->id_course_path)) ? $path[0]->id_course_path : 0))->result();

        foreach ($path as $p) {
            foreach ($course as $c) {
                $row = array(
                    'courseName' => $c->name_lesson,
                    'description' => $c->description,
                    'courseUrl' => $c->course_lesson_url,
                    'courseBadge' => $c->course_lesson_badge
                );
                array_push($data_course, $row);
                $row = array();
            }
            $rowp = array(
                'titlePath' => $p->title_path,
                'description' => $p->description,
                'courses' => $data_course
            );
            array_push($data_path, $rowp);
            $rowp = array();
            $data_course = array();
        }

        $idNumOfLesson = (!empty($NumOfLesson[$Course['id_course']])) ? $NumOfLesson[$Course['id_course']] : 0;

        $data_Course = array(
            'idcourse' => $Course['id_course'],
            'name' => $Course['course_name'],
            'description' => $Course['description'],
            'enrollUrl' => $Course['enroll_url'],
            'courseFile' => $Course['course_file'],
            'courseBadge' => $Course['course_badge'],
            'NumOfLesson' => $idNumOfLesson,
            'path' => (!empty($data_path)) ? $data_path : array()
        );
        array_push($data, $data_Course);

        return json_encode($data);
    }
}