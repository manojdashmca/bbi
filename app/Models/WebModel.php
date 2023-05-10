<?php

namespace App\Models;

use CodeIgniter\Model;

class WebModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUserdetailByUsername($username) {
        $sql = "SELECT module_id_module,lm_name,id_user,user_code,user_name,user_mobile,user_email,user_login_name,user_type,user_dob,user_city,"
                . "user_login_key,user_last_login_date,user_need_pass_change,user_status,user_profile_pic "
                . "FROM user_detail join ibo_user on id_user=user_id_user "
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

}
