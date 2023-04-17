<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\DashboardModel;

class PayoutController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->dashboardModel = new DashboardModel();
    }

    public function dailypayout() {
        $this->data['js'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'filter.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\payout\datatable', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function weeklypayout() {
        $this->data['js'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'filter.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\payout\datatable', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function rankreport() {
        $this->data['js'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'filter.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\payout\datatable', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function rewardreport() {
        $this->data['js'] = 'datatable,sweetalert,alertify';
        $this->data['css'] = 'datatable,sweetalert,alertify';
        $this->data['includefile'] = 'filter.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\payout\datatable', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function franchiseincome() {
        $this->data['js'] = 'datatable,sweetalert,alertify';
        $this->data['css'] = 'datatable,sweetalert,alertify';
        $this->data['includefile'] = 'filter.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\payout\datatable', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function monthlyfranchisepayout() {
        $this->data['js'] = 'datatable,sweetalert,alertify';
        $this->data['css'] = 'datatable,sweetalert,alertify';
        $this->data['includefile'] = 'filter.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\payout\datatable', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

}
