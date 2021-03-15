<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Main');
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

// Controller Main
$routes->get('/', 'Main::index');
$routes->get('/pembayaran', 'Main::payment');

// Controller Auth
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// Controller Jurusan
$routes->get('/jurusan', 'Jurusan::index');
$routes->get('/jurusan/add', 'Jurusan::create');
$routes->get('/jurusan/edit/(:segment)', 'Jurusan::edit/$1');
$routes->post('/jurusan/save', 'Jurusan::save');
$routes->post('/jurusan/update', 'Jurusan::update');
$routes->delete('/jurusan/delete/(:segment)', 'Jurusan::delete/$1');

// Controller Kelas
$routes->get('/kelas', 'Kelas::index');
$routes->get('/kelas/add', 'Kelas::create');
$routes->get('/kelas/edit/(:segment)', 'Kelas::edit/$1');
$routes->post('/kelas/save', 'Kelas::save');
$routes->post('/kelas/update', 'Kelas::update');
$routes->delete('/kelas/delete/(:segment)', 'Kelas::delete/$1');

// Controller Spp
$routes->get('/spp', 'Spp::index');
$routes->get('/spp/add', 'Spp::create');
$routes->get('/spp/edit/(:segment)', 'Spp::edit/$1');
$routes->post('/spp/save', 'Spp::save');
$routes->post('/spp/update', 'Spp::update');
$routes->delete('/spp/delete/(:segment)', 'Spp::delete/$1');

// Controller Siswa
$routes->get('/siswa', 'Siswa::index');
$routes->get('/siswa/add', 'Siswa::create');
$routes->get('/siswa/edit/(:segment)', 'Siswa::edit/$1');
$routes->get('/siswa/detail/(:segment)', 'Siswa::detail/$1');
$routes->post('/siswa/save', 'Siswa::save');
$routes->post('/siswa/update', 'Siswa::update');
$routes->delete('/siswa/delete/(:segment)', 'Siswa::delete/$1');

// Controller Petugas
$routes->get('/petugas', 'Petugas::index');
$routes->get('/petugas/add', 'Petugas::create');
$routes->get('/petugas/edit/(:segment)', 'Petugas::edit/$1');
$routes->post('/petugas/save', 'Petugas::save');
$routes->post('/petugas/update', 'Petugas::update');
$routes->delete('/petugas/delete/(:segment)', 'Petugas::delete/$1');

// Kuitansi atau Bukti Pembayaran
$routes->get('/(:any)', 'Main::receipt/$1');

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
