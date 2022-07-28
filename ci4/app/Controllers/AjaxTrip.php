<?php

namespace App\Controllers;

use App\Models\TripModel;
use Firebase\JWT\JWT;

class AjaxTrip extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function all()
    {
        $model = new TripModel();
        $all = $model->findAll();
        $data = array();
        foreach($all as $row) {
            $data[] = array(
                $row['name'],
                $row['place_from'],
                $row['place_to'],
                $row['date_from'].' - '.$row['date_to'],
                '<div class="table-col-actions"><span class="text-success tbl-action-btn tbl-action-btn-edit" data-id="'.$row['id'].'">Edit</span><span class="text-danger tbl-action-btn tbl-action-btn-delete" data-id="'.$row['id'].'">Delete</span></div>'
            );
        }
        
        return $this->response->setJson(array(
            'success' => true,
            'data' => $data
        ));
    }

    public function add()
    {
        $model = new TripModel();
        $model->insert(array(
            'name' => isset($_POST['name']) ? $_POST['name'] : '',
            'date_from' => isset($_POST['date_from']) ? $_POST['date_from'] : '',
            'date_to' => isset($_POST['date_to']) ? $_POST['date_to'] : '',
            'place_from' => isset($_POST['place_from']) ? $_POST['place_from'] : '',
            'place_to' => isset($_POST['place_to']) ? $_POST['place_to'] : ''
        ));

        return $this->response->setJson(array(
            'success' => true,
            'new_id' => $model->getInsertID()
        ));
    }

    public function update()
    {
        $model = new TripModel();
        $model->update(isset($_POST['id']) ? $_POST['id'] : '', array(
            'name' => isset($_POST['name']) ? $_POST['name'] : '',
            'date_from' => isset($_POST['date_from']) ? $_POST['date_from'] : '',
            'date_to' => isset($_POST['date_to']) ? $_POST['date_to'] : '',
            'place_from' => isset($_POST['place_from']) ? $_POST['place_from'] : '',
            'place_to' => isset($_POST['place_to']) ? $_POST['place_to'] : ''
        ));

        return $this->response->setJson(array(
            'success' => true
        ));
    }

    public function get($id)
    {
        $model = new TripModel();
        $found = $model->find($id);
        if($found) {
            return $this->response->setJson(array(
                'success' => true,
                'data' => $found
            ));
        }
        else {
            return $this->response->setJson(array(
                'success' => false,
                'message' => 'Not found data'
            ));
        }
    }

    public function delete($id)
    {
        $model = new TripModel();
        $model->delete($id);
        
        return $this->response->setJson(array(
            'success' => true,
        ));
    }
}
