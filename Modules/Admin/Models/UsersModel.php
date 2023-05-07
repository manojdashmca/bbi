<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class UsersModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function selectUsers($data, $ordercolumn = 3, $orderdirecttion = 'desc', $offset = 0, $limit = 10) {
        try {
            $return = array();
            $columnarray = array('id_user','user_name', 'user_code', 'user_mobile', 'user_email', 'user_status', 'user_create_date');
            $sql = "select SQL_CALC_FOUND_ROWS id_user,user_name,CONCAT_WS(' / ',user_code,user_login_name) user_coden,user_mobile,user_email,"
                    . "if(user_status='1','Active','Blocked') user_status,"
                    . "date_format(user_create_date,'%d-%m-%Y %H:%i:%s') createedon "
                    . "FROM user_detail "
                    . "WHERE user_status !=3 and user_type >=4 ";
            !empty($data['email']) ? $sql .= " AND  a.user_email = '" . $data['email'] . "'" : $sql .= '';
            !empty($data['mobile']) ? $sql .= " AND  a.user_mobile = '" . $data['mobile'] . "'" : $sql .= '';
            !empty($data['status']) ? $sql .= " AND  a.user_status in( '" . $data['status'] . "')" : $sql .= '';
            !empty($data['name']) ? $sql .= " AND  a.user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND  date_format(user_create_date,'%Y-%m-%d') >= '" . date('Y-m-d', strtotime($data['fromdate'])) . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND  date_format(user_create_date,'%Y-%m-%d') <= '" . date('Y-m-d', strtotime($data['todate'])) . "'" : $sql .= '';
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

    public function getUserDetailById($id) {
        $sql = "SELECT id_user,user_login_name,user_login_key,user_code,user_title,user_name,user_father_husband,user_gender,user_marital_status,user_mobile,user_whatsappno,"
                . "user_email,user_dob,user_address,user_city,user_pincode,user_post_office,user_district,user_state,user_country,user_pan,user_nominee_name,"
                . "user_nominee_relation,user_nominee_address,user_bank_ac_no,user_bank_ifsc,user_bank_name,user_bank_branch,kyc_address,kyc_pan,kyc_image "
                . "from user_detail "
                . " where id_user='$id'";
        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function getModuleControll() {
        $sql = "SELECT module_id,module_name FROM modules WHERE module_status=1 AND module_is_default=0 ORDER BY module_short_order ASC";
        $results = $this->db->query($sql);
        $result = $results->getResult();
        for ($x = 0; $x < count($result); $x++) {
            $sql1 = "SELECT id_mc,mc_display_name,mc_name FROM module_controls WHERE mc_status=1 AND module_id_module='" . $result[$x]->module_id . "' ORDER BY mc_short_order ASC";
            $res = $this->db->query($sql1);
            $result[$x]->module_control = $res->getResult();
        }
        $return['data'] = $result;
        $return['message'] = "DB Operation Completed Succesfully";
        return $return;
    }
    
    public function getUserModuleAndSubmodules($iduser) {
        try {
            $sql = "SELECT user_modules,user_module_controls FROM admin_user WHERE user_id_user=$iduser";            
            $result = $this->db->query($sql);
            $return['data'] = $result->getRow();
            $return['message'] = "DB Operation Completed Succesfully";
        } catch (Exception $e) {
            $this->createModelError($e, 'User', 'getUserModuleAndSubmodules');
        }

        return $return;
    }

}
