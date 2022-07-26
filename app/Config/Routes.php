<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Page');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Page::applications');
$routes->get('/login', 'Page::login');
// $routes->post('/login', 'Page::login');
$routes->get('/logout', 'Page::logout');
$routes->get('/operators', 'Page::operators');
$routes->get('/customers', 'Page::customers');
$routes->get('/users', 'Page::users');
$routes->get('/aircrafts', 'Page::aircrafts');
$routes->get('/trips', 'Page::trips');
$routes->get('/bids', 'Page::bids');
$routes->get('/bid/(:any)/operators', 'Page::bid_operators/$1');

// Ajax Calls
$routes->group("ajax", function ($routes) {
    $routes->get('operator/all', 'AjaxOperator::all');
    $routes->post('operator/add', 'AjaxOperator::add');
    $routes->post('operator/update', 'AjaxOperator::update');
    $routes->get('operator/get/(:any)', 'AjaxOperator::get/$1');
    $routes->get('operator/delete/(:any)', 'AjaxOperator::delete/$1');

    $routes->get('customer/all', 'AjaxCustomer::all');
    $routes->post('customer/add', 'AjaxCustomer::add');
    $routes->post('customer/update', 'AjaxCustomer::update');
    $routes->get('customer/get/(:any)', 'AjaxCustomer::get/$1');
    $routes->get('customer/delete/(:any)', 'AjaxCustomer::delete/$1');

    $routes->get('user/all', 'AjaxUser::all');
    $routes->post('user/add', 'AjaxUser::add');
    $routes->post('user/update', 'AjaxUser::update');
    $routes->get('user/get/(:any)', 'AjaxUser::get/$1');
    $routes->get('user/delete/(:any)', 'AjaxUser::delete/$1');

    $routes->get('aircraft/all', 'AjaxAircraft::all');
    $routes->post('aircraft/add', 'AjaxAircraft::add');
    $routes->post('aircraft/update', 'AjaxAircraft::update');
    $routes->get('aircraft/get/(:any)', 'AjaxAircraft::get/$1');
    $routes->get('aircraft/delete/(:any)', 'AjaxAircraft::delete/$1');

    $routes->get('trip/all', 'AjaxTrip::all');
    $routes->post('trip/add', 'AjaxTrip::add');
    $routes->post('trip/update', 'AjaxTrip::update');
    $routes->get('trip/get/(:any)', 'AjaxTrip::get/$1');
    $routes->get('trip/delete/(:any)', 'AjaxTrip::delete/$1');

    $routes->get('bid/all', 'AjaxBid::all');
    $routes->post('bid/customer/add', 'AjaxBid::customer_add');
    $routes->get('bid/delete/(:any)', 'AjaxBid::delete/$1');

    $routes->get('bid/(:any)/operator/all', 'AjaxBid::operator_all/$1');
    $routes->post('bid/operator/add', 'AjaxBid::operator_add');
    $routes->get('bid/operator/get/(:any)', 'AjaxBid::operator_get/$1');
    $routes->post('bid/operator/update', 'AjaxBid::operator_update');
    $routes->get('bid/operator/delete/(:any)', 'AjaxBid::operator_delete/$1');
});

// APIS
$routes->group("api", function ($routes) {
    $routes->post('login', 'APIUser::login');
    $routes->post('signup', 'APIUser::signup');
    $routes->post('forgot_password', 'APIUser::forgot_password');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

