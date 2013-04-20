<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Test extends ORM {
    	protected $_has_many = array(
		'questions'	  	=> array('model' => 'Question'),
            );
} 
