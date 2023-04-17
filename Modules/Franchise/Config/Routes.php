<?php

$routes->group("outlet", ["namespace" => "\Modules\Franchise\Controllers"], function ($routes) {
    
    //-----Dashboard Controller-----    
    $routes->get("dashboard", "FranchiseController::index");
    $routes->get("/", "FranchiseController::index");          
    $routes->match(['get', 'post'],"profile-setting", "FranchiseController::profilesetting");
    $routes->match(['get', 'post'],"change-password", "FranchiseController::changepassword");   

    //-------------------Ajax Calls-----------
    
    
    //---------------------------------------

   
});
