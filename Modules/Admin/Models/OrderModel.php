<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class OrderModel extends Model {

    protected $table = 'users';

    public function __construct() {
        parent::__construct();
    }

    public function selectIBOOrder($data, $ordercolumn = 3, $orderdirecttion = 'desc', $offset = 0, $limit = 10) {
        try {
            $return = array();
            $columnarray = array('transaction_id', 'trn_order_no', 'user_name', 'transaction_date', 'total_billing_amount', 'user_mobile', 'user_email', 'user_status', 'user_create_date');
            $sql = "select SQL_CALC_FOUND_ROWS transaction_id,trn_order_no,CONCAT_WS(' / ',user_name,user_code,user_login_name) user_coden,"
                    . "date_format(transaction_date,'%d-%m-%Y %H:%i:%s') trn_date,total_billing_amount,"
                    . "CASE shipping_status WHEN '0' THEN 'Waiting For Update' "
                    . "WHEN '1' THEN 'Packaged' "
                    . "WHEN '2' THEN 'Shipped' "
                    . "WHEN '3' THEN 'Delivered' "
                    . "WHEN '4' THEN 'Returned' "
                    . "END as shipping_status ,"
                    . "CONCAT_WS(' / ',shipping_company,awb_no,shipping_date) shipping_detail,"
                    . "CASE transaction_status WHEN '1' THEN 'Created' "
                    . "WHEN '2' THEN 'Approved' "
                    . "WHEN '3' THEN 'Cancelled' "
                    . "END as order_status "
                    . "FROM ibo_order a join user_detail on user_id_user=id_user "
                    . "left JOIN shipping_detail on transaction_id=order_id_order "
                    . "WHERE issued_from =1 ";
            !empty($data['rderno']) ? $sql .= " AND trn_order_no = '" . $data['rderno'] . "'" : $sql .= '';
            !empty($data['mobile']) ? $sql .= " AND user_mobile = '" . $data['mobile'] . "'" : $sql .= '';
            !empty($data['username']) ? $sql .= " AND (user_code = '" . $data['username'] . "' OR user_login_name= '" . $data['username'] . "')" : $sql .= '';
            //!empty($data['status']) ? $sql .= " AND  a.user_status in( '" . $data['status'] . "')" : $sql .= '';
            !empty($data['name']) ? $sql .= " AND  user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND  date_format(transaction_date,'%Y-%m-%d') >= '" . date('Y-m-d', strtotime($data['fromdate'])) . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND  date_format(transaction_date,'%Y-%m-%d') <= '" . date('Y-m-d', strtotime($data['todate'])) . "'" : $sql .= '';
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
    
    public function selectShippingOrder($data, $ordercolumn = 3, $orderdirecttion = 'desc', $offset = 0, $limit = 10) {
        try {
            $return = array();
            $columnarray = array('transaction_id', 'trn_order_no', 'user_name', 'transaction_date', 'total_billing_amount', 'user_mobile', 'user_email', 'user_status', 'user_create_date');
            $sql = "select SQL_CALC_FOUND_ROWS transaction_id,trn_order_no,date_format(transaction_date,'%d-%m-%Y %H:%i:%s') order_date,"                    
                    . "CONCAT_WS(' , ',shipping_address,concat(shipping_state,'-',shipping_pincode),shipping_mobile) shipping_address,"
                    . "CASE shipping_status WHEN '0' THEN 'Waiting For Update' "
                    . "WHEN '1' THEN 'Packaged' "
                    . "WHEN '2' THEN 'Shipped' "
                    . "WHEN '3' THEN 'Delivered' "
                    . "WHEN '4' THEN 'Returned' "
                    . "END as shipping_status ,"
                    . "CONCAT_WS(' / ',shipping_company,awb_no,shipping_date) shipping_detail "                    
                    . "FROM ibo_order a join user_detail on user_id_user=id_user "
                    . "JOIN shipping_detail on transaction_id=order_id_order "
                    . "WHERE issued_from =1 and transaction_status=2 ";
            !empty($data['rderno']) ? $sql .= " AND trn_order_no = '" . $data['rderno'] . "'" : $sql .= '';
            !empty($data['mobile']) ? $sql .= " AND user_mobile = '" . $data['mobile'] . "'" : $sql .= '';
            !empty($data['username']) ? $sql .= " AND (user_code = '" . $data['username'] . "' OR user_login_name= '" . $data['username'] . "')" : $sql .= '';
            !empty($data['name']) ? $sql .= " AND  user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND  date_format(transaction_date,'%Y-%m-%d') >= '" . date('Y-m-d', strtotime($data['fromdate'])) . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND  date_format(transaction_date,'%Y-%m-%d') <= '" . date('Y-m-d', strtotime($data['todate'])) . "'" : $sql .= '';
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

    public function getOrderDetailById($orderid) {
        $sql = "SELECT * from ibo_order where transaction_id='$orderid'";
        $result = $this->db->query($sql);
        return $result->getRow();
    }
    public function getOrderProductDetailById($trnid) {
        $sql = "SELECT * from ibo_order_has_product where trn_id_trn='$trnid'";
        $result = $this->db->query($sql);
        return $result->getResult();
    }
    
    public function getIboUserDetail($iboid){
        $sql = "SELECT * from ibo_user where user_id_user='$iboid'";
        $result = $this->db->query($sql);
        return $result->getRow();
    }

}
