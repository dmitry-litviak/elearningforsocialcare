<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Model_Course extends ORM {

    protected $_belongs_to = array(
        'test' => array(
            'model' => 'Test',
            'foreign_key' => 'test_id'
        )
    );

}

