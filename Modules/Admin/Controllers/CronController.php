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
     * 1-Delete Old Files Older Than 15 Days
     * Class- Cron
     * Method-  deleteLogs
     * curl --silent http://www.sskbbi.co.in/delete-system-log
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

            $counter = 0;
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

            $counter = 0;
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

    /*

      12- Gererate weekly Payout Repurchase
     * Class- Cron
     * Method-generateWeeklyPayoutRepurchase
     * curl --silent http://www.sskbbi.co.in/create-payout-date/$1
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

    /* 11- Gererate weekly Payout
     * Class- Cron
     * Method-generateWeeklyPayout
     * curl --silent http://www.sskbbi.co.in/confirm-transaction
     * frequency- Months 1st,8th,16th,23rd(On the payoutdate at 12:05 AM)
     */

    public function confirmTransaction() {
        try {
            $this->createCron('Confirm Transaction', 'Cron Started');
            $count = 0;
            $payoutdata = $this->cronModel->getLastPayoutId();
            $payoutid = $payoutdata->payout_date_id;
            $trndata = $this->cronModel->getNoneConfirmedTransaction();

            $srconsultingboard = $this->cronModel->getSrConsultingMember();
            $srmembershare = floor(500 / count($srconsultingboard));
            for ($x = 0; $x < count($trndata); $x++) {
                $trnid = $trndata[$x]->mpd_id;
                $moduledirector = $trndata[$x]->director_id;
                $moduleasdirector = $trndata[$x]->assistant_director_id;
                $moduleassodirector = $trndata[$x]->associate_director_id;
                $sponsoruser = $trndata[$x]->sponsor_user_id;

                $this->cronModel->transStart();

                $this->createIncome($moduledirector, $payoutid, $trnid, 1, 3000);
                $this->createIncome($moduleassodirector, $payoutid, $trnid, 2, 500);
                $this->createIncome($moduleasdirector, $payoutid, $trnid, 3, 500);
                $this->createIncome($sponsoruser, $payoutid, $trnid, 4, 3000);
                for ($src = 0; $src < count($srconsultingboard); $src++) {
                    $this->createIncome($srconsultingboard[$src]->user_id_user, $payoutid, $trnid, 5, $srmembershare);
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

    protected function createIncome($incomemember, $payoutid, $trnid, $inctype, $incamount) {
        $incomearray = array(
            "user_id_user" => $incomemember,
            "payout_id_payout" => $payoutid,
            "payment_id_payment" => $trnid,
            "income_type" => $inctype,
            "income_amount" => $incamount
        );
        $this->cronModel->createRecordInTable($incomearray, 'member_income');
    }

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

    protected function createOrUpdatePayoutRecord($payoutid, $userid, $incometype, $amount) {
        $payoutrecord = $this->cronModel->getTableData('*', 'monthly_payout', 'user_id_user=' . $userid . ' and payout_id_payout=' . $payoutid);
        $data = array();
        switch ($incometype) {
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
        if (!empty($payoutrecord)) {
            $this->cronModel->updateRecordInTable($data, 'monthly_payout', 'mp_id', $payoutrecord->mp_id);
        } else {
            $data['user_id_user'] = $userid;
            $data['payout_id_payout'] = $payoutid;
            $this->cronModel->createRecordInTable($data, 'monthly_payout');
        }
    }

    public function updateGrossIncome() {
        $payoutd = $this->cronModel->getLastPayoutId();
        $payoutid = $payoutd->payout_date_id;
        $this->cronModel->updateGrossPayout($payoutid);
    }

}
