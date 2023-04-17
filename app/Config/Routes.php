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
$routes->get('/', 'Home::comingsoon');
/*$routes->get('/', 'Home::homepage');
 $routes->get('about-us', 'Home::aboutus');
$routes->get('products', 'Home::productpage');
$routes->get("product-detail/(:any)", "Home::productdetailpage/$1");
$routes->get('why-wellness', 'Home::whywellness');
$routes->get('resource-download', 'Home::resourcesDownload');
$routes->get('resource-faq', 'Home::resourcesFaq');
$routes->get('partner-with-us', 'Home::partnerwithus');
$routes->get('company-certificate', 'Home::companycertificate');
$routes->get('team-winwellness', 'Home::teamwinwellness');
$routes->get('contact-us', 'Home::contactus');
$routes->get('privacy-policy', 'Home::privacypolicy');
$routes->get('contract-agreement', 'Home::contractAgreement');
$routes->get('shipping-policy', 'Home::shippingpolicy');
$routes->get('cancellation-refund-policy', 'Home::cancellationandrefundpolicy');
$routes->get('term-condition', 'Home::termsandcondition');
$routes->get('disclaimer', 'Home::disclaimer');
$routes->get('grivances', 'Home::grivances');*/

$routes->get('shopping-cart', 'Home::shoppingCart');
$routes->get('checkout', 'Home::checkout');
//---------login related routings-----
$routes->match(['get', 'post'], 'login', 'Home::logMeIn');
$routes->match(['get', 'post'], 'register-me', 'Home::registerMe');
$routes->match(['get', 'post'], 'password-recovery', 'Home::forgotpassword');
//------------------------------
/* User Dashboard Related routing */
$routes->get('user-dashboard', 'UserController::dashboard');
$routes->match(['get', 'post'], 'user-profile', 'UserController::profile');
$routes->match(['get', 'post'], 'change-password', 'UserController::changepassword');
$routes->get('logout', 'UserController::logout');
$routes->get('reset-password', 'Home::resetpassord');

//-----------stop commandline---
$routes->cli('login', 'Home::commandlineblocked');
$routes->cli('forgot-password', 'Home::commandlineblocked');
//$routes->cli('reset-password', 'Home::commandlineblocked');
$routes->cli('register-me', 'Home::commandlineblocked');

//----ajaxcall-------
$routes->match(['get', 'post'], 'check-mobile', 'Home::checkMobileExist');
$routes->match(['get', 'post'], 'check-email', 'Home::checkEmailExist');
//-----------------------------
//--------------------Autometic jobs--------
$routes->get('/jobs/publish-email', 'WebController::sendPendingEmails');
$routes->get('/jobs/delete-email-attachments', 'WebController::deleteEmailAttachment');
$routes->get('/jobs/delete-system-log', 'WebController::deleteSystemLogs');
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
