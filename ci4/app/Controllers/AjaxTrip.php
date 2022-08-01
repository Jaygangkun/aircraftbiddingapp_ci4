<?php

namespace App\Controllers;

use App\Models\TripModel;
use App\Models\TripLegModel;
use App\Models\TripOperatorModel;
use App\Models\OperatorModel;
use App\Models\CustomerModel;
use App\Models\AircraftModel;

use Firebase\JWT\JWT;

class AjaxTrip extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function all()
    {
        $model = new TripModel();
        $model_legs = new TripLegModel();
        $model_operators = new TripOperatorModel();
        $model_aircrafts = new AircraftModel();
        $model_customers = new CustomerModel();

        $all = $model->findAll();
        $data = array();
        foreach($all as $row) {
            $row_legs = '';
            $legs = $model_legs->where('trip', $row['id'])->findAll();
            foreach($legs as $leg) {
                $row_legs .= '<div><span class="text-primary">'.$leg['from'].'</span> - <span class="text-primary">'.$leg['to'].'</span>  <span class="text-success">'.$leg['date'].'</span> <span class="text-success">'.$leg['time'].'</span></div>';
            }

            $operators = $model_operators->where('trip', $row['id'])->findAll(); 

            $aircraft = null;
            if($row['aircraft']) {
                $aircraft = $model_aircrafts->get_aircraft_with_category_by_id($row['aircraft']);
            }

            $customer = null;
            if($row['customer']) {
                $customer = $model_customers->find($row['customer']);
            }
            
            
            $data[] = array(
                $customer ? '<a href="'.base_url('/trip/'.$row['id'].'/details').'">'.$customer['name'].'</a>' : '',
                $row_legs,
                count($operators),
                $aircraft ? ($aircraft->name.($aircraft->aircraft_category_name != '' ? ' (<a href="'.base_url('/aircrafts/'.$aircraft->category).'">'.$aircraft->aircraft_category_name.'</a>)' : '')) : '',
                $row['pax'],
                $row['date'],
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
        if(isset($_POST['customer_option']) && $_POST['customer_option'] == 'new') {
            // create new customer
            $model = new CustomerModel();
            $model->insert(array(
                'name' => isset($_POST['customer_name']) ? $_POST['customer_name'] : '',
                'company' => isset($_POST['customer_company']) ? $_POST['customer_company'] : '',
                'email' => isset($_POST['customer_email']) ? $_POST['customer_email'] : '',
                'telephone' => isset($_POST['customer_telephone']) ? $_POST['customer_telephone'] : '',
            ));

            $customer_id = $model->getInsertID();
        }
        else {
            $customer_id = $_POST['customer_id'];
        }

        $model = new TripModel();
        $model->insert(array(
            'customer' => $customer_id,
            'status' => isset($_POST['status']) ? $_POST['status'] : '',
            'date' => date('m/d/Y'),
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
        if(isset($_POST['customer_option']) && $_POST['customer_option'] == 'new') {
            // create new customer
            $model = new CustomerModel();
            $model->insert(array(
                'name' => isset($_POST['customer_name']) ? $_POST['customer_name'] : '',
                'company' => isset($_POST['customer_company']) ? $_POST['customer_company'] : '',
                'email' => isset($_POST['customer_email']) ? $_POST['customer_email'] : '',
                'telephone' => isset($_POST['customer_telephone']) ? $_POST['customer_telephone'] : '',
            ));

            $customer_id = $model->getInsertID();
        }
        else {
            $customer_id = $_POST['customer_id'];
        }

        $model = new TripModel();
        $model_legs = new TripLegModel();
        $model->update(isset($_POST['id']) ? $_POST['id'] : '', array(
            'customer' => $customer_id,
            'status' => isset($_POST['status']) ? $_POST['status'] : '',
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

    public function operator_all($trip_id)
    {
        $model = new TripOperatorModel();
        $all = $model->get_trip_operators_table_data($trip_id);

        $data = array();
        foreach($all as $row) {
            $row_trip = '';
            $row_customer = '';
            $row_operator = '';

            $data[] = array(
                $row->operator_name,
                $row->pax,
                $row->cost,
                $row->aircraft_name.($row->aircraft_category_name != '' ? ' (<a href="'.base_url('/aircrafts/'.$row->aircraft_category_id).'">'.$row->aircraft_category_name.'</a>)' : ''),

                $row->status,
                '<div class="table-col-actions"><span class="text-success tbl-action-btn tbl-action-btn-edit" data-id="'.$row->id.'">Edit</span><span class="text-danger tbl-action-btn tbl-action-btn-delete" data-id="'.$row->id.'">Delete</span></div>'
            );
        }
        
        return $this->response->setJson(array(
            'success' => true,
            'data' => $data
        ));
    }

    public function operator_get($id)
    {
        $model = new TripOperatorModel();
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

    public function operator_add()
    {
        $customer_id = null;

        if(isset($_POST['operator_option']) && $_POST['operator_option'] == 'new') {
            // create new customer
            $model = new OperatorModel();
            $model->insert(array(
                'name' => isset($_POST['operator_name']) ? $_POST['operator_name'] : '',
                'telephone' => isset($_POST['operator_telephone']) ? $_POST['operator_telephone'] : '',
                'contact' => isset($_POST['operator_contact']) ? $_POST['operator_contact'] : ''
            ));

            $operator_id = $model->getInsertID();
        }
        else {
            $operator_id = $_POST['operator_id'];
        }

        $aircraft_id = null;
        if(isset($_POST['aircraft_option']) && $_POST['aircraft_option'] == 'new') {
            // create new aircraft
            if(isset($_POST['aircraft_category_name']) && $_POST['aircraft_category_name'] != '') {
                // create new aircraft category
                $model = new AircraftCategoryModel();
                $model->insert(array(
                    'name' => isset($_POST['aircraft_category_name']) ? $_POST['aircraft_category_name'] : '',
                ));
    
                $aircraft_category_id = $model->getInsertID();    
            }
            else {
                $aircraft_category_id = isset($_POST['aircraft_category']) ? $_POST['aircraft_category'] : '';
            }

            $model = new AircraftModel();
            $model->insert(array(
                'name' => isset($_POST['aircraft_name']) ? $_POST['aircraft_name'] : '',
                'category' => $aircraft_category_id
            ));

            $aircraft_id = $model->getInsertID();
        }
        else {
            $aircraft_id = $_POST['aircraft_id'];
        }

        $model = new TripOperatorModel();
        $model->insert(array(
            'trip' => isset($_POST['trip_id']) ? $_POST['trip_id'] : '',
            'operator' => $operator_id,
            'pax' => isset($_POST['pax']) ? $_POST['pax'] : '',
            'cost' => isset($_POST['cost']) ? $_POST['cost'] : '',
            'aircraft' => $aircraft_id,
            'status' => isset($_POST['operator_status']) ? $_POST['operator_status'] : '',
        ));

        return $this->response->setJson(array(
            'success' => true,
            'new_id' => $model->getInsertID()
        ));
    }

    public function operator_update()
    {
        $customer_id = null;

        if(isset($_POST['operator_option']) && $_POST['operator_option'] == 'new') {
            // create new customer
            $model = new OperatorModel();
            $model->insert(array(
                'name' => isset($_POST['operator_name']) ? $_POST['operator_name'] : '',
                'telephone' => isset($_POST['operator_telephone']) ? $_POST['operator_telephone'] : '',
                'contact' => isset($_POST['operator_contact']) ? $_POST['operator_contact'] : ''
            ));

            $operator_id = $model->getInsertID();
        }
        else {
            $operator_id = $_POST['operator_id'];
        }

        $aircraft_id = null;
        if(isset($_POST['aircraft_option']) && $_POST['aircraft_option'] == 'new') {
            // create new aircraft
            if(isset($_POST['aircraft_category_name']) && $_POST['aircraft_category_name'] != '') {
                // create new aircraft category
                $model = new AircraftCategoryModel();
                $model->insert(array(
                    'name' => isset($_POST['aircraft_category_name']) ? $_POST['aircraft_category_name'] : '',
                ));
    
                $aircraft_category_id = $model->getInsertID();    
            }
            else {
                $aircraft_category_id = isset($_POST['aircraft_category']) ? $_POST['aircraft_category'] : '';
            }

            $model = new AircraftModel();
            $model->insert(array(
                'name' => isset($_POST['aircraft_name']) ? $_POST['aircraft_name'] : '',
                'category' => $aircraft_category_id
            ));

            $aircraft_id = $model->getInsertID();
        }
        else {
            $aircraft_id = $_POST['aircraft_id'];
        }

        $model = new TripOperatorModel();
        $model->update(isset($_POST['operator_trip_id']) ? $_POST['operator_trip_id'] : '', array(
            'operator' => $operator_id,
            'pax' => isset($_POST['pax']) ? $_POST['pax'] : '',
            'cost' => isset($_POST['cost']) ? $_POST['cost'] : '',
            'aircraft' => $aircraft_id,
            'status' => isset($_POST['operator_status']) ? $_POST['operator_status'] : '',
        ));

        return $this->response->setJson(array(
            'success' => true,
            'new_id' => $model->getInsertID()
        ));
    }

    public function operator_delete($id)
    {
        $model = new TripOperatorModel();
        $model->delete($id);
        
        return $this->response->setJson(array(
            'success' => true,
        ));
    }
}
