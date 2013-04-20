<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Tests extends My_Layout_Admin_Controller {

    public function before() {
        parent::before();
        Helper_AdminSiteBar::setActiveItem('tests');
    }

    public function action_index() {
        Helper_Output::factory()
                ->link_js('libs/jquery.dataTables.min')
                ->link_js('libs/jquery.dataTables.pagination')
                ->link_js('admin/tests/index');
        $this->setTitle('Tests')
                ->view('admin/tests/index')
                ->render();
    }

    public function action_create() {
        Helper_Output::factory()
                ->link_js('libs/wysihtml5-0.3.0.min')
                ->link_js('libs/bootstrap-wysihtml5')
                ->link_js('libs/jquery.validationEngine-en')
                ->link_js('libs/jquery.validationEngine')
                ->link_css('validationEngine.jquery')
                ->link_js('libs/underscore')
                ->link_js('public/assets/workspace')
                ->link_js('admin/tests/create')
                ->link_css('bootstrap-wysihtml5');
        if ($this->request->post()) {
            $model = ORM::factory('Test');
            $post = Helper_Output::clean($this->request->post());
            try {
                $model->values(array('title' => $post['title']));
                $model->save();

                foreach ($post['questions'] as $key => $question) {
                    $q_model = ORM::factory('Question');
                    $q_model->values(array(
                        'question' => $question,
                        'answer' => $post['answers'][$key],
                        'test_id' => $model->id
                    ));

                    $q_model->save();
                }

                $this->redirect('admin/tests');
            } catch (ORM_Validation_Exception $e) {
                Helper_Alert::setStatus('error');
                Helper_Alert::set_flash($e->errors('Test'));
            }
        }
        $this->setTitle('Create Tests')
                ->view('admin/tests/create')
                ->render();
    }

    public function action_getAjaxData() {
        $offset = $this->request->query('iDisplayStart');
        $limit = $this->request->query('iDisplayLength');
        $columns = array();
        $columns[] = 'id';
        $columns[] = 'title';
        $columns[] = 'number';

        $tests = ORM::factory('Test');

        if ($this->request->query('sSearch')) {
            $tests->where('title', 'like', trim($this->request->query('sSearch')) . '%');
        }

        $tests = $tests->limit($limit)->offset($offset)->order_by($columns[$this->request->query('iSortCol_0')], $this->request->query('sSortDir_0'))->find_all();

        $data['iTotalDisplayRecords'] = ORM::factory('Test')->count_all();
        $data['iTotalRecords'] = $data['iTotalDisplayRecords'];

        if (count($tests)) {
            foreach ($tests as $test) {
                $tempArray = array();
                $tempArray[] = $test->id;
                $tempArray[] = $test->title;
                $tempArray[] = $test->questions->count_all();
                $tempArray[] = '<a href="' . URL::site('admin/tests/edit/' . $test->id) . '" class="btn btn-small btn-primary"> Edit </a>
                                 <a onclick="javascript:index.remove(' . $test->id . ', this)" class="btn btn-small btn-danger"> Remove </a>';

                $data['aaData'][] = $tempArray;
            }
        } else {
            $data['aaData'] = array();
        }

        echo json_encode($data);
    }

    public function action_edit() {
        Helper_Output::factory()
                ->link_js('libs/wysihtml5-0.3.0.min')
                ->link_js('libs/bootstrap-wysihtml5')
                ->link_js('libs/jquery.validationEngine-en')
                ->link_js('libs/jquery.validationEngine')
                ->link_js('libs/underscore')
                ->link_js('public/assets/workspace')
                ->link_js('admin/tests/edit')
                ->link_css('bootstrap-wysihtml5')
                ->link_css('validationEngine.jquery');

        if ($this->request->param('id')) {
            $data['test'] = ORM::factory('Test', $this->request->param('id'));
            $data['questions'] = $data['test']->questions->find_all();
        } else {
            $this->redirect('admin/tests');
        }
        
        if ($this->request->post()) {
            $post = Helper_Output::clean($this->request->post());
            try {
                $model = $data['test'];
                $model->values(array('title' => $post['title']));
                $model->save();
                DB::delete('questions')->where('test_id', '=', $model->id)->execute();
                foreach ($post['questions'] as $key => $question) {
                    $q_model = ORM::factory('Question');
                    $q_model->values(array(
                        'question' => $question,
                        'answer' => $post['answers'][$key],
                        'test_id' => $model->id
                    ));

                    $q_model->save();
                }
                $this->redirect('admin/tests');
            } catch (ORM_Validation_Exception $e) {
                Helper_Alert::setStatus('error');
                Helper_Alert::set_flash($e->errors('Test'));
            }
        }

        $this->setTitle('Edit Test')
                ->view('admin/tests/edit', $data)
                ->render();
    }

    public function action_delete() {
        ORM::factory('Test', $this->request->post('id'))->delete();
        Helper_Jsonresponse::render_json('success', null);
    }

}

// End Admin Dashboard
