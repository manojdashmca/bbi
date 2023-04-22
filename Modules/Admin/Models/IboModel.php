<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class IboModel extends Model {

    protected $table = 'users';

    public function __construct() {
        parent::__construct();
    }

    public function selectIBO($data, $ordercolumn = 7, $orderdirecttion = 'desc', $offset = 0, $limit = 30) {
        try {
            $return = array();
            $columnarray = array('a.id_user', 'a.user_name', 'a.user_code', 'a.user_city', 'a.user_mobile', 'a.sponsor_user_id', 'a.user_create_date');
            $sql = "select SQL_CALC_FOUND_ROWS a.id_user,a.user_name,CONCAT_WS(' / ',a.user_code,a.user_login_name) user_coden,a.user_city,a.user_mobile ,CONCAT_WS(' / ',b.user_code,b.user_login_name,b.user_name) as sponsor,
                date_format(a.user_create_date,'%d-%m-%Y %H:%i:%s') createedon,
                CASE a.user_status WHEN '0' THEN 'In Active'
                WHEN '1' THEN 'Active'
                WHEN '2' THEN 'Blocked' END as user_status
                FROM user_detail as a
                LEFT JOIN user_detail as b on a.sponsor_user_id=b.id_user                 
                where a.user_type =1 ";

            !empty($data['name']) ? $sql .= " AND a.user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['pan']) ? $sql .= " AND a.user_pan = '" . $data['pan'] . "'" : $sql .= '';
            !empty($data['mobile']) ? $sql .= " AND a.user_mobile = '" . $data['mobile'] . "'" : $sql .= '';
            !empty($data['username']) ? $sql .= " AND (a.user_code = '" . $data['username'] . "' OR a.user_login_name= '" . $data['username'] . "')" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND DATE_FORMAT(a.user_create_date,'%Y-%m-%d') >= '" . $data['fromdate'] . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND DATE_FORMAT(a.user_create_date,'%Y-%m-%d') <= '" . $data['todate'] . "'" : $sql .= '';

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

    public function getIboDetailById($id) {
        $sql = "SELECT a.id_user,a.user_login_name,a.user_login_key,a.user_code,a.user_name,a.user_mobile,"
                . "a.user_email,a.user_dob,a.user_address,a.user_city,a.user_pincode,a.user_post_office,a.user_district,a.user_state,a.user_country,a.user_pan,"
                . "a.user_bank_ac_no,a.user_bank_ifsc,a.user_bank_name,a.user_bank_branch,"
                . "CASE user_activation_type WHEN NULL THEN 'Activation Not done' "
                . "WHEN '1' THEN 'Autometic' "
                . "WHEN '2' THEN 'Manual' "
                . "END as activation_type,a.user_education,a.user_profession_certification,a.user_group_link,a.user_group_link_org,a.user_blood_group,"
                . "user_activation_date,a.user_create_date,joining_type,"
                . "CONCAT_WS(' / ',b.user_code,b.user_login_name,b.user_name) as sponsor "                
                . "from user_detail a join ibo_user on a.id_user=user_id_user "
                . "LEFT JOIN user_detail as b on a.sponsor_user_id=b.id_user "
                . "where a.id_user='$id'";
        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function getSponsorDetailById($id) {
        try {
            $sql = "SELECT id_user, user_name
                    FROM user_detail                      
                    JOIN ibo_user on id_user =user_id_user 
                    WHERE (user_code= '$id' or user_login_name = '$id') and user_type=1 ";
            $result = $this->db->query($sql);
            $return = $result->getRow();
        } catch (Exception $e) {
            $this->createModelError($e, 'Distributor', 'selectDistributor');
        }
        return $return;
    }

    public function getPositionUser($parent, $position) {
        try {
            $sql = "SELECT id_user,user_name,user_mobile, user_email,user_code,"
                    . "DATE_format(user_dob,'%d-%m-%Y') as user_dob "
                    . "FROM user_detail "
                    . "WHERE user_type=1";

            if (!empty($position)) {
                $sql .= " AND user_position='$position' AND reporting_user_id='$parent'";
            } else {
                $sql .= " AND id_user='$parent'";
            }

            $result = $this->db->query($sql);
            $return = $result->getRow();
        } catch (Exception $e) {
            $this->createModelError($e, 'User', 'getUserDetailById');
        }

        return $return;
    }

    public function getSponsordetailByUser($userid) {
        try {
            $sql = "SELECT sponsor_user_id from user_detail "
                    . " WHERE id_user = $userid ";
            $result = $this->db->query($sql);
            $return = $result->getRow();
        } catch (Exception $e) {
            $this->createModelError($e, 'user_detail', 'getSponsordetail');
        }
        return $return;
    }

    public function getIntroducerdetailByUser($userid) {
        try {
            $sql = "SELECT reporting_user_id,user_position from user_detail "
                    . " WHERE id_user = $userid ";
            $result = $this->db->query($sql);
            $return = $result->getRow();
        } catch (Exception $e) {
            $this->createModelError($e, 'user_detail', 'getSponsordetail');
        }
        return $return;
    }

    public function selectDownline($data, $offset = 0, $limit = 30) {
        try {
            $sql = "select SQL_CALC_FOUND_ROWS table_id,CONCAT_WS(' / ',b.user_code,b.user_login_name,b.user_name) user_coden,b.user_city,b.user_mobile ,b.user_email, b.user_create_date,
                if(a.position='1','Left','Right') as position 
                FROM ibo_binary_position as a
                JOIN user_detail as b on a.ibo_id=b.id_user  
                JOIN user_detail as c on a.parent_id=c.id_user 
                where 1 =1 ";
            !empty($data['code']) ? $sql .= " AND c.user_code = '" . $data['code'] . "'" : $sql .= '';
            $sql .= " ORDER BY ibo_id asc  limit $offset,$limit";

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

    public function getIboIdByCodeUsername($code) {
        $sql = "SELECT id_user,CONCAT_WS(' / ',user_code,user_login_name,user_name) user_coden,user_city,user_mobile ,user_email, user_create_date,
                if(user_position='1','Left','Right') as position "
                . "from user_detail "
                . "where user_login_name='$code' or user_code='$code'";
        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function selectSponsorship($data, $offset = 0, $limit = 30) {
        try {
            $sql = "select SQL_CALC_FOUND_ROWS isp_id,CONCAT_WS(' / ',b.user_code,b.user_login_name,b.user_name) user_coden,
                b.user_city,b.user_mobile ,b.user_email, b.user_create_date,level                   
                FROM ibo_sponsor_position as a
                JOIN user_detail as b on a.child=b.id_user  
                JOIN user_detail as c on a.sponsor=c.id_user 
                where 1 =1 ";
            !empty($data['code']) ? $sql .= " AND c.user_code = '" . $data['code'] . "'" : $sql .= '';
            !empty($data['level']) ? $sql .= " AND level = '" . $data['level'] . "'" : $sql .= '';
            $sql .= " ORDER BY level,b.id_user asc  limit $offset,$limit";

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

    public function getUserDetailById($id) {
        try {
            $sql = "SELECT id_user,user_name,user_code,user_login_name,user_mobile,"
                    . "user_email,user_dob,user_gender,user_create_date,payout_status "
                    . "FROM user_detail join ibo_user on id_user=user_id_user "
                    . "WHERE id_user='" . $id . "' or user_code='" . $id . "' or user_login_name='" . $id . "'";
            $result = $this->db->query($sql);
            $return['data'] = $result->getRow();
            $return['message'] = "DB Operation Completed Succesfully";
        } catch (Exception $e) {
            $this->createModelError($e, 'User', 'getUserDetailById');
        }

        return $return;
    }

    public function getUserTreeDetailById($id) {
        try {
            $sql = "SELECT position, COUNT( table_id ) AS count
                    FROM ibo_binary_position
                    WHERE parent_id =$id
                    GROUP BY position";
            $result = $this->db->query($sql);
            $dat = $result->getResult();
            $data['left'] = 0;
            $data['right'] = 0;
            $data['left_foi'] = 0;
            $data['right_foi'] = 0;
            $data['left_total_bv'] = 0;
            $data['right_total_bv'] = 0;
            if (!empty($dat)) {
                if (count($dat) > 1) {
                    if ($dat[0]->position == 1) {
                        $data['left'] = $dat[0]->count;
                    } else {
                        $data['right'] = $dat[0]->count;
                    }
                    if ($dat[1]->position == 1) {
                        $data['left'] = $dat[1]->count;
                    } else {
                        $data['right'] = $dat[1]->count;
                    }
                } else {
                    if ((int) $dat[0]->position == 1) {
                        $data['left'] = $dat[0]->count;
                    } else {
                        $data['right'] = $dat[0]->count;
                    }
                }
            }
            $return['data'] = $data;
            $return['message'] = "DB Operation Completed Succesfully";
        } catch (Exception $e) {
            $this->createModelError($e, 'User', 'getUserDetailById');
        }

        return $return;
    }

    public function getNodeUserDetail($userid) {
        try {
            $sql = "SELECT user_name,user_code,user_login_name,"
                    . "id_user,user_email,user_mobile,user_create_date ,user_position,payout_status "
                    . "FROM user_detail join ibo_user on id_user=user_id_user"
                    . " where reporting_user_id=$userid AND user_type=1";
            $result = $this->db->query($sql);
            $return['data'] = $result->getResult();
            $return['message'] = "DB Operation Completed Succesfully";
        } catch (Exception $e) {

            $this->createModelError($e, 'User', 'selectUser');
        }
        return $return;
    }

    public function selectIboVirtualBP($data, $ordercolumn = 7, $orderdirecttion = 'desc', $offset = 0, $limit = 30) {
        try {
            $return = array();
            $columnarray = array('a.vbpt_id', 'b.user_name', 'b.user_code', 'b.user_mobile', 'a.trn_position', 'a.trn_type', 'a.trn_bp', 'a.vbp_left_balance', 'a.vbp_right_balance', 'a.trn_date', 'a.remark', 'a.trn_status', 'trn_by', 'a.vbpt_id');
            $sql = "select SQL_CALC_FOUND_ROWS a.vbpt_id,b.user_name,CONCAT_WS(' / ',b.user_code,b.user_login_name) user_coden,b.user_mobile ,
                if(a.trn_position='1','Left','Right') as position,if(a.trn_type='1','Credit','Debit') as type,trn_bp,vbp_left_balance,vbp_right_balance,
                date_format(a.trn_date,'%d-%m-%Y %H:%i:%s') createedon,remark,
                if(a.trn_status='1','Active','Cancelled') as status,
                CONCAT_WS(' / ',c.user_code,c.user_login_name) created_by
                FROM virtual_bp_transaction as a
                LEFT JOIN user_detail as b on a.user_id_user=b.id_user 
                LEFT JOIN user_detail as c on a.trn_by=c.id_user 
                where 1 =1 ";

            !empty($data['name']) ? $sql .= " AND b.user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['pan']) ? $sql .= " AND b.user_pan = '" . $data['pan'] . "'" : $sql .= '';
            !empty($data['mobile']) ? $sql .= " AND b.user_mobile = '" . $data['mobile'] . "'" : $sql .= '';
            !empty($data['username']) ? $sql .= " AND (b.user_code = '" . $data['username'] . "' OR b.user_login_name= '" . $data['username'] . "')" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND DATE_FORMAT(a.trn_date,'%Y-%m-%d') >= '" . $data['fromdate'] . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND DATE_FORMAT(a.trn_date,'%Y-%m-%d') <= '" . $data['todate'] . "'" : $sql .= '';

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

    public function checkNewSponsorPosition($parent, $position, $newsponsor) {
        $sql = "select count(*) as count from ibo_binary_position where parent_id='$parent' and position='$position' and ibo_id='$newsponsor'";
        $result = $this->db->query($sql);
        return $result->getRow()->count;
    }
    
    public function getBusinesssegment(){
        $sql="Select * from master_segment where segment_status=1";
        $result = $this->db->query($sql);
        return $result->getResult();
    }public function getBusinessCategory($segmentid=0){
        $sql="Select * from master_category where category_status=1";
        if(!empty($segmentid)){
            $sql.=" AND segment_id_segment='$segmentid'";
        }
        $result = $this->db->query($sql);
        return $result->getResult();
    }public function getBusinessSubCategory($segmentid=0,$categoryid=0){
        $sql="Select * from master_sub_category where sub_category_status=1";
        if(!empty($segmentid)){
            $sql.=" AND segment_id_segment='$segmentid'";
        }if(!empty($segmentid)){
            $sql.=" AND category_id_category='$categoryid'";
        }
        $result = $this->db->query($sql);
        return $result->getResult();
    }

}
