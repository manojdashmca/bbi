<?php

$routes->group("backoffice", ["namespace" => "\Modules\Admin\Controllers"], function ($routes) {
    //---------Auth Controller----
    $routes->match(['get', 'post'], "login", "AuthController::login");
    $routes->match(['get', 'post'], "forgot-password", "AuthController::forgotpassword");
    $routes->get("reset-password", "AuthController::resetpassword");
    $routes->get("logout", "AuthController::logout");
    $routes->get("un-authorised", "AuthController::unAuthorisedAccess");
    //-----Dashboard Controller-----
    $routes->get("dashboard", "DashboardController::index");
    $routes->get("/", "DashboardController::index");
    $routes->get("get-dashboard-data", "DashboardController::getDashBoardData");
    //------IBO Controller   
    $routes->get("ibo-list", "IBOController::index");
    $routes->match(['get', 'post'], "ibo-add", "IBOController::add");
    $routes->post("ibo-data", "IBOController::ibodata");
    $routes->get("ibo-edit/(:any)", "IBOController::edit/$1");
    $routes->get("get-sponsordetail-by-id/(:any)", "IBOController::getSponsorDetailById/$1");
    $routes->get("get-member-by-id/(:any)", "IBOController::getMemberDetailById/$1");
    $routes->post("delete-ibo-user", "UsersController::deleteIboUser");

    $routes->get("sr_consulting_board", "TeamsController::srConsultingBoard");
    $routes->post("sr_consulting_board_data", "TeamsController::srConsultingBoardData");
    $routes->get("consulting_board", "TeamsController::consultingBoard");
    $routes->post("consulting_board_data", "TeamsController::consultingBoardData");
    $routes->get("state_team", "TeamsController::stateTeam");
    $routes->post("state_team_data", "TeamsController::stateTeamData");
    $routes->get("national_team", "TeamsController::nationalTeam");
    $routes->post("national_team_data", "TeamsController::nationalTeamData");
    $routes->get("zone_team", "TeamsController::zoneTeam");
    $routes->post("zone_team_data", "TeamsController::zoneTeamData");
    $routes->post("update-teams-status", "TeamsController::updateTeamsStatus");
    $routes->post("add-member-to-table", "TeamsController::addUserToTable");

    //genealogy
    $routes->get("sponsor-view", "TreeController::sponsorview");
    $routes->post("tree-sponsorship-data", "TreeController::sponshorshipdata");
    //------Order Controller   
    $routes->get("payment-list", "OrderController::index");
    $routes->post("payment-data", "OrderController::orderdata");
    $routes->post("update-payment-status", "OrderController::updateOrderStatus");
    $routes->get("monthly-tax", "OrderController::monthlytaxstatement");
    //------Module Controller   
    $routes->get("module-list", "ModuleController::index");
    $routes->match(['get', 'post'], "module-add", "ModuleController::add");
    $routes->post("module-data", "ModuleController::moduledata");
    $routes->match(['get', 'post'], "module-edit/(:any)", "ModuleController::edit/$1");
    $routes->get("module-detailview/(:any)", "ModuleController::detailview/$1");
    $routes->get("get-moduledetail-by-id/(:any)", "ModuleController::getModuleDetailById/$1");
    $routes->post("update-module-status", "ModuleController::updateModuleStatus");
    $routes->post("update-module-director", "ModuleController::updateModuleDirectors");
    $routes->get("segment-list", "ModuleController::segmentlist");
    $routes->post("segment-data", "ModuleController::segmentdata");
    $routes->post("update-segcatsubcat-status", "ModuleController::updateSegmentCategorySubcategoryStatus");
    $routes->match(['get', 'post'], "segment-edit/(:any)", "ModuleController::editSegment/$1");
    $routes->match(['get', 'post'], "segment-add", "ModuleController::addSegment");
    $routes->get("category-list", "ModuleController::categorylist");
    $routes->post("category-data", "ModuleController::categoryData");
    $routes->match(['get', 'post'], "category-edit/(:any)", "ModuleController::editCategory/$1");
    $routes->match(['get', 'post'], "category-add", "ModuleController::addCategory");
    $routes->get("subcategory-list", "ModuleController::subcategorylist");
    $routes->post("subcategory-data", "ModuleController::subcategoryData");
    $routes->match(['get', 'post'], "subcategory-edit/(:any)", "ModuleController::editSubcategory/$1");
    $routes->match(['get', 'post'], "subcategory-add", "ModuleController::addSubcategory");
    $routes->get("module-subcategory-status", "ModuleController::moduleSubcategoryStatus");
    $routes->post("module-subcategory-data", "ModuleController::moduleSubcategoryData");
    //------Payout Controller   
    $routes->get("payout-dates", "PayoutController::payoutDates");
    $routes->post("payout-dates-data", "PayoutController::payourDatesData");
    $routes->get("payout-member", "PayoutController::memberPayout");
    $routes->post("payout-member-data", "PayoutController::payourMemberData");

    //------Reports Controller   
    $routes->get("business-report", "ReportsController::business");
    $routes->get("company-performance", "ReportsController::performance");

    //-----Personal Controller
    $routes->get("profile", "PersonalController::index");
    $routes->match(['get', 'post'], "change-password", "PersonalController::changepassword");

    //-----Users Controller
    $routes->get("users-list", "UsersController::index");
    $routes->match(['get', 'post'], "user-add", "UsersController::add");
    $routes->match(['get', 'post'], "user-edit/(:any)", "UsersController::edit/$1");
    $routes->get("user-detailview/(:any)", "UsersController::detailview/$1");
    $routes->match(['get', 'post'], "user-controlls/(:any)", "UsersController::controlls/$1");
    $routes->post("users-data", "UsersController::userdata");
    $routes->post("delete-admin-user", "UsersController::deleteAdminUser");

    $routes->match(['get', 'post'], "add-new-user", "UsersController::addNewUser");
    //-----Configuration Controller
    $routes->match(['get', 'post'], "configuration", "ConfigurationController::index");
    $routes->get("webcontact", "UtilityController::webcontact");
    $routes->match(['get', 'post'], "webcontact-data", "UtilityController::webcontactData");
    $routes->get("startamodule", "UtilityController::startamodule");
    $routes->match(['get', 'post'], "startamodule-data", "UtilityController::startamoduleData");

    $routes->get("addressByPincode/(:any)", "AuthController::addressByPincode/$1");
    $routes->get("getBankDetailByIfsc/(:any)", "AuthController::getBankDetailByIfsc/$1");
    $routes->post("update-contact-detail", "AuthController::updateContactDetail");
    $routes->post("update-personal-detail", "AuthController::updatePersonalDetail");
    #$routes->post("update-nominee-detail", "AuthController::updateNomineeDetail");
    $routes->post("update-banking-detail", "AuthController::updateBankingDetail");
    $routes->post("update-login-detail", "AuthController::updateLoginDetail");
    $routes->post("update-profile-pic", "AuthController::updateProfilePic");
    $routes->post("update-user-status", "AuthController::updateUserStatus");

    $routes->post("get-category-by-segment", "AuthController::getCategoryBySegment");
    $routes->post("get-subcategory-by-category-module", "AuthController::getSubCategoryByCategoryModule");

    $routes->post("check-pan", "AuthController::checkpan");
    $routes->post("check-mobile", "AuthController::checkmobile");
    $routes->post("check-email", "AuthController::checkemail");

    //----------------------------Cron------------------    
    $routes->get("send-pending-emails", "CronController::sendPendingEmails");
    $routes->get("delete-system-log", "CronController::deleteSystemLogs");
    $routes->get("delete-email-attachment", "CronController::deleteEmailAttachment");
    $routes->get("confirm-transaction", "CronController::confirmTransaction");
    $routes->get("create-payout-date", "CronController::createPayoutDate");
    $routes->get("update-sync-status/(:any)", "CronController::updateSyncStatus/$1");
    
    $routes->get("generate-payout", "CronController::generatePayout");
    $routes->get("update-gross-income", "CronController::updateGrossIncome");
    
    

//    $routes->set404Override(function () {
//        return view('\Modules\Admin\Views\auth\404');
//    });
});
