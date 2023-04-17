<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\DashboardModel;

class UtilityController extends AdminController {

    public function __construct() {
        parent::__construct();        
        $this->dashboardModel = new DashboardModel();
    }

    public function grievances() {    
        $this->data['js'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'filter.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\utility\datatable', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function news() {    
        $this->data['js'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'filter.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\utility\datatable', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

}
