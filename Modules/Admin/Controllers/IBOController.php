<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\IboModel;
use Modules\Admin\Models\FranchiseModel;

class IBOController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->iboModel = new IboModel();
        $this->franchiseModel = new FranchiseModel();
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
                        'gender' => 'required',
                        'maritalstatus' => 'required',
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
                    $profcert= $this->request->getPost('profcert');
                    $hidmodule = $this->request->getPost('hidmodule');
                    $dob = $this->request->getPost('dob');
                    $gender = $this->request->getPost('gender');
                    $maritalstatus = $this->request->getPost('maritalstatus');
                    $address = $this->request->getPost('address');
                    $pincode = $this->request->getPost('pincode');
                    $postoffice = $this->request->getPost('postoffice');
                    $city = $this->request->getPost('city');
                    $district = $this->request->getPost('district');
                    $state = $this->request->getPost('state');
                    $country = $this->request->getPost('country');
                    $mobile = $this->request->getPost('mobile');
                    $whatsappno = $this->request->getPost('whatsappno');
                    $emailid = $this->request->getPost('emailid');                    
                    $bankacno = $this->request->getPost('bankacno');
                    $bankifsc = $this->request->getPost('bankifsc');
                    $bankname = $this->request->getPost('bankname');
                    $bankbranch = $this->request->getPost('bankbranch');
                    $panno = $this->request->getPost('panno');
                    $glink = $this->request->getPost('glink');
                    $nameofgroup = $this->request->getPost('nameofgroup');
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
                        'user_gender' => $gender,
                        'user_marital_status' => $maritalstatus,
                        'user_mobile' => $mobile,
                        'user_whatsappno' => $whatsappno,
                        'is_mobile_verified' => 1,
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
                        "user_bank_branch" => $bankbranch
                    );
                    $this->blankModel->transStart();
                    $iduser = $this->blankModel->createRecordInTable($userdetaildata, 'user_detail');
                    $this->blankModel->createRecordInTable(array('user_id_user' => $iduser), 'ibo_user');
                    $usercode = $this->checkAndcreateUserCode($iduser);
                    $updarr = array('user_code' => $usercode);
                    $this->blankModel->updateRecordInTable($updarr, 'user_detail', 'id_user', $iduser);
                    $updarray = array();
                    if (isset($_FILES['cancelcheque'])) {
                        if ($_FILES['cancelcheque']['error'] != 4) {
                            $validationRule = [
                                'pimage' => [
                                    'rules' => 'mime_in[cancelcheque,image/jpg,image/jpeg,image/png,image/webp]'
                                    . '|max_size[cancelcheque,10000000]',
                                ],
                            ];
                            if ($this->validate($validationRule)) {
                                $img = $this->request->getFile('cancelcheque');
                                if (!$img->hasMoved()) {
                                    $filename = $usercode . '_cancelcheque.' . pathinfo($_FILES["cancelcheque"]["name"], PATHINFO_EXTENSION);
                                    $img->move('uploads/images/kyc/', $filename, true);
                                    $updarray['kyc_cancel_cheque'] = $filename;
                                }
                            }
                        }
                    }
                    if ($_FILES['addressproof']['error'] != 4) {
                        $validationRule = [
                            'pimage' => [
                                'rules' => 'mime_in[addressproof,image/jpg,image/jpeg,image/png,image/webp]'
                                . '|max_size[addressproof,10000000]',
                            ],
                        ];
                        if ($this->validate($validationRule)) {
                            $img = $this->request->getFile('addressproof');
                            if (!$img->hasMoved()) {
                                $filename = $usercode . '_address.' . pathinfo($_FILES["addressproof"]["name"], PATHINFO_EXTENSION);
                                $img->move('uploads/images/kyc/', $filename);
                                $updarray['kyc_address'] = $filename;
                            }
                        }
                    }
                    if ($_FILES['pancopy']['error'] != 4) {
                        $validationRule = [
                            'pimage' => [
                                'rules' => 'mime_in[pancopy,image/jpg,image/jpeg,image/png,image/webp]'
                                . '|max_size[pancopy,10000000]',
                            ],
                        ];
                        if ($this->validate($validationRule)) {
                            $img = $this->request->getFile('pancopy');
                            if (!$img->hasMoved()) {
                                $filename = $usercode . '_pan.' . pathinfo($_FILES["pancopy"]["name"], PATHINFO_EXTENSION);
                                $img->move('uploads/images/kyc/', $filename);
                                $updarray['kyc_pan'] = $filename;
                            }
                        }
                    }
                    if ($_FILES['image']['error'] != 4) {
                        $validationRule = [
                            'pimage' => [
                                'rules' => 'mime_in[image,image/jpg,image/jpeg,image/png,image/webp]'
                                . '|max_size[image,10000000]',
                            ],
                        ];
                        if ($this->validate($validationRule)) {
                            $img = $this->request->getFile('image');
                            if (!$img->hasMoved()) {
                                $filename = $usercode . '_image.' . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                                $img->move('uploads/images/kyc/', $filename);
                                $updarray['kyc_image'] = $filename;
                            }
                        }
                    }

                    if (!empty($updarray)) {
                        $this->blankModel->updateRecordInTable($updarray, 'user_detail', 'id_user', $iduser);
                    }
                    //------------do  other functionality LINK SMS EMAIL-----
                    $this->createGenerationTree($sponsorid, $iduser, 1);
                    //----------------------------------------
                    $this->blankModel->transComplete();

                    if ($this->blankModel->transStatus() === false) {
                        $this->session->setFlashdata('message', setMessage("Something went wrong, Please try after some time", 'f'));
                        $this->blankModel->transRollback();
                    } else {
                        $this->blankModel->transCommit();
                        $this->session->setFlashdata('message', setMessage("Member added Successfully.", 's'));
                    }
                } else {
                    $this->session->setFlashdata('message', setMessage("multy time formsubmission not allowed", 'e'));
                }
            }
        }

        $this->data['js'] = 'flatpickr,validation,sweetalert';
        $this->data['css'] = 'flatpickr,validation,sweetalert';
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
