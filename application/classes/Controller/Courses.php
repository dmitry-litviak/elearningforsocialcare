<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Courses extends My_Layout_User_Logged_Controller {

    public function before() {
        parent::before();
        Helper_Mainmenu::setActiveItem('courses');
    }

    public function action_index() {
        $data['courses'] = ORM::factory('Course')->find_all();
        $this->setTitle('Courses')
                ->view('courses/index', $data)
                ->render();
    }

    public function action_take() {
        if ($this->request->param('id')) {
            $data['course'] = ORM::factory('Course', $this->request->param('id'));
            $this->setTitle('Courses')
                    ->view('courses/take', $data)
                    ->render();
        } else {
            $this->redirect('courses');
        }
    }

}

// End Home Controller
