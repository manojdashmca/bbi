<?php

namespace Modules\Franchise\Models;

use CodeIgniter\Model;

class FranchiseModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUsers() {
        $sql = "select * from users";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function getDoctorDetailById($doctorid) {
        $sql = "SELECT a.*,dd.*,"
                . "sp_doctor_designation,sp_image "
                . "FROM users a join doctor_detail dd on id_user=dd.user_id_user "
                . "LEFT JOIN specialities sp on doctor_specialities=sp_id "
                . "WHERE user_type=2 and id_user='$doctorid' ";

        $result = $this->db->query($sql);
        return $result->getRow();
    }

    public function selectAppointments($data, $ordercolumn = 3, $orderdirecttion = 'desc', $offset = 0, $limit = 10) {
        try {
            $return = array();
            $columnarray = array('patient_name', 'uhid', 'booking_date', 'patient_gender', '', 'booking_status');
            $sql = "select SQL_CALC_FOUND_ROWS patient_name,uhid,patient_gender,dhp_id,"
                    . "booking_date,booking_slot,c.user_mobile,c.user_district,c.user_state,"
                    . "(select count(dhb_id) from doctor_has_booking where doctor_id_user='" . $data['doctorid'] . "' and booking_status=4) consultcount, "
                    . "CASE booking_status "
                    . "WHEN '1' THEN '<span class=\"badge badge-pill bg-warning-light\">Pending</span>' "
                    . "WHEN '2' THEN '<span class=\"badge badge-pill bg-info-light\">Booked</span>' "
                    . "WHEN '3' THEN '<span class=\"badge badge-pill bg-danger-light\">Cancelled</span>' "
                    . "WHEN '4' THEN '<span class=\"badge badge-pill bg-success-light\">Completed</span>' "
                    . "WHEN '5' THEN '<span class=\"badge badge-pill bg-primary-light\">Rescheduled</span>' END as status,"
                    . "if(isnull(user_profile_pic),'default.jpg',user_profile_pic) profilepic,booking_status,dhb_id "
                    . "FROM doctor_has_booking as a "
                    . "JOIN patient_detail as b on a.patient_id_user=b.patient_id "
                    . "JOIN users as c on b.user_id_user=c.id_user  "
                    . "LEFT JOIN doctor_has_prescription on dhb_id_dhb=dhb_id "
                    . "WHERE c.user_type =3 and a.doctor_id_user='" . $data['doctorid'] . "'";
            !empty($data['uhid']) ? $sql .= " AND  b.uhid = '" . $data['uhid'] . "'" : $sql .= '';
            !empty($data['status']) ? $sql .= " AND  a.booking_status = '" . $data['status'] . "'" : $sql .= '';   
            !empty($data['name']) ? $sql .= " AND  b.patient_name like '%" . $data['name'] . "%'" : $sql .= '';   
            !empty($data['date']) ? $sql .= " AND  booking_date = '" . $data['date'] . "'" : $sql .= '';
            !empty($data['gdate']) ? $sql .= " AND  booking_date > '" . $data['gdate'] . "'" : $sql .= '';
            !empty($data['startdate']) ? $sql .= " AND  booking_date >= '" . date('Y-m-d',strtotime($data['startdate'])) . "'" : $sql .= ''; 
            !empty($data['enddate']) ? $sql .= " AND  booking_date <= '" . date('Y-m-d',strtotime($data['enddate'])) . "'" : $sql .= ''; 
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

    public function getTotalPatient($doctorid = '', $clinic = '') {
        $sql = "select count(distinct(uhid)) as count "
                . "from patient_detail "
                . "join doctor_has_booking on patient_id_user=patient_id "
                . " where booking_status in (2,4) ";
        if (!empty($clinic)) {
            $sql .= "and clinic_id_clinic in ($clinic) ";
        }if (!empty($doctorid)) {
            $sql .= "and doctor_id_user =$doctorid ";
        }
        $result = $this->db->query($sql);
        return $result->getRow()->count;
    }

    public function getTodayTotalPatient($doctorid = '', $clinic = '') {
        $sql = "select count(distinct(patient_id_user)) as count "
                . "from doctor_has_booking "
                . " where booking_status in (4) and booking_date = '" . date('Y-m-d') . "'";
        if (!empty($clinic)) {
            $sql .= "and clinic_id_clinic in ($clinic) ";
        }if (!empty($doctorid)) {
            $sql .= "and doctor_id_user =$doctorid ";
        }
        $result = $this->db->query($sql);
        return $result->getRow()->count;
    }

    public function getTotalAppointments($doctorid = '', $clinic = '') {
        $sql = "select count(dhb_id) as count "
                . "from doctor_has_booking "
                . " where booking_status in (2,4) ";
        if (!empty($clinic)) {
            $sql .= "and clinic_id_clinic in ($clinic) ";
        }if (!empty($doctorid)) {
            $sql .= "and doctor_id_user =$doctorid ";
        }
        $result = $this->db->query($sql);
        return $result->getRow()->count;
    }

    public function getBookingDetailById($bookingid) {
        $sql = "SELECT doctor_id_user,patient_id_user,clinic_id_clinic,total_booking_amount,taxes,user_id_user,a.user_name,b.user_name as patient_name,b.user_email,booking_date,booking_slot,dhb_id,booking_payment_id,clinic_name,booking_status  "
                . "from doctor_has_booking "
                . "JOIN clinic_location on cl_id=clinic_id_clinic "
                . "join users a on doctor_id_user=a.id_user "
                . "JOIN patient_detail on patient_id=patient_id_user "
                . "JOIN users b on user_id_user=b.id_user "
                . "where dhb_id='$bookingid'";

        $result = $this->db->query($sql);
        $return = $result->getRow();
        return $return;
    }

    public function getDoctorBusinessHr($doctid = null, $dhbhid = null) {
        $sql = "SELECT * FROM doctor_has_business_hr "
                . "WHERE 1=1";
        if (!empty($doctid)) {
            $sql .= " AND user_id_user='$doctid'";
        } if (!empty($dhbhid)) {
            $sql .= " AND dhbh_id='$dhbhid'";
        }

        $result = $this->db->query($sql);
        $return = $result->getRow();
        return $return;
    }

    public function getPatientList($data, $offset, $limit) {
        $return = array();
        try {
            $sql = "SELECT SQL_CALC_FOUND_ROWS distinct(uhid) as uhid,patient_name,patient_gender,patient_dob,patient_blood_group,"
                    . "if(isnull(user_profile_pic),'default.jpg',user_profile_pic) profilepic,user_mobile,user_district,user_state,patient_create_date "
                    . "from patient_detail pd "
                    . "JOIN users on pd.user_id_user=users.id_user "
                    . "JOIN doctor_has_booking on patient_id_user = patient_id "
                    . "where booking_status in(2,4)";
            !empty($data['doctor']) ? $sql .= " AND  doctor_id_user = '" . $data['doctor'] . "'" : $sql .= '';
            !empty($data['uhid']) ? $sql .= " AND  uhid = '" . $data['uhid'] . "'" : $sql .= '';
            !empty($data['name']) ? $sql .= " AND  patient_name like '%" . $data['name'] . "%'" : $sql .= '';
            $sql .= " order by patient_create_date desc limit $offset,$limit";

            $sql1 = "SELECT FOUND_ROWS() as count";
            $result = $this->db->query($sql);
            $result1 = $this->db->query($sql1);
            $return['data'] = $result->getResult();
            $return['record_count'] = $result1->getRow()->count;
        } catch (Exception $e) {
            $this->createModelError($e, 'Distributor', 'selectDistributor');
        }
        return $return;
    }

    public function getPatientBookings($uhid) {
        $sql = "SELECT doctor_id_user,dhb_id,sp_doctor_designation,user_name,if(isnull(user_profile_pic),'default.jpg',user_profile_pic) profilepic,booking_date,booking_slot,relation_to_master_user,booking_created_date,booking_status,total_booking_amount "
                . "FROM doctor_has_booking JOIN users on doctor_id_user=id_user "
                . "JOIN patient_detail on patient_id_user=patient_id "
                . "JOIN doctor_detail on doctor_detail.user_id_user=doctor_id_user "
                . "LEFT JOIN specialities on doctor_specialities=sp_id "
                . " WHERE patient_detail.uhid='$uhid'";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function getPatientPrescriptions($uhid) {
        $sql = "SELECT dhp_id,prescription_created_date,sp_doctor_designation,user_name,if(isnull(user_profile_pic),'default.jpg',user_profile_pic) profilepic,relation_to_master_user "
                . "FROM doctor_has_prescription "
                . "JOIN users on doctor_id_user=id_user "
                . "JOIN patient_detail on patient_id_patient=patient_id "
                . "JOIN doctor_detail on doctor_detail.user_id_user=doctor_id_user "
                . "LEFT JOIN specialities on doctor_specialities=sp_id "
                . " WHERE patient_detail.uhid='$uhid'";

        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function getPatientMedicalReport($uhid) {
        $sql = "SELECT a.*,uhid,user_name,if(isnull(user_profile_pic),'default.jpg',user_profile_pic) profilepic,user_type "
                . "FROM patient_has_medical_report a join users on uploader_id_user=id_user "
                . "JOIN patient_detail on patient_id_patient=patient_id "
                . "where  uhid='$uhid' and medical_report_status=1";
        $result = $this->db->query($sql);
        $return = $result->getResult();
        return $return;
    }

    public function getPatientDetail($uhid) {
        $sql = "SELECT patient_id,uhid,patient_name,patient_gender,patient_dob,patient_blood_group,"
                . "if(isnull(user_profile_pic),'default.jpg',user_profile_pic) profilepic,user_mobile,user_district,user_state "
                . "from patient_detail pd "
                . "JOIN users on pd.user_id_user=users.id_user "
                . "where uhid ='$uhid'";
        
        $result = $this->db->query($sql);
        $return = $result->getRow();
        return $return;
    }
    
    public function getPrescriptionDetailByBookingId($bookingid){
        $sql="SELECT * from doctor_has_prescription where dhb_id_dhb='$bookingid'";        
        $result = $this->db->query($sql);
        $return = $result->getRow();
        return $return;
    }
    
    public function getPrescriptionDetailById($dhpid){
        $sql="SELECT a.*,b.*,c.uhid "
                . "from doctor_has_prescription a "
                . "JOIN prescription_has_medication b on dhp_id=dhp_id_dhp "
                . "JOIN patient_detail c on patient_id=patient_id_patient where dhp_id='$dhpid' and medication_status=1";        
        $result = $this->db->query($sql);
        $return = $result->getResult();
        return $return;
    }
    
    public function getSuggestedMedinice($name){
        $sql="SELECT name,composition from medicinename where name like '$name%' limit 0,5";        
        $result = $this->db->query($sql);
        $return = $result->getResult();
        return $return;
    }
    
    public function getSuggestedLabtest($name){
        $sql="SELECT test_name name from diagnostic_tests where test_name like '$name%' limit 0,5";        
        $result = $this->db->query($sql);
        $return = $result->getResult();
        return $return;
    }

}
