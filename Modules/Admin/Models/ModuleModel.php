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
            $columnarray = array('lm_id', 'lm_code', 'lm_name', 'lm_city', 'lm_state', 'lm_country', 'b.user_name', 'c.user_name', 'd.user_name', 'lm_status');
            $sql = "select SQL_CALC_FOUND_ROWS lm_id,lm_code,lm_name,lm_city,lm_state,lm_country,b.user_name as director,c.user_name associate,d.user_name assistant,
                if(lm_status='1','Active','Blocked') status 
                FROM location_module as a
                left join user_detail b on a.director_id=b.id_user
                left join user_detail c on a.associate_director_id=c.id_user 
                left join user_detail d on a.assistant_director_id=d.id_user                 
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
        return $this->db->affectedRows();
    }

    public function getmoduleDetailById($id) {
        $sql = "select a.*,b.user_name as director                 
                FROM location_module as a
                left join user_detail b on a.director_id=b.id_user        
                where lm_status=1 and (lm_code='$id' OR LOWER(lm_name)= '" . strtolower($id) . "')";
        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function selectSegment($data, $ordercolumn = 1, $orderdirecttion = 'desc', $offset = 0, $limit = 30) {
        try {
            $return = array();
            $columnarray = array('segment_id', 'segment_name', 'segment_status');
            $sql = "select SQL_CALC_FOUND_ROWS segment_id,segment_name,
                if(segment_status='1','Active','Blocked') status 
                FROM master_segment                 
                where 1=1 ";
            !empty($data['name']) ? $sql .= " AND segment_name like '%" . $data['name'] . "%'" : $sql .= '';

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

    public function selectCategory($data, $ordercolumn = 1, $orderdirecttion = 'desc', $offset = 0, $limit = 30) {
        try {
            $return = array();
            $columnarray = array('category_id', 'category_name', 'segment_name', 'category_status');
            $sql = "select SQL_CALC_FOUND_ROWS category_id,category_name,segment_name,
                if(category_status='1','Active','Blocked') status 
                FROM master_category join master_segment on segment_id_segment=segment_id                
                where 1=1 ";
            !empty($data['cname']) ? $sql .= " AND category_name like '%" . $data['cname'] . "%'" : $sql .= '';
            !empty($data['sname']) ? $sql .= " AND segment_name like '%" . $data['sname'] . "%'" : $sql .= '';

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

    public function selectSubCategory($data, $ordercolumn = 1, $orderdirecttion = 'desc', $offset = 0, $limit = 30) {
        try {
            $return = array();
            $columnarray = array('sub_category_id', 'sub_category_name', 'category_name', 'segment_name', 'sub_category_status');
            $sql = "select SQL_CALC_FOUND_ROWS sub_category_id,sub_category_name,category_name,segment_name,
                if(sub_category_status='1','Active','Blocked') status 
                FROM master_sub_category msc 
                join master_category mc on msc.category_id_category=category_id  
                join master_segment ms on msc.segment_id_segment=segment_id 
                where 1=1 ";
            !empty($data['scname']) ? $sql .= " AND sub_category_name like '%" . $data['scname'] . "%'" : $sql .= '';
            !empty($data['cname']) ? $sql .= " AND category_name like '%" . $data['cname'] . "%'" : $sql .= '';
            !empty($data['sname']) ? $sql .= " AND segment_name like '%" . $data['sname'] . "%'" : $sql .= '';

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

    public function getSegmentDetail($id) {
        $sql = "select * from master_segment where segment_id=$id ";
        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function getCategoryDetail($id) {
        $sql = "select * from master_category where category_id=$id ";
        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function getSubcategoryDetail($id) {
        $sql = "select * from master_sub_category where sub_category_id=$id ";
        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function getState() {
        $sql = "SELECT * from state where 1=1";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function selectBlockedSubCategory($data, $ordercolumn = 1, $orderdirecttion = 'desc', $offset = 0, $limit = 30) {
        try {
            $return = array();
            $columnarray = array('sub_category_id', 'sub_category_name', 'category_name', 'segment_name', 'sub_category_status');
            $sql = "select SQL_CALC_FOUND_ROWS sub_category_id,sub_category_name,category_name,segment_name,
                if(sub_category_status='1','Active','Blocked') status,
                if((select count(ibd_id) from ibo_business_detail join user_detail ud on user_id_user=id_user where business_subcategory=sub_category_id and ud.module_id_module='".$data['module']."')='0','<span style=color:green;>Available</span>','<span style=color:red;>Used</span>') used  
                FROM master_sub_category msc 
                join master_category mc on msc.category_id_category=category_id  
                join master_segment ms on msc.segment_id_segment=segment_id 
                where 1=1 ";
            !empty($data['cname']) ? $sql .= " AND msc.category_id_category = '" . $data['cname'] . "'" : $sql .= '';
            !empty($data['sname']) ? $sql .= " AND msc.segment_id_segment = '" . $data['sname'] . "'" : $sql .= '';

            $sql .= " ORDER BY $columnarray[$ordercolumn] $orderdirecttion limit $offset,$limit";
            //echo $sql;
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
