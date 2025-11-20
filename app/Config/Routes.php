<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public site
$routes->get('/', 'Home::index');
$routes->get('about', 'About::index');

// Sejarah publik
$routes->get('sejarah', 'Home::sejarah');
$routes->get('sejarah/(:num)', 'Home::sejarahDetail/$1');

// Resep
$routes->get('resep', 'Home::resep');
$routes->get('resep/detail/(:num)', 'Home::resepDetail/$1');

// Galeri (dedicated controller)
$routes->get('galeri', 'Galeri::index');

// Serve BLOB images (centralized endpoints)
$routes->get('img/resep/(:num)', 'Home::imgResep/$1');
$routes->get('img/sejarah/(:num)', 'Home::imgSejarah/$1');
$routes->get('img/galeri/(:num)', 'Galeri::img/$1'); // optional


// Public auth routes
$routes->get('login', 'Auth::login');         // halaman form login
$routes->post('login', 'Auth::attempt');      // proses login
$routes->get('logout', 'Auth::logout');       // logout

// Admin area (protected manually di controller)
$routes->get('admin', 'Admin\Dashboard::index');
$routes->get('admin/resep', 'Admin\ResepController::index');


// Admin group
// Admin routes (gunakan group; hapus filter kalau belum tersedia)
$routes->group('admin', function($routes){
    // Dashboard
    $routes->get('', 'Admin\Dashboard::index');        // /admin
    $routes->get('login', 'Auth::login');             // /admin/login jika mau

    // Resep
    $routes->get('resep', 'Admin\ResepController::index');
    $routes->get('resep/create', 'Admin\ResepController::create');
    $routes->post('resep/store', 'Admin\ResepController::store');
    $routes->get('resep/edit/(:num)', 'Admin\ResepController::edit/$1');
    $routes->post('resep/update/(:num)', 'Admin\ResepController::update/$1');
    $routes->post('resep/delete/(:num)', 'Admin\ResepController::delete/$1');


    // Sejarah
    $routes->get('sejarah', 'Admin\SejarahController::index');
    $routes->get('sejarah/create', 'Admin\SejarahController::create');
    $routes->post('sejarah/store', 'Admin\SejarahController::store');
    $routes->get('sejarah/edit/(:num)', 'Admin\SejarahController::edit/$1');
    $routes->post('sejarah/update/(:num)', 'Admin\SejarahController::update/$1');
    $routes->post('sejarah/delete/(:num)', 'Admin\SejarahController::delete/$1');

    // Makanan (parent)
    $routes->get('makanan', 'Admin\MakananController::index');
    $routes->get('makanan/create', 'Admin\MakananController::create');
    $routes->post('makanan/store', 'Admin\MakananController::store');
    $routes->get('makanan/edit/(:num)', 'Admin\MakananController::edit/$1');
    $routes->post('makanan/update/(:num)', 'Admin\MakananController::update/$1');
    $routes->post('makanan/delete/(:num)', 'Admin\MakananController::delete/$1');

});

