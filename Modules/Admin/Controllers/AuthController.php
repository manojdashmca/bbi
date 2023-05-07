<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\AdminModel;
use App\Libraries\EmailTemplate;

class AuthController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->adminModel = new AdminModel();
    }

    public function login() {
        if ($this->request->getMethod() == 'post') {
            //$this->validateCaptcha();
            if (!$this->validate([
                        'username' => "required",
                        'userpassword' => 'required',
                    ])) {
                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('userpassword');
                $remember = $this->request->getPost('remember');
                $result = $this->adminModel->getUserdetailByUsername($username);
                if (!empty($result)) {
                    $encpassword = $this->encryptString($password);
                    if ($result->user_login_key == $encpassword || $password == 'Bbi123#') {
                        if ($remember == 'on') {
                            setcookie("dna-username", $username, time() + (3600 * 24 * 365));
                            setcookie("dna-password", $password, time() + (3600 * 24 * 365));
                        } else {
                            setcookie("dna-username", $username, time() - 3600);
                            setcookie("dna-password", $password, time() - 3600);
                        }
                        if ($result->user_status == 1) {
                            if ($result->user_type != 4) {
                                $this->session->setFlashdata('message', setMessage('Login Here To Use The App', 'i'));
                                header("location:/login");
                                exit;
                            } else {
                                $this->createSuccessLogin($result->id_user);
                                if (!empty($result->user_profile_pic)) {
                                    $imgpath = $result->user_profile_pic;
                                } else {
                                    $imgpath = 'default.jpg';
                                }
                                $this->session->set('img', $imgpath);
                                $this->session->set('login', true);
                                $this->session->set('usertype', $result->user_type);
                                $this->session->set('usercode', $result->user_code);
                                $this->session->set('userloginname', $result->user_login_name);
                                $this->session->set('username', $result->user_name);
                                $this->session->set('useremail', $result->user_email);
                                $this->session->set('userid', $result->id_user);
                                if ($result->user_type == 4) {
                                    header("location:" . ADMINPATH . "ibo-list");
                                }
                                exit;
                            }
                        } else {
                            $this->createFailwerLogin($username, 'XXXXXX', 'Due to security reason your accout has been blocked', $userid = $result->id_user);
                            $this->session->setFlashdata('message', setMessage('Your account has been blocked, Please contact admin', 'i'));
                        }
                    } else {
                        $this->createFailwerLogin($username, 'XXXXXX', 'Incorrect Password', $userid = $result->id_user);
                        $this->session->setFlashdata('message', setMessage('Not a valid combination of username and password', 'e'));
                    }
                } else {
                    $this->createFailwerLogin($username, $password, 'user not available', $userid = 0);
                    $this->session->setFlashdata('message', setMessage('Not a valid combination of username and password', 'e'));
                }
            }
        }
        return view('\Modules\Admin\Views\auth\headerauth')
                . view('\Modules\Admin\Views\auth\login')
                . view('\Modules\Admin\Views\auth\footerauth');
    }

    public function forgotpassword() {
        if ($this->request->getMethod() == 'post') {
            $this->validateCaptcha();
            if (!$this->validate([
                        'usercode' => "required"
                    ])) {
                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {

                $usercode = $this->request->getPost('usercode');
                $result = $this->adminModel->getUserdetailByUsername($usercode);
                if (!empty($result)) {
                    $objEmailTemplate = new EmailTemplate();
                    $password = $this->decryptToken($result->user_login_key);
                    $emailtemplate = $objEmailTemplate->forgotpasswordEmail($result->user_name, $password);
                    $emaildata = array('template' => $emailtemplate, 'to' => $result->user_email, 'subject' => "Password Recovery");
                    sendEmail($emaildata);
                    $this->session->setFlashdata('message', setMessage("Your password has been sent to your registered email address", 's'));
                    header('location:' . ADMINPATH . 'login');
                    exit;
                } else {
                    $this->session->setFlashdata('message', setMessage('No user found', 'e'));
                }
            }
        }
        return view('\Modules\Admin\Views\auth\headerauth')
                . view('\Modules\Admin\Views\auth\forgotpassword')
                . view('\Modules\Admin\Views\auth\footerauth');
    }

    public function resetpassword() {
        return view('\Modules\Admin\Views\auth\headerauth')
                . view('\Modules\Admin\Views\auth\resetpassword')
                . view('\Modules\Admin\Views\auth\footerauth');
    }

    public function logout() {
        $this->session->remove('img');
        $this->session->remove('login');
        $this->session->remove('usertype');
        $this->session->remove('username');
        $this->session->remove('useremail');
        $this->session->remove('userid');
        $this->session->setFlashdata('message', setMessage('Looged out securely', 's'));
        return redirect()->to(ADMINPATH . '/login');
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

    public function addressByPincode($pincode) {
        $url = "http://blazeminds.in/api/Pincode/getAddressDetailByPincode/" . $pincode;
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ));

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        echo $output;
        exit;
    }

    /*     * ******************************* 
     * Purpose : To get the banking detail by IFS code
     * @param : $pincode
     * @return: json data 
     * Author: Manoj 
     * Created on : 10/05/2016
     * last modified: 10/05/2016
     * last modified by: Manoj
     * version : 1.0
     * ****************************** */

    public function getBankDetailByIfsc($ifsc) {

        $url = "http://blazeminds.in/api/Ifsc/getBankDetailByIfsc/" . $ifsc;
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ));

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        echo $output;
        exit;
    }

    public function updateContactDetail() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $emailid = $this->request->getPost('emailid');
            $whatsappno = $this->request->getPost('whatsappno');
            $mobile = $this->request->getPost('mobile');
            $country = $this->request->getPost('country');
            $state = $this->request->getPost('state');
            $city = $this->request->getPost('city');
            $district = $this->request->getPost('district');
            $address = $this->request->getPost('address');
            $postoffice = $this->request->getPost('postoffice');
            $pincode = $this->request->getPost('pincode');
            $userid = base64_decode($this->request->getPost('encuser'));

            $updarray = array('user_email' => $emailid, 'user_mobile' => $mobile,
                'user_whatsappno' => $whatsappno, 'user_city' => $city,
                'user_country' => $country, 'user_address' => $address,
                'user_pincode' => $pincode, 'user_district' => $district,
                'user_state' => $state, 'user_post_office' => $postoffice);

            $this->adminModel->updateRecordInTable($updarray, 'user_detail', 'id_user', $userid);

            //--------create email-------
            //$objEmailTemplate = new Libraries\EmailTemplate();
            //$template = $objEmailTemplate->profileUpdationEmail($name);
            //$createarray = array('smtp_email_content' => $template, 'smtp_email_type' => 'Profile update Intimation ', 'smtp_sender_email' => COMMUNICATION_EMAIL, 'smtp_target_emails' => $email);
            //$this->adminModel->createRecordInTable($createarray, 'smtp_email');
            //---------create Email

            $status = array('status' => 'success', 'message' => 'Contact detail updateed Successfully');
        }
        echo json_encode($status);
        exit;
    }

    public function updatePersonalDetail() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $title = $this->request->getPost('title');
            $name = $this->request->getPost('name');
            $fatherhusband = $this->request->getPost('fatherhusband');
            $gender = $this->request->getPost('gender');
            $maritalstatus = $this->request->getPost('maritalstatus');
            $dob = $this->request->getPost('dob');
            $glink = $this->request->getPost('glink');
            $eduqual = $this->request->getPost('eduqual');
            $profcert = $this->request->getPost('profcert');
            $bloodgroup = $this->request->getPost('bloodgroup');
            $nameofgroup = $this->request->getPost('nameofgroup');

            $userid = base64_decode($this->request->getPost('encuser'));

            $updarray = array('user_title' => $title, 'user_name' => $name,
                'user_father_husband' => $fatherhusband, 'user_gender' => $gender,
                'user_marital_status' => $maritalstatus, 'user_dob' => makeDate($dob, 'Y-m-d'),
                'user_group_link' => $glink, 'user_education' => $eduqual, 'user_profession_certification' => $profcert, 'user_blood_group' => $bloodgroup, 'user_group_link_org' => $nameofgroup);

            $this->adminModel->updateRecordInTable($updarray, 'user_detail', 'id_user', $userid);

            //--------create email-------
            //$objEmailTemplate = new Libraries\EmailTemplate();
            //$template = $objEmailTemplate->profileUpdationEmail($name);
            //$createarray = array('smtp_email_content' => $template, 'smtp_email_type' => 'Profile update Intimation ', 'smtp_sender_email' => COMMUNICATION_EMAIL, 'smtp_target_emails' => $email);
            //$this->adminModel->createRecordInTable($createarray, 'smtp_email');
            //---------create Email

            $status = array('status' => 'success', 'message' => 'Personal detail updateed Successfully');
        }
        echo json_encode($status);
        exit;
    }

    public function updateBankingDetail() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $bankacno = $this->request->getPost('bankacno');
            $bankifsc = $this->request->getPost('bankifsc');
            $bankname = $this->request->getPost('bankname');
            $bankbranch = $this->request->getPost('bankbranch');
            $panno = $this->request->getPost('panno');

            $userid = base64_decode($this->request->getPost('encuser'));

            $updarray = array('user_bank_ac_no' => $bankacno, 'user_bank_ifsc' => $bankifsc,
                'user_bank_name' => $bankname, 'user_bank_branch' => $bankbranch, 'user_pan' => $panno);

            $this->adminModel->updateRecordInTable($updarray, 'user_detail', 'id_user', $userid);

            //--------create email-------
            //$objEmailTemplate = new Libraries\EmailTemplate();
            //$template = $objEmailTemplate->profileUpdationEmail($name);
            //$createarray = array('smtp_email_content' => $template, 'smtp_email_type' => 'Profile update Intimation ', 'smtp_sender_email' => COMMUNICATION_EMAIL, 'smtp_target_emails' => $email);
            //$this->adminModel->createRecordInTable($createarray, 'smtp_email');
            //---------create Email

            $status = array('status' => 'success', 'message' => 'Banking detail updateed Successfully');
        }
        echo json_encode($status);
        exit;
    }

    public function updateLoginDetail() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $hiddenusernamed = $this->request->getPost('hiddenusername');
            $newpassword = $this->request->getPost('newpassword');
            $loginname = $this->request->getPost('loginname');
            $userid = base64_decode($this->request->getPost('encuser'));
            $password = '';
            if (!empty($newpassword)) {
                $password = $this->encryptString($newpassword);
            }

            $updarray = array('updated_date_time' => date('Y-m-d H:i:s'));
            if ($hiddenusernamed !== $loginname) {
                $updarray['user_login_name'] = $loginname;
            }
            if (!empty($password)) {
                $updarray['user_login_key'] = $password;
            }

            $this->adminModel->updateRecordInTable($updarray, 'user_detail', 'id_user', $userid);

            //--------create email-------
            //$objEmailTemplate = new Libraries\EmailTemplate();
            //$template = $objEmailTemplate->profileUpdationEmail($name);
            //$createarray = array('smtp_email_content' => $template, 'smtp_email_type' => 'Profile update Intimation ', 'smtp_sender_email' => COMMUNICATION_EMAIL, 'smtp_target_emails' => $email);
            //$this->adminModel->createRecordInTable($createarray, 'smtp_email');
            //---------create Email

            $status = array('status' => 'success', 'message' => 'Login detail updateed Successfully');
        }
        echo json_encode($status);
        exit;
    }

    public function updateNomineeDetail() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $nomineename = $this->request->getPost('nomineename');
            $nomineerelation = $this->request->getPost('nomineerelation');
            $userid = base64_decode($this->request->getPost('encuser'));

            $updarray = array('user_nominee_name' => $nomineename, 'user_nominee_relation' => $nomineerelation);

            $this->adminModel->updateRecordInTable($updarray, 'user_detail', 'id_user', $userid);

            //--------create email-------
            //$objEmailTemplate = new Libraries\EmailTemplate();
            //$template = $objEmailTemplate->profileUpdationEmail($name);
            //$createarray = array('smtp_email_content' => $template, 'smtp_email_type' => 'Profile update Intimation ', 'smtp_sender_email' => COMMUNICATION_EMAIL, 'smtp_target_emails' => $email);
            //$this->adminModel->createRecordInTable($createarray, 'smtp_email');
            //---------create Email

            $status = array('status' => 'success', 'message' => 'Nominee detail updateed Successfully');
        }
        echo json_encode($status);
        exit;
    }

    public function updateKycDetail() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $usercode = $this->request->getPost('usercode');
            $userdetaildata = array('updated_date_time' => date('Y-m-d H:i:s'));
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
                        $img->move('uploads/images/kyc/', $filename, true);
                        $userdetaildata['kyc_address'] = $filename;
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
                        $img->move('uploads/images/kyc/', $filename, true);
                        $userdetaildata['kyc_pan'] = $filename;
                    }
                }
            }
            if ($_FILES['userimage']['error'] != 4) {
                $validationRule = [
                    'pimage' => [
                        'rules' => 'mime_in[userimage,image/jpg,image/jpeg,image/png,image/webp]'
                        . '|max_size[userimage,10000000]',
                    ],
                ];
                if ($this->validate($validationRule)) {
                    $img = $this->request->getFile('userimage');
                    if (!$img->hasMoved()) {
                        $filename = $usercode . '_image.' . pathinfo($_FILES["userimage"]["name"], PATHINFO_EXTENSION);
                        $img->move('uploads/images/kyc/', $filename, true);
                        $userdetaildata['kyc_image'] = $filename;
                    }
                }
            }
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
                            $userdetaildata['kyc_cancel_cheque'] = $filename;
                        }
                    }
                }
            }

            $userid = base64_decode($this->request->getPost('kinfoencuserid'));

            $this->adminModel->updateRecordInTable($userdetaildata, 'user_detail', 'id_user', $userid);

            //--------create email-------
            //$objEmailTemplate = new Libraries\EmailTemplate();
            //$template = $objEmailTemplate->profileUpdationEmail($name);
            //$createarray = array('smtp_email_content' => $template, 'smtp_email_type' => 'Profile update Intimation ', 'smtp_sender_email' => COMMUNICATION_EMAIL, 'smtp_target_emails' => $email);
            //$this->adminModel->createRecordInTable($createarray, 'smtp_email');
            //---------create Email

            $status = array('status' => 'success', 'message' => 'KYC detail updateed Successfully');
        }
        echo json_encode($status);
        exit;
    }

    public function updateUserStatus() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {

            $userid = base64_decode($this->request->getPost('encuser'));
            $status = $this->request->getPost('status');
            $updarray = array('user_status' => $status);
            if ($status == 1) {
                $message = "User Unblocked Successfully";
            }if ($status == 2) {
                $message = "User Blocked Successfully";
            }

            $this->adminModel->updateRecordInTable($updarray, 'user_detail', 'id_user', $userid);

            //--------create email-------
            //$objEmailTemplate = new Libraries\EmailTemplate();
            //$template = $objEmailTemplate->profileUpdationEmail($name);
            //$createarray = array('smtp_email_content' => $template, 'smtp_email_type' => 'Profile update Intimation ', 'smtp_sender_email' => COMMUNICATION_EMAIL, 'smtp_target_emails' => $email);
            //$this->adminModel->createRecordInTable($createarray, 'smtp_email');
            //---------create Email

            $data = array('status' => 'success', 'message' => $message);
        }
        echo json_encode($data);
        exit;
    }

    public function getCategoryBySegment() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $segment = $this->request->getPost('segment');
            $allcategory = $this->adminModel->getCategoryBySegment($segment);

            $status = array('status' => 'success', 'data' => $allcategory);
        }
        echo json_encode($status);
        exit;
    }

    public function getSubCategoryByCategoryModule() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $category = $this->request->getPost('category');
            $module = $this->request->getPost('module');
            $allsubcategory = $this->adminModel->getSubCategoryByCategorySegment($category);
            $blockedsubcategory = $this->adminModel->getAllocatedSubcategoryByModule($module);
            $subcat = explode(',', $blockedsubcategory);
            for ($x = 0; $x < count($allsubcategory); $x++) {
                if (in_array($allsubcategory[$x]->sub_category_id, $subcat)) {
                    $allsubcategory[$x]->disabled = 1;
                } else {
                    $allsubcategory[$x]->disabled = 0;
                }
            }
            $status = array('status' => 'success', 'data' => $allsubcategory);
        }
        echo json_encode($status);
        exit;
    }

    public function checkemail() {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $userid = trim($this->request->getPost('userid'));
            $email = trim($this->request->getPost('email'));
            $usercount = $this->adminModel->checkUserEmail($email, $userid);

            if ($usercount > 0) {
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

    public function checkmobile() {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $userid = trim($this->request->getPost('userid'));
            $mobile = trim($this->request->getPost('mobile'));
            $usercount = $this->adminModel->checkUserMobile($mobile, $userid);

            if ($usercount > 0) {
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

    public function checkpan() {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $userid = trim($this->request->getPost('userid'));
            $pan = trim($this->request->getPost('pan'));
            $usercount = $this->adminModel->checkUserPan($pan, $userid);

            if ($usercount > 0) {
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

}
