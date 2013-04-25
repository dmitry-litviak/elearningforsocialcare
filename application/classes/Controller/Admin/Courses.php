<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Courses extends My_Layout_Admin_Controller {

    public function before() {
        parent::before();
        Helper_AdminSiteBar::setActiveItem('courses');
    }

    public function action_index() {
        Helper_Output::factory()
                ->link_js('libs/jquery.dataTables.min')
                ->link_js('libs/jquery.dataTables.pagination')
                ->link_js('admin/courses/index');
        $this->setTitle('Courses')
                ->view('admin/courses/index')
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
                ->link_js('admin/courses/create')
                ->link_css('bootstrap-wysihtml5');
        $data['tests'] = ORM::factory('Test')->find_all();
        if ($this->request->post()) {
            $model = ORM::factory('Course');
            $post = Helper_Output::clean($this->request->post());
            try {
                $model->values($post);
                $model->save();
                $this->redirect('admin/courses');
            } catch (ORM_Validation_Exception $e) {
                Helper_Alert::setStatus('error');
                Helper_Alert::set_flash($e->errors('Course'));
            }
        }
        $this->setTitle('Create Course')
                ->view('admin/courses/create', $data)
                ->render();
    }

    public function action_getAjaxData() {
        $offset = $this->request->query('iDisplayStart');
        $limit = $this->request->query('iDisplayLength');
        $columns = array();
        $columns[] = 'id';
        $columns[] = 'title';
        $columns[] = 'description';
        $columns[] = 'test';
 
        $courses = ORM::factory('Course');

        if ($this->request->query('sSearch')) {
            $courses->where('title', 'like', trim($this->request->query('sSearch')) . '%');
        }

        $courses = $courses->limit($limit)->offset($offset)->order_by($columns[$this->request->query('iSortCol_0')], $this->request->query('sSortDir_0'))->find_all();

        $data['iTotalDisplayRecords'] = ORM::factory('Course')->count_all();
        $data['iTotalRecords'] = $data['iTotalDisplayRecords'];

        if (count($courses)) {
            foreach ($courses as $course) {
                $tempArray = array();
                $tempArray[] = $course->id;
                $tempArray[] = $course->title;
                $tempArray[] = $course->description;
                $tempArray[] = $course->test->title;
                $tempArray[] = '<a href="' . URL::site('admin/courses/edit/' . $course->id) . '" class="btn btn-small btn-primary"> Edit </a>
                                 <a onclick="javascript:index.remove(' . $course->id . ', this)" class="btn btn-small btn-danger"> Remove </a>';

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
            $data['course'] = ORM::factory('Course', $this->request->param('id'));
            $data['tests'] = ORM::factory('Test')->find_all();
        } else {
            $this->redirect('admin/courses');
        }
        
        if ($this->request->post()) {
            $post = Helper_Output::clean($this->request->post());
            try {
                $model = $data['course'];
                $model->values($post);
                $model->save();
                $this->redirect('admin/courses');
                
            } catch (ORM_Validation_Exception $e) {
                Helper_Alert::setStatus('error');
                Helper_Alert::set_flash($e->errors('Test'));
            }
        }

        $this->setTitle('Edit Course')
                ->view('admin/courses/edit', $data)
                ->render();
    }

    public function action_delete() {
        ORM::factory('Course', $this->request->post('id'))->delete();
        Helper_Jsonresponse::render_json('success', null);
    }

}

// End Admin Dashboard
