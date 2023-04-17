<?php

namespace App\Models;

use CodeIgniter\Model;

class WebModel extends Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function getUserdetailByUsername($username){
         $sql = "SELECT id_user,user_code,user_title,user_name,user_mobile,user_email,user_login_name,user_type,user_dob,user_city,"
                . "user_login_key,user_last_login_date,user_need_pass_change,user_status,user_profile_pic "
                . "FROM user_detail join ibo_user on id_user=user_id_user "
                . "WHERE (user_code='$username' or user_login_name='$username') AND user_status in(1,2) ";

        $result = $this->db->query($sql);
        return $result->getRow();
    }
    

    public function getWebProducts() {
        $sql = "select product_id_product,web_display_image,b.product_name,product_sku from product_has_web_summery a join product b on product_id_product=product_id where display_on_web='1' and product_status=1 order by product_name";
        $result = $this->db->query($sql);
        $return = $result->getResult();
        return $return;
    }

    public function getProductDetailById($id) {
        $sql = "select a.*,b.product_name,product_sku,product_mrp from product_has_web_summery a join product b on product_id_product=product_id where display_on_web='1' and product_status=1 and product_id_product='$id'";
        $result = $this->db->query($sql);
        $return = $result->getRow();
        return $return;
    }
    
    public function getResourceDownload(){
        $sql = "select product_brochure,product_id_product,web_display_image,b.product_name,product_sku from product_has_web_summery a join product b on product_id_product=product_id where product_brochure !='' and product_status=1 order by product_name";
        $result = $this->db->query($sql);
        $return = $result->getResult();
        return $return;
    }

}
