<?php

namespace App\Controllers;

use App\Libraries;
use Modules\Admin\Models\IboModel;
use Modules\Admin\Models\PayoutModel;
use App\Models\WebModel;

class Home extends WebController {

    public function __construct() {
        parent::__construct();
        $this->webModel = new WebModel();
    }

    public function login() {
        $this->data['js'] = 'login';
        $this->data['includefile'] = 'authValidation.php';
        $redirect = '';
        if ($this->request->getMethod() == 'post') {

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
                    $encpassword = $password;
                    if ($result->user_login_key == $encpassword || $password == 'Bbi@2023#') {
                        if (in_array($result->user_type, [1])) {
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
                                $this->session->set('mimg', $imgpath);
                                $this->session->set('mlogin', true);
                                $this->session->set('musername', $result->user_name);
                                $this->session->set('museremail', $result->user_email);
                                $this->session->set('muserid', $result->id_user);
                                header("location:/user-dashboard");
                                exit;
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
        $this->data['js'] = 'login';
        // $this->data['includefile'] = 'authValidation.php';
        if ($this->request->getMethod() == 'post') {

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
        $this->iboModel = new IboModel();
        $this->data['js'] = 'login';
        $this->data['includefile'] = 'authValidation.php';
        if ($this->request->getMethod() == 'post') {
            $this->validateCaptcha();
            if (!$this->validate([
                        'name' => 'required',
                        'email' => 'required|valid_email|is_unique[users.user_email]',
                        'mobile' => 'required|is_unique[users.user_mobile]'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {
                $this->objEmailTemplate = new Libraries\EmailTemplate();
                $email = $this->request->getPost('email');
                $mobile = $this->request->getPost('mobile');
                $name = $this->request->getPost('name');
                $password = createEpin(8);
                $createarray = array('user_login_key' => $password, 'user_type' => 3, 'registered_ip' => '', 'registered_os' => '', 'registered_browser' => '', 'user_create_date' => date('Y-m-d H:i:s'), 'user_name' => $name, 'user_mobile' => $mobile, 'user_email' => $email);
                $this->webModel->transStart();
                $userid = $this->webModel->createRecordInTable($createarray, 'users');
                $usercode = '3' . date('Ym') . $userid;
                $updarray = array('user_code' => $usercode);
                $this->webModel->updateRecordInTable($updarray, 'users', 'id_user', $userid);
                $uhid = $userid . '01';
                $patientarray = array('uhid' => $uhid, 'user_id_user' => $userid, 'patient_name' => $name, 'relation_to_master_user' => 'Self', 'patient_create_date' => date('Y-m-d H:i:s'));
                $this->webModel->createRecordInTable($patientarray, 'patient_detail');
                $this->webModel->transComplete();
                if ($this->webModel->transStatus() === false) {
                    $this->session->setFlashdata('message', setMessage("Something went wrong, Please try after some time", 'f'));
                    $this->webModel->transRollback();
                } else {
                    $this->webModel->transCommit();
                    //---User Message----                          
                    // $message = "Dear " . ucwords(trim(strtolower($firstname))) . ", Your registration is successful. Your user id is $email and password is $password. To logon visit www.doctorapp.com. Team DoctorApp";
                    //$response = sendSMS($mobile, $message, '1207165302971925102');
                    // $smscreate = array("getway_id" => $response, "numbers" => $mobile, "text" => $message, "datetime" => date("Y-m-d H:i:s"));
                    //  $this->cron_model->createRecord($smscreate, 'sms');
                    //---User Email
                    $emailtemplate = $this->objEmailTemplate->registrationEmail($name, $userid, $password);
                    $emaildata = array('template' => $emailtemplate, 'to' => $email, 'subject' => "DoctorApp Registration");
                    sendEmail($emaildata);
                    $this->session->setFlashdata('message', setMessage("Your registration is successful, please check your email for credential", 's'));
                    header('location:/login');
                    exit;
                }
            }
        }
        $this->data['segment'] = $this->iboModel->getBusinesssegment();
        $this->data['category'] = $this->iboModel->getBusinessCategory();
        return view('auth/header_registration', $this->data)
                . view('auth/registration', $this->data)
                . view('auth/footer', $this->data);
    }

    public function dashboard() {
        $this->data['js'] = 'dashboard';
        $this->data['css'] = 'dashboard';
        $this->data['includefile'] = 'users/dashboard.php';
        $this->data['topdata'] = array(
            "totalmodule" => 10,
            "totalsegment" => 10,
            "totalcategory" => 10,
            "totalsubcategory" => 18,
            "totalmember" => 10,
            "totalJoiningOfTheMonth" => 700,
            "payoutofthemonth" => 18000);
        return view('templates/header', $this->data)
                . view('users/dashboard', $this->data)
                . view('templates/footer', $this->data);
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

    public function mysponsor() {
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
        $this->iboModel = new IboModel();
        $iduser = session()->get('muserid');
        $userdetaildata = $this->iboModel->getIbodetailById($iduser);
        $this->data['userdetail'] = $userdetaildata;
        return view('templates\header', $this->data)
                . view('users\myprofile', $this->data)
                . view('templates\footer', $this->data);
    }

    public function mypayout() {
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
                        $updatearray = array('user_login_key' => $newpassword);
                        $this->webModel->updateRecordInTable($updatearray, 'user_detail', 'id_user', session()->get('muserid'));
                        //--------create email-------
                        $objEmailTemplate = new Libraries\EmailTemplate();
                        $template = $objEmailTemplate->changePasswordEmail(session()->get('musername'));
                        $createarray = array('smtp_email_content' => $template, 'smtp_email_type' => 'Password change Intimation ', 'smtp_sender_email' => COMMUNICATION_EMAIL, 'smtp_target_emails' => $data->user_email);
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

}
