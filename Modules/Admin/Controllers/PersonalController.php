<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use App\Libraries;

//use Modules\Admin\Models\AdminModel;

class PersonalController extends AdminController {

    public function __construct() {
        parent::__construct();
        //$this->webModel = new WebModel();
    }

    public function index() {       
               
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\personal\index', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function changepassword() {
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
                    $data = $this->adminModel->getTableData('user_login_key,user_email', 'users', 'id_user=' . session()->get('userid'));
                    if ($data->user_login_key == $oldpassword) {
                        $updatearray = array('user_login_key' => $newpassword, 'user_last_update' => date('Y-m-d H:i:s'));
                        $this->adminModel->updateRecordInTable($updatearray, 'users', 'id_user', $this->session->get('userid'));
                        //--------create email-------
                        $objEmailTemplate = new Libraries\EmailTemplate();
                        $template = $objEmailTemplate->changePasswordEmail($this->session->get('username'));
                        $createarray = array('smtp_email_content' => $template, 'smtp_email_type' => 'Password change Intimation ', 'smtp_sender_email' => COMMUNICATION_EMAIL, 'smtp_target_emails' => $data->user_email);
                        $this->adminModel->createRecordInTable($createarray, 'smtp_email');
                        //---------create Email
                        $this->session->setFlashdata('message', setMessage("Password changed successfully.", 's'));
                    } else {
                        $this->session->setFlashdata('message', setMessage('Old Password doesnot match', 'e'));
                    }
                } else {
                    $this->session->setFlashdata('message', setMessage('New Password and confirm password doesnot match', 'e'));
                }
            }
        }
        header('location:/admin/profile');
        exit;
    }

    public function updateProfile() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $name = $this->request->getPost('name');
            $gender = $this->request->getPost('gender');
            $dob = $this->request->getPost('dob');
            $email = $this->request->getPost('email');
            $mobile = $this->request->getPost('mobile');
            $bloodgroup = $this->request->getPost('bloodgroup');
            $address = $this->request->getPost('address');
            $city = $this->request->getPost('city');
            $state = $this->request->getPost('state');
            $pincode = $this->request->getPost('pincode');

            $updarray = array('user_name' => $name, 'user_mobile' => $mobile, 'user_email' => $email, 'user_dob' => makeDate($dob, 'Y-m-d'),
                'user_bloog_group' => $bloodgroup, 'user_address' => $address, 'user_pincode' => $pincode, 'user_district' => $city,
                'user_state' => $state, 'user_gender' => $gender);
            $success = 1;

            if ($_FILES['imagefile']['error'] != 4) {
                $validationRule = [
                    'imagefile' => [
                        'rules' => 'mime_in[imagefile,image/jpg,image/jpeg,image/png]'
                        . '|max_size[imagefile,300]',
                    ],
                ];
                if ($this->validate($validationRule)) {                    
                    $img = $this->request->getFile('imagefile');
                    if (!$img->hasMoved()) {                        
                        $filename = session()->get('userid') . '_' . $img->getRandomName();
                        $img->move('uploads/images/admins/', $filename);
                        $updarray['user_profile_pic'] = $filename;
                        $updarray['profile_pic_upload_date']=date('Y-m-d H:i:s');
                    } else {
                        
                        $success = 0;
                    }
                } else {
                    $success = 0;
                }
            } else {
                
                $success = 0;
            }

            $this->adminModel->updateRecordInTable($updarray, 'users','id_user',session()->get('userid'));
            session()->set('username',$name);
            
            //--------create email-------
            $objEmailTemplate = new Libraries\EmailTemplate();
            $template = $objEmailTemplate->profileUpdationEmail($name);
            $createarray = array('smtp_email_content' => $template, 'smtp_email_type' => 'Profile update Intimation ', 'smtp_sender_email' => COMMUNICATION_EMAIL, 'smtp_target_emails' => $email);
            $this->adminModel->createRecordInTable($createarray, 'smtp_email');
            //---------create Email
            if ($success) {
                session()->set('img',$filename);
                $status = array('status' => 'success', 'message' => 'Profile updated Successfully');
            } else {
                $status = array('status' => 'success', 'message' => 'Profile updated Successfully, but unable to upload profilepic');
            }
        }
        echo json_encode($status);
        exit;
    }

}
