<?php

namespace Config;

use CodeIgniter\Config\Services;

$routes = Services::routes();

/*
|--------------------------------------------------------------------------
| System Routes
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
$routes->setAutoRoute(false); // 🔒 IMPORTANT

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
$routes->get('/', 'Home::index');
$routes->get('about', 'About::index');
$routes->get('contact', 'Contact::index');
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
| Donations
|--------------------------------------------------------------------------
*/
$routes->get('donations', 'Donation::index');
$routes->post('donations/submit', 'SubmitDonation::index');

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
$routes->get('login', 'Login::index');
$routes->get('logout', 'Logout::index');

/*
|--------------------------------------------------------------------------
| Environment Routes
|--------------------------------------------------------------------------
*/
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
