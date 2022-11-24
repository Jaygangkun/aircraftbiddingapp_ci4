<?php

namespace App\Controllers;

use App\Models\AircraftModel;
use App\Models\AircraftCategoryModel;
use App\Models\CustomerModel;
use App\Models\TripModel;
use App\Models\TripLegModel;
use App\Models\OperatorModel;
use App\Models\UserModel;

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

            $model = new UserModel();
            $user = $model->checkUser($this->request->getPost('user_name'), $this->request->getPost('password'));

            if($user == null) {
                $this->session->setFlashdata('warning', 'User name or password is incorrect');

                return view('auth/login');
            }

            if($user->status == 'deactive') {
                $this->session->setFlashdata('warning', 'User is deactivate');

                return view('auth/login');
            }
            // if($this->request->getPost('user_name') != 'admin' || $this->request->getPost('password') != 'admin') {
			// 	$this->session->setFlashdata('warning', 'User name or password is incorrect');
                
            //     return view('auth/login');
			// }

            $this->session->set('user', $user);

			return redirect()->to('/trips');
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
        if(!$this->session->has('user')) {
            return redirect()->to('/login');
        }

        $data = array(
            'title' => 'Operators',
            'sub_page' => 'operators'
        );

        return view('dashboard/basic', $data);
    }

    public function customers()
    {
        if(!$this->session->has('user')) {
            return redirect()->to('/login');
        }

        $data = array(
            'title' => 'Customers',
            'sub_page' => 'customers'
        );

        return view('dashboard/basic', $data);
    }

    public function users()
    {
        if(!$this->session->has('user')) {
            return redirect()->to('/login');
        }

        $data = array(
            'title' => 'Users',
            'sub_page' => 'users'
        );

        return view('dashboard/basic', $data);
    }

    public function aircraft_categories()
    {
        if(!$this->session->has('user')) {
            return redirect()->to('/login');
        }

        $data = array(
            'title' => 'Aircrafts',
            'sub_page' => 'aircraft-categories'
        );

        return view('dashboard/basic', $data);
    }

    public function aircrafts($aircraft_category_id)
    {
        if(!$this->session->has('user')) {
            return redirect()->to('/login');
        }

        $model = new AircraftCategoryModel();
        $data = array(
            'title' => 'Aircrafts',
            'sub_page' => 'aircrafts',

            'aircraft_category' => $model->find($aircraft_category_id)
        );

        return view('dashboard/basic', $data);
    }

    public function trips()
    {
        if(!$this->session->has('user')) {
            return redirect()->to('/login');
        }

        $model_customer = new CustomerModel();
        $model_trip = new TripModel();
        $model_aircraft = new AircraftModel();
        $model_aircraft_category = new AircraftCategoryModel();

        $data = array(
            'title' => 'Trips',
            'sub_page' => 'trips',

            'customers' => $model_customer->orderBy('name', 'asc')->findAll(),
            'trips' => $model_trip->findAll(),
            'aircrafts' => $model_aircraft->get_aircrafts_with_category(),
            'aircraft_categories' => $model_aircraft_category->orderBy('name', 'asc')->findAll(),
        );

        return view('dashboard/basic', $data);
    }

    public function closed_trips()
    {
        if(!$this->session->has('user')) {
            return redirect()->to('/login');
        }

        $model_customer = new CustomerModel();
        $model_trip = new TripModel();
        $model_aircraft = new AircraftModel();
        $model_aircraft_category = new AircraftCategoryModel();

        $data = array(
            'title' => 'Closed Trips',
            'sub_page' => 'closed-trips',

            'customers' => $model_customer->orderBy('name', 'asc')->findAll(),
            'trips' => $model_trip->findAll(),
            'aircrafts' => $model_aircraft->get_aircrafts_with_category(),
            'aircraft_categories' => $model_aircraft_category->orderBy('name', 'asc')->findAll(),
        );

        return view('dashboard/basic', $data);
    }

    public function trip_details($trip_id)
    {
        if(!$this->session->has('user')) {
            return redirect()->to('/login');
        }

        $model_trip = new TripModel();
        $model_customer = new CustomerModel();
        $model_operator = new OperatorModel();
        $model_trip_legs = new TripLegModel();
        $model_aircraft = new AircraftModel();
        $model_aircraft_category = new AircraftCategoryModel();

        $trip = $model_trip->find($trip_id);

        $data = array(
            'title' => 'Trip Details',
            'sub_page' => 'trip-details',

            'trip_id' => $trip_id,
            'trip' => $trip,
            'aircraft_category' => $model_aircraft_category->find($trip['aircraft_category']),
            'trip_legs' => $model_trip_legs->where('trip', $trip_id)->findAll(),
            'customer' => $model_customer->find($trip['customer']),

            'operators' => $model_operator->orderBy('name', 'asc')->findAll(),

            'aircrafts' => $model_aircraft->get_aircrafts_with_category(),
            'aircraft_categories' => $model_aircraft_category->orderBy('name', 'asc')->findAll(),
        );

        return view('dashboard/basic', $data);
    }
}
