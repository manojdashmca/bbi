<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\IboModel;

class TreeController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->iboModel = new IboModel();
    }

    public function index() {
        $this->data['js'] = 'tooltips';
        $this->data['css'] = 'tooltips';
        $this->data['includefile'] = 'tree/binarytree.php';
        $this->data['ibo'] = $this->request->getVar('usercode');
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\tree\index', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function sponsorview() {
        $this->data['js'] = 'datatable';
        $this->data['css'] = 'datatable';
        $this->data['includefile'] = 'tree/sponsorshipview.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\tree\sponsorshipview', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function downlianeview() {
        $this->data['js'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'tree/downlineview.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\tree\downlineview', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function downlianedata() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $code = trim($this->request->getPost('name'));
            $position = trim($this->request->getPost('position'));
            $data = array('code' => $code);
            $firstrow = array();
            if (!empty($position)) {
                $parentdata = $this->iboModel->getIboIdByCodeUsername($code);
                $positionusercode = $this->iboModel->getPositionUser($parentdata->id_user, $position);
                $data = array('code' => $positionusercode->user_code);
                $firstchild = $this->iboModel->getIboIdByCodeUsername($positionusercode->user_code);
                $firstrow = array(1, $firstchild->user_coden, $firstchild->user_city, $firstchild->user_mobile, $firstchild->user_email, $firstchild->user_create_date, $firstchild->position);
            }
            $treedata = $this->iboModel->selectDownline($data, $offset, $limit);
            $returndata['data'] = $this->fn_formatedDownlinedata($treedata['data'], $offset, $firstrow);
            $returndata['draw'] = $draw;
            if (!empty($firstrow)) {
                $returndata['recordsTotal'] = $treedata['record_count'] + 1;
                $returndata['recordsFiltered'] = $treedata['record_count'] + 1;
            } else {
                $returndata['recordsTotal'] = $treedata['record_count'];
                $returndata['recordsFiltered'] = $treedata['record_count'];
            }
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedDownlinedata($data, $offset, $firstrow) {
        $return = array();
        $arraydata = (array) $data;
        if (!empty($firstrow)) {
            $return[] = $firstrow;
        }
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array_values((array) $arraydata[$x]);
            if (!empty($firstrow)) {
                $values[0] = $offset + $x + 2;
            } else {
                $values[0] = $offset + $x + 1;
            }
            $return[] = $values;
        }

        return $return;
    }

    public function sponshorshipdata() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $code = trim($this->request->getPost('code'));
            $level = trim($this->request->getPost('level'));
            $data = array('code' => $code, 'level' => $level);
            $treedata = $this->iboModel->selectSponsorship($data, $offset, $limit);
            $returndata['data'] = $this->fn_formatedSponshorshipdata($treedata['data'], $offset);
            $returndata['draw'] = $draw;

            $returndata['recordsTotal'] = $treedata['record_count'];
            $returndata['recordsFiltered'] = $treedata['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedSponshorshipdata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;

        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    public function treeview() {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $usercode = trim($this->request->getPost('usercode'));
            $parentdata = $this->iboModel->getIboIdByCodeUsername($usercode);
            $userid = $parentdata->id_user;
            for ($x = 1; $x < 16; $x++) {
                $data['node' . $x] = array("Id" => 0);
            }
            $node1val = $this->iboModel->getUserDetailById($userid);
            $n1counter = $this->iboModel->getUserTreeDetailById($userid);
            if (!empty($node1val['data'])) {
                $nval = $node1val['data'];
                $ndata = $n1counter['data'];
                $data['node1'] = array(
                    "Name" => $nval->user_name,
                    "Email" => $nval->user_email,
                    "Id" => $nval->user_login_name,
                    "Ps" => $nval->payout_status,
                    "Code" => $nval->user_code,
                    "Mobile" => $nval->user_mobile,
                    "DOJ" => $nval->user_create_date,
                    "Type" => 0,
                    "Left" => $ndata['left'],
                    "Right" => $ndata['right'],
                    "Left_FOI" => $ndata['left_foi'],
                    "Right_FOI" => $ndata['right_foi'],
                    "Left_T_BV" => $ndata['left_total_bv'],
                    "Right_T_BV" => $ndata['right_total_bv']);
                $node2and3val = $this->iboModel->getNodeUserDetail($nval->id_user);
                //echo "<pre>";print_r($node2and3val['data']);exit;
                if (!empty($node2and3val['data'])) {
                    foreach ($node2and3val['data'] as $val1) {
                        if ($val1->user_position == 1) {
                            $data['node2'] = $this->setNodeVal($val1);
                            $node4and5val = $this->iboModel->getNodeUserDetail($val1->id_user);
                            //echo "<pre>";print_r($node4and5val['data']);exit;
                            if (!empty($node4and5val['data'])) {
                                foreach ($node4and5val['data'] as $val2) {
                                    if ($val2->user_position == 1) {
                                        $data['node4'] = $this->setNodeVal($val2);
                                        $node8and9val = $this->iboModel->getNodeUserDetail($val2->id_user);
                                        if (!empty($node8and9val['data'])) {
                                            foreach ($node8and9val['data'] as $val3) {
                                                if ($val3->user_position == 1) {
                                                    $data['node8'] = $this->setNodeVal($val3);
                                                } else {
                                                    $data['node9'] = $this->setNodeVal($val3);
                                                }
                                            }
                                        }
                                    } else {
                                        $data['node5'] = $this->setNodeVal($val2);
                                        $node10and11val = $this->iboModel->getNodeUserDetail($val2->id_user);
                                        if (!empty($node10and11val['data'])) {
                                            foreach ($node10and11val['data'] as $val3) {
                                                if ($val3->user_position == 1) {
                                                    $data['node10'] = $this->setNodeVal($val3);
                                                } else {
                                                    $data['node11'] = $this->setNodeVal($val3);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            $data['node3'] = $this->setNodeVal($val1);
                            $node6and7val = $this->iboModel->getNodeUserDetail($val1->id_user);
                            if (!empty($node6and7val['data'])) {
                                foreach ($node6and7val['data'] as $val4) {
                                    if ($val4->user_position == 1) {
                                        $data['node6'] = $this->setNodeVal($val4);
                                        $node12and13val = $this->iboModel->getNodeUserDetail($val4->id_user);
                                        if (!empty($node12and13val['data'])) {
                                            foreach ($node12and13val['data'] as $val5) {
                                                if ($val5->user_position == 1) {
                                                    $data['node12'] = $this->setNodeVal($val5);
                                                } else {
                                                    $data['node13'] = $this->setNodeVal($val5);
                                                }
                                            }
                                        }
                                    } else {
                                        $data['node7'] = $this->setNodeVal($val4);
                                        $node14and15val = $this->iboModel->getNodeUserDetail($val4->id_user);
                                        if (!empty($node14and15val['data'])) {
                                            foreach ($node14and15val['data'] as $val6) {
                                                if ($val6->user_position == 1) {
                                                    $data['node14'] = $this->setNodeVal($val6);
                                                } else {
                                                    $data['node15'] = $this->setNodeVal($val6);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                echo json_encode(array("data" => $data, "status" => "Ok", "Message" => "Business Associate Found"));
            } else {
                echo json_encode(array("data" => $data, "status" => "Error", "Message" => "Business Associate Not Found"));
            }
            exit;
        } else {
            redirect("custom_errors/methodNotFound");
            exit;
        }
    }

    private function setNodeVal($val) {
        $n1counter = $this->iboModel->getUserTreeDetailById($val->id_user);
        $ndata = $n1counter['data'];
        return array("Name" => $val->user_name,
            "Email" => $val->user_email,
            "Id" => $val->user_login_name,
            "Code" => $val->user_code,
            "Ps" => $val->payout_status,
            "Mobile" => $val->user_mobile,
            "DOJ" => $val->user_create_date,
            "Type" => 0,
            "Left" => $ndata['left'],
            "Right" => $ndata['right'],
            "Left_FOI" => $ndata['left_foi'],
            "Right_FOI" => $ndata['right_foi'],
            "Left_T_BV" => $ndata['left_total_bv'],
            "Right_T_BV" => $ndata['right_total_bv']);
    }

}
