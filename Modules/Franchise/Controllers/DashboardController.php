<?php

namespace Modules\Franchise\Controllers;

use Modules\Franchise\Controllers\FranchiseController;

//use Modules\Admin\Models\AdminModel;

class DashboardController111111 extends DoctorController {

    public function __construct() {
        parent::__construct();
        $this->data['js'] = 'stickyleft';
    }

    public function index() {
        $this->data['js'] = 'dd';
        return view('templates\header', $this->data)
                . view('\Modules\Doctor\Views\dashboard\index', $this->data)
                . view('templates\footer', $this->data);
    }    

}
