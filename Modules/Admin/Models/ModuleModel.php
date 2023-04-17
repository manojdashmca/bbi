<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class ModuleModel extends Model {

    protected $table = 'users';

    public function __construct() {
        parent::__construct();
    }

    public function selectModule($data, $ordercolumn = 7, $orderdirecttion = 'desc', $offset = 0, $limit = 30) {
        try {
            $return = array();
            $columnarray = array('lm_id', 'lm_code', 'lm_name', 'lz_name', 'b.user_name', 'c.user_name', 'd.user_name', 'lm_status');
            $sql = "select SQL_CALC_FOUND_ROWS lm_id,lm_code,lm_name,lz_name,b.user_name as director,c.user_name associate,d.user_name assistant,
                if(lm_status='1','Active','Blocked') status 
                FROM location_module as a
                left join user_detail b on a.director_id=b.id_user
                left join user_detail c on a.associate_director_id=c.id_user 
                left join user_detail d on a.assistant_director_id=d.id_user 
                left join location_zone on zone_id_zone=lz_id 
                where 1=1 ";
            !empty($data['name']) ? $sql .= " AND lm_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['sku']) ? $sql .= " AND product_sku = '" . $data['sku'] . "'" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND DATE_FORMAT(lm_create_date,'%Y-%m-%d') >= '" . $data['fromdate'] . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND DATE_FORMAT(lm_create_date,'%Y-%m-%d') <= '" . $data['todate'] . "'" : $sql .= '';

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

    public function getModuleDetail($id) {
        $sql = "SELECT * from location_module where lm_id='$id'";
        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function getAllZones() {
        $sql = "Select * from location_zone where lz_status=1";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function updatePositionExit($type, $userid, $lmid) {
        if ($type == 'd') {
            $sql = "update module_position_audit set date_of_exit='" . date('Y-m-d H:i:s') . "',status=2 where status=1 and user_id_user='$userid' and position_id='1' and module_id_module='$lmid'";
        }
        if ($type == 'as') {
            $sql = "update module_position_audit set date_of_exit='" . date('Y-m-d H:i:s') . "',status=2 where status=1 and user_id_user='$userid' and position_id='2' and module_id_module='$lmid'";
        }
        if ($type == 'ast') {
            $sql = "update module_position_audit set date_of_exit='" . date('Y-m-d H:i:s') . "',status=2 where status=1 and user_id_user='$userid' and position_id='3' and module_id_module='$lmid'";
        }      
        
        $this->db->query($sql);
        return  $this->db->affectedRows();
    }

}
