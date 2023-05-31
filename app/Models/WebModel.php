<?php

namespace App\Models;

use CodeIgniter\Model;

class WebModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUserdetailByUsername($username) {
        $sql = "SELECT module_id_module,lm_name,id_user,user_code,user_name,user_mobile,user_email,user_login_name,user_type,user_dob,"
                . "user_city,user_login_key,user_last_login_date,user_need_pass_change,user_status,user_profile_pic "
                . "FROM user_detail a "
                . "left join ibo_user b on a.id_user=b.user_id_user "
                . "left join admin_user c on a.id_user=c.user_id_user "
                . "left join location_module on module_id_module=lm_id "
                . "WHERE (user_code='$username' or user_login_name='$username' or user_email='$username' or user_mobile='$username' ) AND user_status in(1,2) ";

        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function getPayoutDropDownData($limit = 100) {
        $sql = "Select payout_date_id,date_format(payout_start_date,'%d-%m-%Y') startdate,date_format(payout_close_date,'%d-%m-%Y') enddate from payout_date order by payout_date_id desc limit 0,$limit";
        $result = $this->db->query($sql);
        return $result->getResult();
    }
    
    public function selectIBO($data, $ordercolumn = 7, $orderdirecttion = 'desc', $offset = 0, $limit = 30) {
        try {
            $return = array();
            $columnarray = array('a.id_user', 'a.user_name', 'a.user_city', 'a.user_mobile','segment_name','category_name', 'a.user_create_date');
            $sql = "select SQL_CALC_FOUND_ROWS distinct(a.id_user),a.user_name, a.user_city,a.user_mobile ,
                segment_name,category_name,date_format(a.user_create_date,'%d-%m-%Y %H:%i:%s') createedon,
                CASE a.user_status WHEN '0' THEN 'In Active'
                WHEN '1' THEN 'Active'
                WHEN '2' THEN 'Blocked' END as user_status
                FROM user_detail as a                
                LEFT JOIN ibo_business_detail c on a.id_user=c.user_id_user 
                LEFT JOIN master_segment on business_segment=segment_id 
                LEFT JOIN master_category on business_category=category_id                 
                where a.user_type =1 ";

            !empty($data['segment']) ? $sql .= " AND business_segment = '" . $data['segment'] . "'" : $sql .= '';
            !empty($data['moduleid']) ? $sql .= " AND a.module_id_module = '" . $data['moduleid'] . "'" : $sql .= '';
            !empty($data['category']) ? $sql .= " AND business_category = '" . $data['category'] . "'" : $sql .= '';
            #!empty($data['username']) ? $sql .= " AND (a.user_code = '" . $data['username'] . "' OR a.user_login_name= '" . $data['username'] . "')" : $sql .= '';
            #!empty($data['fromdate']) ? $sql .= " AND DATE_FORMAT(a.user_create_date,'%Y-%m-%d') >= '" . $data['fromdate'] . "'" : $sql .= '';
            #!empty($data['todate']) ? $sql .= " AND DATE_FORMAT(a.user_create_date,'%Y-%m-%d') <= '" . $data['todate'] . "'" : $sql .= '';

            $sql .= " ORDER BY $columnarray[$ordercolumn] $orderdirecttion limit $offset,$limit";

            $sql1 = "SELECT FOUND_ROWS() as count";
            $result = $this->db->query($sql);
            $result1 = $this->db->query($sql1);
            $return['data'] = $result->getResult();
            $return['record_count'] = $result1->getRow()->count;
            $return['message'] = "DB Operation Completed Succesfully";
        } catch (Exception $e) {
            $this->createModelError($e, 'IBO', 'selectDistributor');
        }
        return $return;
    }

}
