<?php

$routes->group("api/v1", ["namespace" => "\Modules\Api\Controllers"], function ($routes) {    
    // welcome page - URL: /admin
    $routes->get("/", "ApiController::index");
    
});
