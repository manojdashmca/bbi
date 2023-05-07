<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class DashboardModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUserCount() {
        $sql = "select user_type,count(id_user) count from user_detail group by user_type order by user_type asc ";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function getIboWalletBalance($userid = null) {
        if (empty($userid)) {
            $sql = "SELECT coalesce(sum(ibo_wallet_balance)) as sum from ibo_user ";
        } else {
            $sql = "SELECT coalesce(ibo_wallet_balance) as sum from ibo_user where user_id_user='$userid' ";
        }
        $result = $this->db->query($sql);
        return $result->getRow()->sum;
    }

    public function franchiseWalletBalance($userid = null) {
        if (empty($userid)) {
            $sql = "SELECT coalesce(sum(franchise_balance)) as sum from franchise_user ";
        } else {
            $sql = "SELECT coalesce(franchise_balance) as sum from franchise_user where user_id_user='$userid' ";
        }
        $result = $this->db->query($sql);
        return $result->getRow()->sum;
    }

    public function getTotalBusinessByDate($startdate, $enddate) {
        $sql = "SELECT coalesce(sum(total_billing_amount))- coalesce(sum(total_tax))- coalesce(sum(courior_charge)) as totalbusiness from ibo_order where transaction_status=2 and date_format(transaction_date,'%Y-%m-%d') >='$startdate' and date_format(transaction_date,'%Y-%m-%d') <='$enddate' ";

        $result = $this->db->query($sql);
        return $result->getRow()->totalbusiness;
    }

    public function getPayoutAmountByDate($startdate, $enddate) {
        return 0;
    }

    public function getProductWiseSales($startdate, $enddate) {
        $sql = "select product_name,coalesce(sum(iohp_total_dp))+coalesce(sum(iohp_total_mrp)) as amount "
                . "from ibo_order_has_product join product on product_id_product=product_id "
                . "join ibo_order on trn_id_trn=transaction_id where transaction_status=2 and transaction_date >='" . $startdate . "' and transaction_date <='" . $enddate . "' ";

        $result = $this->db->query($sql);
        return $result->getResult();
    }

}
