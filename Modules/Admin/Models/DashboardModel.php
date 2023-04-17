<?php

namespace Modules\Admin\Models;

use CodeIgniter\Model;

class DashboardModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUserCount() {
        $sql = "select user_type,count(id_user) count from users group by user_type order by user_type asc ";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function getPatientCount() {
        $sql = "select count(patient_id) count from patient_detail";
        $result = $this->db->query($sql);
        return $result->getRow()->count;
    }

    public function getAppointmentCount() {
        $sql = "select count(dhb_id) count from doctor_has_booking where booking_status in (2,4)";
        $result = $this->db->query($sql);
        return $result->getRow()->count;
    }

    public function getMonthlyAppointment() {
        $sql = "select count(dhb_id) count, MONTH(booking_date) month from doctor_has_booking where booking_status in(2,4) and YEAR(booking_date)='" . date('Y') . "' group by YEAR(booking_date),MONTH(booking_date)";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

    public function getMonthlyOnlineVsOfflineAppointment() {
        $sql = "select count(dhb_id) count, MONTH(booking_date) month,booking_from from doctor_has_booking where booking_status in(2,4) and YEAR(booking_date)='" . date('Y') . "' group by YEAR(booking_date),MONTH(booking_date),booking_from";
        $result = $this->db->query($sql);
        return $result->getResult();
    }

}
