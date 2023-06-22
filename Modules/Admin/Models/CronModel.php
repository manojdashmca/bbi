<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class CronModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getQueuedEmail($limit = 10) {
        $sql = "SELECT * from smtp_email where smtp_send_status=0 order by smtp_send_id asc limit 0,$limit ";
        $result = $this->db->query($sql);
        $return = $result->getResult();
        return $return;
    }

    public function getNoneConfirmedTransaction() {
        $sql = "SELECT mpd_id,user_id_user,module_id_module,sponsor_user_id,director_id,associate_director_id,assistant_director_id "
                . "from ibo_joining_payment_detail join user_detail on user_id_user=id_user "
                . "join location_module on module_id_module=lm_id "
                . " WHERE payout_status=0 and payment_status=2 "
                . " order by mpd_id asc limit 0,10";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function getSrConsultingMember() {
        $sql = "select user_id_user  from team_sr_consulting_board where status=1";
        $result = $this->db->query($sql);
        return $result->getResult();
    }
    
    public function getConsultingMember() {
        $sql = "select user_id_user  from team_consulting_board where status=1";
        $result = $this->db->query($sql);
        return $result->getResult();
    }
    
    public function getNationalMember() {
        $sql = "select user_id_user  from team_national where status=1";
        $result = $this->db->query($sql);
        return $result->getResult();
    }
    
    public function getStateMember() {
        $sql = "select user_id_user  from team_state where status=1";
        $result = $this->db->query($sql);
        return $result->getResult();
    }
    
    public function getZoneMember() {
        $sql = "select user_id_user  from team_zone where status=1";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function getLastPayoutId($type = 1) {
        $sql = "select *  from payout_date where payout_type='$type' order by payout_date_id desc limit 0,1";
        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function getMemberIncomeByPayoutId($payoutid) {
        $sql = "SELECT user_id_user, sum(`income_amount`) as amount,`income_type` FROM `member_income` WHERE mi_release_status=0 and `payout_id_payout`=$payoutid group by user_id_user,income_type limit 0,200";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function updateMemberIncomeRecord($payoutid, $userid, $incometype) {
        $sql = "UPDATE member_income set mi_release_status='1',mi_release_date='" . date('Y-m-d') . "',mi_release_detail='Amount sent to payout' "
                . "WHERE user_id_user=$userid and payout_id_payout=$payoutid and income_type=$incometype";
        $this->db->query($sql);
    }

    public function updateGrossPayout($payoutid) {
        $sql = "UPDATE monthly_payout set gross_income=md_income+ma_income+mas_income+referrer_income+srcab_income+cab_income+nt_income+st_income+zt_income+bbi_head_income where payout_id_payout=$payoutid";
        $this->db->query($sql);
        $sql1 = "UPDATE monthly_payout set tds_deducted=gross_income*10/100,net_income=gross_income-(gross_income*10/100) where payout_id_payout=$payoutid";
        $this->db->query($sql1);
        //$sql2 = "UPDATE monthly_payout set net_income=gross_income-tds_deducted where payout_id_payout=$payoutid";
        //$this->db->query($sql2);
    }

}
