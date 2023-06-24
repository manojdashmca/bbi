<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Modules\Admin\Models\IboModel;
use Modules\Admin\Models\ModuleModel;
use Modules\Admin\Models\OrderModel;
use Modules\Admin\Models\PayoutModel;
use Modules\Admin\Models\TeamsModel;
use Modules\Admin\Models\UsersModel;
use Modules\Admin\Models\UtilityModel;

class ReportsController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->spreadsheet = new Spreadsheet();
    }

    public function downloadAdminUserReport() {
        $this->usersModel = new UsersModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'User Id');
        $sheet->setCellValue('D1', 'Mobile No');
        $sheet->setCellValue('E1', 'Email Id');
        $sheet->setCellValue('F1', 'System Access');
        $sheet->setCellValue('G1', 'Date Of Join');
        $sheet->setCellValue('H1', 'User Status');
        extract($_REQUEST);
        $daterange = generateDateFromDateRange($daterange);
        $data = array('name' => $name, 'mobile' => $mobile, 'status' => $status, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);

        $userlistdata = $this->usersModel->selectUsers($data, 6, 'desc', 0, 9999);
        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->user_name);
            $sheet->setCellValue('C' . $rows, $user->user_coden);
            $sheet->setCellValue('D' . $rows, $user->user_mobile);
            $sheet->setCellValue('E' . $rows, $user->user_email);
            $sheet->setCellValue('F' . $rows, $user->user_status);
            $sheet->setCellValue('G' . $rows, $user->createedon);
            $sheet->setCellValue('H' . $rows, $user->userstatus);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('user_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadIboUserReport() {
        $this->iboModel = new IboModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'User Id');
        $sheet->setCellValue('D1', 'Module Name');
        $sheet->setCellValue('E1', 'City');
        $sheet->setCellValue('F1', 'Mobile');
        $sheet->setCellValue('G1', 'Referrer Code and Name');
        $sheet->setCellValue('H1', 'Segment');
        $sheet->setCellValue('I1', 'Category');
        $sheet->setCellValue('J1', 'DOJ');
        $sheet->setCellValue('K1', 'System Access');
        $sheet->setCellValue('L1', 'Member Status');
        extract($_REQUEST);
        $daterange = generateDateFromDateRange($daterange);
        $data = array('name' => $name, 'moduleid' => $moduleid, 'mobile' => $mobile, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
        $userlistdata = $this->iboModel->selectIbo($data, 10, 'desc', 0, 9999);
        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->user_name);
            $sheet->setCellValue('C' . $rows, $user->user_coden);
            $sheet->setCellValue('D' . $rows, $user->lm_name);
            $sheet->setCellValue('E' . $rows, $user->user_city);
            $sheet->setCellValue('F' . $rows, $user->user_mobile);
            $sheet->setCellValue('G' . $rows, $user->sponsor);
            $sheet->setCellValue('H' . $rows, $user->segment_name);
            $sheet->setCellValue('I' . $rows, $user->category_name);
            $sheet->setCellValue('J' . $rows, $user->createedon);
            $sheet->setCellValue('K' . $rows, $user->user_status);
            $sheet->setCellValue('L' . $rows, $user->userstatus);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('member_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadReferralUserReport() {
        $this->iboModel = new IboModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Member Id/Code/User Name');
        $sheet->setCellValue('C1', 'City');
        $sheet->setCellValue('D1', 'Mobile');
        $sheet->setCellValue('E1', 'Email');
        $sheet->setCellValue('F1', 'DOJ');
        $sheet->setCellValue('G1', 'Level');
        extract($_REQUEST);
        $data = array('code' => $code, 'level' => $level);
        $treedata = $this->iboModel->selectSponsorship($data, 0, 9999);
        $userlist = $treedata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->user_coden);
            $sheet->setCellValue('C' . $rows, $user->user_city);
            $sheet->setCellValue('D' . $rows, $user->user_mobile);
            $sheet->setCellValue('E' . $rows, $user->user_email);
            $sheet->setCellValue('F' . $rows, $user->user_create_date);
            $sheet->setCellValue('G' . $rows, $user->level);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('referrer_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadOrderReport() {
        $this->orderModel = new OrderModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Member Name');
        $sheet->setCellValue('C1', 'Payment Date');
        $sheet->setCellValue('D1', 'Joining Fee');
        $sheet->setCellValue('E1', 'Topup Fee');
        $sheet->setCellValue('F1', 'GST');
        $sheet->setCellValue('G1', 'Payment Amount');
        $sheet->setCellValue('H1', 'Payment Type');
        $sheet->setCellValue('I1', 'Payment Detail');
        $sheet->setCellValue('J1', 'Payment Status');
        $sheet->setCellValue('K1', 'Booked Service');
        $sheet->setCellValue('L1', 'Payout Status');
        extract($_REQUEST);
        $daterange = generateDateFromDateRange($daterange);
        $data = array('moduleid' => $moduleid, 'status' => $status, 'name' => $name, 'mobile' => $mobile, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
        $userlistdata = $this->orderModel->selectIBOOrder($data, 2, 'desc', 0, 9999);

        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->user_coden);
            $sheet->setCellValue('C' . $rows, $user->payment_date);
            $sheet->setCellValue('D' . $rows, $user->joining_fee);
            $sheet->setCellValue('E' . $rows, $user->topup_fee);
            $sheet->setCellValue('F' . $rows, $user->gst);
            $sheet->setCellValue('G' . $rows, $user->payment_amount);
            $sheet->setCellValue('H' . $rows, $user->payment_method);
            $sheet->setCellValue('I' . $rows, $user->payment_remark);
            $sheet->setCellValue('J' . $rows, $user->paymentstatus);
            $sheet->setCellValue('K' . $rows, $user->bookedservice);
            $sheet->setCellValue('L' . $rows, $user->payout);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('payment_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadModuleReport() {
        $this->moduleModel = new ModuleModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Module Code');
        $sheet->setCellValue('C1', 'Module Name');
        $sheet->setCellValue('D1', 'City');
        $sheet->setCellValue('E1', 'State');
        $sheet->setCellValue('F1', 'Nation');
        $sheet->setCellValue('G1', 'Director');
        $sheet->setCellValue('H1', 'Assistant Director');
        $sheet->setCellValue('I1', 'Associate Director');
        $sheet->setCellValue('J1', 'Status');

        extract($_REQUEST);
        $daterange = generateDateFromDateRange($daterange);
        $data = array('name' => $name, 'code' => $code, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
        $userlistdata = $this->moduleModel->selectModule($data, 1, 'ASC', 0, 9999);

        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->lm_code);
            $sheet->setCellValue('C' . $rows, $user->lm_name);
            $sheet->setCellValue('D' . $rows, $user->lm_city);
            $sheet->setCellValue('E' . $rows, $user->lm_state);
            $sheet->setCellValue('F' . $rows, $user->lm_country);
            $sheet->setCellValue('G' . $rows, $user->director);
            $sheet->setCellValue('H' . $rows, $user->associate);
            $sheet->setCellValue('I' . $rows, $user->assistant);
            $sheet->setCellValue('J' . $rows, $user->status);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('module_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadSegmentReport() {
        $this->moduleModel = new ModuleModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Segment Name');
        $sheet->setCellValue('C1', 'Status');
        extract($_REQUEST);
        $data = array('name' => $name);
        $userlistdata = $this->moduleModel->selectSegment($data, 1, 'ASC', 0, 9999);
        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->segment_name);
            $sheet->setCellValue('C' . $rows, $user->status);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('segment_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadCategoryReport() {
        $this->moduleModel = new ModuleModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Category Name');
        $sheet->setCellValue('C1', 'Segment Name');
        $sheet->setCellValue('D1', 'Status');
        extract($_REQUEST);
        $data = array('cname' => $categoryname, 'sname' => $segmentname);
        $userlistdata = $this->moduleModel->selectCategory($data, 2, 'ASC', 0, 9999);
        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->category_name);
            $sheet->setCellValue('C' . $rows, $user->segment_name);
            $sheet->setCellValue('D' . $rows, $user->status);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('category_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadSubcategoryReport() {
        $this->moduleModel = new ModuleModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Sub Category Name');
        $sheet->setCellValue('C1', 'Category Name');
        $sheet->setCellValue('D1', 'Segment Name');
        $sheet->setCellValue('E1', 'Status');
        extract($_REQUEST);
        $data = array('scname' => $subcategoryname, 'cname' => $categoryname, 'sname' => $segmentname);
        $userlistdata = $this->moduleModel->selectSubCategory($data, 3, 'ASC', 0, 9999);
        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->sub_category_name);
            $sheet->setCellValue('C' . $rows, $user->category_name);
            $sheet->setCellValue('D' . $rows, $user->segment_name);
            $sheet->setCellValue('E' . $rows, $user->status);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('subcategory_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadSubCategoryUsedReport() {
        $this->moduleModel = new ModuleModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Sub Category Name');
        $sheet->setCellValue('C1', 'Category Name');
        $sheet->setCellValue('D1', 'Segment Name');
        $sheet->setCellValue('E1', 'Access Status');
        $sheet->setCellValue('F1', 'Used Status');
        extract($_REQUEST);
        $data = array('module' => $module, 'cname' => $cname, 'sname' => $sname);
        $userlistdata = $this->moduleModel->selectBlockedSubCategory($data, 3, 'ASC', 0, 9999);
        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->sub_category_name);
            $sheet->setCellValue('C' . $rows, $user->category_name);
            $sheet->setCellValue('D' . $rows, $user->segment_name);
            $sheet->setCellValue('E' . $rows, $user->status);
            $sheet->setCellValue('F' . $rows, $user->used);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('blocked_sub_category_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadSrConsultingBoardTeamReport() {
        $this->teamsModel = new TeamsModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Member Name');
        $sheet->setCellValue('C1', 'Member Code');
        $sheet->setCellValue('D1', 'User Name');
        $sheet->setCellValue('E1', 'Date joined The Team');
        extract($_REQUEST);
        $daterange = generateDateFromDateRange($daterange);
        $data = array('name' => $name, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
        $userlistdata = $this->teamsModel->selectSrConsultingBoard($data, 1, 'ASC', 0, 9999);
        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->user_name);
            $sheet->setCellValue('C' . $rows, $user->user_code);
            $sheet->setCellValue('D' . $rows, $user->user_login_name);
            $sheet->setCellValue('E' . $rows, $user->join_date);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('sr_consultingt_board_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadConsultingBoardTeamReport() {
        $this->teamsModel = new TeamsModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Member Name');
        $sheet->setCellValue('C1', 'Member Code');
        $sheet->setCellValue('D1', 'User Name');
        $sheet->setCellValue('E1', 'Date joined The Team');
        extract($_REQUEST);
        $daterange = generateDateFromDateRange($daterange);
        $data = array('name' => $name, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
        $userlistdata = $this->teamsModel->selectConsultingBoard($data, 1, 'ASC', 0, 9999);
        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->user_name);
            $sheet->setCellValue('C' . $rows, $user->user_code);
            $sheet->setCellValue('D' . $rows, $user->user_login_name);
            $sheet->setCellValue('E' . $rows, $user->join_date);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('consulting_board_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadNationalTeamReport() {
        $this->teamsModel = new TeamsModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Member Name');
        $sheet->setCellValue('C1', 'Member Code');
        $sheet->setCellValue('D1', 'User Name');
        $sheet->setCellValue('E1', 'Date joined The Team');
        extract($_REQUEST);
        $daterange = generateDateFromDateRange($daterange);
        $data = array('name' => $name, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
        $userlistdata = $this->teamsModel->selectNationalTeam($data, 1, 'ASC', 0, 9999);
        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->user_name);
            $sheet->setCellValue('C' . $rows, $user->user_code);
            $sheet->setCellValue('D' . $rows, $user->user_login_name);
            $sheet->setCellValue('E' . $rows, $user->join_date);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('national_team_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadStateTeamReport() {
        $this->teamsModel = new TeamsModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Member Name');
        $sheet->setCellValue('C1', 'Member Code');
        $sheet->setCellValue('D1', 'User Name');
        $sheet->setCellValue('E1', 'Date joined The Team');
        extract($_REQUEST);
        $daterange = generateDateFromDateRange($daterange);
        $data = array('name' => $name, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
        $userlistdata = $this->teamsModel->selectStateTeam($data, 1, 'ASC', 0, 9999);
        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->user_name);
            $sheet->setCellValue('C' . $rows, $user->user_code);
            $sheet->setCellValue('D' . $rows, $user->user_login_name);
            $sheet->setCellValue('E' . $rows, $user->join_date);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('state_team_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadZoneTeamReport() {
        $this->teamsModel = new TeamsModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Member Name');
        $sheet->setCellValue('C1', 'Member Code');
        $sheet->setCellValue('D1', 'User Name');
        $sheet->setCellValue('E1', 'Date joined The Team');
        extract($_REQUEST);
        $daterange = generateDateFromDateRange($daterange);
        $data = array('name' => $name, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
        $userlistdata = $this->teamsModel->selectZoneTeam($data, 1, 'ASC', 0, 9999);
        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->user_name);
            $sheet->setCellValue('C' . $rows, $user->user_code);
            $sheet->setCellValue('D' . $rows, $user->user_login_name);
            $sheet->setCellValue('E' . $rows, $user->join_date);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('zone_team_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadMemberPayoutReport() {
        $this->payoutModel = new PayoutModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Member Name');
        $sheet->setCellValue('C1', 'Payout Range');
        $sheet->setCellValue('D1', 'Gross Income');
        $sheet->setCellValue('E1', 'TDS Deducted');
        $sheet->setCellValue('F1', 'Net Income');
        $sheet->setCellValue('G1', 'Release Status');
        $sheet->setCellValue('H1', 'Release Date');
        $sheet->setCellValue('I1', 'Release Detail');
        extract($_REQUEST);
        $daterange = generateDateFromDateRange($daterange);
        $data = array('name' => $name, 'payout' => $payout, 'mobile' => $mobile, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
        $userlistdata = $this->payoutModel->selectMemberPayout($data, 1, 'ASC', 0, 9999);
        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->user_coden);
            $sheet->setCellValue('C' . $rows, $user->payout);
            $sheet->setCellValue('D' . $rows, $user->gross_income);
            $sheet->setCellValue('E' . $rows, $user->tds_deducted);
            $sheet->setCellValue('F' . $rows, $user->net_income);
            $sheet->setCellValue('G' . $rows, $user->releasestatus);
            $sheet->setCellValue('H' . $rows, $user->releasedate);
            $sheet->setCellValue('I' . $rows, $user->release_detail);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('payout_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadWebContactReport() {
        $this->utilityModel = new UtilityModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Mobile');
        $sheet->setCellValue('E1', 'Subject');
        $sheet->setCellValue('F1', 'Text');
        $sheet->setCellValue('G1', 'Contact Date');
        extract($_REQUEST);
        $daterange = generateDateFromDateRange($daterange);
        $data = array('name' => $name, 'email' => $email, 'mobile' => $mobile, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
        $userlistdata = $this->utilityModel->selectWebcontact($data, 1, 'ASC', 0, 9999);
        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->name);
            $sheet->setCellValue('C' . $rows, $user->email);
            $sheet->setCellValue('D' . $rows, $user->mobile);
            $sheet->setCellValue('E' . $rows, $user->subject);
            $sheet->setCellValue('F' . $rows, $user->message);
            $sheet->setCellValue('G' . $rows, $user->create_date);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('webcontact_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }

    public function downloadStartAModuleReport() {
        $this->utilityModel = new UtilityModel();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Sl No');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Mobile');
        $sheet->setCellValue('E1', 'Area');
        $sheet->setCellValue('F1', 'Text');
        $sheet->setCellValue('G1', 'Contact Date');
        extract($_REQUEST);
        $daterange = generateDateFromDateRange($daterange);
        $data = array('area' => $area, 'name' => $name, 'email' => $email, 'mobile' => $mobile, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
        $userlistdata = $this->utilityModel->selectStartamodule($data, 1, 'ASC', 0, 9999);
        $userlist = $userlistdata['data'];
        $rows = 2;
        foreach ($userlist as $user) {
            $sheet->setCellValue('A' . $rows, ($rows - 1));
            $sheet->setCellValue('B' . $rows, $user->name);
            $sheet->setCellValue('C' . $rows, $user->email);
            $sheet->setCellValue('D' . $rows, $user->mobile);
            $sheet->setCellValue('E' . $rows, $user->area);
            $sheet->setCellValue('F' . $rows, $user->message);
            $sheet->setCellValue('G' . $rows, $user->create_date);
            $rows++;
        }
        $writer = new Xlsx($this->spreadsheet);
        $writer->save('report.xlsx');
        return $this->response->download('report.xlsx', null)->setFileName('startamodule_report_' . date('d_m_Y_H_i_s') . '.xlsx');
    }
}
