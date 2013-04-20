<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Results extends My_Layout_User_Logged_Controller {

    public function before() {
        parent::before();
        Helper_Mainmenu::setActiveItem('results');
    }

    public function action_index() {
        $data['results'] = $this->logged_user->results->order_by('created_at', 'DESC')->find_all();
        $this->setTitle('Results')
                ->view('results/index', $data)
                ->render();
    }

}

// End Home Controller
