<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class AdminModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUserdetailByUsername($username) {
        $sql = "SELECT id_user,user_code,user_name,user_mobile,user_email,user_login_name,user_type,"
                . "user_login_key,user_last_login_date,user_need_pass_change,user_status,user_profile_pic "
                . "FROM user_detail join admin_user on id_user=user_id_user "
                . "WHERE (user_code='$username' or user_login_name='$username' or user_email='$username' or user_mobile='$username') AND user_status in(1,2) ";

        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function getSegment() {
        $sql = "select segment_id,segment_name from master_segment where segment_status=1 ";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function getCategoryBySegment($segment) {
        $sql = "select category_id,category_name from master_category where segment_id_segment='$segment' and category_status=1 ";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function getSubCategoryByCategorySegment($category = '', $segment = '') {
        $sql = "select sub_category_id,sub_category_name from master_sub_category where sub_category_status=1 ";
        if (!empty($category)) {
            $sql .= " AND category_id_category='$category'";
        }if (!empty($segment)) {
            $sql .= " AND segment_id_segment='$segment'";
        }

        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function getAllocatedSubcategoryByModule($module) {
        $sql = "SELECT group_concat(business_subcategory) as subcategory from ibo_business_detail join user_detail on user_id_user=id_user where module_id_module='$module' and approval_status in(0,1) ";
        $result = $this->db->query($sql);
        return $result->getRow()->subcategory;
    }

    public function checkUserEmail($email, $userid = '') {

        $sql = "SELECT count(id_user) count FROM   user_detail  WHERE user_status !=3 AND user_email = '$email' ";

        if (!empty($userid)) {
            $sql .= " AND id_user !=$userid";
        }

        $result = $this->db->query($sql);
        return $result->getRow()->count;
    }

    public function checkUserMobile($mobile, $userid = '') {

        $sql = "SELECT count(id_user) count FROM  user_detail  WHERE user_status !=3 AND user_mobile = '$mobile' ";
        if (!empty($userid)) {
            $sql .= " AND id_user !=$userid";
        }
        
        $result = $this->db->query($sql);
        return $result->getRow()->count;
    }

    public function checkUserPan($pan, $userid = '') {

        $sql = "SELECT count(id_user) count FROM   user_detail WHERE user_status !=3 AND user_pan = '$pan' ";
        if (!empty($userid)) {
            $sql .= " AND id_user !=$userid";
        }
        $result = $this->db->query($sql);
        return $result->getRow()->count;
    }

}
