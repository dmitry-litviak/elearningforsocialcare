<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends My_Layout_User_Controller {

    public function action_index()
    {
        ChromePhp::log('Hello console!');
        ChromePhp::warn('something went wrong!');
        ChromePhp::info("gdfhdfh");
        ChromePhp::error("sadadasd");
        ChromePhp::group("sfdfsdf");
        $this->setTitle('Home Page')
                ->view('home/index')
                ->render();
    }

} // End Home Controller
