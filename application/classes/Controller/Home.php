<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends My_Layout_User_Controller {

    public function action_index()
    {
        $this->setTitle('Home Page')
                ->view('home/index')
                ->render();
    }

} // End Home Controller
