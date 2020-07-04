<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->add('/', 'Home::index');
$routes->add('tentang', 'Tentang::index');


// Auth Routes
$routes->add('login', 'Auth/Auth::index');
$routes->add('logout', 'Auth/Auth::logout');

// User Routes
$routes->group('voting', function($routes)
{
    $routes->add('/', 'Pemilih/Voting::index');
    $routes->add('kandidat', 'Pemilih/Voting::kandidatList', ['filter' => 'cektoken']);
    $routes->add('kandidat/pilih', 'Pemilih/Voting::pilihKandidat', ['filter' => 'cektoken']);
});


// Admin Routes
$routes->group('admin', ['filter' => 'ceklogin'], function($routes)
{
    $routes->add('/', 'Admin/Dashboard::index');
    $routes->add('hasil', 'Admin/ResultVoting::index');

    // admin user routes
    $routes->add('users', 'Admin/Users::index');
    $routes->add('user/add', 'Admin/Users::add');
    $routes->add('user/delete', 'Admin/Users::delete');
    $routes->add('user/edit/(:num)', 'Admin/Users::edit');

    //admin kandidat routes
    $routes->add('kandidat', 'Admin/Kandidat::index');
    $routes->add('kandidat/add', 'Admin/Kandidat::add');
    $routes->add('kandidat/delete', 'Admin/Kandidat::delete');
    $routes->add('kandidat/edit/(:num)', 'Admin/Kandidat::edit');

    // admin token routes
    $routes->add('token', 'Admin/Token::index');
    $routes->add('token/add', 'Admin/Token::add');
    $routes->add('token/delete', 'Admin/Token::delete');
    $routes->add('token/delete_all', 'Admin/Token::delete_all');

    // admin pemilih routes
    $routes->add('pemilih', 'Admin/Pemilih::index');
    $routes->add('pemilih/delete', 'Admin/Pemilih::delete');
    $routes->add('pemilih/delete_all', 'Admin/Pemilih::delete_all');
});

// ajax routes
$routes->group('ajax', ['filter' => 'ceklogin'], function($routes)
{
    $routes->add('get_users', 'Admin/Users::get_users_ajax');
    $routes->add('get_kandidat', 'Admin/Kandidat::get_kandidat_ajax');
    $routes->add('get_token', 'Admin/Token::get_token_ajax');
    $routes->add('get_pemilih', 'Admin/Pemilih::get_pemilih_ajax');
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
