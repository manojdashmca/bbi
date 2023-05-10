<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class DashboardModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUserCount() {
        $sql = "select user_type,count(id_user) count from user_detail group by user_type order by user_type asc ";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function getSegmentCount() {
        $sql = "select count(segment_id) qcount from master_segment where 1=1";
        $result = $this->db->query($sql);
        return $result->getRow()->qcount;
    }

    public function getModuleCount() {
        $sql = "select count(lm_id) qcount from location_module where 1=1";
        $result = $this->db->query($sql);
        return $result->getRow()->qcount;
    }

    public function getCategoryCount() {
        $sql = "select count(category_id) qcount from master_category where 1=1";
        $result = $this->db->query($sql);
        return $result->getRow()->qcount;
    }

    public function getSubCategoryCount() {
        $sql = "select count(sub_category_id) qcount from master_sub_category where 1=1";
        $result = $this->db->query($sql);
        return $result->getRow()->qcount;
    }

    public function getTotaljoiningByDate($fromdate = '', $todate = '') {
        $sql = "select count(id_user) usercount from user_detail where 1=1";
        if (!empty($fromdate)) {
            $sql .= " AND date_format(user_create_date,'%Y-%m-%d') >= '$fromdate'";
        }
        if (!empty($todate)) {
            $sql .= " AND date_format(user_create_date,'%Y-%m-%d') <= '$todate'";
        }
        $result = $this->db->query($sql);
        return $result->getRow()->usercount;
    }

    public function getPayoutAmountByDate($startdate, $enddate) {
        return 0;
    }

    public function getTotalSponsor($userid) {
        $sql = "select count(id_user) usercount from user_detail where sponsor_user_id='$userid'";
        $result = $this->db->query($sql);
        return $result->getRow()->usercount;
    }

    public function getTotalIncome($userid = '', $fromdate = '', $todate = '') {
        $sql = "select coalesce(sum(income_amount)) income from member_income mi "
                . "join ibo_joining_payment_detail on payment_id_payment = mpd_id "
                . "where 1=1 ";
        if (!empty($userid)) {
            $sql .= " AND mi.user_id_user='$userid'";
        }
        if (!empty($fromdate)) {
            $sql .= " AND date_format(payment_date,'%Y-%m-%d') >= '$fromdate'";
        }
        if (!empty($todate)) {
            $sql .= " AND date_format(payment_date,'%Y-%m-%d') <= '$todate'";
        }
        $result = $this->db->query($sql);
        return $result->getRow()->income;
    }

    public function getMemberInModule($moduleid) {
        $sql = "select count(id_user) usercount from user_detail where module_id_module='$moduleid'";
        $result = $this->db->query($sql);
        return $result->getRow()->usercount;
    }

    public function getModuleDetail($moduleid) {
        $sql = "select a.user_name director,b.user_name assodirector,c.user_name astdirector from location_module "
                . "left join user_detail a on director_id=a.id_user "
                . "left join user_detail b on associate_director_id=b.id_user "
                . "left join user_detail c on assistant_director_id=c.id_user "
                . "where lm_id='$moduleid'";
        $result = $this->db->query($sql);
        return $result->getRow();
    }

}
