<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class UtilityModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function selectWebcontact($data, $ordercolumn = 6, $orderdirecttion = 'desc', $offset = 0, $limit = 10) {
        try {
            $return = array();
            $columnarray = array('wc_id','name', 'email', 'mobile', 'subject', 'message', 'create_date');
            $sql = "select SQL_CALC_FOUND_ROWS wc_id,name,email,mobile,subject,message,create_date "                    
                    . "FROM webcontact  "
                    . "WHERE 1=1 ";
            !empty($data['email']) ? $sql .= " AND  email = '" . $data['email'] . "'" : $sql .= '';
            !empty($data['mobile']) ? $sql .= " AND  mobile = '" . $data['mobile'] . "'" : $sql .= '';
            !empty($data['name']) ? $sql .= " AND  name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND  date_format(create_date,'%Y-%m-%d') >= '" . date('Y-m-d', strtotime($data['fromdate'])) . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND  date_format(create_date,'%Y-%m-%d') <= '" . date('Y-m-d', strtotime($data['todate'])) . "'" : $sql .= '';
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

    public function selectStartamodule($data, $ordercolumn = 6, $orderdirecttion = 'desc', $offset = 0, $limit = 10) {
        try {
            $return = array();
            $columnarray = array('sm_id','name', 'email', 'mobile', 'area', 'message', 'create_date');
            $sql = "select SQL_CALC_FOUND_ROWS sm_id,name,email,mobile,area,message,create_date "                    
                    . "FROM startamodule  "
                    . "WHERE 1=1 ";
            !empty($data['email']) ? $sql .= " AND  email = '" . $data['email'] . "'" : $sql .= '';
            !empty($data['mobile']) ? $sql .= " AND  mobile = '" . $data['mobile'] . "'" : $sql .= '';
            !empty($data['name']) ? $sql .= " AND  name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['area']) ? $sql .= " AND  area like '%" . $data['area'] . "%'" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND  date_format(create_date,'%Y-%m-%d') >= '" . date('Y-m-d', strtotime($data['fromdate'])) . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND  date_format(create_date,'%Y-%m-%d') <= '" . date('Y-m-d', strtotime($data['todate'])) . "'" : $sql .= '';
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

}
