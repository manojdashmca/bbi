<?php

namespace App\Controllers;

use App\Models\WebModel;
use App\Libraries;

class WebController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->webModel = new WebModel();
        $cntrl=explode('\\',$this->controller);
        $opencontroller=$cntrl[(sizeof($cntrl)-1)];
        //$openmethods = array('maintenanceMode', 'generatePrescriptionEmail', 'deleteSystemLogs', 'deleteEmailAttachment', 'generateInvoiceEmail', 'autocancellPendingBooking', 'sendPendingEmails', 'checkMobileExist', 'checkEmailExist', 'homepage', 'termsandcondition', 'privacypolicy', 'aboutus', 'contactus',  'login', 'logout', 'registration', 'forgotpassord', 'resetpassord');
        if ($opencontroller != 'Home') {
            if ($this->session->has('login')) {
                
            } else {
                header("location:/login");
                exit;
            }
        }
    }

    public function deleteEmailAttachment() {
        try {
            $counter = 0;
            $logdir = APPPATH . "../public/uploads/emailattachments";
            $files = array_values(array_diff(scandir($logdir), array('..', '.', 'CVS')));
            foreach ($files as $fileInfo) {
                if ($fileInfo != 'index.html') {
                    $file = $logdir . '/' . $fileInfo;
                    if (time() - filemtime($file) >= 60 * 60 * 24 * 3) {
                        $counter++;
                        unlink($file);
                    }
                }
            }
        } catch (Exception $e) {
            
        }
    }

//--------------------------
}
