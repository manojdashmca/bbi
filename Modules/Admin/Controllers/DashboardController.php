<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\DashboardModel;

class DashboardController extends AdminController {

    public function __construct() {
        parent::__construct();        
        $this->dashboardModel = new DashboardModel();
    }

    public function index() {    
        $this->data['js'] = 'dashboard';
        $this->data['css'] = 'dashboard';
        $this->data['includefile'] = 'dashboard/index.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\dashboard\index', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }
    
}
