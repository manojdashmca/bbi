<?php

namespace Modules\Admin\Controllers;

use App\Controllers\BaseController;
use Modules\Admin\Models\AdminModel;

require_once '../vendor/autoload.php';

use Twilio\Rest\Client;

class AdminController extends BaseController {

    public function __construct() {
        $this->data['js'] = '';
        $this->data['css'] = '';
        $this->data['includefile'] = '';
        parent::__construct();
        $openmethods = array('login', 'logout', 'forgotpassword', 'resetpassword', 'addressByPincode', 'getBankDetailByIfsc',
            'getCategoryBySegment', 'getSubCategoryByCategoryModule', 'checkpan', 'checkmobile', 'checkmobile', 'checkemail',
            'getSponsorDetailById', 'getModuleDetailById', 'deleteSystemLogs', 'createPayoutDate', 'updateSyncStatus',
            'confirmTransaction', 'generatePayout', 'updateGrossIncome', 'sendPendingEmails', 'deleteEmailAttachment');
        if (!in_array($this->method, $openmethods)) {
            if ($this->session->has('login')) {
                if ($this->session->get('usertype') != 4) {
                    $this->session->setFlashdata('message', setMessage('You are not authorised to access this section', 'e'));
                    header("location:login");
                    exit;
                }
            } else {
                //$this->session->setFlashdata('message', setMessage('To Access the portal Please login', 'e'));
                header("location:/backoffice/login");
                exit;
            }
        }
        $this->adminModel = new AdminModel();
        $controller = $this->data['controllername'];
        $ctroller = explode('\\', $controller);
        $this->data['controllername'] = $ctroller[(count($ctroller) - 1)];
    }

    public function checkAccessControll($id, $type = 'c', $return = 1) {
        $sessionmodules = session()->get('accessmodules');
        $sessioncontroll = session()->get('accesscontrols');
        $error = false;
        if ($type == 'c') {
            if (!in_array($id, $sessioncontroll)) {
                $error = true;
            }
        }
        if ($type == 'm') {
            if (!in_array($id, $sessionmodules)) {
                $error = true;
            }
        }
        if ($return && $error) {
            header("location:" . ADMINPATH . "un-authorised");
            exit;
        } if (!$return && $error) {
            echo json_encode(array("status" => "error", "message" => "You are not authorised to perform this task"));
            exit;
        }
    }

    public function unAuthorisedAccess() {
        return view('\Modules\Admin\Views\auth\401');
    }

}
