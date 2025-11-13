<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/sejarah', 'Home::sejarah');
$routes->get('/resep', 'Home::resep');
$routes->get('/resep/detail/(:num)', 'Home::resepDetail/$1');
$routes->get('/sejarah', 'Home::sejarah');
$routes->get('/sejarah/detail/(:num)', 'Home::sejarahDetail/$1');

// endpoints untuk serve image (fallback BLOB)
$routes->get('/home/imgResep/(:num)', 'Home::imgResep/$1');
$routes->get('/home/imgSejarah/(:num)', 'Home::imgSejarah/$1');

$routes->get('/galeri', 'Home::galeri');
$routes->get('/kontak', 'Home::kontak');
$routes->get('/login', 'Home::login');

