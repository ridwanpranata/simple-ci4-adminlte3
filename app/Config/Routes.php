<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index'); 
// => default controller
$routes->get('/dashboard', 'DashboardController::index',['as' => 'dashboard']);

$routes->get('/book', 'BookController::index',['as' => 'book']);
$routes->get('/book/create', 'BookController::create',['as' => 'book-create']);
$routes->post('/book/store', 'BookController::store',['as' => 'book-store']);
$routes->get('/book/edit/(:num)', 'BookController::edit/$1',['as' => 'book-edit']);
$routes->post('/book/update', 'BookController::update',['as' => 'book-update']);
$routes->get('/book/delete/(:num)', 'BookController::delete/$1',['as' => 'book-delete']);

$routes->group('group', static function ($routes) {
    $routes->get('', 'GroupController::index',['as' => 'group']);
    $routes->get('create', 'GroupController::create',['as' => 'group-create']);
    $routes->post('store', 'GroupController::store',['as' => 'group-store']);
    $routes->get('edit/(:num)', 'GroupController::edit/$1',['as' => 'group-edit']);
    $routes->post('update', 'GroupController::update',['as' => 'group-update']);
    $routes->get('delete/(:num)', 'GroupController::delete/$1',['as' => 'group-delete']);
});


service('auth')->routes($routes);

// API Routes
$routes->group("api", ["namespace" => "App\Controllers"], function ($routes) {

    $routes->get("invalid-access", "AuthController::accessDenied");

    // Post
    $routes->post("register", "AuthController::register");

    // Post
    $routes->post("login", "AuthController::login");

    // Get
    $routes->get("profile", "AuthController::profile", ["filter" => "apiauth"]);

    // Get
    $routes->get("logout", "AuthController::logout", ["filter" => "apiauth"]);
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
