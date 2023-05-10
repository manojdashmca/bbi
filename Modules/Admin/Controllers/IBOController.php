<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\IboModel;
use App\Libraries;

class IBOController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->iboModel = new IboModel();
        $this->parentUser = 0;
    }

    public function index() {
        $this->data['js'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'ibo/ibolist.php,common/common.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\ibo\ibolist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function add() {
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                        'name' => 'required',
                        'dob' => 'required',
                        'hidval' => 'required',
                        'hidmodule' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {
                $utr = $this->request->getPost('utr');
                $utrstatus = $this->blankModel->checkUTR($utr, 'user_detail');
                if ($utrstatus) {
                    $sponsorid = $this->request->getPost('hidval');
                    $name = $this->request->getPost('name');
                    $bloodgroup = $this->request->getPost('bloodgroup');
                    $eduqual = $this->request->getPost('eduqual');
                    $profcert = $this->request->getPost('profcert');
                    $hidmodule = $this->request->getPost('hidmodule');
                    $dob = $this->request->getPost('dob');
                    $address = $this->request->getPost('address');
                    $pincode = $this->request->getPost('pincode');
                    $postoffice = $this->request->getPost('postoffice');
                    $city = $this->request->getPost('city');
                    $district = $this->request->getPost('district');
                    $state = $this->request->getPost('state');
                    $country = "India"; //$this->request->getPost('country');
                    $mobile = $this->request->getPost('mobile');
                    $emailid = $this->request->getPost('emailid');
                    $bankacno = $this->request->getPost('bankacno');
                    $bankifsc = $this->request->getPost('bankifsc');
                    $bankname = $this->request->getPost('bankname');
                    $bankbranch = $this->request->getPost('bankbranch');
                    $panno = $this->request->getPost('panno');
                    $glink = $this->request->getPost('glink');
                    $nameofgroup = $this->request->getPost('nameofgroup');

                    $businessbankacno = $this->request->getPost('businessbankacno');
                    $businessbankifsc = $this->request->getPost('businessbankifsc');
                    $businessbankname = $this->request->getPost('businessbankname');
                    $businessbankbranch = $this->request->getPost('businessbankbranch');

                    $shopact = $this->request->getPost('shopact');
                    $shoplicenseno = $this->request->getPost('shoplicenseno');
                    $isgst = $this->request->getPost('isgst');
                    $gstno = $this->request->getPost('gstno');

                    //----------------businessdetail--------
                    $businessname = $this->request->getPost('businessname');
                    $businessdesignation = $this->request->getPost('businessdesignation');
                    $businesssegment = $this->request->getPost('businesssegment');
                    $businesscategory = $this->request->getPost('businesscategory');
                    //$businesssubcategory = $this->request->getPost('businesssubcategory');
                    $businessaddress = $this->request->getPost('businessaddress');
                    $businesscity = $this->request->getPost('businesscity');
                    $gstaddress = $this->request->getPost('gstaddress');
                    $businesspan = $this->request->getPost('businesspan');
                    $currentbusiness = $this->request->getPost('currentbusiness');
                    $businessemail = $this->request->getPost('businessemail');
                    $businesswebsite = $this->request->getPost('businesswebsite');
                    $businessexp = $this->request->getPost('businessexp');
                    if ($this->request->getPost('social') != false) {
                        $social = implode(',', $this->request->getPost('social'));
                    } else {
                        $social = '';
                    }
                    $paymentamount = $this->request->getPost('membershipfee');
                    $hiddengst = $this->request->getPost('hiddengst');
                    $joiningfee = $this->request->getPost('joiningfee');
                    $paymentmode = $this->request->getPost('paymentmode');
                    $paymentdetail = $this->request->getPost('paymentdetail');
                    $subcatvalue = $this->request->getPost('subcatvalue');
                    $expsubcat = explode(',', $subcatvalue);
                    //-------------------------------------

                    $passphrase = createEpin(6);
                    $passwordnew = $this->encryptString($passphrase);
                    $userdetaildata = array(
                        'utr_no' => $utr,
                        "user_login_key" => $passwordnew,
                        "user_create_date" => date("Y-m-d H:i:s"),
                        "sponsor_user_id" => $sponsorid,
                        'module_id_module' => $hidmodule,
                        'user_name' => $name,
                        'user_education' => $eduqual,
                        'user_profession_certification' => $profcert,
                        'user_blood_group' => $bloodgroup,
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
                        "user_type" => 1,
                        "user_group_link" => $glink,
                        "user_group_link_org" => $nameofgroup,
                        "user_bank_ac_no" => $bankacno,
                        "user_bank_ifsc" => $bankifsc,
                        "user_bank_name" => $bankname,
                        "user_bank_branch" => $bankbranch,
                        "user_business_bank_account" => $businessbankacno,
                        "user_business_bank_ifsc" => $businessbankifsc,
                        "user_business_bank_name" => $businessbankname,
                        "user_business_bank_branch" => $businessbankbranch,
                        "shop_act" => $shopact,
                        "shop_license_no" => $shoplicenseno,
                        "gst_registered" => $isgst,
                        "gst_no" => $gstno
                    );
                    $this->blankModel->transStart();
                    $iduser = $this->blankModel->createRecordInTable($userdetaildata, 'user_detail');
                    $this->blankModel->createRecordInTable(array('user_id_user' => $iduser), 'ibo_user');
                    $paymentdetaila = array(
                        'user_id_user' => $iduser,
                        'payment_date' => date('Y-m-d H:i:s'),
                        'joining_fee' => $joiningfee,
                        'topup_fee' => $paymentamount - $hiddengst - $joiningfee,
                        'gst' => $hiddengst,
                        'payment_amount' => $paymentamount,
                        'payment_method' => $paymentmode,
                        'payment_remark' => $paymentdetail,
                        'payment_status' => 1);
                    $paymentid = $this->blankModel->createRecordInTable($paymentdetaila, 'ibo_joining_payment_detail');
                    for ($sbc = 0; $sbc < count($expsubcat); $sbc++) {
                        $businessdetailarray = array(
                            'user_id_user' => $iduser,
                            'business_name' => $businessname,
                            'business_designation' => $businessdesignation,
                            'business_segment' => $businesssegment,
                            'business_category' => $businesscategory,
                            'business_subcategory' => ($businesssegment != 26) ? $expsubcat[$sbc] : 0,
                            'actual_subcategory' => $expsubcat[$sbc],
                            'business_address' => $businessaddress,
                            'business_city' => $businesscity,
                            'gst_address' => $gstaddress,
                            'business_pan' => $businesspan,
                            'current_business' => $currentbusiness,
                            'business_email' => $businessemail,
                            'business_website' => $businesswebsite,
                            'overall_experience' => $businessexp,
                            'paymentdetail_id' => $paymentid,
                            'social_presence' => $social
                        );
                        $this->blankModel->createRecordInTable($businessdetailarray, 'ibo_business_detail');
                    }
                    $usercode = $this->checkAndcreateUserCode($iduser);
                    $updarr = array('user_code' => $usercode);
                    $this->blankModel->updateRecordInTable($updarr, 'user_detail', 'id_user', $iduser);
                    //$updarray = array();
                    //------------do  other functionality LINK SMS EMAIL-----
                    $this->createGenerationTree($sponsorid, $iduser, 1);
                    //----------------------------------------
                    $this->blankModel->transComplete();

                    if ($this->blankModel->transStatus() === false) {
                        $this->session->setFlashdata('message', setMessage("Something went wrong, Please try after some time", 'f'));
                        $this->blankModel->transRollback();
                    } else {
                        $this->blankModel->transCommit();
                        $objEmailTemplate = new Libraries\EmailTemplate();
                        $emailtemplate = $objEmailTemplate->registrationEmail($name, $emailid, $passphrase);
                        $emaildata = array('template' => $emailtemplate, 'to' => $emailid, 'subject' => "SSK BBI Registration");
                        sendEmail($emaildata);
                        $this->session->setFlashdata('message', setMessage("Member added Successfully. Member code-" . $usercode, 's'));
                    }
                } else {
                    $this->session->setFlashdata('message', setMessage("multy time formsubmission not allowed", 'e'));
                }
            }
        }
        $this->data['segment'] = $this->iboModel->getBusinesssegment();
        $this->data['category'] = $this->iboModel->getBusinessCategory();
        //$this->data['subcategory'] = $this->iboModel->getBusinessSubCategory();
        $this->data['js'] = 'choices,flatpickr,validation,sweetalert';
        $this->data['css'] = 'choices,flatpickr,validation,sweetalert';
        $this->data['includefile'] = 'ibo/iboadd.php,common/common.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\ibo\iboadd', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    protected function checkAndcreateUserCode($iduser) {
        $usercode = randomUsercode($iduser);
        $userdata = $this->blankModel->getTableData('id_user', 'user_detail', "user_code='$usercode'");
        if (empty($userdata)) {
            return $usercode;
        } else {
            $this->checkAndcreateUserCode($iduser);
        }
    }

    protected function createGenerationTree($parent, $child, $level) {
        if ((trim($parent) != 0 || trim($parent) != "0")) {
            $dataarray = array("sponsor" => $parent, "child" => $child, "level" => $level);
            $this->blankModel->createRecordInTable($dataarray, 'ibo_sponsor_position');
            $sponsordetail = $this->iboModel->getSponsordetailByUser($parent);

            if ($sponsordetail->sponsor_user_id != 0) {
                if ($level < 6) {
                    $this->createGenerationTree($sponsordetail->sponsor_user_id, $child, $level + 1);
                }
            }
        }
    }

    public function edit($userid) {
        $this->data['js'] = 'alertify,lightbox,flatpickr,validation';
        $this->data['css'] = 'alertify,lightbox,flatpickr,validation';
        $this->data['includefile'] = 'ibo/iboedit.php,common/common.php';
        $iduser = base64_decode($userid);
        $userdetaildata = $this->iboModel->getIbodetailById($iduser);
        $this->data['userdetail'] = $userdetaildata;
        $this->data['encuserid'] = $userid;
        $this->data['password'] = $this->decryptToken($userdetaildata->user_login_key);
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\ibo\iboedit', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function ibodata() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $pan = trim($this->request->getPost('pan'));
            $mobile = trim($this->request->getPost('mobile'));
            $username = trim($this->request->getPost('username'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'pan' => $pan, 'mobile' => $mobile, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->iboModel->selectIbo($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedIbodata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedIbodata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $action = '';
            $action .= '<a class="blue" target="_blank" title="Edit Detail"   href="' . ADMINPATH . 'ibo-edit/' . base64_encode($data[$x]->id_user) . '"><i class="fas fa-user-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
            if ($data[$x]->user_status == 'Active') {
                $action .= '<a class="blue" title="Block Account" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->id_user) . '&#39;,2);"><i class="fas fa-lock"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }if ($data[$x]->user_status == 'Blocked') {
                $action .= '<a class="blue"  title="Unblock Account" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->id_user) . '&#39;,1);"><i class="fas fa-lock-open"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $action .= '<a class="blue" target="_blank" title="Change Sponsor" data-bs-toggle="modal" data-bs-target="#changesponsorforuser"   href="#" onclick="putMemberId(&#39;' . base64_encode($data[$x]->id_user) . '&#39;)"><i class="fas fa-sitemap"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';

            $arraydata[$x]->action = $action;
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    public function getSponsorDetailById($id) {
        $result = $this->iboModel->getSponsorDetailById($id);
        $return = array();
        if (!empty($result)) {

            $return['sponsor_id'] = $result->id_user;
            $return['sponsor_name'] = $result->user_name;
            $return['status'] = "success";
            $return['message'] = "Sponsor Found";
        } else {
            $return['message'] = "IBO Not found";
            $return['status'] = "error";
            $return['id_user'] = 0;
        }


        echo json_encode($return);
        exit;
    }

    public function getMemberDetailById($id) {
        $result = $this->franchiseModel->getFranchiseDetailByCode($id);
        if (!empty($result)) {
            $return['data'] = $result;
            $return['status'] = "success";
            $return['message'] = "Member Found";
        } else {
            $return['message'] = "Member Not found";
            $return['status'] = "error";
            $return['id_user'] = 0;
        }
        echo json_encode($return);
        exit;
    }

    public function updateSponsor() {
        $return = array('message' => 'Unauthorides Access', 'status' => 'error');
        if ($this->request->isAJAX()) {
            $userid = base64_decode(trim($this->request->getPost('userid')));
            $sponsorid = trim($this->request->getPost('sponsorid'));
            if ($userid != $sponsorid) {
                $userdata = $this->blankModel->getTableData('sponsor_user_id', 'user_detail', 'id_user=' . $userid);
                $currentsponsor = $userdata->sponsor_user_id;
                if ($sponsorid == $currentsponsor) {
                    $return = array('message' => 'Same sponsor switch prohibited', 'status' => 'error');
                } else {
                    $sqlupd = array('sponsor_user_id' => $sponsorid);
                    $this->blankModel->updateRecordInTable($sqlupd, 'user_detail', 'id_user', $userid);
                    $return = array('message' => 'Sponsor changed successfully', 'status' => 'success');
                }
            } else {
                $return = array('message' => 'User can not sponsor him/her self', 'status' => 'error');
            }
        }

        echo json_encode($return);
        exit;
    }

}
