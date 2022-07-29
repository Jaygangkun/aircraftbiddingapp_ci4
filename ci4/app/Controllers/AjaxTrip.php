<?php

namespace App\Controllers;

use App\Models\TripModel;
use App\Models\TripLegModel;
use Firebase\JWT\JWT;

class AjaxTrip extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function all()
    {
        $model = new TripModel();
        $model_legs = new TripLegModel();
        $all = $model->findAll();
        $data = array();
        foreach($all as $row) {
            $row_legs = '';
            $legs = $model_legs->where('trip', $row['id'])->findAll();
            foreach($legs as $leg) {
                $row_legs .= '<div><span class="text-primary">'.$leg['from'].'</span> - <span class="text-primary">'.$leg['to'].'</span>  <span class="text-success">'.$leg['date'].'</span> <span class="text-success">'.$leg['time'].'</span></div>';
            }

            $data[] = array(
                $row['name'],
                $row_legs,
                $row['status'],
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
            'status' => isset($_POST['status']) ? $_POST['status'] : ''
        ));

        $trip_id = $model->getInsertID();

        $model = new TripLegModel();
        if(isset($_POST['legs'])) {
            foreach($_POST['legs'] as $leg) {
                $model->insert(array(
                    'trip' => $trip_id,
                    'from' => $leg['from'],
                    'to' => $leg['to'],
                    'date' => $leg['date'],
                    'time' => $leg['time'],
                ));
            }
        }
        return $this->response->setJson(array(
            'success' => true,
            'new_id' => $trip_id
        ));
    }

    public function update()
    {
        $model = new TripModel();
        $model_legs = new TripLegModel();
        $model->update(isset($_POST['id']) ? $_POST['id'] : '', array(
            'name' => isset($_POST['name']) ? $_POST['name'] : '',
            'status' => isset($_POST['status']) ? $_POST['status'] : ''
        ));

        $model_legs->where('trip', isset($_POST['id']) ? $_POST['id'] : '')->delete();
        if(isset($_POST['legs'])) {
            foreach($_POST['legs'] as $leg) {
                $model_legs->insert(array(
                    'trip' => isset($_POST['id']) ? $_POST['id'] : '',
                    'from' => $leg['from'],
                    'to' => $leg['to'],
                    'date' => $leg['date'],
                    'time' => $leg['time'],
                ));
            }
        }

        return $this->response->setJson(array(
            'success' => true
        ));
    }

    public function get($id)
    {
        $model = new TripModel();
        $model_legs = new TripLegModel();
        $trip = $model->find($id);
        if($trip) {
            $legs = $model_legs->where('trip', $id)->findAll();
            return $this->response->setJson(array(
                'success' => true,
                'trip' => $trip,
                'legs' => $legs
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
        
        $model_legs = new TripLegModel();
        $model_legs->where('trip', $id)->delete();
        return $this->response->setJson(array(
            'success' => true,
        ));
    }
}
