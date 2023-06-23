<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\CronModel;

class CronController extends AdminController {

    public function __construct() {
        set_time_limit(0);
        parent::__construct();
        $this->cronModel = new CronModel();
    }

    protected function createCron($module, $type, $comment = '') {
        $createarray = array('cron_module' => $module, 'insert_type' => $type, 'cron_comment' => $comment);
        $this->cronModel->createRecordInTable($createarray, 'cron_table');
    }

    /*     * ****************************** Jobs Detail 
     * 1-Send Pending Emails available in the email table
     * Class- Cron
     * Method-  sendPendingEmails
     * curl --silent https://www.sskbbi.co.in/send-pending-emails
     * Frequency- Every Minute
     */

    public function sendPendingEmails() {
        $queuedemail = $this->cronModel->getQueuedEmail(5);
        foreach ($queuedemail as $email) {
            $emaildata = array('template' => $email->smtp_email_content, 'to' => $email->smtp_target_emails, 'subject' => $email->smtp_email_type);
            (!empty($email->smtp_attachment)) ? $emaildata['attachment'][] = __DIR__ . '/../../public/uploads/emailattachments/' . $email->smtp_attachment : '';
            $status = sendEmail($emaildata);
            if ($status) {
                $updarray = array('smtp_send_status' => 1, 'smtp_deliver_date_time' => date('Y-m-d H:i:s'));
                $this->blankModel->updateRecordInTable($updarray, 'smtp_email', 'smtp_send_id', $email->smtp_send_id);
            }
        }
    }

    /*     * ****************************** Jobs Detail 
     * 1-delete system logs which is 7 days older available in the writable/logs writable/session and writable/debug directory
     * Class- Cron
     * Method-  deleteSystemLogs
     * curl --silent https://www.sskbbi.co.in/delete-system-log
     * Frequency- Once Per Day(Mid Night 12:00 AM)
     */

    public function deleteSystemLogs() {
        try {
            $counter = 0;
            $logdir = APPPATH . "../writable/logs";
            $files = array_values(array_diff(scandir($logdir), array('..', '.', 'CVS')));
            foreach ($files as $fileInfo) {
                if ($fileInfo != 'index.html') {
                    $file = $logdir . '/' . $fileInfo;
                    if (time() - filemtime($file) >= 60 * 60 * 24 * 7) {
                        $counter++;
                        unlink($file);
                    }
                }
            }
            $logdir = APPPATH . "../writable/session";
            $files = array_values(array_diff(scandir($logdir), array('..', '.', 'CVS')));
            foreach ($files as $fileInfo) {
                if ($fileInfo != 'index.html') {
                    $file = $logdir . '/' . $fileInfo;
                    if (time() - filemtime($file) >= 60 * 60 * 24 * 2) {
                        $counter++;
                        unlink($file);
                    }
                }
            }

            $logdir = APPPATH . "../writable/debugbar";
            $files = array_values(array_diff(scandir($logdir), array('..', '.', 'CVS')));
            foreach ($files as $fileInfo) {
                if ($fileInfo != 'index.html') {
                    $file = $logdir . '/' . $fileInfo;
                    if (time() - filemtime($file) >= 60 * 60 * 24 * 1) {
                        $counter++;
                        unlink($file);
                    }
                }
            }
        } catch (Exception $e) {
            
        }
    }

    /*     * ****************************** Jobs Detail 
     * 1-delete the email attachments available in uploads/emailattachments directory
     * Class- Cron
     * Method-  deleteEmailAttachment
     * curl --silent https://www.sskbbi.co.in/delete-email-attachment
     * Frequency- Once Per Day(Mid Night 12:00 AM)
     */

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

    /*     * ****************************** Jobs Detail 
     * 1-Confirm the unconfirmed transaction
     * Class- Cron
     * Method-  confirmTransaction
     * curl --silent https://www.sskbbi.co.in/confirm-transaction
     * Frequency- Every five minutes
     */

    public function confirmTransaction() {
        try {
            $this->createCron('Confirm Transaction', 'Cron Started');
            $count = 0;
            $payoutdata = $this->cronModel->getLastPayoutId();
            $payoutid = $payoutdata->payout_date_id;
            $trndata = $this->cronModel->getNoneConfirmedTransaction();
            //----level distribution----
            $srconsultingmember = $this->cronModel->getSrConsultingMember();
            $consultingmember = $this->cronModel->getConsultingMember();
            $nationalmember = $this->cronModel->getNationalMember();
            $statemember = $this->cronModel->getStateMember();
            $zonemember = $this->cronModel->getZoneMember();
            $srcmembershare = $cmembershare = $nmembershare = $smembershare = $zmembershare = 0;
            if (!empty($srconsultingmember)) {
                $srcmembershare = floor(1000 / count($srconsultingmember));
            }
            if (!empty($consultingmember)) {
                $cmembershare = floor(1000 / count($consultingmember));
            }
            if (!empty($nationalmember)) {
                $nmembershare = floor(1000 / count($nationalmember));
            }
            if (!empty($statemember)) {
                $smembershare = floor(1000 / count($statemember));
            }
            if (!empty($zonemember)) {
                $zmembershare = floor(1000 / count($zonemember));
            }
            for ($x = 0; $x < count($trndata); $x++) {
                $trnid = $trndata[$x]->mpd_id;
                $moduledirector = $trndata[$x]->director_id;
                $moduleassodirector = $trndata[$x]->associate_director_id;
                $moduleasdirector = $trndata[$x]->assistant_director_id;
                $sponsoruser = $trndata[$x]->sponsor_user_id;

                $this->cronModel->transStart();
                if (!empty($moduledirector)) {
                    $this->createIncome($moduledirector, $payoutid, $trnid, 1, 3000);
                }if (!empty($moduleassodirector)) {
                    $this->createIncome($moduleassodirector, $payoutid, $trnid, 2, 500);
                }if (!empty($moduleasdirector)) {
                    $this->createIncome($moduleasdirector, $payoutid, $trnid, 3, 500);
                }
                $this->createIncome($sponsoruser, $payoutid, $trnid, 4, 3000);
                for ($src = 0; $src < count($srconsultingmember); $src++) {
                    $this->createIncome($srconsultingmember[$src]->user_id_user, $payoutid, $trnid, 5, $srcmembershare);
                }
                for ($c = 0; $c < count($consultingmember); $c++) {
                    $this->createIncome($consultingmember[$c]->user_id_user, $payoutid, $trnid, 6, $cmembershare);
                }
                for ($n = 0; $n < count($nationalmember); $n++) {
                    $this->createIncome($nationalmember[$n]->user_id_user, $payoutid, $trnid, 7, $nmembershare);
                }
                for ($st = 0; $st < count($statemember); $st++) {
                    $this->createIncome($statemember[$st]->user_id_user, $payoutid, $trnid, 8, $smembershare);
                }
                for ($z = 0; $z < count($zonemember); $z++) {
                    $this->createIncome($zonemember[$z]->user_id_user, $payoutid, $trnid, 9, $zmembershare);
                }
                $this->createIncome(2, $payoutid, $trnid, 10, 500);
                $invupdatearray = array("payout_status" => 1);
                $this->cronModel->updateRecordInTable($invupdatearray, 'ibo_joining_payment_detail', 'mpd_id', $trnid);

                $this->cronModel->transComplete();
                if ($this->blankModel->transStatus() === false) {
                    $this->blankModel->transRollback();
                } else {
                    $count++;
                    $this->blankModel->transCommit();
                }
            }
            $this->createCron('Confirm Transaction', 'Cron Closed', $count . " Transactions Confirmed");
        } catch (Exception $e) {
            
        }
    }

    /*
      9- Update synchstatus Activate mentainance mode
     * Class- Cron
     * Method-updateSyncStatus
     * curl --silent http://www.sskbbi.co.in/update-sync-status/$1
     * frequency- Once Per Day(Mid Night 12:30 AM)
     */

    public function updateSyncStatus($status) {
        if ($status == 0) {
            $switch = "";
            $this->createCron('De-Activate Sync Mode', 'Cron Started');
        } else {
            $switch = "on";
            $this->createCron('Activate Sync Mode', 'Cron Started');
        }
        $configdata = file_get_contents("./uploads/config/config.json");
        $data = json_decode($configdata, true);
        $data['radio']['maintenance_mode'] = $switch;
        $newdata = json_encode($data);
        file_put_contents("./uploads/config/config.json", $newdata);
        if ($status == 0) {
            $this->createCron('De-Activate Sync Mode', 'Cron Closed');
        } else {
            $this->createCron('Activate Sync Mode', 'Cron Closed');
        }
    }

    /* 11- Gererate weekly Payout
     * Class- Cron
     * Method-generateWeeklyPayout
     * curl --silent http://www.sskbbi.co.in/confirm-transaction
     * frequency- Months 1st,8th,16th,23rd(On the payoutdate at 12:05 AM)
     */

    public function generatePayout() {
        $this->createCron('Generate Payout', 'Cron Started');
        $payoutd = $this->cronModel->getLastPayoutId();
        $payoutid = $payoutd->payout_date_id;
        $payoutdata = $this->cronModel->getMemberIncomeByPayoutid($payoutid);
        $count = 0;
        for ($x = 0; $x < count($payoutdata); $x++) {
            $this->createOrUpdatePayoutRecord($payoutid, $payoutdata[$x]->user_id_user, $payoutdata[$x]->income_type, $payoutdata[$x]->amount);
            $this->cronModel->updateMemberIncomeRecord($payoutid, $payoutdata[$x]->user_id_user, $payoutdata[$x]->income_type);
            $count++;
        }

        $this->createCron('Generate Payout', 'Cron Closed', $count . " Payout Released");
    }

    public function updateGrossIncome() {
        $payoutd = $this->cronModel->getLastPayoutId();
        $payoutid = $payoutd->payout_date_id;
        $this->cronModel->updateGrossPayout($payoutid);
    }

    /*

      12- Gererate Monthly Payout date
     * Class- Cron
     * Method-createPayoutDate
     * curl --silent http://www.sskbbi.co.in/create-payout-date
     * frequency- Months 1st,8th,16th,23rd(On the payoutdate at 12:10 AM)
     *
     */

    public function createPayoutDate() {
        $type = 1;
        $this->createCron('Creating Monthly Payout Date', 'Cron Started');
        if ($type == 1) {
            $startdate = date('Y-m-01 00:00:00');
            $enddate = date('Y-m-t 23:59:59');
            $releasedate = date('Y-m-05', strtotime('+1 months', strtotime(date('Y-m-d'))));
        }
        $createarray = array('payout_type' => $type, 'payout_start_date' => $startdate, 'payout_close_date' => $enddate, 'payout_release_date' => $releasedate, 'created_by' => 'Server');
        try {
            $this->cronModel->createRecordInTable($createarray, 'payout_date');
        } catch (Exception $e) {
            
        }

        $this->createCron('Creating Daily Payout Date', 'Cron Closed');
    }

    //------------------internal function-------
    protected function createIncome($incomemember, $payoutid, $trnid, $inctype, $incamount) {
        if (!empty($incomemember)) {
            $incomearray = array(
                "user_id_user" => $incomemember,
                "payout_id_payout" => $payoutid,
                "payment_id_payment" => $trnid,
                "income_type" => $inctype,
                "income_amount" => $incamount
            );
            $this->cronModel->createRecordInTable($incomearray, 'member_income');
        }
    }

    protected function createOrUpdatePayoutRecord($payoutid, $userid, $incometype, $amount) {
        $payoutrecord = $this->cronModel->getTableData('*', 'monthly_payout', 'user_id_user=' . $userid . ' and payout_id_payout=' . $payoutid);
        $data = array();
        $fieldarray = array('', 'md_income', 'ma_income', 'mas_income', 'referrer_income', 'srcab_income', 'cab_income', 'nt_income', 'st_income', 'zt_income', 'bbi_head_income');
        $data[$fieldarray[$incometype]] = $amount;

        if (!empty($payoutrecord)) {
            $this->cronModel->updateRecordInTable($data, 'monthly_payout', 'mp_id', $payoutrecord->mp_id);
        } else {
            $data['user_id_user'] = $userid;
            $data['payout_id_payout'] = $payoutid;
            $this->cronModel->createRecordInTable($data, 'monthly_payout');
        }
    }
}

/*
 * switch ($incometype) {
            case 1:
                $data['md_income'] = $amount;
                break;
            case 2:
                $data['ma_income'] = $amount;
                break;
            case 3:
                $data['mas_income'] = $amount;
                break;
            case 4:
                $data['referrer_income'] = $amount;
                break;
            case 5:
                $data['srcab_income'] = $amount;
                break;
            case 6:
                $data['cab_income'] = $amount;
                break;
            case 7:
                $data['nt_income'] = $amount;
                break;
            case 8:
                $data['st_income'] = $amount;
                break;
            case 9:
                $data['zt_income'] = $amount;
                break;
            case 10:
                $data['bbi_head_income'] = $amount;
                break;
        }
 */