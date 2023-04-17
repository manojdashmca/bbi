<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\DashboardModel;

class ConfigurationController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->dashboardModel = new DashboardModel();
    }

    public function index() {
        $this->data['js'] = 'choice';
        $this->data['css'] = 'choice';
        $this->data['includefile'] = 'configuration/index.php';
        if ($this->request->getMethod() == 'post') {
            $textdata = $radiodata = array();
            $textdata['company_name'] = trim($this->request->getPost('company_name'));
            $textdata['company_address'] = trim($this->request->getPost('company_address'));
            $textdata['comapny_state_pin'] = trim($this->request->getPost('comapny_state_pin'));
            $textdata['company_contact_email'] = trim($this->request->getPost('company_contact_email'));
            $textdata['company_website'] = trim($this->request->getPost('company_website'));
            $textdata['company_no_replay_email'] = trim($this->request->getPost('company_no_replay_email'));
            $textdata['company_phone'] = trim($this->request->getPost('company_phone'));
            $textdata['smtp_host'] = trim($this->request->getPost('smtp_host'));
            $textdata['smtp_user'] = trim($this->request->getPost('smtp_user'));
            $textdata['smtp_password'] = trim($this->request->getPost('smtp_password'));
            $textdata['smtp_port'] = trim($this->request->getPost('smtp_port'));
            $textdata['smtp_auth'] = trim($this->request->getPost('smtp_auth'));
            $textdata['session_expire_time'] = trim($this->request->getPost('session_expire_time'));
            $textdata['record_per_page'] = trim($this->request->getPost('record_per_page'));
            $textdata['otp_length'] = trim($this->request->getPost('otp_length'));
            $textdata['otp_validity'] = trim($this->request->getPost('otp_validity'));
            $textdata['default_password'] = trim($this->request->getPost('default_password'));
            $radiodata['server_status'] = trim($this->request->getPost('server_status'));
            $radiodata['server_status'] = trim($this->request->getPost('server_status'));
            $radiodata['send_sms'] = trim($this->request->getPost('send_sms'));            
            $radiodata['send_email'] = trim($this->request->getPost('send_email'));            
            $radiodata['use_default_password'] = trim($this->request->getPost('use_default_password'));            
            $radiodata['maintenance_mode'] = trim($this->request->getPost('maintenance_mode'));
            $data['text'] = $textdata;
            $data['radio'] = $radiodata;
            $newdata = json_encode($data);
            try {
                file_put_contents("./uploads/config/config.json", $newdata);
                $this->session->setFlashdata('message', setMessage("Configuration Updated Successfully", 's'));
            } catch (Exception $e) {
                $this->session->setFlashdata('message', setMessage("Unable to update configuration", 'e'));
            }
        }

        $configdata = file_get_contents("./uploads/config/config.json");
        $data = json_decode($configdata, true);
        $this->data['text'] = $data['text'];
        $this->data['radio'] = $data['radio'];
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\configuration\index', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

}
