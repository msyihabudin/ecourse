<?php 

class QuestModel extends CI_Model {

    function getQuest($id_quest) {
        return $this->db->get_where('lesson', array('id'=>$id_quest));
    }

    function getLectureQuest($id_lecture) {
        return $this->db->get_where('lesson', array('id_lecture'=>$id_lecture));
    }

    function getAllQuest() {
        return $this->db->get('lesson');
    }

    function getQuestPath($id_quest) {
        return $this->db->get_where('lesson_detail', array('id'=>$id_quest));
    }

    function getAllLesson($id_quest_path) {
        return $this->db->get_where('lesson_detail', array('id_lesson'=>$id_quest_path));
    }

    function getEnrollStatus($id_user, $id_lesson) {
        return $this->db->get_where('enroll_lesson', array('id_lesson' => $id_lesson, 'id_user' => $id_user));
    }

    function getNumOfLesson() {
        $select = array(
            'lesson.id',
            'count(lesson_detail.id_lesson) as NumOfLesson'
        );
        $result = $this->db
                        ->select($select)
                        ->from('lesson, lesson_detail')
                        ->where('lesson.id = lesson_detail.id_lesson')
                        ->group_by('lesson.id')
                        ->get()
                        ->result_array();

        $NumOfLesson = array();
        foreach ($result as $num) {
            $NumOfLesson[$num['id']] = $num['NumOfLesson'];
        }

        return $NumOfLesson;
    }

    function getMainPage() {
        $quests =  $this->getAllQuest()->result();
        $NumOfLesson = $this->getNumOfLesson();

        $data = array();
        foreach ($quests as $quest) {
            $row = array(
                'id' => $quest->id,
                'name' => $quest->lesson_name,
                'lecture' => $quest->id_lecture,
                'NumOfLesson' => $NumOfLesson[$quest->id],
                'description' => $quest->description,
                'status' => $quest->status,
                'enrollUrl' => $quest->enroll_url,
                'img' => $quest->img
            );
            array_push($data, $row);
            $row = array();
        }

        return json_encode($data);
    }

    function getQuestContent($url) {
        $quest = $this->db->get_where('lesson', array('enroll_url'=>$url))->row_array();
        $NumOfLesson = $this->getNumOfLesson();
        $lesson = $this->db->get_where('lesson_detail', array('id_lesson'=>$quest['id']))->result();

        $lecture = $this->db->get_where('lecture', array('id_lecture'=>$quest['id_lecture']))->row_array();

        $data = array();
        $data_lesson = array();
        foreach ($lesson as $c) {
            $row = array(
                'idlesson' => $c->id,
                'namelesson' => $c->detail_name,
                'description' => $c->keterangan,
                'img' => $c->img,
                'point' => $c->point,
                'status' => $c->status,
                'file' => $c->file
            );
            array_push($data_lesson, $row);
            $row = array();
        }

        $idNumOfLesson = (!empty($NumOfLesson[$lesson['id']])) ? $NumOfLesson[$lesson['id']] : 0;

        $data_quest = array(
            'id' => $quest['id'],
            'name' => $quest['lesson_name'],
            'description' => $quest['description'],
            'enrollUrl' => $quest['enroll_url'],
            'img' => $quest['img'],
            'NumOfLesson' => $idNumOfLesson,
            'lecture' => $lecture['name'],
            'lecturePhoto' => $lecture['photo_url'],
            'lessons' => $data_lesson
        );
        array_push($data, $data_quest);

        return json_encode($data);
    }
}