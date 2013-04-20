<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Tests extends My_Layout_User_Logged_Controller {

    public function before() {
        parent::before();
        Helper_Mainmenu::setActiveItem('courses');
    }

    public function action_index() {
        Helper_Output::factory()->link_js('tests/index');
        if ($this->request->param('id')) {
            $data['test'] = ORM::factory('test', $this->request->param('id'));
            $data['questions'] = $data['test']->questions->find_all();
            $this->setTitle('Test')
                    ->view('tests/index', $data)
                    ->render();
        } else {
            $this->redirect('courses');
        }
    }
    
    public function action_result() {
        if ($this->request->post()) {
            $post = Helper_Output::clean($this->request->post());
            $questions = ORM::factory('Question')->where('test_id', '=', $post['test']['id'])->find_all();
            try {
                $result = 0;
                foreach ($questions as $key => $question) {
                    if ($question->answer == $post['answers'][$key]) {
                        $result++;
                    }
                }
                $percent = round(100 * $result / count($post['answers']), 2);
                $model = ORM::factory('Result')->where('test_id', '=', $post['test']['id'])->where('user_id', '=', $this->logged_user->id)->find();
                if (!$model->id) {
                    $model = ORM::factory('Result');
                }
                $model->values(array(
                    'test_id' => $post['test']['id'],
                    'user_id' => $this->logged_user->id,
                    'score'   => $percent
                ));
                $model->save();
                Library_Mail::factory()
                            ->setFrom(array('0' => 'noreply@elearningforsocialcare.co.uk'))
                            ->setTo(array('0' => $this->logged_user->email))
                            ->setSubject('Test Passed')
                            ->setView('mail/test', array(
                                'score' => $percent,
                                'user' => $this->logged_user,
                                'test' => ORM::factory('Test', $post['test']['id'])
                            ))
                            ->send();
                $this->redirect('results');
            } catch (ORM_Validation_Exception $e) {
                Helper_Alert::setStatus('error');
                Helper_Alert::set_flash($e->errors('Result'));
            }
        } else {
            $this->redirect($this->request->referrer());
        }
    }

}

// End Home Controller
