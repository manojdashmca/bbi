<?php

namespace App\Controllers;

use App\Models\WebModel;
use App\Libraries;

class WebController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->webModel = new WebModel();
        $cntrl = explode('\\', $this->controller);
        $opencontroller = $cntrl[(sizeof($cntrl) - 1)];
        $openmethods = array('login', 'logout', 'forgotpassword', 'registerMe', 'termsandcondition', 'webContactForm');
        if (!in_array($this->method, $openmethods)) {
            if ($this->session->has('mlogin')) {
                
            } else {
                header("location:login");
                exit;
            }
        }
    }

//--------------------------
}
