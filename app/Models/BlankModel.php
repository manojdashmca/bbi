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

}
