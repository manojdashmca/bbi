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
        $openmethods = array('login', 'logout', 'test', 'forgotpassword', 'resetpassword','addressByPincode','getBankDetailByIfsc',
            'getCategoryBySegment','getSubCategoryByCategoryModule','checkpan','checkmobile','checkmobile','checkemail',
            'getSponsorDetailById','getModuleDetailById','deleteSystemLogs','createPayoutDate','updateSyncStatus',
            'confirmTransaction','generatePayout','updateGrossIncome','sendPendingEmails','deleteEmailAttachment');
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

    public function index() {
        echo "<br/>" . base_url();
        echo "<br/>" . ROOTPATH;
        echo "<br/>" . SYSTEMPATH;
        echo "<br/>" . APPPATH;
        exit;
        // echo "This is simple from Student Module";
        $users = $this->adminModel->getUsers();
        $this->aesObj->setData('ManojDash');
        echo "<br/>" . $token = $this->aesObj->encrypt();
        $this->aesObj->setData($token);
        echo "<br/>" . $this->aesObj->decrypt();

        $this->data['methodname'] = $this->method;
        $this->data['controllername'] = $this->controller;
        $this->data['transactionid'] = createEpin();
        $this->Mylog->debug('function executed successfully', $this->data);
        echo "<pre>";
        print_r($users);
        exit;
        $data = ["name" => "Sanjay", "email" => "sanjay_kumar@gmail.com"];

        return view("\Modules\Admin\Views\admin_index", $data);
    }

    public function test() {
        $sid = 'AC094df811916b42a7c48b461599307276';
        $token = '37d1d74e2b363b66004457d2bcdc532a';
        $twilio = new Client($sid, $token);
        $message = $twilio->messages
                ->create("whatsapp:+918722040200", // to
                [
                    "from" => "whatsapp:+14155238886",
                    "body" => "Hi, Joe! Thanks for placing an order with us. We’ll let you know once your order has been processed and delivered. Your order number is O12235234"
                ]
        );

        print($message->sid);
    }

    public function form() {
        $this->data['js'] = 'form';
        $this->data['css'] = 'form';
        $this->data['includefile'] = '';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\sample\form', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function table() {
        $this->data['js'] = 'datatable,sweetalert,alertify';
        $this->data['css'] = 'datatable,sweetalert,alertify';
        $this->data['includefile'] = 'filter.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\sample\datatable', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function chart() {
        $this->data['js'] = 'dashboard';
        $this->data['css'] = 'dashboard';
        $this->data['includefile'] = '';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\sample\chart', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    

}
