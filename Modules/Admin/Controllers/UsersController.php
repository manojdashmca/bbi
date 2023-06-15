<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\UsersModel;

class UsersController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->usersModel = new UsersModel();
    }

    public function index() {
        $this->checkAccessControll(1, 'm');
        $this->data['js'] = 'choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'users/userlist.php,common/common.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\users\userlist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function add() {
        $this->data['js'] = 'flatpickr,validation';
        $this->data['css'] = 'flatpickr,validation';
        $this->data['includefile'] = '/users/useradd.php,common/common.php';
        $this->checkAccessControll(1);
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                        'name' => 'required',
                        'pincode' => 'required',
                        'dob' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {
                $utr = $this->request->getPost('utr');
                $utrstatus = $this->usersModel->checkUTR($utr, 'user_detail');
                if ($utrstatus) {
                    $name = $this->request->getPost('name');
                    $dob = $this->request->getPost('dob');
                    $address = $this->request->getPost('address');
                    $pincode = $this->request->getPost('pincode');
                    $postoffice = $this->request->getPost('postoffice');
                    $city = $this->request->getPost('city');
                    $district = $this->request->getPost('district');
                    $state = $this->request->getPost('state');
                    $country = $this->request->getPost('country');
                    $mobile = $this->request->getPost('mobile');
                    $emailid = $this->request->getPost('emailid');
                    $bankacno = $this->request->getPost('bankacno');
                    $bankifsc = $this->request->getPost('bankifsc');
                    $bankname = $this->request->getPost('bankname');
                    $bankbranch = $this->request->getPost('bankbranch');
                    $panno = $this->request->getPost('panno');

                    $passphrase = createEpin(6);
                    $passwordnew = $this->encryptString($passphrase);
                    $this->usersModel->transStart();

                    $userdetaildata = array(
                        "utr_no" => $utr,
                        "user_login_key" => $passwordnew,
                        "user_create_date" => date("Y-m-d H:i:s"),
                        'user_name' => $name,
                        'user_mobile' => $mobile,
                        "user_email" => $emailid,
                        "user_dob" => makeDate($dob, 'Y-m-d'),
                        "user_address" => $address,
                        "user_pincode" => $pincode,
                        "user_post_office" => $postoffice,
                        "user_district" => $district,
                        "user_city" => $city,
                        "user_state" => $state,
                        "user_country" => $country,
                        "user_pan" => $panno,
                        "user_type" => 4,
                        "user_bank_ac_no" => $bankacno,
                        "user_bank_ifsc" => $bankifsc,
                        "user_bank_name" => $bankname,
                        "user_bank_branch" => $bankbranch
                    );
                    $iduser = $this->usersModel->createRecordInTable($userdetaildata, 'user_detail');
                    $this->usersModel->createRecordInTable(array('user_id_user' => $iduser), 'admin_user');
                    $usercode = createUserCode($iduser);
                    $updarray = array('user_code' => $usercode);
                    $this->usersModel->updateRecordInTable($updarray, 'user_detail', 'id_user', $iduser);
                    $this->blankModel->transComplete();

                    if ($this->blankModel->transStatus() === false) {
                        $this->session->setFlashdata('message', setMessage("Something went wrong, Please try after some time", 'f'));
                        $this->blankModel->transRollback();
                    } else {
                        $this->blankModel->transCommit();
                        $this->session->setFlashdata('message', setMessage("User added Successfully.", 's'));
                        //------------do  other functionality-----
                        //----------------------------------------
                    }
                } else {
                    $this->session->setFlashdata('message', setMessage("multy time formsubmission not allowed", 'e'));
                }
            }
        }

        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\users\useradd', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function edit($userid) {
        $this->checkAccessControll(2);
        $this->data['js'] = 'alertify,lightbox,flatpickr,validation';
        $this->data['css'] = 'alertify,lightbox,flatpickr,validation';
        $this->data['includefile'] = 'users/useredit.php,common/common.php';
        $iduser = base64_decode($userid);
        $userdetaildata = $this->usersModel->getUserdetailById($iduser);
        $this->data['userdetail'] = $userdetaildata;
        $this->data['encuserid'] = $userid;
        $this->data['password'] = $this->decryptToken($userdetaildata->user_login_key);
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\users\useredit', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function controlls($userid) {
        $this->checkAccessControll(3);
        if ($this->request->getMethod() == 'post') {
            $encuser = $this->request->getPost('encuser');
            $module = implode(",", $this->request->getPost('module'));
            $module_control = implode(",", $this->request->getPost('module_control'));
            $updatekeydata = array("user_modules" => $module, "user_module_controls" => $module_control);
            $status = $this->usersModel->updateRecordInTable($updatekeydata, 'admin_user', 'user_id_user', base64_decode($encuser));
            if ($status) {
                $this->session->setFlashdata('message', setMessage("Controll Updated Successfully", 's'));
            } else {
                $this->session->setFlashdata('message', setMessage("Technical error, Please try after some time", 'e'));
            }
        }
        $id = \base64_decode(\trim($userid));
        $data = $this->usersModel->getModuleControll();
        $this->data['controldata'] = $data['data'];
        $this->data['encuserid'] = $userid;
        $usermodulesdata = $this->usersModel->getUserModuleAndSubmodules($id);
        $usermodules = explode(",", $usermodulesdata['data']->user_modules);
        $usermodulecontrol = explode(",", $usermodulesdata['data']->user_module_controls);
        $this->data['usermodule'] = $usermodules;
        $this->data['usermodulecontrol'] = $usermodulecontrol;
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\users\usercontrol', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function userdata() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $mobile = trim($this->request->getPost('mobile'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            $this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'mobile' => $mobile, 'status' => $status, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->usersModel->selectUsers($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedUserdata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedUserdata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $action = '';
            if (in_array(2, session()->get('accesscontrols'))) {
                $action .= '<a class="blue" target="_blank" title="Edit Detail"   href="' . ADMINPATH . 'user-edit/' . base64_encode($data[$x]->id_user) . '"><i class="fas fa-user-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
            }if (in_array(3, session()->get('accesscontrols'))) {
                $action .= "<a title='Manage User Controls' href='" . ADMINPATH . "user-controlls/" . base64_encode($arraydata[$x]->id_user) . "'><i class='fas fa-user-cog'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            }if (in_array(4, session()->get('accesscontrols'))) {
                if ($data[$x]->user_status == 'Granted') {
                    $action .= '<a class="blue" title="Block Account" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->id_user) . '&#39;,2);"><i class="fas fa-lock"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }if ($data[$x]->user_status == 'Blocked') {
                    $action .= '<a class="blue"  title="Unblock Account" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->id_user) . '&#39;,1);"><i class="fas fa-lock-open"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            if (in_array(36, session()->get('accesscontrols'))) {
                if ($data[$x]->userstatus == 'Active') {
                    $action .= '<a class="blue"  title="Delete User" href="#" onclick="return deleteUser(&#39;' . base64_encode($data[$x]->id_user) . '&#39;);"><i class="fas fa-trash"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            $arraydata[$x]->action = $action;
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    public function deleteAdminUser() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $this->checkAccessControll(36, 'c', 0);
            $userid = base64_decode($this->request->getPost('encuser'));
                    
            $this->adminModel->updateRecordInTable(array('admin_user_status' => 2), 'admin_user', 'user_id_user', $userid);
            $this->adminModel->updateRecordInTable(array('user_status' => 2), 'user_detail', 'id_user', $userid);
            
            $message = "User Removed Successfully";
            //--------create email-------
            //$objEmailTemplate = new EmailTemplate();
            //$template = $objEmailTemplate->profileUpdationEmail($name);
            //$createarray = array('smtp_email_content' => $template, 'smtp_email_type' => 'Profile update Intimation ', 'smtp_sender_email' => COMMUNICATION_EMAIL, 'smtp_target_emails' => $email);
            //$this->adminModel->createRecordInTable($createarray, 'smtp_email');
            //---------create Email

            $data = array('status' => 'success', 'message' => $message);
        }
        echo json_encode($data);
        exit;
    }

}
