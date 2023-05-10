<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class TeamsModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function selectSrConsultingBoard($data, $ordercolumn = 3, $orderdirecttion = 'desc', $offset = 0, $limit = 10) {
        try {
            $return = array();
            $columnarray = array('scaab_id','user_name', 'user_code', 'user_login_name','join_date','status');
            $sql = "select SQL_CALC_FOUND_ROWS scaab_id,user_name,user_code,user_login_name,"
                    . "date_format(join_date,'%d-%m-%Y') join_date,status "
                    . "FROM team_sr_consulting_board join user_detail on user_id_user=id_user "
                    . "WHERE status=1 ";            
            !empty($data['name']) ? $sql .= " AND  user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['username']) ? $sql .= " AND (a.user_code = '" . $data['username'] . "' OR a.user_login_name= '" . $data['username'] . "')" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND  date_format(join_date,'%Y-%m-%d') >= '" . date('Y-m-d', strtotime($data['fromdate'])) . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND  date_format(join_date,'%Y-%m-%d') <= '" . date('Y-m-d', strtotime($data['todate'])) . "'" : $sql .= '';
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
    
    public function selectConsultingBoard($data, $ordercolumn = 3, $orderdirecttion = 'desc', $offset = 0, $limit = 10) {
        try {
            $return = array();
            $columnarray = array('cbt_id','user_name', 'user_code', 'user_login_name','added_on','addition_type ','status');
            $sql = "select SQL_CALC_FOUND_ROWS cbt_id,user_name,user_code,user_login_name,"
                    . "date_format(added_on,'%d-%m-%Y') join_date,"
                    . "if(addition_type=1,'Manual','Autometic') addition_type,status "
                    . "FROM team_consulting_board join user_detail on user_id_user=id_user "
                    . "WHERE status=1 ";
            
            !empty($data['name']) ? $sql .= " AND  user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['username']) ? $sql .= " AND (a.user_code = '" . $data['username'] . "' OR a.user_login_name= '" . $data['username'] . "')" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND  date_format(added_on,'%Y-%m-%d') >= '" . date('Y-m-d', strtotime($data['fromdate'])) . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND  date_format(added_on,'%Y-%m-%d') <= '" . date('Y-m-d', strtotime($data['todate'])) . "'" : $sql .= '';
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
    public function selectStateTeam($data, $ordercolumn = 3, $orderdirecttion = 'desc', $offset = 0, $limit = 10) {
        try {
            $return = array();
            $columnarray = array('st_id','user_name', 'user_code', 'user_login_name','added_on','addition_type ','status');
            $sql = "select SQL_CALC_FOUND_ROWS st_id,user_name,user_code,user_login_name,"
                    . "date_format(added_on,'%d-%m-%Y') join_date,"
                    . "if(addition_type=1,'Manual','Autometic') addition_type,status "
                    . "FROM team_state join user_detail on user_id_user=id_user "
                    . "WHERE status=1 ";            
            !empty($data['name']) ? $sql .= " AND  user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['username']) ? $sql .= " AND (a.user_code = '" . $data['username'] . "' OR a.user_login_name= '" . $data['username'] . "')" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND  date_format(added_on,'%Y-%m-%d') >= '" . date('Y-m-d', strtotime($data['fromdate'])) . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND  date_format(added_on,'%Y-%m-%d') <= '" . date('Y-m-d', strtotime($data['todate'])) . "'" : $sql .= '';
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
public function selectNationalTeam($data, $ordercolumn = 3, $orderdirecttion = 'desc', $offset = 0, $limit = 10) {
        try {
            $return = array();
            $columnarray = array('nt_id','user_name', 'user_code', 'user_login_name','added_on','addition_type ','status');
            $sql = "select SQL_CALC_FOUND_ROWS nt_id,user_name,user_code,user_login_name,"
                    . "date_format(added_on,'%d-%m-%Y') join_date,"
                    . "if(addition_type=1,'Manual','Autometic') addition_type,status "
                    . "FROM team_national join user_detail on user_id_user=id_user "
                    . "WHERE status=1 ";            
            !empty($data['name']) ? $sql .= " AND  user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['username']) ? $sql .= " AND (a.user_code = '" . $data['username'] . "' OR a.user_login_name= '" . $data['username'] . "')" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND  date_format(added_on,'%Y-%m-%d') >= '" . date('Y-m-d', strtotime($data['fromdate'])) . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND  date_format(added_on,'%Y-%m-%d') <= '" . date('Y-m-d', strtotime($data['todate'])) . "'" : $sql .= '';
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
    
    public function selectZoneTeam($data, $ordercolumn = 3, $orderdirecttion = 'desc', $offset = 0, $limit = 10) {
        try {
            $return = array();
            $columnarray = array('zt_id','user_name', 'user_code', 'user_login_name','added_on','addition_type ','status');
            $sql = "select SQL_CALC_FOUND_ROWS zt_id,user_name,user_code,user_login_name,"
                    . "date_format(added_on,'%d-%m-%Y') join_date,"
                    . "if(addition_type=1,'Manual','Autometic') addition_type,status "
                    . "FROM team_zone join user_detail on user_id_user=id_user "
                    . "WHERE status=1 ";           
            !empty($data['name']) ? $sql .= " AND  user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['username']) ? $sql .= " AND (a.user_code = '" . $data['username'] . "' OR a.user_login_name= '" . $data['username'] . "')" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND  date_format(added_on,'%Y-%m-%d') >= '" . date('Y-m-d', strtotime($data['fromdate'])) . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND  date_format(added_on,'%Y-%m-%d') <= '" . date('Y-m-d', strtotime($data['todate'])) . "'" : $sql .= '';
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
