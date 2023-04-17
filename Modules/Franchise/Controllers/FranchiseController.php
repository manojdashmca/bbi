<?php

namespace Modules\Franchise\Controllers;

use App\Controllers\BaseController;
use Modules\Franchise\Models\FranchiseModel;
use App\Libraries;

class FranchiseController extends BaseController {

    public function __construct() {
        //echo "Manoj";exit;
        parent::__construct();
        $openmethods = array('', 'index');
        $this->data['js'] = 'stickyleft';
        if (!in_array($this->method, $openmethods)) {
            if ($this->session->has('login')) {
                if ($this->session->get('usertype') != 2) {
                    $this->session->setFlashdata('message', setMessage('You are not authorised to access this section', 'e'));
                    header("location:/login");
                    exit;
                }
            } else {
                //$this->session->setFlashdata('message', setMessage('To Access the portal Please login', 'e'));
                header("location:/outlet/login");
                exit;
            }
        }
        $this->franchiseModel = new FranchiseModel();
    }

    public function index() {
        return view('\Modules\Admin\Views\auth\headerauth')
                . view('\Modules\Admin\Views\auth\login')
                . view('\Modules\Admin\Views\auth\footerauth');
    }

    public function changepassword() {
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
                        $createarray = array('smtp_email_content' => $template, 'smtp_email_type' => 'Password change Intimation ', 'smtp_sender_email' => COMMUNICATION_EMAIL, 'smtp_target_emails' => $data->user_email);
                        $this->blankModel->createRecordInTable($createarray, 'smtp_email');
                        //---------create Email
                        $this->session->setFlashdata('message', setMessage("Password changed successfully.", 's'));
                        header('location:/doctor/change-password');
                        exit;
                    } else {
                        $this->session->setFlashdata('message', setMessage('Old Password doesnot match', 'e'));
                    }
                } else {
                    $this->session->setFlashdata('message', setMessage('New Password and confirm password doesnot match', 'e'));
                }
            }
        }
        return view('\Modules\Doctor\Views\templates\d_header', $this->data)
                . view('\Modules\Doctor\Views\changepassword', $this->data)
                . view('\Modules\Doctor\Views\templates\d_footer', $this->data);
    }

}
