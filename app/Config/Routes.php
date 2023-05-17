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
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//website related
$routes->get('maintenance-active', 'Home::maintenanceMode');
$routes->get('/', 'Home::dashboard');
$routes->match(['get', 'post'], 'login', 'Home::login');
$routes->match(['get', 'post'], 'forgot-password', 'Home::forgotpassword');
$routes->match(['get', 'post'], 'register-me', 'Home::registerMe');
$routes->get('user-dashboard', 'Home::dashboard');
$routes->get('get-dashboard-data', 'Home::getDashBoardData');
$routes->get('terms-and-conditions', 'Home::termsandcondition');

$routes->get('my-sponsor', 'Home::mysponsor');
$routes->post('my-sponsorship-data', 'Home::mySponsorshipData');
$routes->get('my-profile', 'Home::myprofile');
$routes->get('my-payout', 'Home::mypayout');
$routes->get('payments', 'Home::payments');
$routes->post('my-payout-data', 'Home::myPayoutData');
$routes->get('logout', 'Home::logout');
$routes->match(['get', 'post'], 'change-password', 'Home::changePassword');


//----------------------------------------
$routes->set404Override(function () {
    return view('\App\Views\home\404');
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

/*
 * --------------------------------------------------------------------
 * Additional Routing For Modules
 * --------------------------------------------------------------------
 */
$modules_path = ROOTPATH . 'Modules/';
$modules = scandir($modules_path);

foreach ($modules as $module) {
    if ($module === '.' || $module === '..') {
        continue;
    }

    if (is_dir($modules_path) . '/' . $module) {
        $routes_path = $modules_path . $module . '/Config/Routes.php';
        if (file_exists($routes_path)) {
            require $routes_path;
        } else {
            continue;
        }
    }
}
