<?php

namespace App\Controllers;

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use App\Libraries;

class UserController extends WebController {

    public function __construct() {
        parent::__construct();
        $this->keyId = 'rzp_test_rZSAbrBcnr1KG7';
        $this->keySecret = 'VJNd6lTlPZ3VVJzdWgytFr8s';
    }

//----------------------website methods--------------------------
//    public function resetpassord() {
//        $this->data['js'] = 'login';
//        $this->data['includefile'] = 'authValidation.php';
//        if ($this->request->getMethod() == 'post') {
//            $this->validateCaptcha();
//        }
//        $this->data['js'] = 'login';
//        return view('templates/header', $this->data)
//                . view('home/resetpassord', $this->data)
//                . view('templates/footer', $this->data);
//    }



    public function dashboard() {
        $this->data['js'] = '';        
        $this->data['includefile'] =''; 
        return view('templates/header', $this->data)
                . view('users/dashboard_wbo', $this->data)
                . view('templates/footer', $this->data);
    }

    public function profile() {
        $this->data['js'] = 'patientprofile';
        $this->data['css'] = 'patientprofile';
        $this->data['includefile'] = 'userValidation.php';
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                        'name' => 'required',
                        'email' => 'required',
                        'mobile' => 'required',
                        'dob' => 'required',
                        'gender' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {

                $name = $this->request->getPost('name');
                $mobile = $this->request->getPost('mobile');
                $email = $this->request->getPost('email');
                $dob = $this->request->getPost('dob');
                $gender = $this->request->getPost('gender');
                $bloodgroup = $this->request->getPost('bloodgroup');
                $address = $this->request->getPost('address');
                $city = $this->request->getPost('city');
                $state = $this->request->getPost('state');
                $zip = $this->request->getPost('zip');

                $updatearray = array('user_name' => $name,
                    'user_email' => $email,
                    'user_mobile' => $mobile,
                    'user_dob' => makeDate($dob, 'Y-m-d'),
                    'user_gender' => $gender,
                    'user_address' => $address,
                    'user_district' => $city,
                    'user_state' => $state,
                    'user_bloog_group' => $bloodgroup,
                    'user_pincode' => $zip,
                    'user_last_update' => date('Y-m-d H:i:s'));
                $this->session->set('dob', $dob);
                $this->session->set('city', $city);
                $this->session->set('state', $state);
                $this->session->set('username', $name);
                $this->session->set('useremail', $email);
                $error = 0;
                if ($_FILES['userfile']['error'] != 4) {
                    $validationRule = [
                        'userfile' => [
                            'rules' => 'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                            . '|max_size[userfile,100]',
                        ],
                    ];
                    if ($this->validate($validationRule)) {
                        $img = $this->request->getFile('userfile');
                        if (!$img->hasMoved()) {
                            $filename = $this->session->get('userid') . '_' . $img->getRandomName();
                            $img->move('uploads/images/patients/', $filename);
                            $updatearray['user_profile_pic'] = $filename;
                            $updatearray['profile_pic_upload_date'] = date('Y-m-d H:i:s');
                            $this->session->set('img', CUSTOMPATH . 'uploads/images/patients/' . $filename);
                        }
                    } else {
                        $error = 1;
                    }
                }
                $this->blankModel->updateRecordInTable($updatearray, 'users', 'id_user', $this->session->get('userid'));
                $this->webModel->updateSelfData($name, $gender, makeDate($dob, 'Y-m-d'), $this->session->get('userid'));
                //--------create email-------
                $objEmailTemplate = new Libraries\EmailTemplate();
                $template = $objEmailTemplate->profileUpdationEmail($this->session->get('username'));
                $createarray = array('smtp_email_content' => $template, 'smtp_email_type' => 'Profile Updation Intimation ', 'smtp_sender_email' => NOREPLAY_EMAIL, 'smtp_target_emails' => $email);
                $this->webModel->createRecordInTable($createarray, 'smtp_email');
                //---------create Email
                if ($error) {
                    $this->session->setFlashdata('message', setMessage("Unable to upload image (" . $this->validator->getErrors()['userfile'] . "), But Profile Data Updated Successfully.", 'i'));
                } else {
                    $this->session->setFlashdata('message', setMessage("Profile Data Updated Successfully.", 's'));
                }
                header('location:/user-profile');
                exit;
            }
        }
        $userprofile = $this->webModel->getUserProfile($this->session->get('userid'));
        $this->data['userprofile'] = $userprofile;

        return view('templates/header', $this->data)
                . view('users/profile', $this->data)
                . view('templates/footer', $this->data);
    }

    public function changepassword() {
        $this->data['js'] = 'stickyleft';
        $this->data['includefile'] = 'userValidation.php';
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
                    $data = $this->blankModel->getTableData('user_login_key,user_email', 'users', 'id_user=' . $this->session->get('userid'));
                    if ($data->user_login_key == $oldpassword) {
                        $updatearray = array('user_login_key' => $newpassword, 'user_last_update' => date('Y-m-d H:i:s'));
                        $this->blankModel->updateRecordInTable($updatearray, 'users', 'id_user', $this->session->get('userid'));
                        //--------create email-------
                        $objEmailTemplate = new Libraries\EmailTemplate();
                        $template = $objEmailTemplate->changePasswordEmail($this->session->get('username'));
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

    public function logout() {
        $this->session->remove('img');
        $this->session->remove('login');
        $this->session->remove('usertype');
        $this->session->remove('username');
        $this->session->remove('useremail');
        $this->session->remove('userid');
        $this->session->remove('dob');
        $this->session->remove('city');
        $this->session->remove('state');
        $this->session->remove('rescheduleid');
        $this->session->remove('rescheduledocid');
        $this->session->remove('edu');
        $this->session->remove('speciality');
        header('location:/logout');
        exit;
    }

   
//-----------------helper function section--------------
    protected function rozerpayCheckout($paymentamount, $orderno) {
        $userprofile = $this->webModel->getUserProfile($this->session->get('userid'));

        $api = new Api($this->keyId, $this->keySecret);
        $orderData = [
            'receipt' => $orderno,
            'amount' => $paymentamount * 100, // 2000 rupees in paise
            'currency' => 'INR',
            'payment_capture' => 1 // auto capture
        ];

        $razorpayOrder = $api->order->create($orderData);
        $razorpayOrderId = $razorpayOrder['id'];
        $amount = $orderData['amount'];
        $data = [
            "key" => $this->keyId,
            "amount" => $amount,
            "name" => "Medserve",
            "description" => "",
            "image" => CUSTOMPATH . "assets/img/pg_logo.PNG",
            "prefill" => [
                "name" => $userprofile->user_name,
                "email" => $userprofile->user_email,
                "contact" => $userprofile->user_mobile,
            ],
            "notes" => [
                "address" => "",
                "merchant_order_id" => $orderno,
            ],
            "theme" => [
                "color" => "#F37254"
            ],
            "order_id" => $razorpayOrderId,
        ];

        $this->data['rz_data'] = $data;
        $this->session->set('rzp_orderid', $razorpayOrderId);
    }

}
