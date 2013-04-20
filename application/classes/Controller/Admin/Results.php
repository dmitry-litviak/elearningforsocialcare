<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Results extends My_Layout_Admin_Controller {

    public function before() {
        parent::before();
        Helper_AdminSiteBar::setActiveItem('results');
    }

    public function action_index() {
        Helper_Output::factory()
                ->link_js('libs/jquery.dataTables.min')
                ->link_js('libs/jquery.dataTables.pagination')
                ->link_js('admin/results/index');
        $this->setTitle('Results')
                ->view('admin/results/index')
                ->render();
    }

    public function action_getAjaxData() {
        $offset = $this->request->query('iDisplayStart');
        $limit = $this->request->query('iDisplayLength');
        $columns = array();
        $columns[] = 'id';
        $columns[] = 'user';
        $columns[] = 'test';
        $columns[] = 'date';
        $columns[] = 'score';

        $results = ORM::factory('Result');

        if ($this->request->query('sSearch')) {
            $results->where('score', 'like', trim($this->request->query('sSearch')) . '%');
        }

        $results = $results->limit($limit)->offset($offset)->order_by($columns[$this->request->query('iSortCol_0')], $this->request->query('sSortDir_0'))->find_all();

        $data['iTotalDisplayRecords'] = ORM::factory('Result')->count_all();
        $data['iTotalRecords'] = $data['iTotalDisplayRecords'];

        if (count($results)) {
            foreach ($results as $result) {
                $tempArray = array();
                $tempArray[] = $result->id;
                $user = ORM::factory('User')->where('id', '=', $result->user_id)->find();
                $tempArray[] = $user->first_name . ' ' . $user->last_name;
                $tempArray[] = $result->test->title;
                $tempArray[] = $result->created_at;
                $tempArray[] = $result->score . '%';
                ;
                $tempArray[] = '<a onclick="javascript:index.remove(' . $result->id . ', this)" class="btn btn-small btn-danger"> Remove </a>';

                $data['aaData'][] = $tempArray;
            }
        } else {
            $data['aaData'] = array();
        }

        echo json_encode($data);
    }

    public function action_delete() {
        ORM::factory('Result', $this->request->post('id'))->delete();
        Helper_Jsonresponse::render_json('success', null);
    }

}

// End Admin Dashboard
