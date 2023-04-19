<?php

$routes->group("backoffice", ["namespace" => "\Modules\Admin\Controllers"], function ($routes) {
    //---------Auth Controller----
    $routes->match(['get', 'post'], "login", "AuthController::login");
    $routes->match(['get', 'post'], "forgot-password", "AuthController::forgotpassword");
    $routes->get("reset-password", "AuthController::resetpassword");
    $routes->get("logout", "AuthController::logout");
    $routes->get("test", "AdminController::test");
    $routes->get("form", "AdminController::form");
    $routes->get("table", "AdminController::table");
    //-----Dashboard Controller-----
    $routes->get("dashboard", "DashboardController::index");
    $routes->get("/", "DashboardController::index");
    //------IBO Controller   
    $routes->get("ibo-list", "IBOController::index");
    $routes->match(['get', 'post'], "ibo-add", "IBOController::add");
    $routes->post("ibo-data", "IBOController::ibodata");
    $routes->get("ibo-edit/(:any)", "IBOController::edit/$1"); 
    $routes->get("get-sponsordetail-by-id/(:any)", "IBOController::getSponsorDetailById/$1");
    $routes->post("ibo-virtual-bp-data", "IBOController::iboVirtcualBpData");
    $routes->get("ibo-virtual-bp", "IBOController::iboVirtcualBp");
    $routes->get("get-member-by-id/(:any)", "IBOController::getMemberDetailById/$1");
    $routes->post("add-virtualbp-transaction", "IBOController::addBpTransaction");
    $routes->post("cancel-vbp-transaction", "IBOController::cancelVBPTransaction");
    $routes->post("update-sponsor", "IBOController::updateSponsor");   

    //------Tree Controller   
//    $routes->get("binary-tree", "TreeController::index");
//    $routes->get("sponsor-view", "TreeController::sponsorview");
//    $routes->post("tree-sponsorship-data", "TreeController::sponshorshipdata");
//    $routes->get("downline-view", "TreeController::downlianeview");
//    $routes->post("tree-downline-data", "TreeController::downlianedata");
//    $routes->post("tree-treeview-data", "TreeController::treeview");

    //------Order Controller   
    $routes->get("order-list", "OrderController::index");
    $routes->post("order-data", "OrderController::orderdata");
    $routes->post("update-order-status", "OrderController::updateOrderStatus");    
    $routes->get("monthly-tax", "OrderController::monthlytaxstatement");
    $routes->get("order-add", "OrderController::addNewOrder");
    $routes->get("get-ibo-by-id-order/(:any)", "OrderController::getIBODetailByIdOrder/$1");
    $routes->post("place-order", "OrderController::createOrder"); 
    $routes->post("place-repurchase-order", "OrderController::createRepurchaseOrder"); 
    $routes->get("order-manage-shipping", "OrderController::manageShipping");
    $routes->post("order-Shipping-data", "OrderController::shippingdata");
    $routes->post("update-shipping", "OrderController::updateShipping");
    $routes->post("update-shipping-status", "OrderController::updateShippingStatus");
    //------Module Controller   
    $routes->get("module-list", "ModuleController::index");
    $routes->match(['get', 'post'], "module-add", "ModuleController::add");
    $routes->post("module-data", "ModuleController::moduledata");
    $routes->match(['get', 'post'], "module-edit/(:any)", "ModuleController::edit/$1");
    $routes->get("module-detailview/(:any)", "ModuleController::detailview/$1"); 
    $routes->get("get-moduledetail-by-id/(:any)", "ModuleController::getModuleDetailById/$1");
    $routes->post("update-module-status", "ModuleController::updateModuleStatus");
    $routes->post("update-module-director","ModuleController::updateModuleDirectors");
    //------Coupons Controller   
    $routes->get("coupon-list", "CouponsController::index");

    //------Ewallet Controller   
    $routes->get("e-wallet-balance", "EwalletController::balance");
    $routes->get("e-wallet-request", "EwalletController::request");
    $routes->get("e-wallet-transaction", "EwalletController::transaction");

    //------Payout Controller   
    $routes->get("daily-payout", "PayoutController::dailypayout");
    $routes->get("weekly-payout", "PayoutController::weeklypayout");
    $routes->get("rank-report", "PayoutController::rankreport");
    $routes->get("reward-report", "PayoutController::rewardreport");
    $routes->get("franchise-income", "PayoutController::franchiseincome");
    $routes->get("monthly-franchise-payout", "PayoutController::monthlyfranchisepayout");

    //------Reports Controller   
    $routes->get("business-report", "ReportsController::business");
    $routes->get("company-performance", "ReportsController::performance");

    //------Utility Controller   
    $routes->get("grievances-list", "UtilityController::grievances");
    $routes->get("news-list", "UtilityController::news");

    //------Verification Controller   
    $routes->get("kyc-verification", "VerificationController::kycverification");
    $routes->get("kyc-user", "VerificationController::kycuser");
    $routes->get("proficpic-verification", "VerificationController::profilepic");
    $routes->get("kyc-franchise", "VerificationController::kycfranchise");
    //------Configuration Controller   
    $routes->match(['get', 'post'], "configuration", "ConfigurationController::index");

    //-----Personal Controller
    $routes->get("profile", "PersonalController::index");
    $routes->post("change-password", "PersonalController::changepassword");

    //-----Users Controller
    $routes->get("users-list", "UsersController::index");
    $routes->match(['get', 'post'], "user-add", "UsersController::add");
    $routes->match(['get', 'post'], "user-edit/(:any)", "UsersController::edit/$1");
    $routes->get("user-detailview/(:any)", "UsersController::detailview/$1");
    $routes->match(['get', 'post'], "user-controlls/(:any)", "UsersController::controlls/$1");
    $routes->post("users-data", "UsersController::userdata");

    $routes->match(['get', 'post'], "add-new-user", "UsersController::addNewUser");
    //-----Configuration Controller
    $routes->match(['get', 'post'], "configuration", "AdminController::configuration");

    $routes->get("addressByPincode/(:any)", "AuthController::addressByPincode/$1");
    $routes->get("getBankDetailByIfsc/(:any)", "AuthController::getBankDetailByIfsc/$1");
    $routes->post("update-contact-detail", "AuthController::updateContactDetail");
    $routes->post("update-personal-detail", "AuthController::updatePersonalDetail");
    $routes->post("update-nominee-detail", "AuthController::updateNomineeDetail");
    $routes->post("update-banking-detail", "AuthController::updateBankingDetail");
    $routes->post("update-login-detail", "AuthController::updateLoginDetail");
    $routes->post("update-kyc-detail", "AuthController::updateKycDetail");
    $routes->post("update-user-status", "AuthController::updateUserStatus");

//    $routes->set404Override(function () {
//        return view('\Modules\Admin\Views\auth\404');
//    });
});
