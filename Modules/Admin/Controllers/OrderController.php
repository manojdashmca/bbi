<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\OrderModel;
use Modules\Admin\Models\ProductModel;

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

    public function shippingdata() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $rderno = trim($this->request->getPost('rderno'));
            $mobile = trim($this->request->getPost('mobile'));
            $username = trim($this->request->getPost('username'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'rderno' => $rderno, 'mobile' => $mobile, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->orderModel->selectShippingOrder($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedshippingdata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedshippingdata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $action = '';
            $action .= '<a class="blue" title="View Detail" href="#" onclick=""><i class="fas fa-search"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            $action .= '<a class="blue" title="Print Lable" href="#" onclick=""><i class="fas fa-print"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            if ($data[$x]->shipping_status == "Waiting For Update") {
                $action .= '<a class="blue"  title="Packed" href="#" onclick="return updateShippingDetail(&#39;' . base64_encode($data[$x]->transaction_id) . '&#39;,&#39;pac&#39;);"><i class="fas fa-gift"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }if ($data[$x]->shipping_status == "Packaged" || $data[$x]->shipping_status == "Returned") {
                $action .= '<a class="blue" data-bs-toggle="modal" data-bs-target="#updateshipping" title="Dispatch Product" href="#" onclick="putTrnId(&#39;' . base64_encode($data[$x]->transaction_id) . '&#39;,&#39;' . $data[$x]->trn_order_no . '&#39;)"><i class="fas fa-shipping-fast"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }if ($data[$x]->shipping_status == "Shipped") {
                $action .= '<a class="blue"  title="Delivered" href="#" onclick="return updateShippingDetail(&#39;' . base64_encode($data[$x]->transaction_id) . '&#39;,&#39;del&#39;);"><i class="fas fa-check-circle"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                $action .= '<a class="blue"  title="Returned" href="#" onclick="return updateShippingDetail(&#39;' . base64_encode($data[$x]->transaction_id) . '&#39;,&#39;ret&#39;);"><i class="fas fa-reply"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $arraydata[$x]->action = $action;
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
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
            $rderno = trim($this->request->getPost('rderno'));
            $mobile = trim($this->request->getPost('mobile'));
            $username = trim($this->request->getPost('username'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'rderno' => $rderno, 'mobile' => $mobile, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
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
            $action .= '<a class="blue" title="View Detail" href="#" onclick=""><i class="fas fa-search"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

            if ($data[$x]->order_status == 'Approved') {
                $action .= '<a class="blue" title="Print Invoice" href="#" onclick=""><i class="fas fa-print"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }if ($data[$x]->order_status == 'Created') {
                $action .= '<a class="blue"  title="Approve Order" href="#" onclick="return updateTrnStatus(&#39;' . base64_encode($data[$x]->transaction_id) . '&#39;,2);"><i class="fas fa-check-circle"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                $action .= '<a class="blue"  title="Reject Order" href="#" onclick="return updateTrnStatus(&#39;' . base64_encode($data[$x]->transaction_id) . '&#39;,3);"><i class="fas fa-times-circle"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
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
            $orderid = base64_decode($this->request->getPost('encorderid'));
            $status = $this->request->getPost('status');
            $orderdetail = $this->orderModel->getOrderDetailById($orderid);
            if ($orderdetail->transaction_status == 1) {
                $this->blankModel->transStart();
                $iboupdarray = array();
                $updarray = array('approved_by' => session()->get('userid'), 'transaction_status' => $status, 'approved_date' => date('Y-m-d H:i:s'));
                if ($status == 2) {
                    //--------------co the calculation here----------
                    $ibodata = $this->orderModel->getIboUserDetail($orderdetail->user_id_user);
                    $transactionfor = $orderdetail->transaction_for;
                    $joiningtype = $ibodata->joining_type;
                    $cappingtype = $ibodata->capping_type;
                    if ($transactionfor == 1) {
                        $cumulative_fo = $ibodata->cumulative_fo;
                        $newcummulative_fo = $cumulative_fo + $orderdetail->total_mrp;
                        $ibostatus = $ibodata->user_is_active;
                        if ($joiningtype != 2) {
                            if ($newcummulative_fo >= 4000) {
                                $iboupdarray['joining_type'] = 2;
                            }
                        }
                        if ($ibostatus == 0) {
                            $iboupdarray['user_is_active'] = 1;
                            $iboupdarray['user_activation_date'] = date('Y-m-d H:i:s');
                            $iboupdarray['user_activation_type'] = 1;
                        }
                        $iboupdarray['cumulative_fo'] = $newcummulative_fo;
                    }
                    if ($transactionfor == 2) {
                        $cumulative_ro = $ibodata->cumulative_ro;
                        $newcummulative_ro = $ibodata->cumulative_ro + $orderdetail->total_dp;
                        if ($newcummulative_ro > 0 && $newcummulative_ro < 4000) {
                            $capping = 1;
                        } elseif ($newcummulative_ro >= 4000 && $newcummulative_ro < 20000) {
                            $capping = 2;
                        } elseif ($newcummulative_ro >= 20000 && $newcummulative_ro < 40000) {
                            $capping = 3;
                        } elseif ($newcummulative_ro >= 40000 && $newcummulative_ro < 80000) {
                            $capping = 4;
                        } elseif ($newcummulative_ro >= 80000) {
                            $capping = 5;
                        }
                        $iboupdarray['capping_type'] = $capping;
                        $iboupdarray['cumulative_ro'] = $newcummulative_ro;
                    }
                    $iboupdarray['last_update_date'] = date('Y-m-d H:i:s');
                    $this->adminModel->updateRecordInTable($iboupdarray, 'ibo_user', 'user_id_user', $orderdetail->user_id_user);
                    //-----------------------------------------------
                    $message = "Order Approved Successfully";
                }if ($status == 3) {
                    $message = "Order Rejected Successfully";
                }

                $this->adminModel->updateRecordInTable($updarray, 'ibo_order', 'transaction_id', $orderid);
                $this->blankModel->transComplete();
                if ($this->blankModel->transStatus() === false) {
                    $data = array('status' => 'success', 'message' => 'Technical error, please try after some time');
                    $this->blankModel->transRollback();
                } else {
                    $this->blankModel->transCommit();
                    $data = array('status' => 'success', 'message' => $message);
                }
            } else {
                $data = array('status' => 'error', 'message' => 'The order not in create state');
            }
        }
        echo json_encode($data);
        exit;
    }

    public function updateShippingStatus() {
        $data = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $trnid = base64_decode($this->request->getPost('encorderid'));
            $status = $this->request->getPost('status');
            $statusarray = array('pac' => 1, 'del' => 3, 'ret' => 4);
            $updarray = array('shipping_status' => $statusarray[$status]);

            $updstatus = $this->adminModel->updateRecordInTable($updarray, 'shipping_detail', 'order_id_order', $trnid);
            if ($updstatus) {
                $data = array('status' => 'success', 'message' => "Shipping Status Updated successfully");
            } else {
                $data = array('status' => 'error', 'message' => "Unable toupdate shipping");
            }
        }
        echo json_encode($data);
        exit;
    }

    public function updateShipping() {
        $data = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $trnid = base64_decode($this->request->getPost('trnid'));
            $shippingcompany = $this->request->getPost('shippingcompany');
            $awbno = $this->request->getPost('awbno');
            $updarray = array('shipping_status' => 2, 'shipping_date' => date('Y-m-d H:i:s'), 'shipping_company' => $shippingcompany, 'awb_no' => $awbno);

            $updstatus = $this->adminModel->updateRecordInTable($updarray, 'shipping_detail', 'order_id_order', $trnid);
            if ($updstatus) {
                $data = array('status' => 'success', 'message' => "Shipping Updated successfully");
            } else {
                $data = array('status' => 'error', 'message' => "Unable toupdate shipping");
            }
        }
        echo json_encode($data);
        exit;
    }

    public function addNewOrder() {
        $this->data['js'] = 'validation,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'order/orderadd.php';
        $this->productModel = new ProductModel();
        $this->data['allproduct'] = $this->productModel->getAllProduct();
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\order\orderadd', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function createOrder() {
        $this->productModel = new ProductModel();
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                        'fhidval' => 'required',
                        'fhiddentotal' => 'required',
                        'fpaymenttype' => 'required',
                        'fpaymentdetail' => 'required',
                        'fshippingname' => 'required',
                        'fshippingaddress' => 'required',
                        'fshippingstate' => 'required',
                        'fshippingpincode' => 'required',
                        'fshippingmobile' => 'required',
                        'orderproduct' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {
                $utr = $this->request->getPost('utr');
                $utrstatus = $this->blankModel->checkUTR($utr, 'ibo_order');
                if ($utrstatus) {
                    $iboid = $this->request->getPost('fhidval');
                    $shippingcharge = $this->request->getPost('fshipping');
                    $paymenttype = $this->request->getPost('fpaymenttype');
                    $paymentdetail = $this->request->getPost('fpaymentdetail');
                    $shippingname = $this->request->getPost('fshippingname');
                    $shippingaddress = $this->request->getPost('fshippingaddress');
                    $shippingstate = $this->request->getPost('fshippingstate');
                    $shippingpincode = $this->request->getPost('fshippingpincode');
                    $shippingmobile = $this->request->getPost('fshippingmobile');
                    $shippinglandmark = $this->request->getPost('fshippinglandmark');
                    $shippingemail = $this->request->getPost('fshippingemail');
                    $orderproducts = json_decode($this->request->getPost('orderproduct'));

                    $this->blankModel->transStart();
                    $createarray = array('utr_no' => $utr,
                        'transaction_date' => date('Y-m-d H:i:s'),
                        'user_id_user' => $iboid,
                        'payment_type' => $paymenttype,
                        'payment_detail' => $paymentdetail,
                        'courior_charge' => $shippingcharge,
                        'create_by' => session()->get('userid'),
                        'transaction_status' => 1,
                        'transaction_for' => 1);
                    $trnid = $this->blankModel->createRecordInTable($createarray, 'ibo_order');
                    $shippingarray = array('order_id_order' => $trnid, 'shipping_name' => $shippingname, 'shipping_address' => $shippingaddress,
                        'shipping_pincode' => $shippingpincode, 'shipping_state' => $shippingstate, 'shipping_landmark' => $shippinglandmark,
                        'shipping_mobile' => $shippingmobile, 'shipping_email' => $shippingemail);
                    $this->blankModel->createRecordInTable($shippingarray, 'shipping_detail');
                    $tproduct = $tunit = $tmrp = $tbp = $ttax = 0;
                    for ($x = 0; $x < count($orderproducts); $x++) {
                        $tproduct++;
                        $billedproductdetail = $this->productModel->getProductDetail($orderproducts[$x][0]);
                        $prdqty = $orderproducts[$x][4];
                        $totalmrp = $billedproductdetail->product_mrp * $prdqty;
                        $totalpv = $billedproductdetail->product_fop * $prdqty;
                        $totaltaxamount = $billedproductdetail->product_gst_on_mrp * $prdqty;
                        $tunit += $prdqty;
                        $tmrp += $totalmrp;
                        $tbp += $totalpv;
                        $ttax += $totaltaxamount;
                        $productarray = array('trn_id_trn' => $trnid, 'product_id_product' => $orderproducts[$x][0],
                            'iohp_total_mrp' => $totalmrp, 'iohp_total_pv' => $totalpv,
                            'iohp_unit' => $prdqty, 'iohp_tax_percent' => $billedproductdetail->product_tax_percent,
                            'iohp_tax_amount' => $totaltaxamount, 'iohp_cgst_percent' => $billedproductdetail->product_tax_percent / 2,
                            'iohp_cgst_amount' => $totaltaxamount / 2, 'iohp_sgst_percent' => $billedproductdetail->product_tax_percent / 2,
                            'iohp_sgst_amount' => $totaltaxamount / 2, 'iohp_billing_amt' => $totalmrp);
                        $this->blankModel->createRecordInTable($productarray, 'ibo_order_has_product');
                    }
                    $orderno = createOrderNo(1, 1, $trnid);
                    $updarraytrn = array('trn_order_no' => $orderno, 'total_no_of_product' => $tproduct,
                        'total_unit' => $tunit, 'total_mrp' => $tmrp, 'total_bp' => $tbp, 'total_tax' => $ttax,
                        'total_cgst' => $ttax / 2, 'total_sgst' => $ttax / 2, 'total_billing_amount' => $tmrp + $shippingcharge);
                    $this->blankModel->updateRecordInTable($updarraytrn, 'ibo_order', 'transaction_id', $trnid);

                    $this->blankModel->transComplete();

                    if ($this->blankModel->transStatus() === false) {
                        $this->session->setFlashdata('message', setMessage("Something went wrong, Please try after some time", 'f'));
                        $this->blankModel->transRollback();
                    } else {
                        $this->blankModel->transCommit();
                        $this->session->setFlashdata('message', setMessage("Order Placed Successfully. Order No-" . $orderno, 's'));
                    }
                } else {
                    $this->session->setFlashdata('message', setMessage("Multiple time form submission not allowed", 'e'));
                }
            }
        } else {
            $this->session->setFlashdata('message', setMessage("Method not allowed", 'e'));
        }
        return redirect()->to(ADMINPATH . '/order-add');
    }

    public function createRepurchaseOrder() {
        $this->productModel = new ProductModel();
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                        'rhidval' => 'required',
                        'rhiddentotal' => 'required',
                        'rpaymenttype' => 'required',
                        'rpaymentdetail' => 'required',
                        'rshippingname' => 'required',
                        'rshippingaddress' => 'required',
                        'rshippingstate' => 'required',
                        'rshippingpincode' => 'required',
                        'rshippingmobile' => 'required',
                        'rorderproduct' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {
                $utr = $this->request->getPost('rutr');
                $utrstatus = $this->blankModel->checkUTR($utr, 'ibo_order');
                if ($utrstatus) {
                    $iboid = $this->request->getPost('rhidval');
                    $shippingcharge = $this->request->getPost('rshipping');
                    $paymenttype = $this->request->getPost('rpaymenttype');
                    $paymentdetail = $this->request->getPost('rpaymentdetail');
                    $shippingname = $this->request->getPost('rshippingname');
                    $shippingaddress = $this->request->getPost('rshippingaddress');
                    $shippingstate = $this->request->getPost('rshippingstate');
                    $shippingpincode = $this->request->getPost('rshippingpincode');
                    $shippingmobile = $this->request->getPost('rshippingmobile');
                    $shippinglandmark = $this->request->getPost('rshippinglandmark');
                    $shippingemail = $this->request->getPost('rshippingemail');
                    $orderproducts = json_decode($this->request->getPost('rorderproduct'));

                    $this->blankModel->transStart();
                    $createarray = array('utr_no' => $utr,
                        'transaction_date' => date('Y-m-d H:i:s'),
                        'user_id_user' => $iboid,
                        'payment_type' => $paymenttype,
                        'payment_detail' => $paymentdetail,
                        'courior_charge' => $shippingcharge,
                        'create_by' => session()->get('userid'),
                        'transaction_status' => 1,
                        'transaction_for' => 2);
                    $trnid = $this->blankModel->createRecordInTable($createarray, 'ibo_order');
                    $shippingarray = array('order_id_order' => $trnid, 'shipping_name' => $shippingname, 'shipping_address' => $shippingaddress,
                        'shipping_pincode' => $shippingpincode, 'shipping_state' => $shippingstate, 'shipping_landmark' => $shippinglandmark,
                        'shipping_mobile' => $shippingmobile, 'shipping_email' => $shippingemail);
                    $this->blankModel->createRecordInTable($shippingarray, 'shipping_detail');
                    $tproduct = $tunit = $tdp = $tbp = $ttax = 0;
                    for ($x = 0; $x < count($orderproducts); $x++) {
                        $tproduct++;
                        $billedproductdetail = $this->productModel->getProductDetail($orderproducts[$x][0]);
                        $prdqty = $orderproducts[$x][4];
                        $totaldp = $billedproductdetail->product_dp * $prdqty;
                        $totalpv = $billedproductdetail->product_rop * $prdqty;
                        $totaltaxamount = $billedproductdetail->product_gst_on_dp * $prdqty;
                        $tunit += $prdqty;
                        $tdp += $totaldp;
                        $tbp += $totalpv;
                        $ttax += $totaltaxamount;
                        $productarray = array('trn_id_trn' => $trnid, 'product_id_product' => $orderproducts[$x][0],
                            'iohp_total_dp' => $totaldp, 'iohp_total_pv' => $totalpv,
                            'iohp_unit' => $prdqty, 'iohp_tax_percent' => $billedproductdetail->product_tax_percent,
                            'iohp_tax_amount' => $totaltaxamount, 'iohp_cgst_percent' => $billedproductdetail->product_tax_percent / 2,
                            'iohp_cgst_amount' => $totaltaxamount / 2, 'iohp_sgst_percent' => $billedproductdetail->product_tax_percent / 2,
                            'iohp_sgst_amount' => $totaltaxamount / 2, 'iohp_billing_amt' => $totaldp);
                        $this->blankModel->createRecordInTable($productarray, 'ibo_order_has_product');
                    }
                    $orderno = createOrderNo(2, 1, $trnid);
                    $updarraytrn = array('trn_order_no' => $orderno, 'total_no_of_product' => $tproduct,
                        'total_unit' => $tunit, 'total_dp' => $tdp, 'total_bp' => $tbp, 'total_tax' => $ttax,
                        'total_cgst' => $ttax / 2, 'total_sgst' => $ttax / 2, 'total_billing_amount' => $tdp + $shippingcharge);
                    $this->blankModel->updateRecordInTable($updarraytrn, 'ibo_order', 'transaction_id', $trnid);

                    $this->blankModel->transComplete();

                    if ($this->blankModel->transStatus() === false) {
                        $this->session->setFlashdata('message', setMessage("Something went wrong, Please try after some time", 'f'));
                        $this->blankModel->transRollback();
                    } else {
                        $this->blankModel->transCommit();
                        $this->session->setFlashdata('message', setMessage("Order Placed Successfully. Order No-" . $orderno, 's'));
                    }
                } else {
                    $this->session->setFlashdata('message', setMessage("Multiple time form submission not allowed", 'e'));
                }
            }
        } else {
            $this->session->setFlashdata('message', setMessage("Method not allowed", 'e'));
        }
        return redirect()->to(ADMINPATH . '/order-add');
    }

    public function getIBODetailByIdOrder($username) {
        $ordertype = $this->request->getVar('ordertype');
        $ibodetail = $this->adminModel->getIboShippingDetail($username);
        //print_r($ibodetail);
        if (!empty($ibodetail)) {
            if ($ibodetail->ibo_type == 2) {
                if ($ordertype == 'r') {
                    if ($ibodetail->is_first_order_placed == 0) {
                        $data = array('status' => 'error', 'message' => "IBO found, But first order not yet placed");
                    } else {
                        $data = array('status' => 'success', 'message' => "IBO found", 'data' => $ibodetail);
                    }
                } else if ($ordertype == 'f') {
                    $data = array('status' => 'success', 'message' => "IBO found", 'data' => $ibodetail);
                } else {
                    $data = array('status' => 'error', 'message' => "Technical error");
                }
            } else {
                $data = array('status' => 'error', 'message' => "IBO Found, But it need to upgrade as WBO");
            }
        } else {
            $data = array('status' => 'error', 'message' => "IBO Not Found");
        }
        echo json_encode($data);
        exit;
    }

}
