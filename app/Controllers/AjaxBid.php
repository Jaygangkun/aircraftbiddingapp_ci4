<?php

namespace App\Controllers;

use App\Models\BidModel;
use App\Models\CustomerModel;
use App\Models\OperatorModel;
use App\Models\TripModel;
use App\Models\OperatorBidModel;

use Firebase\JWT\JWT;

class AjaxBid extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function all()
    {
        $model = new BidModel();
        $model_customer = new CustomerModel();
        $model_operator = new OperatorModel();
        $model_trip = new TripModel();
        $model_operator_bid = new OperatorBidModel();

        $all = $model->get_bids_table_data();
        $data = array();
        foreach($all as $row) {
            $row_trip = '';
            $row_customer = '';

            $operator_bids = $model_operator_bid->where('bid', $row->id)->findAll();

            $data[] = array(
                $row->trip_name,
                $row->customer_name,
                count($operator_bids),
                $row->aircraft_name,
                $row->cost,
                $row->status,
                '<div class="table-col-actions"><span class="text-primary tbl-action-btn tbl-action-btn-edit" data-id="'.$row->id.'">Details</span><a href="'.base_url('/bid/'.$row->id.'/operators').'"class="text-primary tbl-action-btn" data-id="'.$row->id.'">Operators</a><span class="text-success tbl-action-btn tbl-action-btn-edit" data-id="'.$row->id.'">Edit</span><span class="text-danger tbl-action-btn tbl-action-btn-delete" data-id="'.$row->id.'">Delete</span></div>'
            );
        }
        
        return $this->response->setJson(array(
            'success' => true,
            'data' => $data
        ));
    }

    public function delete($id)
    {
        $model = new BidModel();
        $model->delete($id);
        
        return $this->response->setJson(array(
            'success' => true,
        ));
    }

    public function customer_add()
    {
        $customer_id = null;

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

        $trip_id = null;
        if(isset($_POST['trip_option']) && $_POST['trip_option'] == 'new') {
            // create new customer
            $model = new TripModel();
            $model->insert(array(
                'name' => isset($_POST['trip_name']) ? $_POST['trip_name'] : '',
                'date_from' => isset($_POST['trip_date_from']) ? $_POST['trip_date_from'] : '',
                'date_to' => isset($_POST['trip_date_to']) ? $_POST['trip_date_to'] : '',
                'place_from' => isset($_POST['trip_place_from']) ? $_POST['trip_place_from'] : '',
                'place_to' => isset($_POST['trip_place_to']) ? $_POST['trip_place_to'] : ''
            ));

            $trip_id = $model->getInsertID();
        }
        else {
            $trip_id = $_POST['trip_id'];
        }

        $model = new BidModel();
        $model->insert(array(
            'customer' => $customer_id,
            'trip' => $trip_id,
            'pax' => isset($_POST['pax']) ? $_POST['pax'] : '',
            'aircraft' => isset($_POST['aircraft']) ? $_POST['aircraft'] : '',
            'status' => 'new'
        ));

        return $this->response->setJson(array(
            'success' => true,
            'new_id' => $model->getInsertID()
        ));
    }

    public function operator_all($bid_id)
    {
        $model = new OperatorBidModel();
        $all = $model->get_bid_operators_table_data($bid_id);

        $data = array();
        foreach($all as $row) {
            $row_trip = '';
            $row_customer = '';
            $row_operator = '';

            $data[] = array(
                $row->operator_name,
                $row->pax,
                $row->cost,
                $row->aircraft_name,
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
        $model = new OperatorBidModel();
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

        $model = new BidModel();
        $model->update(isset($_POST['bid_id']) ? $_POST['bid_id'] : '', array(
            // 'cost' => isset($_POST['cost']) ? $_POST['cost'] : '',
            'status' => 'pending'
        ));
        $model = new OperatorBidModel();
        $model->insert(array(
            'bid' => isset($_POST['bid_id']) ? $_POST['bid_id'] : '',
            'operator' => $operator_id,
            'pax' => isset($_POST['pax']) ? $_POST['pax'] : '',
            'cost' => isset($_POST['cost']) ? $_POST['cost'] : '',
            'aircraft' => isset($_POST['aircraft']) ? $_POST['aircraft'] : '',
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

        $model = new BidModel();
        $model->update(isset($_POST['bid_id']) ? $_POST['bid_id'] : '', array(
            // 'cost' => isset($_POST['cost']) ? $_POST['cost'] : '',
            'status' => 'pending'
        ));
        $model = new OperatorBidModel();
        $model->update(isset($_POST['operator_bid_id']) ? $_POST['operator_bid_id'] : '', array(
            'operator' => $operator_id,
            'pax' => isset($_POST['pax']) ? $_POST['pax'] : '',
            'cost' => isset($_POST['cost']) ? $_POST['cost'] : '',
            'aircraft' => isset($_POST['aircraft']) ? $_POST['aircraft'] : '',
            'status' => isset($_POST['operator_status']) ? $_POST['operator_status'] : '',
        ));

        return $this->response->setJson(array(
            'success' => true,
            'new_id' => $model->getInsertID()
        ));
    }

    public function operator_delete($id)
    {
        $model = new OperatorBidModel();
        $model->delete($id);
        
        return $this->response->setJson(array(
            'success' => true,
        ));
    }

}
