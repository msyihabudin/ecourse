<?php 

class CourseModel extends CI_Model {

    function getCourses($id_course) {
        return $this->db->get_where('course', array('id_course'=>$id_course));
    }

    function getAllCourses() {
        return $this->db->get('course');
    }

    function getAllLessons() {
        return $this->db->get('course_lesson');
    }

    function getAllCurr() {
        return $this->db->get('course_path');
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

    function getNumOfEnroll() {
        $select = array(
            'course.id_course',
            'count(enroll_course.id_enroll_course) as NumOfEnroll'
        );
        $result = $this->db
                        ->select($select)
                        ->from('course, enroll_course')
                        ->where('course.id_course = enroll_course.id_course')
                        ->group_by('course.id_course')
                        ->get()
                        ->result_array();

        $NumOfEnroll = array();
        foreach ($result as $num) {
            $NumOfEnroll[$num['id_course']] = $num['NumOfEnroll'];
        }

        return $NumOfEnroll;
    }

    function getMainPage() {
        $courses =  $this->getAllCourses()->result();
        $NumOfLesson = $this->getNumOfLesson();        

        $data = array();
        foreach ($courses as $key=>$Course) {
            $idNumOfLesson = (!empty($NumOfLesson[$Course->id_course])) ? $NumOfLesson[$Course->id_course] : 0;
            $student = count($this->getNumofStudent($Course->id_course));
            $row = array(
                'id' => $Course->id_course,
                'name' => $Course->course_name,
                'NumOfLesson' => $idNumOfLesson,
                'description' => $Course->description,
                'enrollUrl' => $Course->enroll_url,
                'courseBadge' => $Course->course_badge,
                'student' => $student,
                'price' => ($Course->price > 0) ? 'IDR'.$Course->price : 'Free'
            );
            array_push($data, $row);
            $row = array();            
        }

        return json_encode($data);
    }

    function getHomeMainPage() {
        $courses =  $this->getTopCourse()->result();

        $NumOfLesson = $this->getNumOfLesson();        

        $data = array();
        foreach ($courses as $key=>$Course) {
            $idNumOfLesson = (!empty($NumOfLesson[$Course->id_course])) ? $NumOfLesson[$Course->id_course] : 0;
            $student = count($this->getNumofStudent($Course->id_course));
            $row = array(
                'id' => $Course->id_course,
                'name' => $Course->course_name,
                'NumOfLesson' => $idNumOfLesson,
                'description' => $Course->description,
                'enrollUrl' => $Course->enroll_url,
                'courseBadge' => $Course->course_badge,
                'student' => $student,
                'price' => ($Course->price > 0) ? 'IDR'.$Course->price : 'Free'
            );
            array_push($data, $row);
            $row = array();            
        }

        return json_encode($data);
    }

    function getTopCourse() {
        $select = array(
            'course.id_course', 'course.course_name', 'course.description', 'course.course_badge', 
            'course.enroll_url', 'course.id_quest', 'course.price', 'count(*) AS NumOfStudents'
        );
        $result = $this->db
                        ->select($select)
                        ->from('course')
                        ->join('enroll_course', 'course.id_course = enroll_course.id_course')
                        ->group_by('course.id_course', 'course.course_name')
                        ->order_by('NumOfStudents', 'desc')
                        ->limit(6)
                        ->get();
        return $result;
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
        $course_lesson = $this->db->get_where('course_lesson', array('id_course_path'=>(!empty($path[0]->id_course_path)) ? $path[0]->id_course_path : 0))->result();

        foreach ($path as $p) {
            foreach ($course_lesson as $c) {
                $row = array(
                    'courseName' => $c->name_lesson,
                    'description' => $c->description,
                    'courseUrl' => $c->course_lesson_url,
                    'courseBadge' => $c->course_lesson_file
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
        $category = $this->getCategory($Course['id_quest']);
        $student = count($this->getNumofStudent($Course['id_course']));

        $data_Course = array(
            'idcourse' => $Course['id_course'],
            'name' => $Course['course_name'],
            'description' => $Course['description'],
            'enrollUrl' => $Course['enroll_url'],
            'courseFile' => $course_lesson[0]->course_lesson_url,
            'courseBadge' => $Course['course_badge'],
            'NumOfLesson' => $idNumOfLesson,
            'student' => $student,
            'path' => (!empty($data_path)) ? $data_path : array(),
            'category' => $category['quest_name'],
            'price' => ($Course['price'] > 0) ? 'IDR'.$Course['price'] : 'Free'
        );

        array_push($data, $data_Course);

        return json_encode($data);
    }

    function getCategory($id) {
        return $this->db->get_where('quest', array('id'=>$id))->row_array();
    }

    function getNumofStudent($id) {
        return $this->db->get_where('enroll_course', array('id_course' => $id))->result();
    }

    public function insertRow($table, $data){
        $this->db->insert($table, $data);
        return  $this->db->insert_id();
    }

    public function remove_course($id)
    {       
        return $this->db->delete('course', ['id_course' => $id]);
    }

    public function remove_path($id)
    {       
        return $this->db->delete('course_path', ['id_course_path' => $id]);
    }

    public function remove_lesson($id)
    {       
        return $this->db->delete('course_lesson', ['id_course_lesson' => $id]);
    }

    function getSearchItems($search_data) {
        $this->db->select('id_course, course_name, description, id_quest, enroll_url, course_badge, price');
        $this->db->from('course');
        //$this->db->group_start();
        if ($search_data['id_quest'] != 'All') {
            $this->db->where('id_quest = '. $search_data['id_quest']);

            if (!empty($search_data['keyword'])) {
                $this->db->where("(course_name like '%".$search_data['keyword']."%' or description like '%".$search_data['keyword']."%')");
            }
        } else {
            if (!empty($search_data['keyword'])) {
                $this->db->where("course_name like '%".$search_data['keyword']."%' or description like '%".$search_data['keyword']."%'");
            }
        }
        //$this->db->group_end();
        //$this->db->limit(10);
        $this->db->order_by("created_at", 'desc');
        $query = $this->db->get();

        $courses =  $query->result();
        $NumOfLesson = $this->getNumOfLesson();
        $NumOfEnroll = $this->getNumOfEnroll();

        //print_r($courses);    

        $data = array();
        if (!empty($courses)) {
            foreach ($courses as $key=>$Course) {
                $idNumOfLesson = (!empty($NumOfLesson[$Course->id_course])) ? $NumOfLesson[$Course->id_course] : 0;
                $student = count($this->getNumofStudent($Course->id_course));
                $row = array(
                    'id' => $Course->id_course,
                    'name' => $Course->course_name,
                    'NumOfLesson' => $idNumOfLesson,
                    'description' => $Course->description,
                    'enrollUrl' => $Course->enroll_url,
                    'courseBadge' => $Course->course_badge,
                    'student' => $student,
                    'price' => ($Course->price == 0) ? 'Free' : 'IDR'.$Course->price
                );
                array_push($data, $row);
                $row = array();            
            }
        }
        
        return json_encode($data);
    }

    function getOrder($users_id){
        $select = array(
            'course.id_course', 'course.course_name','course.price','user_items.user_item_id','user_items.user_id','user_items.item_id',
            'user_items.flag', 'order_items.order_id', 'order_items.order_item_name', 'order_items.status', 'order_items.total'
        );
        $result = $this->db
                        ->select($select)
                        ->from('course, user_items, order_items')
                        ->where('user_items.user_id = '.$users_id.' and user_items.item_id = course.id_course and order_items.order_item_id = user_items.user_item_id')
                        ->get()
                        ->result_array();

        return $result;
    }

    function getAllOrder(){
        $select = array(
            'course.id_course', 'course.course_name','course.price','user_items.user_item_id','user_items.user_id','user_items.item_id',
            'user_items.flag', 'order_items.order_id', 'order_items.order_item_name', 'order_items.status', 'order_items.total', 'order_items.created_at', 'order_items.is_edited', 'users.fullname'
        );
        $result = $this->db
                        ->select($select)
                        ->from('course, user_items, order_items, users')
                        ->where('user_items.item_id = course.id_course and order_items.order_item_id = user_items.user_item_id and user_items.user_id = users.users_id')
                        ->get()
                        ->result_array();

        return $result;
    }

    function getCheckout($users_id) {
        $select = array(
            'course.id_course',
            'course.course_name','course.price','user_items.user_item_id','user_items.user_id','user_items.item_id'
        );
        $result = $this->db
                        ->select($select)
                        ->from('course, user_items')
                        ->where('user_items.user_id = '.$users_id.' and user_items.item_id = course.id_course and user_items.flag = "cart"')
                        ->get()
                        ->result_array();

        return $result;
    }

    function deleteCart($id) {
        return $this->db->delete('user_items', ['user_item_id' => $id]);
    }

    function getOrderId($order_id) {
        //return $this->db->get_where('order_items', array('order_id'=>$order_id));
        $select = array(
            'course.id_course', 'course.course_name','course.price','user_items.user_item_id','user_items.user_id','user_items.item_id',
            'user_items.flag', 'order_items.order_id', 'order_items.order_item_name', 'order_items.status', 'order_items.total', 'order_items.created_at', 'order_items.is_edited', 'users.fullname', 'users.email'
        );
        $result = $this->db
                        ->select($select)
                        ->from('course, user_items, order_items, users')
                        ->where('user_items.item_id = course.id_course and order_items.order_item_id = user_items.user_item_id and user_items.user_id = users.users_id and order_items.order_id = '.$order_id.'')
                        ->get();

        return $result;
    }

    function getPaymentInfo($order_id) {
        return $this->db->get_where('order_confirm', array('order_id' => $order_id));
    }
}