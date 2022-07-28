<?php

namespace App\Controllers;

use App\Models\AircraftModel;
use Firebase\JWT\JWT;

class AjaxAircraft extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function all()
    {
        $model = new AircraftModel();
        $all = $model->findAll();
        $data = array();
        foreach($all as $row) {
            $data[] = array(
                $row['name'],
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
        $model = new AircraftModel();
        $model->insert(array(
            'name' => isset($_POST['name']) ? $_POST['name'] : '',
            'telephone' => isset($_POST['telephone']) ? $_POST['telephone'] : '',
            'contact' => isset($_POST['contact']) ? $_POST['contact'] : '',
        ));

        return $this->response->setJson(array(
            'success' => true,
            'new_id' => $model->getInsertID()
        ));
    }

    public function update()
    {
        $model = new AircraftModel();
        $model->update(isset($_POST['id']) ? $_POST['id'] : '', array(
            'name' => isset($_POST['name']) ? $_POST['name'] : '',
            'telephone' => isset($_POST['telephone']) ? $_POST['telephone'] : '',
            'contact' => isset($_POST['contact']) ? $_POST['contact'] : '',
        ));

        return $this->response->setJson(array(
            'success' => true
        ));
    }

    public function get($id)
    {
        $model = new AircraftModel();
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
        $model = new AircraftModel();
        $model->delete($id);
        
        return $this->response->setJson(array(
            'success' => true,
        ));
    }
}
