<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->add('/', 'Home::index');
$routes->add('/check_ip', 'Home::check_ip');
$routes->add('/notifikasi', 'Home::notifikasi');
$routes->add('/jadwal_libur', 'Home::jadwal_libur');
$routes->add('/jadwal_kerja', 'Home::jadwal_kerja');
$routes->add('/absen', 'Home::absen');
$routes->add('/ajax_online', 'Home::ajax_online');
$routes->add('/absen_day/(:any)', 'Home::absen_day/$1');
$routes->add('/notifikasi/(:any)', 'Home::notifikasi/dibaca');
$routes->add('/dlaporan/(:any)', 'Home::dlaporan/$1');



$routes->add('/laporan', 'Home::laporan');
$routes->add('/laporan/(:any)', 'Home::laporan2/$1');
$routes->add('/laporan/(:any)', 'Home::laporan/$1');
$routes->add('/download_laporan', 'Home::download_laporan');
$routes->add('/download_laporan/(:any)', 'Home::download_laporan/$1');
$routes->add('/rekap_data', 'Home::rekap_data');



$routes->add('/pengguna', 'Home::pengguna');
$routes->add('/cari', 'Home::cari');
$routes->add('/data_absen', 'Home::data_absen');
$routes->add('/data_absen/(:any)', 'Home::data_absen/$1');
$routes->add('/absen_wfh', 'Home::absen_wfh');
$routes->add('/absen_wfh/(:any)', 'Home::absen_wfh/$1');
$routes->add('/absen_wfh/(:any)/(:any)', 'Home::absen_wfh/$1/$2');
$routes->add('/confirm_wfh/(:num)', 'Home::confirm_wfh/$1');


$routes->add('/confirm_absen/(:any)', 'Home::confirm_absen/$1');
$routes->add('/delete_pengguna/(:num)', 'Home::delete_pengguna/$1');
$routes->add('/delete_jabatan/(:num)', 'Home::delete_jabatan/$1');
$routes->add('/delete_golongan/(:num)', 'Home::delete_golongan/$1');
$routes->add('/delete_harilibur/(:num)', 'Home::delete_harilibur/$1');
$routes->add('/profil', 'Home::profil');
$routes->add('/profil/(:num)', 'Home::profil/$1');
$routes->add('/pengaturan', 'Home::pengaturan');
$routes->add('/keluar', 'Home::keluar');
$routes->add('/ganti_password', 'Home::ganti_password');
$routes->add('/edit_profil', 'Home::edit_profil');
$routes->add('/list_absen', 'Home::list_absen');
$routes->add('/presensi', 'Home::list_absen');
$routes->add('/list_absen/(:any)', 'Home::list_absen/$1');


$routes->add('/login', 'Auth::index');
$routes->add('/register', 'Auth::register');
$routes->add('/forget_password', 'Auth::forget_password');

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
