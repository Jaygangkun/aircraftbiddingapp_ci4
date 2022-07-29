<?php

namespace App\Controllers;

use App\Models\AircraftModel;
use App\Models\AircraftCategoryModel;
use Firebase\JWT\JWT;

class AjaxAircraftCategory extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function all()
    {
        $model = new AircraftCategoryModel();
        $model_aircraft = new AircraftModel();
        $all = $model->findAll();
        $data = array();
        foreach($all as $row) {
            $aircrafts = $model_aircraft->where('category', $row['id'])->findAll();
            $data[] = array(
                $row['name'],
                '<a href="'.base_url('/aircrafts/'.$row['id']).'">View ('.count($aircrafts).")</span>",
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
        $model = new AircraftCategoryModel();
        $model->insert(array(
            'name' => isset($_POST['name']) ? $_POST['name'] : '',
        ));

        return $this->response->setJson(array(
            'success' => true,
            'new_id' => $model->getInsertID()
        ));
    }

    public function update()
    {
        $model = new AircraftCategoryModel();
        $model->update(isset($_POST['id']) ? $_POST['id'] : '', array(
            'name' => isset($_POST['name']) ? $_POST['name'] : '',
        ));

        return $this->response->setJson(array(
            'success' => true
        ));
    }

    public function get($id)
    {
        $model = new AircraftCategoryModel();
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
        $model = new AircraftCategoryModel();
        $model->delete($id);
        
        $model = new AircraftModel();
        $model->where('category', $id)->delete();

        return $this->response->setJson(array(
            'success' => true,
        ));
    }
}
