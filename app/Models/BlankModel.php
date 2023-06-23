<?php

namespace App\Models;

use CodeIgniter\Model;

class BlankModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function checkUserEmail($emailid, $userid = '') {
        $sql = "SELECT count(1) count from users where user_email='$emailid' and user_status !=3 ";
        if (!empty($userid)) {
            $sql .= " AND id_user !='$userid'";
        }
        $result = $this->db->query($sql);
        $return = $result->getRow()->count;
        return $return;
    }
    
    public function checkUserMobile($mobileno, $userid = '') {
        $sql = "SELECT count(1) count from users where user_mobile='$mobileno' and user_status !=3 ";
        if (!empty($userid)) {
            $sql .= " AND id_user !='$userid'";
        }
        $result = $this->db->query($sql);
        $return = $result->getRow()->count;
        return $return;
    }
    
    public function getModuleDropDown() {
        $sql = "Select lm_id,lm_code, lm_name from location_module where lm_status=1";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

}
