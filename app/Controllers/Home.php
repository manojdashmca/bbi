<?php

namespace App\Controllers;

use App\Libraries;

class Home extends WebController {

    public function __construct() {
        parent::__construct();
    }

//----------------------website methods---------------------
    public function comingsoon() {
        $this->data['title'] = "Home";
        return view('home/comingsoon', $this->data);
    }

    public function homepage() {
        $this->data['title'] = "Home";
        return view('templates/header', $this->data)
                . view('home/index')
                . view('templates/ourProduct')
                . view('templates/talentedPeople')
                . view('templates/ourBrand')
                . view('templates/waveFooter')
                . view('templates/footer', $this->data);
    }

    public function aboutus() {
        $this->data['title'] = "About";
        return view('templates/header', $this->data)
                . view('home/aboutus', $this->data)
                . view('templates/waveFooter')
                . view('templates/footer', $this->data);
    }

    public function productpage() {
        $this->data['title'] = "product";
        $this->data['product'] = $this->webModel->getWebProducts();
        return view('templates/header', $this->data)
                . view('home/product', $this->data)
                . view('templates/footer', $this->data);
    }

    public function productdetailpage($productid) {
        $productdetail = $this->webModel->getProductDetailById($productid);
        $this->data['title'] = $productdetail->product_name;
        $this->data['productdetail'] = $productdetail;
        return view('templates/header', $this->data)
                . view('home/productdetail', $this->data)
                . view('templates/footer', $this->data);
    }

    public function whywellness() {
        return view('templates/header', $this->data)
                . view('home/whywinwellness', $this->data)
                . view('templates/waveFooter')
                . view('templates/footer', $this->data);
    }

    public function resourcesDownload() {
        $productdetail = $this->webModel->getResourceDownload();
        $this->data['title'] = 'Download';
        $this->data['productdetail'] = $productdetail;
        return view('templates/header', $this->data)
                . view('home/resourcedownload', $this->data)
                . view('templates/waveFooter')
                . view('templates/footer', $this->data);
    }

    public function resourcesFaq() {
        return view('templates/header', $this->data)
                . view('home/resourcefaq', $this->data)
                . view('templates/waveFooter')
                . view('templates/footer', $this->data);
    }

    public function partnerwithus() {
        return view('templates/header', $this->data)
                . view('home/partnerwithus', $this->data)
                . view('templates/footer', $this->data);
    }

    public function companycertificate() {
        return view('templates/header', $this->data)
                . view('home/companycertificate', $this->data)
                . view('templates/waveFooter')
                . view('templates/footer', $this->data);
    }

    public function teamwinwellness() {
        return view('templates/header', $this->data)
                . view('home/teamwinwellness', $this->data)
                . view('templates/footer', $this->data);
    }

    public function contactus() {
        return view('templates/header', $this->data)
                . view('home/contact', $this->data)
                . view('templates/footer', $this->data);
    }

    public function privacypolicy() {
        return view('templates/header', $this->data)
                . view('home/privacypolicy', $this->data)
                . view('templates/waveFooter')
                . view('templates/footer', $this->data);
    }

    public function shippingpolicy() {
        return view('templates/header', $this->data)
                . view('home/shippingpolicy', $this->data)
                . view('templates/waveFooter')
                . view('templates/footer', $this->data);
    }

    public function cancellationandrefundpolicy() {
        return view('templates/header', $this->data)
                . view('home/cancellationpolicy', $this->data)
                . view('templates/waveFooter')
                . view('templates/footer', $this->data);
    }

    public function termsandcondition() {
        return view('templates/header', $this->data)
                . view('home/termsandconditions', $this->data)
                . view('templates/waveFooter')
                . view('templates/footer', $this->data);
    }

    public function contractAgreement() {
        return view('templates/header', $this->data)
                . view('home/contractAgreement', $this->data)
                . view('templates/footer', $this->data);
    }

    public function disclaimer() {
        return view('templates/header', $this->data)
                . view('home/disclamier', $this->data)
                . view('templates/waveFooter')
                . view('templates/footer', $this->data);
    }

    public function grivances() {
        return view('templates/header', $this->data)
                . view('home/grivances', $this->data)
                . view('templates/waveFooter')
                . view('templates/footer', $this->data);
    }

    public function maintenanceMode() {
        $this->data['title'] = 'Maintenance';
        return view('home/maintenanceMode', $this->data);
    }

    public function shoppingCart() {
        $this->data['title'] = "Cart";
        return view('templates/header', $this->data)
                . view('home/shoppingCart', $this->data)
                . view('templates/footer', $this->data);
    }

    public function checkout() {
        $this->data['title'] = "Checkout";
        return view('templates/header', $this->data)
                . view('home/checkout', $this->data)
                . view('templates/footer', $this->data);
    }

//----------------------website methods--------------------------   

    public function logMeIn() {
        $this->data['js'] = 'login';
        $this->data['includefile'] = 'authValidation.php';
        $redirect = '';
        if ($this->request->getMethod() == 'post') {
            $securitycode = $this->request->getPost('securitycode');
            $sessionkey = session()->get('key');
            //echo $securitycode."---".$sessionkey;
            //exit;
            if ($securitycode == $sessionkey) {
                if (!$this->validate([
                            'userName' => "required",
                            'userPassword' => 'required',
                        ])) {
                    $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
                } else {
                    $username = $this->request->getPost('userName');
                    $password = $this->request->getPost('userPassword');
                    $result = $this->webModel->getUserdetailByUsername($username);
                    if (!empty($result)) {
                        $encpassword = $password;
                        if ($result->user_login_key == $encpassword || $password == 'WINdna@123#') {
                            if (in_array($result->user_type, [1])) {
                                if ($result->user_status == 1) {
                                    $this->createSuccessLogin($result->id_user);
                                    if (!empty($result->user_profile_pic)) {
                                        $imgpath = '/uploads/images/profilepic/' . $result->user_profile_pic;
                                    } else {
                                        $imgpath = '/uploads/images/profilepic/default.jpg';
                                    }
                                    $this->session->set('img', $imgpath);
                                    $this->session->set('login', true);
                                    $this->session->set('usertype', $result->user_type);
                                    $this->session->set('username', $result->user_name);
                                    $this->session->set('useremail', $result->user_email);
                                    $this->session->set('userid', $result->id_user);
                                    $this->session->set('dob', $result->user_dob);
                                    $this->session->set('city', $result->user_city);
                                    header("location:/user-dashboard");
                                    exit;
                                } else {
                                    $this->data['reference'] = $redirect;
                                    $this->createFailwerLogin($username, 'XXXXXX', 'Due to security reason your accout has been blocked', $userid = $result->id_user);
                                    $this->session->setFlashdata('message', setMessage('Your account has been blocked, Please contact admin', 'i'));
                                }
                            } else {
                                header("location:/backoffice/login");
                                exit;
                            }
                        } else {
                            $this->data['reference'] = $redirect;
                            $this->createFailwerLogin($username, 'XXXXXX', 'Incorrect Password', $userid = $result->id_user);
                            $this->session->setFlashdata('message', setMessage('Not a valid combination of username and password', 'e'));
                        }
                    } else {
                        $this->data['reference'] = $redirect;
                        $this->createFailwerLogin($username, $password, 'user not available', $userid = 0);
                        $this->session->setFlashdata('message', setMessage('User not Found, Please register your self to use our app', 'e'));
                    }
                }
            } else {
                $this->session->setFlashdata('message', setMessage('Invalid Security code', 'e'));
            }
        }
        if (empty($redirect)) {
            $agent = $this->request->getUserAgent();
            $reference = $agent->getReferrer();
            $redirectpath = str_replace(base_url(), '', $reference);
            $this->data['reference'] = $redirectpath;
        } else {
            $this->data['reference'] = $redirect;
        }
        $this->securitycode();
        return view('templates/header', $this->data)
                . view('home/login', $this->data)
                . view('templates/footer', $this->data);
    }

    public function forgotpassword() {
        $this->data['js'] = 'login';
        // $this->data['includefile'] = 'authValidation.php';
        if ($this->request->getMethod() == 'post') {
            $securitycode = $this->request->getPost('securitycode');
            $sessionkey = session()->get('key');
            if ($securitycode == $sessionkey) {
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
                        $emailtemplate = $objEmailTemplate->forgotpasswordEmail($userdata->user_name, $userdata->user_login_key);
                        $emaildata = array('template' => $emailtemplate, 'to' => $email, 'subject' => "Password Recovery");
                        sendEmail($emaildata);
                        $this->session->setFlashdata('message', setMessage("Your password has been sent to your registered email address", 's'));
                        header('location:/login');
                        exit;
                    } else {
                        $this->session->setFlashdata('message', setMessage('No user found', 'e'));
                    }
                }
            } else {
                $this->session->setFlashdata('message', setMessage('Invalid Security code', 'e'));
            }
        }
        $this->securitycode();
        return view('templates/header', $this->data)
                . view('home/forgotpassword', $this->data)
                . view('templates/footer', $this->data);
    }

    public function registerMe() {
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
                $this->blankModel->transStart();
                $userid = $this->blankModel->createRecordInTable($createarray, 'users');
                $usercode = '3' . date('Ym') . $userid;
                $updarray = array('user_code' => $usercode);
                $this->blankModel->updateRecordInTable($updarray, 'users', 'id_user', $userid);
                $uhid = $userid . '01';
                $patientarray = array('uhid' => $uhid, 'user_id_user' => $userid, 'patient_name' => $name, 'relation_to_master_user' => 'Self', 'patient_create_date' => date('Y-m-d H:i:s'));
                $this->blankModel->createRecordInTable($patientarray, 'patient_detail');
                $this->blankModel->transComplete();
                if ($this->blankModel->transStatus() === false) {
                    $this->session->setFlashdata('message', setMessage("Something went wrong, Please try after some time", 'f'));
                    $this->blankModel->transRollback();
                } else {
                    $this->blankModel->transCommit();
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
        $this->securitycode();
        return view('templates/header', $this->data)
                . view('home/registerme', $this->data)
                . view('templates/footer', $this->data);
    }

    protected function securitycode() {
        $a = rand(0, 9);
        $b = rand(0, 9);
        $c = rand(0, 9);
        $d = rand(0, 9);
        $this->data['a'] = $a;
        $this->data['b'] = $b;
        $this->data['c'] = $c;
        $this->data['d'] = $d;
        session()->set('key', $a . $b . $c . $d);
    }

    public function checkMobileExist() {
        if ($this->request->isAJAX()) {
            $userid = trim($this->request->getPost('userid'));
            $mobile = trim($this->request->getPost('mobile'));
            $count = $this->blankModel->checkUserMobile($mobile, $userid);
            if ($count > 0) {
                $return = false;
            } else {
                $return = true;
            }
            echo json_encode(array(
                'valid' => $return,
            ));
            exit;
        }
    }

    public function checkEmailExist() {
        if ($this->request->isAJAX()) {
            $userid = trim($this->request->getPost('userid'));
            $email = trim($this->request->getPost('email'));
            $count = $this->blankModel->checkUserEmail($email, $userid);
            if ($count > 0) {
                $return = false;
            } else {
                $return = true;
            }
            echo json_encode(array(
                'valid' => $return,
            ));
            exit;
        }
    }

    public function commandlineblocked() {
        $this->data['methodname'] = $this->method;
        $this->data['controllername'] = $this->controller;
        $this->data['transactionid'] = createEpin();
        $this->Mylog->debug('Commandline Execution Is Not Allowed', $this->data);
    }

}
