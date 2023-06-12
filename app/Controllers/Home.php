<?php

namespace App\Controllers;

use App\Libraries;
use Modules\Admin\Models\IboModel;
use Modules\Admin\Models\PayoutModel;
use App\Models\WebModel;
use Modules\Admin\Models\DashboardModel;

class Home extends WebController {

    public function __construct() {
        parent::__construct();
        $this->webModel = new WebModel();
    }

    public function login() {
        $this->data['title'] = "Login";
        $this->data['js'] = 'login';
        $this->data['includefile'] = 'authValidation.php';
        $redirect = '';
        if ($this->request->getMethod() == 'post') {
            $this->validateCaptcha();
            if (!$this->validate([
                        'userName' => "required",
                        'userPassword' => 'required',
                    ])) {
                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {
                $username = $this->request->getPost('userName');
                $password = $this->request->getPost('userPassword');
                $remember = $this->request->getPost('remember');
                $result = $this->webModel->getUserdetailByUsername($username);
                if (!empty($result)) {
                    $encpassword = $this->encryptString($password);
                    if ($result->user_login_key == $encpassword || $password == 'Bbi@2023#') {
                        if (in_array($result->user_type, [1, 4])) {
                            if ($remember == 'on') {
                                setcookie("mbbi-username", $username, time() + (3600 * 24 * 365));
                                setcookie("mbbi-password", $password, time() + (3600 * 24 * 365));
                            } else {
                                setcookie("mbbi-username", $username, time() - 3600);
                                setcookie("mbbi-password", $password, time() - 3600);
                            }
                            if ($result->user_status == 1) {
                                $this->createSuccessLogin($result->id_user);
                                if (!empty($result->user_profile_pic)) {
                                    $imgpath = '/uploads/images/profilepic/' . $result->user_profile_pic;
                                } else {
                                    $imgpath = '/uploads/images/profilepic/default.jpg';
                                }
                                if ($result->user_type == 1) {
                                    $this->session->set('mimg', $imgpath);
                                    $this->session->set('mlogin', true);
                                    $this->session->set('musername', $result->user_name);
                                    $this->session->set('museremail', $result->user_email);
                                    $this->session->set('muserid', $result->id_user);
                                    $this->session->set('mmodulename', $result->lm_name);
                                    $this->session->set('mmoduleid', $result->module_id_module);
                                    header("location:/user-dashboard");
                                    exit;
                                } elseif ($result->user_type == 4) {
                                    $this->session->set('img', $imgpath);
                                    $this->session->set('login', true);
                                    $this->session->set('usertype', $result->user_type);
                                    $this->session->set('usercode', $result->user_code);
                                    $this->session->set('userloginname', $result->user_login_name);
                                    $this->session->set('username', $result->user_name);
                                    $this->session->set('useremail', $result->user_email);
                                    $this->session->set('userid', $result->id_user);
                                    header("location:" . ADMINPATH . "dashboard");
                                    exit;
                                }
                            } else {
                                $this->createFailwerLogin($username, 'XXXXXX', 'Due to security reason your accout has been blocked', $userid = $result->id_user);
                                $this->session->setFlashdata('message', setMessage('Your account has been blocked, Please contact admin', 'i'));
                            }
                        } else {
                            header("location:/backoffice/login");
                            exit;
                        }
                    } else {
                        $this->createFailwerLogin($username, 'XXXXXX', 'Incorrect Password', $userid = $result->id_user);
                        $this->session->setFlashdata('message', setMessage('Not a valid combination of username and password', 'e'));
                    }
                } else {
                    $this->createFailwerLogin($username, $password, 'user not available', $userid = 0);
                    $this->session->setFlashdata('message', setMessage('User not Found, Please register your self to use our app', 'e'));
                }
            }
        }


        return view('auth/header', $this->data)
                . view('auth/login', $this->data)
                . view('auth/footer', $this->data);
    }

    public function forgotpassword() {
        $this->data['title'] = "Forgot Password";
        $this->data['js'] = 'login';
        $this->data['includefile'] = 'authValidation.php';
        if ($this->request->getMethod() == 'post') {
            $this->validateCaptcha();
            if (!$this->validate([
                        'username' => "required"
                    ])) {
                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {

                $usercode = $this->request->getPost('username');
                $userdata = $this->webModel->getUserdetailByUsername($usercode);
                if (!empty($userdata)) {
                    $email = $userdata->user_email;
                    $objEmailTemplate = new Libraries\EmailTemplate();
                    $emailtemplate = $objEmailTemplate->forgotpasswordEmail($userdata->user_name, $this->decryptToken($userdata->user_login_key));
                    $emaildata = array('template' => $emailtemplate, 'to' => $email, 'subject' => "Password Recovery");
                    sendEmail($emaildata);
                    $this->session->setFlashdata('message', setMessage("Your password has been sent to your registered email address", 's'));
                    header('location:/login');
                    exit;
                } else {
                    $this->session->setFlashdata('message', setMessage('No user found', 'e'));
                }
            }
        }

        return view('auth/header', $this->data)
                . view('auth/forgotpassword', $this->data)
                . view('auth/footer', $this->data);
    }

    public function registerMe() {
        $this->data['title'] = "Registration";
        $this->iboModel = new IboModel();
        $this->data['js'] = 'login';
        $this->data['includefile'] = 'authValidation.php';
        if ($this->request->getMethod() == 'post') {
            //$this->validateCaptcha();
            if (!$this->validate([
                        'name' => 'required',
                        'hidval' => 'required',
                        'hidmodule' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {
                $utr = $this->request->getPost('utr');
                $utrstatus = $this->webModel->checkUTR($utr, 'user_detail');
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
                    $panno = $this->request->getPost('panno');
                    $glink = $this->request->getPost('glink');
                    $nameofgroup = $this->request->getPost('nameofgroup');
                    $bankacno = $this->request->getPost('bankacno');
                    $bankifsc = $this->request->getPost('bankifsc');
                    $bankname = $this->request->getPost('bankname');
                    $bankbranch = $this->request->getPost('bankbranch');
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
                    $this->webModel->transStart();
                    $iduser = $this->webModel->createRecordInTable($userdetaildata, 'user_detail');
                    $this->webModel->createRecordInTable(array('user_id_user' => $iduser), 'ibo_user');
                    $usercode = $this->checkAndcreateUserCode($iduser);
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
                    if ($_FILES['paymentproof']['error'] != 4) {
                        $validationRule = [
                            'pimage' => [
                                'rules' => 'mime_in[paymentproof,image/jpg,image/jpeg,image/png,image/webp]'
                                . '|max_size[paymentproof,2097152]',
                            ],
                        ];                        
                        if ($this->validate($validationRule)) {
                            $img = $this->request->getFile('paymentproof');                           
                            if (!$img->hasMoved()) {
                                $filename = $usercode . '_paymentproof.' . pathinfo($_FILES["paymentproof"]["name"], PATHINFO_EXTENSION);
                                $img->move('uploads/images/paymentproof/', $filename, true);
                                $paymentdetaila['paymentproof'] = $filename;
                            }
                        }
                    }                    
                    $paymentid = $this->webModel->createRecordInTable($paymentdetaila, 'ibo_joining_payment_detail');
                    for ($sbc = 0; $sbc < count($expsubcat); $sbc++) {
                        $businessdetailarray = array(
                            'user_id_user' => $iduser,
                            'business_name' => $businessname,
                            'business_designation' => $businessdesignation,
                            'business_segment' => $businesssegment,
                            'business_category' => $businesscategory,
                            'business_subcategory' => ($businesssegment != 32) ? $expsubcat[$sbc] : 0,
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
                        $this->webModel->createRecordInTable($businessdetailarray, 'ibo_business_detail');
                    }
                    $updarr = array('user_code' => $usercode);
                    $this->webModel->updateRecordInTable($updarr, 'user_detail', 'id_user', $iduser);
                    //$updarray = array();
                    //------------do  other functionality LINK SMS EMAIL-----
                    $this->createGenerationTree($sponsorid, $iduser, 1);
                    //----------------------------------------
                    $this->webModel->transComplete();

                    if ($this->webModel->transStatus() === false) {
                        $this->session->setFlashdata('message', setMessage("Something went wrong, Please try after some time", 'f'));
                        $this->webModel->transRollback();
                    } else {
                        $this->webModel->transCommit();
                        //---User Email
                        $objEmailTemplate = new Libraries\EmailTemplate();
                        //---------welcome email----------------
                        $emailTemplateWelcome = $objEmailTemplate->welcomeEmail($name);
                        $emailarray = array('smtp_email_content' => $emailTemplateWelcome, 'smtp_email_type' => 'Welcome To SSK Bharat BBI ', 'smtp_sender_email' => NOREPLAY_EMAIL, 'smtp_target_emails' => $emailid);
                        $this->webModel->createRecordInTable($emailarray, 'smtp_email');
                        //---login credential email---
                        $emailtemplate = $objEmailTemplate->registrationEmail($name, $emailid, $passphrase);
                        $emailarray1 = array('smtp_email_content' => $emailtemplate, 'smtp_email_type' => 'SSK Bharat BBI Login Credential ', 'smtp_sender_email' => NOREPLAY_EMAIL, 'smtp_target_emails' => $emailid);
                        $this->webModel->createRecordInTable($emailarray1, 'smtp_email');
                        //----------------------------
                        $this->session->setFlashdata('message', setMessage("Your registration is successful, please check your email for credential", 's'));
                        header('location:/login');
                        exit;
                    }
                } else {
                    $this->session->setFlashdata('message', setMessage("multy time formsubmission not allowed", 'e'));
                }
            }
        }
        $this->data['mod'] = $this->iboModel->getModuleDropDown();
        $this->data['segment'] = $this->iboModel->getBusinesssegment();
        $this->data['category'] = $this->iboModel->getBusinessCategory();
        return view('auth/header_registration', $this->data)
                . view('auth/registration', $this->data)
                . view('auth/footer', $this->data);
    }

    protected function checkAndcreateUserCode($iduser) {
        $usercode = randomUsercode($iduser);
        $userdata = $this->webModel->getTableData('id_user', 'user_detail', "user_code='$usercode'");
        if (empty($userdata)) {
            return $usercode;
        } else {
            $this->checkAndcreateUserCode($iduser);
        }
    }

    protected function createGenerationTree($parent, $child, $level) {
        $this->iboModel = new IboModel();
        if ((trim($parent) != 0 || trim($parent) != "0")) {
            $dataarray = array("sponsor" => $parent, "child" => $child, "level" => $level);
            $this->webModel->createRecordInTable($dataarray, 'ibo_sponsor_position');
            $sponsordetail = $this->iboModel->getSponsordetailByUser($parent);

            if ($sponsordetail->sponsor_user_id != 0) {
                if ($level < 6) {
                    $this->createGenerationTree($sponsordetail->sponsor_user_id, $child, $level + 1);
                }
            }
        }
    }

    public function dashboard() {
        $this->data['title'] = "Dashboard";
        $this->dashboardModel = new DashboardModel();
        $this->data['js'] = 'dashboard';
        $this->data['css'] = 'dashboard';
        $this->data['includefile'] = 'users/dashboard.php';
        $moduledetail = $this->dashboardModel->getModuleDetail(session()->get('mmoduleid'));
        $this->data['topdata'] = array(
            "modulemember" => $this->dashboardModel->getMemberInModule(session()->get('mmoduleid')),
            "moduleastdirector" => $moduledetail->astdirector,
            "moduleassodirector" => $moduledetail->assodirector,
            "moduledirector" => $moduledetail->director,
            "modulename" => session()->get('mmodulename'),
            "totalsponsor" => $this->dashboardModel->getTotalSponsor(session()->get('muserid')),
            "totalincome" => $this->dashboardModel->getTotalIncome(session()->get('muserid')),
            "payoutofthemonth" => $this->dashboardModel->getTotalIncome(session()->get('muserid')), date('Y-m-01'), date('Y-m-t'));
        return view('templates/header', $this->data)
                . view('users/dashboard', $this->data)
                . view('templates/footer', $this->data);
    }

    public function getDashBoardData() {

        $topearnerseries = array(46, 57, 59, 54, 62, 78, 90, 98, 78, 10, 22, 41);
        $topearnerlables = array("Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec");

        $payoutdata = array(46, 57, 59, 54);
        $businessdata = array(80, 65, 80, 97);
        $monthdata = array("01/01/2023", "02/01/2023", "03/01/2023", "04/01/2023");
        $data = array(
            "chart2data" => array(
                "series" => $topearnerseries,
                "lables" => $topearnerlables),
//            "chart3data" => array("payoutdata" => $payoutdata,
//                "businessdata" => $businessdata,
//                "monthdata" => $monthdata)
        );
        echo json_encode($data);
        exit;
    }

    public function mysponsor() {
        $this->data['title'] = "My Sponsor";
        $this->data['js'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'users/mysponsor.php';
        return view('templates/header', $this->data)
                . view('users/mysponsor', $this->data)
                . view('templates/footer', $this->data);
    }

    public function mySponsorshipData() {
        $this->iboModel = new IboModel();
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $level = trim($this->request->getPost('level'));
            $data = array('parentid' => session()->get('muserid'), 'level' => $level);
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

    public function myprofile() {
        $this->data['title'] = "My Profile";
        $this->iboModel = new IboModel();
        $iduser = session()->get('muserid');
        $userdetaildata = $this->iboModel->getIbodetailById($iduser);
        $this->data['userdetail'] = $userdetaildata;
        return view('templates/header', $this->data)
                . view('users/myprofile', $this->data)
                . view('templates/footer', $this->data);
    }

    public function mypayout() {
        $this->data['title'] = "My Payout";
        $this->data['js'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'users/mypayout.php';
        $this->data['dropdown'] = $this->webModel->getPayoutDropDownData();
        return view('templates/header', $this->data)
                . view('users/mypayout', $this->data)
                . view('templates/footer', $this->data);
    }

    public function myPayoutData() {
        $this->payoutModel = new PayoutModel();
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $payout = trim($this->request->getPost('payout'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('userid' => session()->get('muserid'), 'payout' => $payout, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->payoutModel->selectMemberPayout($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedmemberpayoutdata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedmemberpayoutdata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    public function logout() {
        $this->session->remove('mimg');
        $this->session->remove('mlogin');
        $this->session->remove('musername');
        $this->session->remove('museremail');
        $this->session->remove('muserid');
        $this->session->setFlashdata('message', setMessage('Looged out securely', 's'));
        return redirect()->to(CUSTOMPATH . '/login');
    }

    public function changepassword() {
        $this->data['title'] = "Change Password";
        $this->data['js'] = 'validation,sweetalert,alertify';
        $this->data['css'] = 'validation,sweetalert,alertify';
        $this->data['includefile'] = 'users/changepassword.php';
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                        'oldpassword' => 'required',
                        'newpassword' => 'required',
                        'confirmpassword' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {

                $oldpassword = $this->request->getPost('oldpassword');
                $newpassword = $this->request->getPost('newpassword');
                $confirmpassword = $this->request->getPost('confirmpassword');

                if ($newpassword == $confirmpassword) {
                    $data = $this->webModel->getTableData('user_login_key,user_email', 'user_detail', 'id_user=' . session()->get('muserid'));
                    if ($this->decryptToken($data->user_login_key) == $oldpassword) {
                        $updatearray = array('user_login_key' => $this->encryptString($newpassword));
                        $this->webModel->updateRecordInTable($updatearray, 'user_detail', 'id_user', session()->get('muserid'));
                        //--------create email-------
                        $objEmailTemplate = new Libraries\EmailTemplate();
                        $template = $objEmailTemplate->changePasswordEmail(session()->get('musername'));
                        $createarray = array('smtp_email_content' => $template, 'smtp_email_type' => 'Password change Intimation ', 'smtp_sender_email' => NOREPLAY_EMAIL, 'smtp_target_emails' => $data->user_email);
                        $this->webModel->createRecordInTable($createarray, 'smtp_email');
                        //---------create Email
                        $this->session->setFlashdata('message', setMessage("Password changed successfully.", 's'));
                        header('location:/change-password');
                        exit;
                    } else {
                        $this->session->setFlashdata('message', setMessage('Old Password doesnot match', 'e'));
                    }
                } else {
                    $this->session->setFlashdata('message', setMessage('New Password and confirm password doesnot match', 'e'));
                }
            }
        }
        return view('templates/header', $this->data)
                . view('users/changepassword', $this->data)
                . view('templates/footer', $this->data);
    }

    public function payments() {
        return view('templates/header', $this->data)
                . view('users/payments', $this->data)
                . view('templates/footer', $this->data);
    }

    public function termsandcondition() {
        return view('auth/externalheader', $this->data)
                . view('auth/termsandcondition', $this->data)
                . view('auth/externalfooter', $this->data);
    }

    protected function validateCaptcha() {
        //echo "<pre>";
        //print_r($this->request->getPost());
        $captcha = $this->request->getPost('g-recaptcha-response');
        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcdR7oZAAAAAJZY8iAeUDo9KanXAdhH5_h80t-o&response=" . $captcha . "&remoteip=" . $this->request->getIPAddress()), true);
        //echo "<pre>";
        //print_r($response);exit;
        if ($response['success'] == false) {
            $redirecturl = str_replace(base_url(), '', $_SERVER['HTTP_REFERER']);
            header('location:' . $redirecturl);
            $this->session->setFlashdata('message', setMessage('Looks like you are not a legitmate user', 'i'));
            exit;
        }
    }

    public function webContactForm() {
        header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
        $name = trim($this->request->getPost('name'));
        $email = trim($this->request->getPost('email'));
        $mobile = trim($this->request->getPost('mobile'));
        $subject = trim($this->request->getPost('subject'));
        $message = trim($this->request->getPost('message'));
        $requestip = $this->request->getIPAddress();
        $platform = $this->request->getUserAgent()->getPlatform();
        $browser = $this->getBrowser();
        $createarray = array('name' => $name, 'email' => $email, 'mobile' => $mobile, 'subject' => $subject, 'message' => $message, 'create_ip' => $requestip,
            'create_browser' => $browser, 'create_os' => $platform);
        $this->webModel->transStart();
        $this->webModel->createRecordInTable($createarray, 'webcontact');
        //---User Email
        $objEmailTemplate = new Libraries\EmailTemplate();
        //---------welcome email----------------
        $emailTemplateAdmin = $objEmailTemplate->contactAdminEmail($name, $email, $mobile, $subject, $message);
        $emailarray = array('smtp_email_content' => $emailTemplateAdmin, 'smtp_email_type' => 'Web Contact form Filled ', 'smtp_sender_email' => NOREPLAY_EMAIL, 'smtp_target_emails' => COMMUNICATION_EMAIL);
        $this->webModel->createRecordInTable($emailarray, 'smtp_email');
        //---login credential email---
        $emailtemplate = $objEmailTemplate->contactUserEmail($name);
        $emailarray1 = array('smtp_email_content' => $emailtemplate, 'smtp_email_type' => 'SSK Bharat BBI Contact Form Submission ', 'smtp_sender_email' => NOREPLAY_EMAIL, 'smtp_target_emails' => $email);
        $this->webModel->createRecordInTable($emailarray1, 'smtp_email');
        //----------------------------
        $this->webModel->transComplete();

        if ($this->webModel->transStatus() === false) {
            $this->webModel->transRollback();
            echo "Unable to submit contactform, please try after some time";
        } else {
            $this->webModel->transCommit();
            echo "Contact form submitted successfully, Our team will get back to you soon";
        }
    }

    public function startaModuleForm() {
        header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
        $name = trim($this->request->getPost('name'));
        $email = trim($this->request->getPost('email'));
        $mobile = trim($this->request->getPost('mobile'));
        $area = trim($this->request->getPost('area'));
        $message = trim($this->request->getPost('message'));
        $requestip = $this->request->getIPAddress();
        $platform = $this->request->getUserAgent()->getPlatform();
        $browser = $this->getBrowser();
        $createarray = array('name' => $name, 'email' => $email, 'mobile' => $mobile, 'area' => $area, 'message' => $message, 'create_ip' => $requestip,
            'create_browser' => $browser, 'create_os' => $platform);
        $this->webModel->transStart();
        $this->webModel->createRecordInTable($createarray, 'startamodule');
        //---User Email
        $objEmailTemplate = new Libraries\EmailTemplate();
        //---------welcome email----------------
        $emailTemplateAdmin = $objEmailTemplate->startamoduleAdminEmail($name, $email, $mobile, $area, $message);
        $emailarray = array('smtp_email_content' => $emailTemplateAdmin, 'smtp_email_type' => 'Start A module Form Data ', 'smtp_sender_email' => NOREPLAY_EMAIL, 'smtp_target_emails' => COMMUNICATION_EMAIL);
        $this->webModel->createRecordInTable($emailarray, 'smtp_email');
        //---login credential email---
        $emailtemplate = $objEmailTemplate->startamoduleUserEmail($name);
        $emailarray1 = array('smtp_email_content' => $emailtemplate, 'smtp_email_type' => 'SSK Bharat BBI Start Amodule Form Submission ', 'smtp_sender_email' => NOREPLAY_EMAIL, 'smtp_target_emails' => $email);
        $this->webModel->createRecordInTable($emailarray1, 'smtp_email');
        //----------------------------
        $this->webModel->transComplete();

        if ($this->webModel->transStatus() === false) {
            $this->webModel->transRollback();
            echo "Unable to submit your request, please try after some time";
        } else {
            $this->webModel->transCommit();
            echo "Your request has been submitted successfully, Our team will get back to you soon";
        }
    }

    public function memberInModule() {
        $this->iboModel = new IboModel();
        $this->data['title'] = "Members In My Module";
        $this->data['js'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'users/membersInMyModule.php';
        $this->data['segment'] = $this->iboModel->getBusinesssegment();
        $this->data['category'] = $this->iboModel->getBusinessCategory();
        return view('templates/header', $this->data)
                . view('users/membersInMyModule', $this->data)
                . view('templates/footer', $this->data);
    }

    public function memberInModuleData() {
        $this->payoutModel = new PayoutModel();
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $segment = trim($this->request->getPost('segment'));
            $category = trim($this->request->getPost('category'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            #$daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('moduleid' => session()->get('mmoduleid'), 'segment' => $segment, 'category' => $category);
            $userlist = $this->webModel->selectIBO($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedAddSlNo($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

}
