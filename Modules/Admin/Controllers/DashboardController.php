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
        $usercounts = $this->dashboardModel->getUserCount();
        $member = $franchise = 0;
        for ($x = 0; $x < count($usercounts); $x++) {
            ($usercounts[$x]->user_type == 1) ? $member = $usercounts[$x]->count : '';
        }
        $this->data['topdata'] = array(
            "totalmodule" => 10,
            "totalsegment" => 10,
            "totalcategory" => 10,
            "totalsubcategory" => 18,
            "totalmember" => $member,
            "totalJoiningOfTheMonth" => 700,
            "payoutofthemonth" => 18000);
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\dashboard\index', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function getDashBoardData() {

        $topearnerseries = array(46, 57, 59, 54, 62);
        $topearnerlables = array("GS Parida", "Sangram", "Manoj", "Riaz", "Rahul");

        $payoutdata = array(46, 57, 59, 54);
        $businessdata = array(80, 65, 80, 97);
        $monthdata = array("01/01/2023", "02/01/2023", "03/01/2023", "04/01/2023");
        $data = array(
            "chart2data" => array(
                "series" => $topearnerseries,
                "lables" => $topearnerlables),
            "chart3data" => array("payoutdata" => $payoutdata,
                "businessdata" => $businessdata,
                "monthdata" => $monthdata));
        echo json_encode($data);
        exit;
    }

}
