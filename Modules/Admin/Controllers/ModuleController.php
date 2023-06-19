<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\ModuleModel;
use Modules\Admin\Models\IboModel;

class ModuleController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->moduleModel = new ModuleModel();
    }

    public function index() {
        $this->checkAccessControll(5, 'm');
        $this->data['js'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'module/modulelist.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\modulelist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function add() {
        $this->checkAccessControll(9);
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

                $name = trim($this->request->getPost('name'));
                $city = trim($this->request->getPost('city'));
                $state = trim($this->request->getPost('state'));
                $country = trim($this->request->getPost('country'));
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
        $this->data['state'] = $this->moduleModel->getState();
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
            if (in_array(10, session()->get('accesscontrols'))) {
                $action .= '<a class="blue" target="_blank" title="Edit Detail"   href="' . ADMINPATH . 'module-edit/' . base64_encode($data[$x]->lm_id) . '"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
            }#$action .= "<a title='Detail View' target='_blank' href='" . ADMINPATH . "module-detailview/" . base64_encode($arraydata[$x]->lm_id) . "'><i class='fa fa-search'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            if (in_array(11, session()->get('accesscontrols'))) {
                if ($data[$x]->status == 'Active') {
                    $action .= '<a class="blue" title="Block Account" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->lm_id) . '&#39;,2);"><i class="fas fa-lock"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }if ($data[$x]->status == 'Blocked') {
                    $action .= '<a class="blue"  title="Unblock Account" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->lm_id) . '&#39;,1);"><i class="fas fa-lock-open"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            if (in_array(12, session()->get('accesscontrols'))) {
                $action .= '<a class="blue" title="Assign Module Director" data-bs-toggle="modal" data-bs-target="#changedirector"   href="#" onclick="putModuleId(&#39;' . base64_encode($data[$x]->lm_id) . '&#39;)"><i class="fas fa-user-shield"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
            }if (in_array(13, session()->get('accesscontrols'))) {
                $action .= '<a class="blue" title="Assign Module Associate Director" data-bs-toggle="modal"  data-bs-target="#changeassociate"   href="#" onclick="putModuleId(&#39;' . base64_encode($data[$x]->lm_id) . '&#39;)"><i class="fas fa-user-tag"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
            }if (in_array(14, session()->get('accesscontrols'))) {
                $action .= '<a class="blue" title="Assign Module Assistant Director" data-bs-toggle="modal"  data-bs-target="#changeassistant"   href="#" onclick="putModuleId(&#39;' . base64_encode($data[$x]->lm_id) . '&#39;)"><i class="fas fa-user-tie"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
            }$arraydata[$x]->action = $action;
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
        $this->checkAccessControll(10);
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
                $name = trim($this->request->getPost('name'));
                $city = trim($this->request->getPost('city'));
                $state = trim($this->request->getPost('state'));
                $country = trim($this->request->getPost('country'));

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
        $this->data['state'] = $this->moduleModel->getState();
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
            $this->checkAccessControll(11, 'c', 0);
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
                $this->checkAccessControll(12, 'c', 0);
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
                $this->checkAccessControll(13, 'c', 0);
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
                $this->checkAccessControll(14, 'c', 0);
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
        $this->checkAccessControll(6, 'm');
        $this->data['js'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'module/segmentlist.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\segmentlist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function segmentdata() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            $data = array('name' => $name);
            $userlist = $this->moduleModel->selectSegment($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedSegmentdata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedSegmentdata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $action = '';
            if (in_array(16, session()->get('accesscontrols'))) {
                $action .= '<a class="blue" target="_blank" title="Edit Detail"   href="' . ADMINPATH . 'segment-edit/' . base64_encode($data[$x]->segment_id) . '"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
            }if (in_array(17, session()->get('accesscontrols'))) {
                if ($data[$x]->status == 'Active') {
                    $action .= '<a class="blue" title="Block Segment" href="#" onclick="return updateSegmentStatus(&#39;' . base64_encode($data[$x]->segment_id) . '&#39;,2);"><i class="fas fa-lock"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }if ($data[$x]->status == 'Blocked') {
                    $action .= '<a class="blue"  title="Unblock Segment" href="#" onclick="return updateSegmentStatus(&#39;' . base64_encode($data[$x]->segment_id) . '&#39;,1);"><i class="fas fa-lock-open"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            $arraydata[$x]->action = $action;
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    public function editSegment($segmentid) {
        $this->checkAccessControll(16);
        $this->data['js'] = 'validation';
        $this->data['css'] = 'validation';
        $this->data['includefile'] = 'module/segmentedit.php';
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                        'name' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {
                $sid = base64_decode($this->request->getPost('encsegmentid'));
                $name = trim($this->request->getPost('name'));

                $updarray = array('segment_name' => $name);

                $checkname = $this->blankModel->getTableData('segment_id', 'master_segment', 'lower(segment_name)="' . strtolower($name) . '" and segment_id !="' . $sid . '"');
                if (empty($checkname)) {
                    $this->blankModel->updateRecordInTable($updarray, 'master_segment', 'segment_id', $sid);
                    $this->session->setFlashdata('message', setMessage("Segment updated Successfully.", 's'));
                } else {
                    $this->session->setFlashdata('message', setMessage("Segment Name already exists,Please use a different name.", 'i'));
                }
            }
        }
        $id = base64_decode($segmentid);
        $segmentdetail = $this->moduleModel->getSegmentDetail($id);
        $this->data['encsegmentid'] = $segmentid;
        $this->data['segmentdetail'] = $segmentdetail;
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\segmentedit', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function addSegment() {
        $this->checkAccessControll(15);
        $this->data['js'] = 'validation';
        $this->data['css'] = 'validation';
        $this->data['includefile'] = 'module/segmentadd.php';

        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                        'name' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {
                $name = trim($this->request->getPost('name'));
                $checkname = $this->blankModel->getTableData('segment_id', 'master_segment', 'LOWER(segment_name)="' . strtolower($name) . '"');
                if (empty($checkname)) {
                    $createarray = array('segment_name' => $name);
                    $lmid = $this->blankModel->createRecordInTable($createarray, 'master_segment');
                    $this->session->setFlashdata('message', setMessage("Segment added Successfully.", 's'));
                } else {
                    $this->session->setFlashdata('message', setMessage("Segment Already exists, Please use a different name.", 'e'));
                }
            }
        }

        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\segmentadd', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function categorylist() {
        $this->checkAccessControll(6, 'm');
        $this->data['js'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'module/categorylist.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\categorylist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function addCategory() {
        $this->checkAccessControll(18);
        $this->data['js'] = 'validation';
        $this->data['css'] = 'validation';
        $this->data['includefile'] = 'module/categoryadd.php';

        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                        'name' => 'required',
                        'segment' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {

                $name = trim($this->request->getPost('name'));
                $segment = $this->request->getPost('segment');
                $checkname = $this->blankModel->getTableData('category_id', 'master_category', 'LOWER(category_name)="' . strtolower($name) . '" and segment_id_segment="' . $segment . '"');
                if (empty($checkname)) {
                    $createarray = array('category_name' => $name, 'segment_id_segment' => $segment);
                    $lmid = $this->blankModel->createRecordInTable($createarray, 'master_category');
                    $this->session->setFlashdata('message', setMessage("Category added Successfully.", 's'));
                } else {
                    $this->session->setFlashdata('message', setMessage("Category Already exists, Please use a different name.", 'e'));
                }
            }
        }
        $this->data['segment'] = $this->adminModel->getSegment();
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\categoryadd', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function editCategory($categoryid) {
        $this->checkAccessControll(19);
        $this->data['js'] = 'validation';
        $this->data['css'] = 'validation';
        $this->data['includefile'] = 'module/categoryedit.php';
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                        'name' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {
                $cid = base64_decode($this->request->getPost('enccategoryid'));
                $name = trim($this->request->getPost('name'));
                $segment = trim($this->request->getPost('segment'));
                $updarray = array('category_name' => $name, 'segment_id_segment' => $segment);

                $checkname = $this->blankModel->getTableData('category_id', 'master_category', 'lower(category_name)="' . strtolower($name) . '" and segment_id_segment ="' . $segment . '" and category_id !="' . $cid . '"');
                if (empty($checkname)) {
                    $this->blankModel->updateRecordInTable($updarray, 'master_category', 'category_id', $cid);
                    $this->session->setFlashdata('message', setMessage("Category updated Successfully.", 's'));
                } else {
                    $this->session->setFlashdata('message', setMessage("Category Name already exists,Please use a different name.", 'i'));
                }
            }
        }
        $id = base64_decode($categoryid);
        $categorydetail = $this->moduleModel->getCategoryDetail($id);
        $this->data['segment'] = $this->adminModel->getSegment();
        $this->data['enccategoryid'] = $categoryid;
        $this->data['categorydetail'] = $categorydetail;
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\categoryedit', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function categoryData() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $cname = trim($this->request->getPost('cname'));
            $sname = trim($this->request->getPost('sname'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            $data = array('cname' => $cname, 'sname' => $sname);
            $userlist = $this->moduleModel->selectCategory($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedCategorydata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    private function fn_formatedCategorydata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $action = '';
            if (in_array(19, session()->get('accesscontrols'))) {
                $action .= '<a class="blue" target="_blank" title="Edit Detail"   href="' . ADMINPATH . 'category-edit/' . base64_encode($data[$x]->category_id) . '"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
            }if (in_array(20, session()->get('accesscontrols'))) {
                if ($data[$x]->status == 'Active') {
                    $action .= '<a class="blue" title="Block Segment" href="#" onclick="return updateCategoryStatus(&#39;' . base64_encode($data[$x]->category_id) . '&#39;,2);"><i class="fas fa-lock"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }if ($data[$x]->status == 'Blocked') {
                    $action .= '<a class="blue"  title="Unblock Segment" href="#" onclick="return updateCategoryStatus(&#39;' . base64_encode($data[$x]->category_id) . '&#39;,1);"><i class="fas fa-lock-open"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            $arraydata[$x]->action = $action;
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    public function subcategorylist() {
        $this->checkAccessControll(6, 'm');
        $this->data['js'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'module/subcategorylist.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\subcategorylist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function addSubcategory() {
        $this->checkAccessControll(21);
        $this->data['js'] = 'validation';
        $this->data['css'] = 'validation';
        $this->data['includefile'] = 'module/subcategoryadd.php';

        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                        'name' => 'required',
                        'segment' => 'required',
                        'category' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {

                $name = trim($this->request->getPost('name'));
                $segment = $this->request->getPost('segment');
                $category = $this->request->getPost('category');
                $checkname = $this->blankModel->getTableData('sub_category_id', 'master_sub_category', 'LOWER(sub_category_name)="' . strtolower($name) . '" and category_id_category="' . $category . '" and segment_id_segment="' . $segment . '"');
                if (empty($checkname)) {
                    $createarray = array('sub_category_name' => $name, 'category_id_category' => $category, 'segment_id_segment' => $segment);
                    $lmid = $this->blankModel->createRecordInTable($createarray, 'master_sub_category');
                    $this->session->setFlashdata('message', setMessage("Sub Category added Successfully.", 's'));
                } else {
                    $this->session->setFlashdata('message', setMessage("Subcategory Already exists, Please use a different name.", 'e'));
                }
            }
        }
        $this->data['segment'] = $this->adminModel->getSegment();
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\subcategoryadd', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function editsubcategory($subcategoryid) {
        $this->checkAccessControll(22);
        $this->data['js'] = 'validation';
        $this->data['css'] = 'validation';
        $this->data['includefile'] = 'module/subcategoryedit.php';
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                        'name' => 'required',
                        'category' => 'required',
                        'segment' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {
                $sid = base64_decode($this->request->getPost('encsubcategoryid'));
                $name = $this->request->getPost('name');
                $categoryid = $this->request->getPost('category');
                $segmentid = $this->request->getPost('segment');

                $updarray = array('sub_category_name' => $name, 'category_id_category' => $categoryid, 'segment_id_segment' => $segmentid);

                $checkname = $this->blankModel->getTableData('sub_category_id', 'master_sub_category', 'lower(sub_category_name)="' . strtolower($name) . '" and sub_category_id !="' . $sid . '" and category_id_category="' . $categoryid . '" and segment_id_segment="' . $segmentid . '"');
                if (empty($checkname)) {
                    $this->blankModel->updateRecordInTable($updarray, 'master_sub_category', 'sub_category_id', $sid);
                    $this->session->setFlashdata('message', setMessage("Subcategory updated Successfully.", 's'));
                } else {
                    $this->session->setFlashdata('message', setMessage("Subcategory Name already exists,Please use a different name.", 'i'));
                }
            }
        }
        $id = base64_decode($subcategoryid);
        $subcategorydetail = $this->moduleModel->getSubcategoryDetail($id);
        $this->data['segment'] = $this->adminModel->getSegment();
        $this->data['encsubcategoryid'] = $subcategoryid;
        $this->data['subcategorydetail'] = $subcategorydetail;
        $this->data['category'] = $this->adminModel->getCategoryBySegment($subcategorydetail->segment_id_segment);
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\subcategoryedit', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function subcategoryData() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $cname = trim($this->request->getPost('cname'));
            $sname = trim($this->request->getPost('sname'));
            $scname = trim($this->request->getPost('scname'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            $data = array('scname' => $scname, 'cname' => $cname, 'sname' => $sname);
            $userlist = $this->moduleModel->selectSubCategory($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedSubcategorydata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    private function fn_formatedSubcategorydata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $action = '';
            if (in_array(22, session()->get('accesscontrols'))) {
                $action .= '<a class="blue" target="_blank" title="Edit Detail"   href="' . ADMINPATH . 'subcategory-edit/' . base64_encode($data[$x]->sub_category_id) . '"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            if (in_array(23, session()->get('accesscontrols'))) {
                if ($data[$x]->status == 'Active') {
                    $action .= '<a class="blue" title="Block Segment" href="#" onclick="return updateSubcategoryStatus(&#39;' . base64_encode($data[$x]->sub_category_id) . '&#39;,2);"><i class="fas fa-lock"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }if ($data[$x]->status == 'Blocked') {
                    $action .= '<a class="blue"  title="Unblock Segment" href="#" onclick="return updateSubcategoryStatus(&#39;' . base64_encode($data[$x]->sub_category_id) . '&#39;,1);"><i class="fas fa-lock-open"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            $arraydata[$x]->action = $action;
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    public function updateSegmentCategorySubcategoryStatus() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {

            $tableid = base64_decode($this->request->getPost('enctableid'));
            $status = $this->request->getPost('status');
            $type = $this->request->getPost('type');
            switch ($type) {
                case 1 :
                    $this->checkAccessControll(17, 'c', 0);
                    $updarray = array('segment_status' => $status);
                    $this->blankModel->updateRecordInTable($updarray, 'master_segment', 'segment_id', $tableid);
                    if ($status == 1) {
                        $message = "Segment Unblocked Successfully";
                    }if ($status == 2) {
                        $message = "Segment Blocked Successfully";
                    }
                    break;
                case 2 :
                    $this->checkAccessControll(20, 'c', 0);
                    $updarray = array('category_status' => $status);
                    $this->blankModel->updateRecordInTable($updarray, 'master_category', 'category_id', $tableid);
                    if ($status == 1) {
                        $message = "Category Unblocked Successfully";
                    }if ($status == 2) {
                        $message = "Category Blocked Successfully";
                    }
                    break;
                case 3 :
                    $this->checkAccessControll(23, 'c', 0);
                    $updarray = array('sub_category_status' => $status);
                    $this->blankModel->updateRecordInTable($updarray, 'master_sub_category', 'sub_category_id', $tableid);
                    if ($status == 1) {
                        $message = "Sub Category Unblocked Successfully";
                    }if ($status == 2) {
                        $message = "Sub Category Blocked Successfully";
                    }
                    break;
            }
            $data = array('status' => 'success', 'message' => $message);
        }
        echo json_encode($data);
        exit;
    }

    public function moduleSubcategoryStatus() {
        $this->data['title'] = "Registration";
        $this->iboModel = new IboModel();
        $this->data['js'] = 'datatable';
        $this->data['css'] = 'datatable';
        $this->data['includefile'] = 'module/moduleBlockedSubcategory.php';
        $this->data['module'] = $this->iboModel->getModuleDropDown();
        $this->data['segment'] = $this->iboModel->getBusinesssegment();
        $this->data['category'] = $this->iboModel->getBusinessCategory();
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\module\moduleBlockedSubcategory', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function moduleSubcategoryData() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $cname = trim($this->request->getPost('cname'));
            $sname = trim($this->request->getPost('sname'));
            $module = trim($this->request->getPost('module'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            $data = array('module' => $module, 'cname' => $cname, 'sname' => $sname);
            $userlist = $this->moduleModel->selectBlockedSubCategory($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedAddSlNo($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }
}
