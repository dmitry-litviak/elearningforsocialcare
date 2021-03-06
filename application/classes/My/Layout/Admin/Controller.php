<?php defined('SYSPATH') or die('No direct script access.');

class My_Layout_Admin_Controller extends My_Layout_Controller
{
        public function before()
	{
		parent::before();
                $auth = Auth::instance();
                if (!$auth->logged_in() || $auth->get_user()->roles->order_by('role_id', 'desc')->find()->name != 'admin' )
                        $this->redirect('');
                
                $this->logged_user = $auth->get_user();
                Helper_Adminsitebar::init(Kohana::$config->load('admin_menu')->as_array());
                Helper_Output::factory()
//                                        ->link_css('admin')
                                        ->link_css('main');
                
		$this->template = View::factory('layouts/admin');
                
	}
  
}