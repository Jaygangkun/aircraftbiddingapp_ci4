<?php

namespace App\Controllers;

use App\Models\AircraftModel;
use App\Models\CustomerModel;
use App\Models\TripModel;
use App\Models\OperatorModel;
use App\Models\BidModel;
use App\Models\OperatorBidModel;

class Page extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function index()
    {
        return view('home');
    }

    public function login()
    {
        if($this->request->getPost('submit')){

			if($this->request->getPost('user_name') == '' || $this->request->getPost('password') == '') {
				$this->session->setFlashdata('warning', 'Please input both user name and password!');
                
                return view('auth/login');
			}

            if($this->request->getPost('user_name') != 'admin' || $this->request->getPost('password') != 'admin') {
				$this->session->setFlashdata('warning', 'User name or password is incorrect');
                
                return view('auth/login');
			}

            $this->session->set('user', array(
                'role' => 'admin',
                'name' => 'admin'
            ));

			return redirect()->to('/bids');
		}
		else{
			$this->session->remove('user');
			return view('auth/login');
		}
    }

    public function logout() {
        $this->session->remove('user');
        return redirect()->to('/login');
    }

    public function operators()
    {
        // if(!$this->session->has('user')) {
        //     return redirect()->to('/login');
        // }

        $data = array(
            'title' => 'Operators',
            'sub_page' => 'operators'
        );

        return view('dashboard/basic', $data);
    }

    public function customers()
    {
        $data = array(
            'title' => 'Customers',
            'sub_page' => 'customers'
        );

        return view('dashboard/basic', $data);
    }

    public function users()
    {
        $data = array(
            'title' => 'Users',
            'sub_page' => 'users'
        );

        return view('dashboard/basic', $data);
    }

    public function aircrafts()
    {
        $data = array(
            'title' => 'Aircrafts',
            'sub_page' => 'aircrafts'
        );

        return view('dashboard/basic', $data);
    }

    public function trips()
    {
        $data = array(
            'title' => 'Trips',
            'sub_page' => 'trips'
        );

        return view('dashboard/basic', $data);
    }

    public function bids()
    {
        $model_customer = new CustomerModel();
        $model_trip = new TripModel();
        $model_aircraft = new AircraftModel();

        $data = array(
            'title' => 'Bids',
            'sub_page' => 'bids',

            'customers' => $model_customer->findAll(),
            'trips' => $model_trip->findAll(),
            'aircrafts' => $model_aircraft->findAll()
        );

        return view('dashboard/basic', $data);
    }

    public function bid_operators($bid_id)
    {
        $model_operator = new OperatorModel();
        $model_aircraft = new AircraftModel();

        $data = array(
            'title' => 'Bid Operators',
            'sub_page' => 'bid-operators',

            'bid_id' => $bid_id,
            'aircrafts' => $model_aircraft->findAll(),
            'operators' => $model_operator->findAll(),
        );

        return view('dashboard/basic', $data);
    }

    public function bid_details($bid_id)
    {
        $model_bid = new BidModel();
        $model_trip = new TripModel();
        $model_customer = new CustomerModel();
        $model_operator_bid = new OperatorBidModel();

        $bid_data = $model_bid->find($bid_id);

        $data = array(
            'title' => 'Bid Details',
            'sub_page' => 'bid-details',

            'bid' => $model_bid->get_bid_details($bid_id),
            'trip' => $model_trip->find($bid_data['trip']),
            'customer' => $model_customer->find($bid_data['customer']),
            'operators' => $model_operator_bid->get_bid_operators_table_data($bid_id)
        );

        return view('dashboard/basic', $data);
    }
}
