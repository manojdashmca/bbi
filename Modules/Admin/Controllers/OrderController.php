<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\OrderModel;
use Modules\Admin\Models\ProductModel;
use App\Libraries\EmailTemplate;
class OrderController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->orderModel = new OrderModel();
    }

    public function index() {
        $this->data['js'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'order/orderlist.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\order\orderlist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function manageShipping() {
        $this->data['js'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'order/ordermanageshipping.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\order\ordermanageshipping', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function monthlytaxstatement() {
        $this->data['js'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'filter.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\order\datatable', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function orderdata() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            //$rderno = trim($this->request->getPost('rderno'));
            $mobile = trim($this->request->getPost('mobile'));
            $username = trim($this->request->getPost('username'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'mobile' => $mobile, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->orderModel->selectIBOOrder($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedorderdata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedorderdata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $action = '';
            //$action .= '<a class="blue" title="View Detail" href="#" onclick=""><i class="fas fa-search"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

            if ($data[$x]->paymentstatus == 'Approved') {
                //$action .= '<a class="blue" title="Print Invoice" href="#" onclick=""><i class="fas fa-print"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }if ($data[$x]->paymentstatus == 'Created') {
                $action .= '<a class="blue"  title="Approve Order" href="#" onclick="return updateTrnStatus(&#39;' . base64_encode($data[$x]->mpd_id) . '&#39;,2);"><i class="fas fa-check-circle"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                $action .= '<a class="blue"  title="Reject Order" href="#" onclick="return updateTrnStatus(&#39;' . base64_encode($data[$x]->mpd_id) . '&#39;,3);"><i class="fas fa-times-circle"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $arraydata[$x]->action = $action;
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    public function updateOrderStatus() {
        $data = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $paymentid = base64_decode($this->request->getPost('encorderid'));
            $status = $this->request->getPost('status');
            $orderdetail = $this->orderModel->getPaymentDetailById($paymentid);
            if ($orderdetail->payment_status == 1) {
                $this->blankModel->transStart();
                $iboupdarray = array();
                $updarray = array('payment_approved_by' => session()->get('userid'), 'payment_status' => $status, 'payment_approve_comment' => 'Manual Approve by admin', 'payment_approve_reject_date' => date('Y-m-d H:i:s'));
                if ($status == 2) {
                    $iboupdarray['approval_status'] = 1;
                    $message = "Payment Approved Successfully";
                    $this->adminModel->updateRecordInTable(array('user_status' => 1), 'user_detail', 'id_user', $orderdetail->user_id_user);
                }if ($status == 3) {
                    $iboupdarray['approval_status'] = 2;
                    $message = "Payment Rejected Successfully";
                }
                $objEmailTemplate = new Libraries\EmailTemplate();
                //---------welcome email----------------
                $paymentstatus=array(2=>"Payment Approved @ SSK Bharat BBI",3=>"Paymenr Rejected @ SSK Bharat BBI");
                $emailTemplate = $objEmailTemplate->paymentStatusEmail($orderdetail->user_name, $status);
                $emailarray = array('smtp_email_content' => $emailTemplate, 'smtp_email_type' => $paymentstatus[$status], 'smtp_sender_email' => COMMUNICATION_EMAIL, 'smtp_target_emails' => $orderdetail->user_email);
                $this->adminModel->createRecordInTable($emailarray, 'smtp_email');
                $this->adminModel->updateRecordInTable($iboupdarray, 'ibo_business_detail', 'paymentdetail_id', $paymentid);
                $this->adminModel->updateRecordInTable($updarray, 'ibo_joining_payment_detail', 'mpd_id', $paymentid);
                $this->blankModel->transComplete();
                if ($this->blankModel->transStatus() === false) {
                    $data = array('status' => 'success', 'message' => 'Technical error, please try after some time');
                    $this->blankModel->transRollback();
                } else {
                    $this->blankModel->transCommit();
                    $data = array('status' => 'success', 'message' => $message);
                }
            } else {
                $data = array('status' => 'error', 'message' => 'The Payment not in create state');
            }
        }
        echo json_encode($data);
        exit;
    }

}
