<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// CHATBOT
$routes->get('chatbot', 'Chatbot::index');
$routes->post('chatbot/sendMessage', 'Chatbot::sendMessage');

// Home
$routes->get('/', 'Home::index');

// Dashboard
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'login']);

// Pages (User Manuals)
$routes->group('pages', ['filter' => 'login'], function ($routes) {
    $routes->get('/', 'Pages::index');
    $routes->post('filter', 'Pages::filter');
    $routes->get('filter', 'Pages::filter');
    $routes->get('searchPage', 'Pages::search');
    $routes->get('create', 'Pages::create', ['filter' => 'role:admin']);
    $routes->post('save', 'Pages::save');
    $routes->match(['GET', 'POST'], 'edit/(:num)', 'Pages::edit/$1', ['filter' => 'role:admin']);
    $routes->post('update/(:num)', 'Pages::update/$1', ['filter' => 'role:admin']);
    $routes->get('reset', 'Pages::resetFilter');
    $routes->post('uploadImage', 'Pages::uploadImage');
    $routes->get('newManual', 'Pages::newManualForm');
    $routes->post('saveManual', 'Pages::saveManual');
    $routes->get('getManualDesc/(:segment)', 'Pages::getManualDesc/$1');
    $routes->get('editDesc/(:segment)', 'Pages::editDesc/$1', ['filter' => 'role:admin']);
    $routes->post('saveOrUpdateManual', 'Pages::saveOrUpdateManual', ['filter' => 'role:admin']);
    $routes->post('updateDesc/(:segment)', 'Pages::updateDesc/$1', ['filter' => 'role:admin']);


    // HISTORY ROUTES 
    $routes->get('history/delete/(:num)', 'Pages::deleteHistory/$1');
    $routes->get('history/(:segment)/(:segment)', 'Pages::historyDetail/$1/$2');
    $routes->get('history/(:any)/(:any)', 'Pages::oldDetail/$1/$2');
    $routes->post('history/(:num)', 'Pages::delete/$1', ['filter' => 'role:admin']);
    $routes->get('history/(:segment)', 'Pages::history/$1');
    $routes->get('history', 'Pages::history', ['filter' => 'role:admin']);

    // DELETE & MASS DELETE
    $routes->delete('(:num)', 'Pages::delete/$1', ['filter' => 'role:admin']);
    $routes->post('(:num)', 'Pages::deleteAll/$1', ['filter' => 'role:admin']);

    // MANUAL DETAIL
    $routes->get('manual/(:segment)', 'Pages::manual/$1');

    // DETAIL 
    $routes->get('(:segment)', 'Pages::detail/$1');
});

// What's New
$routes->group('whatsnew', function ($routes) {
    $routes->get('detail/(:segment)', 'WhatsNew::detail/$1');
    $routes->get('create', 'WhatsNew::create', ['filter' => 'role:admin']);
    $routes->post('save', 'WhatsNew::save');
    $routes->get('edit/(:segment)', 'WhatsNew::edit/$1', ['filter' => 'role:admin']); // Route untuk form edit
    $routes->post('update/(:segment)', 'WhatsNew::update/$1'); // Route untuk proses update (POST)
    $routes->put('update/(:segment)', 'WhatsNew::update/$1'); // Route untuk proses update (PUT)
    $routes->post('delete/(:num)', 'WhatsNew::delete/$1', ['filter' => 'role:admin']);
    $routes->post('detail/(:num)', 'WhatsNew::delete/$1', ['filter' => 'role:admin']);
    $routes->get('history', 'WhatsNew::history', ['filter' => 'role:admin']);
    $routes->get('history/(:num)', 'WhatsNew::historyDetail/$1', ['filter' => 'role:admin']);
    $routes->get('history/delete/(:num)', 'WhatsNew::deleteHistory/$1', ['filter' => 'role:admin']);
    $routes->get('/', 'WhatsNew::index');
    $routes->get('(:any)', 'WhatsNew::detail/$1');
});

// Auth (Myth:Auth)
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('login', 'AuthController::login', ['as' => 'login']);
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('register', 'AuthController::register', ['as' => 'register']);
    $routes->post('register', 'AuthController::attemptRegister');
    $routes->get('logout', 'AuthController::logout');
    $routes->get('activate-account/(:segment)', 'Auth::activateAccount/$1');
});


$routes->get('/history', 'Pages::history');
$routes->get('/history/(:num)', 'Pages::history/$1');

// Optional: Enable auto-routing (use with caution)
// $routes->setAutoRoute(true);
