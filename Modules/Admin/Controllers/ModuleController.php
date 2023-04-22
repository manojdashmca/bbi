<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\ModuleModel;

class ModuleController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->moduleModel = new ModuleModel();
    }

    public function index() {
        $this->data['js'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'module/modulelist.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\modulelist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function add() {
        $this->data['js'] = 'validation';
        $this->data['css'] = 'validation';
        $this->data['includefile'] = 'module/moduleadd.php';

        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                        'name' => 'required',
                        'city' => 'required',
                        'state' => 'required',
                        'country' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {

                $name = $this->request->getPost('name');
                $city = $this->request->getPost('city');
                $state = $this->request->getPost('state');
                $country = $this->request->getPost('country');
                $checkname = $this->blankModel->getTableData('lm_id', 'location_module', 'LOWER(lm_name)="' . strtolower($name) . '"');
                if (empty($checkname)) {
                    $createarray = array('lm_name' => $name, 'lm_city' => $city, 'lm_state' => $state, 'lm_country' => $country);
                    $lmid = $this->blankModel->createRecordInTable($createarray, 'location_module');
                    $modulecode = $this->createModuleCode($lmid);
                    $this->blankModel->updateRecordInTable(array('lm_code' => $modulecode), 'location_module', 'lm_id', $lmid);
                    $this->session->setFlashdata('message', setMessage("Module added Successfully.", 's'));
                } else {
                    $this->session->setFlashdata('message', setMessage("Module Already exists, Please use a different name.", 'e'));
                }
            }
        }
        
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\moduleadd', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function moduledata() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $code = trim($this->request->getPost('code'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'code' => $code, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->moduleModel->selectModule($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedModuledata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedModuledata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $action = '';
            $action .= '<a class="blue" target="_blank" title="Edit Detail"   href="' . ADMINPATH . 'module-edit/' . base64_encode($data[$x]->lm_id) . '"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
            $action .= "<a title='Detail View' target='_blank' href='" . ADMINPATH . "module-detailview/" . base64_encode($arraydata[$x]->lm_id) . "'><i class='fa fa-search'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            if ($data[$x]->status == 'Active') {
                $action .= '<a class="blue" title="Block Account" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->lm_id) . '&#39;,2);"><i class="fas fa-lock"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }if ($data[$x]->status == 'Blocked') {
                $action .= '<a class="blue"  title="Unblock Account" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->lm_id) . '&#39;,1);"><i class="fas fa-lock-open"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $action .= '<a class="blue" title="Assign Module Director" data-bs-toggle="modal" data-bs-target="#changedirector"   href="#" onclick="putModuleId(&#39;' . base64_encode($data[$x]->lm_id) . '&#39;)"><i class="fas fa-user-shield"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
            $action .= '<a class="blue" title="Assign Module Associate Director" data-bs-toggle="modal"  data-bs-target="#changeassociate"   href="#" onclick="putModuleId(&#39;' . base64_encode($data[$x]->lm_id) . '&#39;)"><i class="fas fa-user-tag"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
            $action .= '<a class="blue" title="Assign Module Assistant Director" data-bs-toggle="modal"  data-bs-target="#changeassistant"   href="#" onclick="putModuleId(&#39;' . base64_encode($data[$x]->lm_id) . '&#39;)"><i class="fas fa-user-tie"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
            $arraydata[$x]->action = $action;
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    protected function createModuleCode($id) {
        if ($id < 10) {
            $productcode = 'LM-000' . $id;
        } elseif ($id > 9 && $id < 100) {
            $productcode = 'LM-00' . $id;
        } elseif ($id > 99 && $id < 1000) {
            $productcode = 'LM-0' . $id;
        } else {
            $productcode = 'LM-' . $id;
        }
        return $productcode;
    }

    public function edit($moduleid) {
        $this->data['js'] = 'validation';
        $this->data['css'] = 'validation';
        $this->data['includefile'] = 'module/moduleedit.php';
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                        'name' => 'required',
                        'city' => 'required',
                        'state' => 'required',
                        'country' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {
                $mid = base64_decode($this->request->getPost('encmoduleid'));
                $name = $this->request->getPost('name');
                $city = $this->request->getPost('city');
                $state = $this->request->getPost('state');
                $country = $this->request->getPost('country');

                $updarray = array(
                    'lm_name' => $name,
                    'lm_city' => $city,
                    'lm_state' => $state,
                    'lm_country' => $country);

                $checkname = $this->blankModel->getTableData('lm_id', 'location_module', 'lower(lm_name)="' . strtolower($name) . '" and lm_id !="' . $mid . '"');
                if (empty($checkname)) {

                    $this->blankModel->updateRecordInTable($updarray, 'location_module', 'lm_id', $mid);
                    $this->session->setFlashdata('message', setMessage("Module updated Successfully.", 's'));
                } else {
                    $this->session->setFlashdata('message', setMessage("Module Name already exists,Please use a different name.", 'i'));
                }
            }
        }
        $id = base64_decode($moduleid);
        $moduledetail = $this->moduleModel->getModuleDetail($id);
        $this->data['encmoduleid'] = $moduleid;
        $this->data['moduledetail'] = $moduledetail;
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\moduleedit', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function updateModuleStatus() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {

            $moduleid = base64_decode($this->request->getPost('encmoduleid'));
            $status = $this->request->getPost('status');
            $updarray = array('lm_status' => $status);
            if ($status == 1) {
                $message = "Module Unblocked Successfully";
            }if ($status == 2) {
                $message = "Module Blocked Successfully";
            }

            $this->adminModel->updateRecordInTable($updarray, 'location_module', 'lm_id', $moduleid);

            $data = array('status' => 'success', 'message' => $message);
        }
        echo json_encode($data);
        exit;
    }

    public function updateModuleDirectors() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        $msgarray = array('d' => 'Director', 'as' => 'Asociate Director', 'ast' => 'Assistant Director');
        if ($this->request->isAJAX()) {


            $userid = $this->request->getPost('userid');
            $lmid = base64_decode($this->request->getPost('lmid'));
            $type = $this->request->getPost('type');

            if ($type == 'd') {
                $pos = $this->blankModel->getTableData('lm_id', 'location_module', 'director_id=' . $userid);
                if (empty($pos)) {
                    $lmdetail = $this->moduleModel->getModuleDetail($lmid);
                    if (!empty($lmdetail->director_id)) {
                        $this->moduleModel->updatePositionExit($type, $userid, $lmid);
                    }
                    $createarray = array('user_id_user' => $userid, 'position_id' => 1, 'date_of_join' => date('Y-m-d H:i:s'), 'module_id_module' => $lmid);
                    $this->blankModel->createRecordInTable($createarray, 'module_position_audit');
                    $updarray = array('director_id' => $userid, 'director_join_date' => date('Y-m-d H:i:s'));
                    $this->blankModel->updateRecordInTable($updarray, 'location_module', 'lm_id', $lmid);
                    $status = 'success';
                    $message = $msgarray[$type] . " updated successfully.";
                } else {
                    $status = 'error';
                    $message = "The Member is already a module director in other module";
                }
            }
            if ($type == 'as') {
                $pos = $this->blankModel->getTableData('lm_id', 'location_module', 'associate_director_id=' . $userid);
                if (empty($pos)) {
                    $lmdetail = $this->moduleModel->getModuleDetail($lmid);
                    if (!empty($lmdetail->associate_director_id)) {
                        $this->moduleModel->updatePositionExit($type, $userid, $lmid);
                    }
                    $createarray = array('user_id_user' => $userid, 'position_id' => 2, 'date_of_join' => date('Y-m-d H:i:s'), 'module_id_module' => $lmid);
                    $this->blankModel->createRecordInTable($createarray, 'module_position_audit');
                    $updarray = array('associate_director_id' => $userid, 'associate_director_join_date' => date('Y-m-d H:i:s'));
                    $this->blankModel->updateRecordInTable($updarray, 'location_module', 'lm_id', $lmid);
                    $status = 'success';
                    $message = $msgarray[$type] . " updated successfully.";
                } else {
                    $status = 'error';
                    $message = "The Member is already a module director in other module";
                }
            }if ($type == 'ast') {
                $pos = $this->blankModel->getTableData('lm_id', 'location_module', 'assistant_director_id=' . $userid);
                if (empty($pos)) {
                    $lmdetail = $this->moduleModel->getModuleDetail($lmid);
                    if (!empty($lmdetail->assistant_director_id)) {
                        $this->moduleModel->updatePositionExit($type, $userid, $lmid);
                    }
                    $createarray = array('user_id_user' => $userid, 'position_id' => 3, 'date_of_join' => date('Y-m-d H:i:s'), 'module_id_module' => $lmid);
                    $this->blankModel->createRecordInTable($createarray, 'module_position_audit');
                    $updarray = array('assistant_director_id' => $userid, 'assistant_director_join_date' => date('Y-m-d H:i:s'));
                    $this->blankModel->updateRecordInTable($updarray, 'location_module', 'lm_id', $lmid);
                    $status = 'success';
                    $message = $msgarray[$type] . " updated successfully.";
                } else {
                    $status = 'error';
                    $message = "The Member is already a module director in other module";
                }
            }

            $data = array('status' => $status, 'message' => $message);
        }
        echo json_encode($data);
        exit;
    }

    public function getModuleDetailById($id) {

        if ($this->request->isAJAX()) {
            $moduledetail = $this->moduleModel->getmoduleDetailById($id);
            if (!empty($moduledetail)) {
                $data = array('status' => 'success', 'message' => 'Module Detail Found', 'data' => $moduledetail);
            } else {
                $data = array('status' => 'error', 'message' => 'Module Not Found');
            }
        }
        echo json_encode($data);
        exit;
    }

    public function segmentlist() {
        $this->data['js'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'module/segmentlist.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\segmentlist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function categorylist() {
        $this->data['js'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'module/modulelist.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\modulelist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function subcategorylist() {
        $this->data['js'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'module/modulelist.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\modulelist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

}
