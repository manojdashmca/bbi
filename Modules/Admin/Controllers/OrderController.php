<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\OrderModel;
use App\Libraries\EmailTemplate;

class OrderController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->orderModel = new OrderModel();
    }

    public function index() {
        $this->data['title'] = "Payments List";
        $this->checkAccessControll(4, 'm');
        $this->data['js'] = 'validation,lightbox,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,lightbox,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'order/orderlist.php';
        $this->data['module'] = $this->blankModel->getModuleDropDown();
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\order\orderlist', $this->data)
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
            $moduleid = trim($this->request->getPost('moduleid'));
            $status = trim($this->request->getPost('status'));
            $mobile = trim($this->request->getPost('mobile'));
            $username = trim($this->request->getPost('username'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('moduleid' => $moduleid, 'status' => $status, 'name' => $name, 'mobile' => $mobile, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
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
            if ($data[$x]->paymentproof) {
                $data[$x]->paymentproof = '<a href="/uploads/images/paymentproof/' . $data[$x]->paymentproof . '" class="image-popup" data-title="Payment Proof" data-description="Uploaded Payment Prooft">
                                                                <img src="/uploads/images/paymentproof/' . $data[$x]->paymentproof . '"  alt="ayment" height="60" width="120">
                                                            </a>';
            }
            $action = '';
            //$action .= '<a class="blue" title="View Detail" href="#" onclick=""><i class="fas fa-search"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            if (in_array(8, session()->get('accesscontrols'))) {
                if ($data[$x]->paymentstatus == 'Approved') {
                    //$action .= '<a class="blue" title="Print Invoice" href="#" onclick=""><i class="fas fa-print"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }if ($data[$x]->paymentstatus == 'Created') {
                    $action .= '<a class="blue"  title="Approve Order" href="#" onclick="return updateTrnStatus(&#39;' . base64_encode($data[$x]->mpd_id) . '&#39;,2);"><i class="fas fa-check-circle"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    $action .= '<a class="blue"  title="Reject Order" href="#" onclick="return updateTrnStatus(&#39;' . base64_encode($data[$x]->mpd_id) . '&#39;,3);"><i class="fas fa-times-circle"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
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
            $this->checkAccessControll(8, 'c', 0);
            $paymentid = base64_decode($this->request->getPost('encorderid'));
            $status = $this->request->getPost('status');
            $orderdetail = $this->orderModel->getPaymentDetailById($paymentid);
            if ($orderdetail->payment_status == 1) {
                $this->blankModel->transStart();
                $iboupdarray = array();
                $updarray = array('payment_approved_by' => session()->get('userid'), 'payment_status' => $status, 'payment_approve_comment' => 'Manual Approve by admin', 'payment_approve_reject_date' => date('Y-m-d H:i:s'));
                $invoicefile = '';
                if ($status == 2) {
                    $invoicefile = $this->invoiceHtml($paymentid);
                    $iboupdarray['approval_status'] = 1;
                    $message = "Payment Approved Successfully";
                    $this->adminModel->updateRecordInTable(array('user_status' => 1), 'user_detail', 'id_user', $orderdetail->user_id_user);
                }if ($status == 3) {
                    $iboupdarray['approval_status'] = 2;
                    $message = "Payment Rejected Successfully";
                }
                $objEmailTemplate = new EmailTemplate();
                //---------welcome email----------------
                $paymentstatus = array(2 => "Payment Approved @ SSK Bharat BBI", 3 => "Paymenr Rejected @ SSK Bharat BBI");
                $emailTemplate = $objEmailTemplate->paymentStatusEmail($orderdetail->user_name, $status);
                $emailarray = array('smtp_email_content' => $emailTemplate, 'smtp_email_type' => $paymentstatus[$status], 'smtp_sender_email' => NOREPLAY_EMAIL, 'smtp_target_emails' => $orderdetail->user_email);
                if (!empty($invoicefile)) {
                    $emailarray['smtp_attachment'] = $invoicefile;
                }
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

    protected function invoiceHtml($paymentid) {
        $invoice = $this->orderModel->getPaymentDetailById($paymentid);
        $html = "";
        $html .= '<div align="center">
<table style="margin: auto; font-family: \'Open Sans\', sans-serif; font-weight:400; font-size:13px; margin:0px; padding:0px; color:#231F20;" width="800" border="0" cellspacing="0" cellpadding="0" align="center" >
<tr>
                <td colspan="20" style="text-align: center; padding: 10px; font-size: 20px; font-weight: 600; border-bottom: 1px solid #000;">TAX INVOICE	</td>
            </tr>';
        $html .= '
            <tr>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="3" rowspan="3">
                    <b>SSK BHARAT BUSINESS BUILDING INITIATIVE PVT. LTD. </b><br/>
                    HEH-380 E 1 1 PATEL CHAWL, PATEL CHAWL, JAIHIND NGR SERVICE ROAD,<br/>
                    MUMBAI CITY, EX HIGHWAY MUMBAI<br/>
                    GSTIN/UIN: 27ABJCS6587P1Z6<br/>
                    State Name :  Maharashtra, Code : 27
                </td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="5">Invoice No.<br/>
                    <b>' . $invoice->mpd_id . '/SSKBBI/' . dateToFiscal($invoice->payment_date) . '</b>
                </td>
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="5">Dated<br/>
                    <b>' . date('d-M-y', strtotime($invoice->payment_date)) . '</b>
                </td>
            </tr>
            <tr >
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="5">Delivery Note <br/><b>Virtual Product</b></td>
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="5">Mode/Terms of Payment<br/><b>' . $invoice->payment_method . '</b></td>
            </tr>
            <tr >
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="5">Reference No. & Date. <br/><b>' . date('d-M-y', strtotime($invoice->payment_date)) . '</b></td>
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="5">Other References<br/><b>-NA-</b></td>

            </tr>
            <tr >
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="3" rowspan="3">Consignee (Ship to)<br/>
                    <b>' . $invoice->business_name . '</b><br/>' . $invoice->business_address . '
                    <br/>';
        if (!empty($invoice->gst_registered)) {
            $html .= 'GSTIN/UIN  : ' . $invoice->gst_no . '<br/>
                    State Name : ';
        } else {
            $html .= 'GSTIN/UIN  : -NA-<br/>
                    State Name : ';
        }

        $html .= '                    
                </td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="5">Buyer\'s Order No<br/>
                    <b>' . $invoice->user_code . '</b>
                </td>
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="5">Dated<br/>
                    <b>' . date('d-M-y', strtotime($invoice->payment_date)) . '</b>
                </td>
            </tr>            
            <tr>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="5">Dispatch Doc No. <br/><b>-NA-</b></td>
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="5">Delivery Note Date<br/><b>Instant / ' . date('d-M-y', strtotime($invoice->payment_date)) . '</b></td>
            </tr>
            <tr>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="5">Dispatched through <br/><b>-NA-</b></td>
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="5">Destination<br/><b>-NA-</b></td>

            </tr>
            <tr >
                
            </tr>
            <tr>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top; border-right:none" colspan="3">Buyer (Bill to)<br/>
                    <b>' . $invoice->business_name . '</b><br/>' . $invoice->business_address . '<br/>';
        if (!empty($invoice->gst_registered)) {
            $html .= 'GSTIN/UIN  : ' . $invoice->gst_no . '<br/>
                    State Name : ';
        } else {
            $html .= 'GSTIN/UIN  : -NA-<br/>
                    State Name : ';
        }
        $html .= '
                </td>
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="10" >
                    Terms of Delivery<br/>
                </td>
            </tr>
            <tr >
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" width="5%">SI<br/>No.</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2">Particulars</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2">HSN/SAC</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2">Quantity</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="3">Rate</td>                
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="3" align="right">Amount</td>
            </tr>
            <tr >
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;">1</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2"><b>Membership Fees</b>
                    <br/>';
        if (!empty($invoice->topup_fee)) {
            $html .= '<b style="float:right">Account Top-Up Fee <br/>';
        }
        $html .= '        <b style="float:right">CGST 9% <br/>
                        SGST 9%</b>

                </td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2"></td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" ><b>1</b>';
        if (!empty($invoice->topup_fee)) {
            $html .= '<br/><b>' . $invoice->topup_fee / 5000 . '</b>';
        }
        $html .= '        </td>
                <td style="text-align:right;padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="3">' . number_format((float) $invoice->joining_fee, 2, '.', '');
        if (!empty($invoice->topup_fee)) {
            $html .= '<br/>' . number_format((float) 5000, 2, '.', '');
        }
        $html .= '    </td>
                
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="3" align="right"><b>' . number_format((float) $invoice->joining_fee, 2, '.', '') . '<br/>';
        if (!empty($invoice->topup_fee)) {
            $html .= '<b>' . number_format((float) $invoice->topup_fee, 2, '.', '') . '</b><br/>';
        }
        $html .= number_format((float) $invoice->gst / 2, 2, '.', '') . '<br/>' . number_format((float) $invoice->gst / 2, 2, '.', '') . '</b></td>
            </tr>
            <tr >
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;"></td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" align="right">Total</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2"></td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2"></td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="3"></td>                
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="3" align="right"><b style="font-size:15px">₹ ' . number_format((float) $invoice->payment_amount, 2, '.', '') . '</b></td>
            </tr> 
            <tr>
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="13">
                    Amount Chargeable (in words)<span style="float:right;font-style: italic;"> E. &amp;O.E</span><br/>
                    <b>INR ' . ucwords(no_to_words($invoice->payment_amount)) . ' Only</b></td>
            </tr>
            <tr >
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" rowspan="2" width="30%">HSN/SAC</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" rowspan="1" rowspan="2" align="center" width="15%">Taxable<br/>Value</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="4" align="center" width="20%">Central Tax</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="4" align="center" width="20%">State Tax</td>
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" rowspan="2" align="center">Total<br/>Tax Amount</td>
            </tr>  

            <tr>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" align="center">Rate</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" align="center">Amount</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" align="center">Rate</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" align="center">Amount</td>
            </tr>
            <tr >
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2"></td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" align="center" >' . number_format((float) ($invoice->joining_fee + $invoice->topup_fee), 2, '.', '') . '</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" align="center">18%</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" align="center">' . number_format((float) $invoice->gst / 2, 2, '.', '') . '</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" align="center">18%</td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" align="center">' . number_format((float) $invoice->gst / 2, 2, '.', '') . '</td>
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" align="center" >' . number_format((float) $invoice->gst, 2, '.', '') . '</td>
            </tr>
            <tr>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2"></td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" align="center" ><b>' . number_format((float) ($invoice->joining_fee + $invoice->topup_fee), 2, '.', '') . '</b></td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" align="center"></td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" align="center"></td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" align="center"></td>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" align="center"></td>
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="2" align="center" ></td>
            </tr>
            <tr >
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="13">Tax Amount (in words)  : <b>INR ' . ucwords(no_to_words($invoice->gst)) . ' Only</b></td>
            </tr>

            <tr>
                <td style="padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="3"></td>
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="10">for <b>SSK BHARAT BUSINESS BUILDING INITIATIVE PVT. LTD. </b>
                    <br/><br/><br/><span style="float:right">Authorised Signatory  </span></td>
            </tr>
            <tr >
                <td style="border-right: 1px solid #000; padding:5px 8px; border-bottom: 1px solid #000; border-left: 1px solid #000; vertical-align: top;" colspan="13" align="center" style="padding:10px 0">Computer generated invoice therefore not require signature</td>
            </tr>
</table></div>';

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('./uploads/emailattachments/' . $invoice->user_code . '.pdf', 'F');
        return $invoice->user_code . '.pdf';
    }
}
