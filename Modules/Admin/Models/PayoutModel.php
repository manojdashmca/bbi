<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class PayoutModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function selectPayoutDates($data, $ordercolumn = 3, $orderdirecttion = 'desc', $offset = 0, $limit = 10) {
        try {
            $return = array();
            $columnarray = array('payout_date_id', 'payout_start_date', 'payout_close_date', 'payout_release_date');
            $sql = "select SQL_CALC_FOUND_ROWS payout_date_id,"
                    . "date_format(payout_start_date,'%d-%m-%Y') startdate, "
                    . "date_format(payout_close_date,'%d-%m-%Y') enddate, "
                    . "date_format(payout_release_date,'%d-%m-%Y') releasedate "
                    . "FROM payout_date "
                    . "WHERE 1=1 ";
            !empty($data['mobile']) ? $sql .= " AND user_mobile = '" . $data['mobile'] . "'" : $sql .= '';
            !empty($data['payout']) ? $sql .= " AND payout_id_payout = '" . $data['payout'] . "'" : $sql .= '';
            !empty($data['name']) ? $sql .= " AND  user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND  date_format(payout_start_date,'%Y-%m-%d') >= '" . date('Y-m-d', strtotime($data['fromdate'])) . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND  date_format(payout_start_date,'%Y-%m-%d') <= '" . date('Y-m-d', strtotime($data['todate'])) . "'" : $sql .= '';
            $sql .= " ORDER BY $columnarray[$ordercolumn] $orderdirecttion limit $offset,$limit";

            $sql1 = "SELECT FOUND_ROWS() as count";
            $result = $this->db->query($sql);
            $result1 = $this->db->query($sql1);
            $return['data'] = $result->getResult();
            $return['record_count'] = $result1->getRow()->count;
            $return['message'] = "DB Operation Completed Succesfully";
        } catch (Exception $e) {
            $this->createModelError($e, 'Distributor', 'selectDistributor');
        }
        return $return;
    }

    public function selectMemberPayout($data, $ordercolumn = 3, $orderdirecttion = 'desc', $offset = 0, $limit = 10) {
        try {
            $return = array();
            $columnarray = array('mp_id', 'payout_start_date', 'payout_close_date', 'payout_release_date');
            $sql = "select SQL_CALC_FOUND_ROWS mp_id,CONCAT_WS(' / ',user_name,user_code,user_login_name) user_coden,"
                    . "concat(date_format(payout_start_date,'%d-%m-%Y'),' TO ',date_format(payout_close_date,'%d-%m-%Y')) payout, "
                    . "gross_income,tds_deducted,net_income,"
                    . "if(release_status=1,'Released','Pending') releasestatus,date_format(release_date,'%d-%m-%Y') releasedate ,release_detail "
                    . "FROM monthly_payout join payout_date on payout_id_payout=payout_date_id "
                    . "join user_detail on user_id_user=id_user "
                    . "WHERE 1=1 ";
            !empty($data['name']) ? $sql .= " AND user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['payout']) ? $sql .= " AND payout_id_payout = '" . $data['payout'] . "'" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND  date_format(payout_start_date,'%Y-%m-%d') >= '" . date('Y-m-d', strtotime($data['fromdate'])) . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND  date_format(payout_start_date,'%Y-%m-%d') <= '" . date('Y-m-d', strtotime($data['todate'])) . "'" : $sql .= '';
            $sql .= " ORDER BY $columnarray[$ordercolumn] $orderdirecttion limit $offset,$limit";

            $sql1 = "SELECT FOUND_ROWS() as count";
            $result = $this->db->query($sql);
            $result1 = $this->db->query($sql1);
            $return['data'] = $result->getResult();
            $return['record_count'] = $result1->getRow()->count;
            $return['message'] = "DB Operation Completed Succesfully";
        } catch (Exception $e) {
            $this->createModelError($e, 'Distributor', 'selectDistributor');
        }
        return $return;
    }

    public function getPayoutDropDownData($limit = 100) {
        $sql = "Select payout_date_id,date_format(payout_start_date,'%d-%m-%Y') startdate,date_format(payout_close_date,'%d-%m-%Y') enddate from payout_date order by payout_date_id desc limit 0,$limit";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

}
