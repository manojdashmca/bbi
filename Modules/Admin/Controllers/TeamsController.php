<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\TeamsModel;

class TeamsController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->teamsModel = new TeamsModel();
    }

    public function srConsultingBoard() {        
        $this->checkAccessControll(7);
        $this->data['title']="Sr Consulting Board";
        $this->data['js'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'teams/commonfunction.php,teams/srconsultingboardlist.php';

        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\teams\srconsultingboardlist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function srConsultingBoardData() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $username = trim($this->request->getPost('username'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->teamsModel->selectSrConsultingBoard($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedsrconsultingboarddata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedsrconsultingboarddata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $action = '';
            //$action .= '<a class="blue" title="View Detail" href="#" onclick=""><i class="fas fa-search"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            if (in_array(25, session()->get('accesscontrols'))) {
                if ($data[$x]->status == 1) {
                    $action .= '<a class="blue"  title="Remove Member" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->scaab_id) . '&#39;,2);"><i class="fas fa-trash"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            $arraydata[$x]->status = $action;
            $values = array_values((array) $arraydata[$x]);

            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    //-----consulting--
    public function consultingBoard() {
        $this->checkAccessControll(7);
        $this->data['title']="Consulting Board";
        $this->data['js'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'teams/commonfunction.php,teams/consultingboardlist.php';

        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\teams\consultingboardlist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function consultingBoardData() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $username = trim($this->request->getPost('username'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->teamsModel->selectConsultingBoard($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedconsultingboarddata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedconsultingboarddata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $action = '';
            //$action .= '<a class="blue" title="View Detail" href="#" onclick=""><i class="fas fa-search"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            if (in_array(27, session()->get('accesscontrols'))) {
                if ($data[$x]->status == 1) {
                    $action .= '<a class="blue"  title="Remove Member" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->cbt_id) . '&#39;,2);"><i class="fas fa-trash"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            $arraydata[$x]->status = $action;
            $values = array_values((array) $arraydata[$x]);

            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    //---------consulting
    //-----stateteam--
    public function stateTeam() {
        $this->checkAccessControll(7);
        $this->data['title']="State Team";
        $this->data['js'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'teams/commonfunction.php,teams/stateteamlist.php';

        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\teams\stateteamlist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function stateTeamData() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $username = trim($this->request->getPost('username'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->teamsModel->selectStateTeam($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedstateTeamddata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedstateTeamddata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $action = '';
            //$action .= '<a class="blue" title="View Detail" href="#" onclick=""><i class="fas fa-search"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            if (in_array(29, session()->get('accesscontrols'))) {
                if ($data[$x]->status == 1) {
                    $action .= '<a class="blue"  title="Remove Member" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->st_id) . '&#39;,2);"><i class="fas fa-trash"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            $arraydata[$x]->status = $action;
            $values = array_values((array) $arraydata[$x]);

            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    //---------stateteam
    //-----nationalteam--
    public function nationalTeam() {
        $this->checkAccessControll(7);
        $this->data['title']="National Team";
        $this->data['js'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'teams/commonfunction.php,teams/nationalteamlist.php';

        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\teams\nationalteamlist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function nationalTeamData() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $username = trim($this->request->getPost('username'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->teamsModel->selectNationalTeam($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatednationalTeamddata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatednationalTeamddata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $action = '';
            //$action .= '<a class="blue" title="View Detail" href="#" onclick=""><i class="fas fa-search"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            if (in_array(31, session()->get('accesscontrols'))) {
                if ($data[$x]->status == 1) {
                    $action .= '<a class="blue"  title="Remove Member" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->nt_id) . '&#39;,2);"><i class="fas fa-trash"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            $arraydata[$x]->status = $action;
            $values = array_values((array) $arraydata[$x]);

            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    //---------nationalteam
    //-----zone--
    public function zoneTeam() {
        $this->checkAccessControll(7);
        $this->data['title']="Zone Team";
        $this->data['js'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'teams/commonfunction.php,teams/zoneteamlist.php';

        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\teams\zoneteamlist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function zoneTeamData() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $username = trim($this->request->getPost('username'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->teamsModel->selectZoneTeam($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedzoneTeamddata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedzoneTeamddata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $action = '';
            //$action .= '<a class="blue" title="View Detail" href="#" onclick=""><i class="fas fa-search"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            if (in_array(33, session()->get('accesscontrols'))) {
                if ($data[$x]->status == 1) {
                    $action .= '<a class="blue"  title="Remove Member" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->zt_id) . '&#39;,2);"><i class="fas fa-trash"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            $arraydata[$x]->status = $action;
            $values = array_values((array) $arraydata[$x]);

            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    //---------zone

    public function updateTeamsStatus() {
        $data = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $tableidvalue = base64_decode($this->request->getPost('tableid'));
            $status = $this->request->getPost('status');
            $table = $this->request->getPost('table');
            $tableidname = array('team_sr_consulting_board' => 'scaab_id',
                'team_consulting_board' => 'cbt_id',
                'team_national' => 'nt_id',
                'team_state' => 'st_id',
                'team_zone' => 'zt_id');
            $updarray = array('status' => $status);
            $this->adminModel->updateRecordInTable($updarray, $table, $tableidname[$table], $tableidvalue);
            $data = array('status' => 'success', 'message' => 'Member Removed from List');
        }
        echo json_encode($data);
        exit;
    }

    public function addUserToTable() {
        $data = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $tableidvalue = base64_decode($this->request->getPost('tableid'));
            $userid = $this->request->getPost('userid');
            $table = $this->request->getPost('table');
            $tableidname = array('team_sr_consulting_board' => 'scaab_id',
                'team_consulting_board' => 'cbt_id',
                'team_national' => 'nt_id',
                'team_state' => 'st_id',
                'team_zone' => 'zt_id');
            $tabledata = $this->blankModel->getTableData("$tableidname[$table]", $table, 'status=1 and user_id_user=' . $userid);
            if (!empty($tabledata)) {
                $data = array('status' => 'error', 'message' => 'Member Already exists In the list');
            } else {
                $createarray = array('user_id_user' => $userid);
                $this->adminModel->createRecordInTable($createarray, $table);
                $data = array('status' => 'success', 'message' => 'Member Added In the List successfully');
            }
        }
        echo json_encode($data);
        exit;
    }

}
