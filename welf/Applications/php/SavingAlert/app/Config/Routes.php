<?php

namespace Config;

use CodeIgniter\Config\Services;

$routes = Services::routes();

/*
|--------------------------------------------------------------------------
| Load System Routes
|--------------------------------------------------------------------------
*/
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
|--------------------------------------------------------------------------
| Router Setup
|--------------------------------------------------------------------------
*/
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false); // 🔒 Disable auto-routing for security

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
$routes->get('/', 'Home::index');
$routes->get('about', 'About::index');
$routes->get('contact', 'Contact::index');
$routes->post('contact/contact_xyz', 'Contact::contact_xyz');
$routes->get('terms', 'Terms::index');
$routes->get('privacy', 'Privacy::index');

/*
|--------------------------------------------------------------------------
| Blood Requests
|--------------------------------------------------------------------------
*/
$routes->get('requests', 'Requests::index');
$routes->post('requests/show', 'Requests::show_req');
$routes->post('requests/accept', 'Requests::accept_blood');

/*
|--------------------------------------------------------------------------
| Blood Request Submission (Requester side)
|--------------------------------------------------------------------------
*/
$routes->get('request-blood', 'RequestDonation::index');
$routes->post('request-blood/submit', 'RequestDonation::request_donation');

/*
|--------------------------------------------------------------------------
| Donations
|--------------------------------------------------------------------------
*/
$routes->get('donations', 'SubmitDonation::index');
$routes->post('donations/submit', 'SubmitDonation::submit_donation');

/*
|--------------------------------------------------------------------------
| Location
|--------------------------------------------------------------------------
*/
$routes->get('location', 'Location::index');
$routes->post('location/submit', 'Location::submit_location');
$routes->post('location/verify-phone', 'Location::verify_phone');
$routes->post('location/confirm-otp', 'Location::confirm_otp');
$routes->post('location/save-name', 'Location::save_name_s');

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
$routes->get('login', 'Login::index');
$routes->get('logout', 'Logout::index');

/*
|--------------------------------------------------------------------------
| Tracking
|--------------------------------------------------------------------------
*/
$routes->get('tracking', 'Tracking::index');

/*
|--------------------------------------------------------------------------
| Environment-specific Routes
|--------------------------------------------------------------------------
*/
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
