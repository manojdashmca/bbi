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
            $columnarray = array('mpd_id', 'user_name', 'payment_date','joining_fee','joining_gst', 'payment_amount', 'payment_method', 'payment_remark', 'payment_status','payout_status');
            $sql = "select SQL_CALC_FOUND_ROWS mpd_id,CONCAT_WS(' / ',user_name,user_code,user_login_name) user_coden,"
                    . "date_format(payment_date,'%d-%m-%Y %H:%i:%s') payment_date,joining_fee,topup_fee,gst,payment_amount,"
                    . "payment_method,payment_remark,paymentproof,"                    
                    . "CASE payment_status WHEN '1' THEN 'Created' "
                    . "WHEN '2' THEN 'Approved' "
                    . "WHEN '3' THEN 'Rejected' "
                    . "END as paymentstatus,(select group_concat(sub_category_name) as service from ibo_business_detail join master_sub_category on actual_subcategory=sub_category_id where paymentdetail_id=mpd_id) as bookedservice,"
                    . "if(payout_status=1,'Processed','Under-process') payout "
                    . "FROM ibo_joining_payment_detail a join user_detail on user_id_user=id_user "                    
                    . "WHERE 1 =1 ";
             !empty($data['mobile']) ? $sql .= " AND user_mobile = '" . $data['mobile'] . "'" : $sql .= '';
            !empty($data['username']) ? $sql .= " AND (user_code = '" . $data['username'] . "' OR user_login_name= '" . $data['username'] . "')" : $sql .= '';
            !empty($data['name']) ? $sql .= " AND  user_name like '%" . $data['name'] . "%'" : $sql .= '';
            !empty($data['fromdate']) ? $sql .= " AND  date_format(payment_date,'%Y-%m-%d') >= '" . date('Y-m-d', strtotime($data['fromdate'])) . "'" : $sql .= '';
            !empty($data['todate']) ? $sql .= " AND  date_format(payment_date,'%Y-%m-%d') <= '" . date('Y-m-d', strtotime($data['todate'])) . "'" : $sql .= '';
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
    
    

    public function getPaymentDetailById($orderid) {
        $sql = "SELECT a.*,b.user_name,b.user_email "
                . "from ibo_joining_payment_detail as a "
                . "join user_detail as b on a.user_id_user=b.id_user "
                . "where mpd_id='$orderid'";
        $result = $this->db->query($sql);
        return $result->getRow();
    }
        
    public function getIboUserDetail($iboid){
        $sql = "SELECT * from ibo_user where user_id_user='$iboid'";
        $result = $this->db->query($sql);
        return $result->getRow();
    }

}
