<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class FranchiseModel extends Model {

    protected $table = 'users';

    public function __construct() {
        parent::__construct();
    }

    public function selectFranchise($data, $ordercolumn = 7, $orderdirecttion = 'desc', $offset = 0, $limit = 30) {
        try {
            $return = array();
            $columnarray = array('id_user', 'user_name', 'user_code', 'user_city', 'user_mobile', 'user_email', 'user_create_date', 'user_status');
            $sql = "select SQL_CALC_FOUND_ROWS id_user,user_name,CONCAT_WS(' / ',user_code,user_login_name) user_coden,user_city,user_mobile ,user_email,                
                date_format(user_create_date,'%d-%m-%Y %H:%i:%s') createedon,
                CASE user_status WHEN '0' THEN 'In Active'
                WHEN '1' THEN 'Active'
                WHEN '2' THEN 'Blocked' END as user_status
                FROM  user_detail                 
                where user_type =2 ";
            !empty($data['name']) ? $sql .= " AND (user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['mobile']) ? $sql .= " AND user_mobile = '" . $data['mobile'] . "'" : $sql .= '';
            !empty($data['username']) ? $sql .= " AND (user_code = '" . $data['username'] . "' OR user_login_name= '" . $data['username'] . "')" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND DATE_FORMAT(user_create_date,'%Y-%m-%d') >= '" . $data['fromdate'] . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND DATE_FORMAT(user_create_date,'%Y-%m-%d') <= '" . $data['todate'] . "'" : $sql .= '';

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

    public function selectFranchiseWallet($data, $ordercolumn = 6, $orderdirecttion = 'desc', $offset = 0, $limit = 30) {
        try {
            $return = array();
            $columnarray = array('wt_id', 'user_name', 'user_code', 'wt_transaction_type', 'wt_debit_amount', 'wt_credit_amount', 'wallet_balance', 'wt_date', 'wt_remark');
            $sql = "select SQL_CALC_FOUND_ROWS wt_id,user_name,user_code,wt_transaction_type,coalesce(wt_debit_amount,0) as debit ,coalesce(wt_credit_amount,0) as credit,wallet_balance,                
                 date_format(wt_date,'%d-%m-%Y %h:%i:%s') trndate,wt_remark 
                FROM  wallet_transaction as a  
                INNER JOIN user_detail as b on a.user_id_user=b.id_user                
                where b.user_type =2 ";

            !empty($data['name']) ? $sql .= " AND user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['mobile']) ? $sql .= " AND user_mobile = '" . $data['mobile'] . "'" : $sql .= '';
            !empty($data['username']) ? $sql .= " AND (user_code = '" . $data['username'] . "' or user_login_name='" . $data['username'] . "')" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND DATE_FORMAT(wt_date,'%Y-%m-%d') >= '" . $data['fromdate'] . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND DATE_FORMAT(wt_date,'%Y-%m-%d') <= '" . $data['todate'] . "'" : $sql .= '';

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

    public function getFranchisedetailById($id) {

        $sql = "SELECT id_user,user_login_name,user_login_key,user_code,user_name,user_mobile,user_whatsappno,"
                . "user_email,user_address,user_city,user_pincode,user_post_office,user_district,user_state,user_country,"
                . "user_bank_ac_no,user_bank_ifsc,user_bank_name,user_bank_branch,franchise_balance,franchise_gst_no,"
                . "franchise_type,franchise_base_inventory "
                . "from user_detail join franchise_user on id_user=user_id_user "
                . "where id_user='$id'";
        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function getFranchiseDetailByCode($code) {
        $sql = "SELECT id_user,user_name "
                . "from user_detail  "
                . "where user_code='$code' or user_login_name='$code'";
        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function selectFranchiseInventory($data, $ordercolumn = 6, $orderdirecttion = 'desc', $offset = 0, $limit = 30) {
        try {
            $return = array();
            $columnarray = array('fi_id', 'product_name', 'product_sku', 'product_hsn', 'stock_amount', 'is_available', 'fr_id_fr');
            $sql = "select SQL_CALC_FOUND_ROWS fi_id,product_name,product_sku,product_hsn,coalesce(sum(fo_stock_amount),0) fostock,coalesce(sum(ro_stock_amount),0) rostock,if(is_available='1','Available','Blocked') status    
                FROM  franchise_inventory as a  
                INNER JOIN product as b on a.product_id_product=b.product_id 
                INNER JOIN user_detail as c on a.fr_id_fr=c.id_user                
                where 1 ";

            !empty($data['prcode']) ? $sql .= " AND product_sku like '%" . $data['prcode'] . "%'" : $sql .= '';
            !empty($data['frcode']) ? $sql .= " AND (user_code = '" . $data['frcode'] . "' or user_login_name='" . $data['frcode'] . "')" : $sql .= '';

            $sql .= " group by product_id_product ORDER BY $columnarray[$ordercolumn] $orderdirecttion limit $offset,$limit";

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

    public function getFranchiseProduct($franchiseid, $status = 0) {
        $sql = "select product_id_product,product_name,product_sku,product_hsn,fo_stock_amount, ro_stock_amount,if(is_available='1','Available','Blocked') status    
                FROM  product as b                    
                left outer JOIN franchise_inventory  as a on a.product_id_product=b.product_id  
                JOIN user_detail as c on a.fr_id_fr=c.id_user 
                where fr_id_fr='$franchiseid' ";
        if (!empty($status)) {
            $sql .= " AND is_available='$status'";
        }

        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function updateInventory($frnid, $prid, $fobalance, $robalance) {
        $sql = "UPDATE franchise_inventory set fo_stock_amount='$fobalance',ro_stock_amount='$robalance' where fr_id_fr='$frnid' and product_id_product='$prid'";
        $this->db->query($sql);
    }

    public function selectFranchiseOrder($data, $ordercolumn = 7, $orderdirecttion = 'desc', $offset = 0, $limit = 30) {
        try {
            $return = array();
            $columnarray = array('fo_id', 'b.user_name', 'order_no', 'order_create_date', 'total_billing_amount', 'total_base_point', 'shipping', 'user_status');
            $sql = "select SQL_CALC_FOUND_ROWS fo_id,CONCAT_WS(' / ',b.user_code,b.user_login_name,b.user_name ) fr_name,order_no,order_create_date,total_billing_amount ,total_base_point,                
             CONCAT_WS(' / ',shipping_company,awb_no) shipping ,
                CASE order_status WHEN '1' THEN 'Order Placed'
                WHEN '2' THEN 'Approved'
                WHEN '3' THEN 'Rejected' 
                WHEN '4' THEN 'Dispatched' 
                WHEN '5' THEN 'Delivered' END as order_status,
                order_update_date,CONCAT_WS(' / ',d.user_code,d.user_name ) user_name 
                FROM  franchise_order  a
                JOIN user_detail b on a.fr_id_fr =b.id_user 
                LEFT JOIN shipping_detail c on a.shipping_id=c.sd_id
                LEFT JOIN user_detail d on a.order_update_by=d.id_user
                where 1 ";
            !empty($data['name']) ? $sql .= " AND (b.user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['username']) ? $sql .= " AND (b.user_code = '" . $data['username'] . "' OR b.user_login_name= '" . $data['username'] . "')" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND DATE_FORMAT(order_create_date,'%Y-%m-%d') >= '" . $data['fromdate'] . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND DATE_FORMAT(order_create_date,'%Y-%m-%d') <= '" . $data['todate'] . "'" : $sql .= '';

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

}
