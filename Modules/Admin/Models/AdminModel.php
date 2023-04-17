<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class AdminModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUserdetailByUsername($username) {
        $sql = "SELECT id_user,user_code,user_title,user_name,user_mobile,user_email,user_login_name,user_type,"
                . "user_login_key,user_last_login_date,user_need_pass_change,user_status,user_profile_pic "
                . "FROM user_detail join admin_user on id_user=user_id_user "
                . "WHERE (user_code='$username' or user_login_name='$username') AND user_status in(1,2) ";

        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function getIboShippingDetail($username) {
        $sql = "SELECT id_user,user_title,user_name,user_mobile,user_email,ibo_type,joining_type,cumulative_fo,"
                . "user_status,user_address,user_city,user_pincode,user_post_office,user_district,user_state,is_first_order_placed "
                . "FROM user_detail join ibo_user on id_user=user_id_user "
                . "WHERE (user_code='$username' or user_login_name='$username') AND user_status =1 and user_type=1 ";

        $result = $this->db->query($sql);
        return $result->getRow();
    }

}
