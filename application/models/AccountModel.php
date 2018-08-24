<?php 

class AccountModel extends CI_Model {

    function checkPass($id, $password) {
        return $this->db->get_where('user', array('id_user'=>$id, 'password'=>$password));
    }

    function getKeepPlayingCourses($id_user) {
        $enroll = $this->db->get_where('enroll_course', array('id_user'=>$id_user))->result();

        $data = array();
        foreach ($enroll as $e) {
            $course = $this->db->get_where('course', array('id_course'=>$e->id_course))->result();
            $row = array(
                'id_user' => $e->id_user,
                'id_course' => $e->id_course,
                'enroll_status' => $e->enroll_status,
                'course_name' => $course[0]->course_name,
                'description' => $course[0]->description,
                'course_badge' => $course[0]->course_badge,
                'enroll_url' => $course[0]->enroll_url
            );
            array_push($data, $row);
            $row = array();
        }

        return json_encode($data);
    }

    function getKeepPlayingQuest($id_user) {
        $enroll = $this->db->get_where('enroll_lesson', array('id_user'=>$id_user))->result();

        $data = array();
        foreach ($enroll as $e) {
            $lesson = $this->db->get_where('lesson', array('id'=>$e->id_lesson))->result();
            $row = array(
                'id_user' => $e->id_user,
                'id_lesson' => $e->id_lesson,
                'enroll_status' => $e->enroll_status,
                'name' => $lesson[0]->lesson_name,
                'img' => $lesson[0]->img,
                'enroll_url' => $lesson[0]->enroll_url
            );
            array_push($data, $row);
            $row = array();
        }

        return json_encode($data);
    }

    function getBadges($id_user) {
        $result = $this->db->get_where('badgenuser', array('id_user'=>$id_user))->result();
        $data = array();
        foreach ($result as $r) {
            $badges = $this->db->get_where('badge', array('id'=>$r->id_badge))->result();
            $row = array(
                'id_badge' => $r->id_badge,
                'img' => $badges[0]->img,
                'nama_badge' => $badges[0]->nama_badge
            );
            array_push($data, $row);
            $row = array();
        }
        
        return json_encode($data);
    }
}