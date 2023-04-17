<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\DashboardModel;

class CouponsController extends AdminController {

    public function __construct() {
        parent::__construct();        
        $this->dashboardModel = new DashboardModel();
    }

    public function index() {    
        $this->data['js'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'filter.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\coupons\datatable', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function add() {
        $this->data['js'] = 'form';
        $this->data['css'] = 'form';
        $this->data['includefile'] = '';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\coupons\form', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

}
