<?php

namespace Modules\Admin\Controllers;

use Modules\Admin\Controllers\AdminController;
use Modules\Admin\Models\FranchiseModel;

class FranchiseController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->franchiseModel = new FranchiseModel();
    }

    public function index() {
        $this->data['js'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'franchise/franchiselist.php,common/common.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\franchise\franchiselist', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function edit($userid) {
        $this->data['js'] = 'alertify,lightbox,flatpickr,validation';
        $this->data['css'] = 'alertify,lightbox,flatpickr,validation';
        $this->data['includefile'] = 'franchise/franchiseedit.php,common/common.php';
        $iduser = base64_decode($userid);
        $userdetaildata = $this->franchiseModel->getFranchisedetailById($iduser);
        $this->data['userdetail'] = $userdetaildata;
        $this->data['encuserid'] = $userid;
        $this->data['password'] = $this->decryptToken($userdetaildata->user_login_key);
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\franchise\franchiseedit', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function updateFrabnchiseDetail() {
        $status = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $type = $this->request->getPost('type');
            $name = $this->request->getPost('name');
            $gstno = $this->request->getPost('gstno');

            $userid = base64_decode($this->request->getPost('encuser'));

            $updarray = array('user_name' => $name);
            $updafrrray = array('franchise_type' => $type, 'franchise_gst_no' => $gstno);

            $this->adminModel->updateRecordInTable($updarray, 'user_detail', 'id_user', $userid);
            $this->adminModel->updateRecordInTable($updafrrray, 'franchise_user', 'user_id_user', $userid);

            //--------create email-------
            //$objEmailTemplate = new Libraries\EmailTemplate();
            //$template = $objEmailTemplate->profileUpdationEmail($name);
            //$createarray = array('smtp_email_content' => $template, 'smtp_email_type' => 'Profile update Intimation ', 'smtp_sender_email' => COMMUNICATION_EMAIL, 'smtp_target_emails' => $email);
            //$this->adminModel->createRecordInTable($createarray, 'smtp_email');
            //---------create Email

            $status = array('status' => 'success', 'message' => 'Personal detail updateed Successfully');
        }
        echo json_encode($status);
        exit;
    }

    public function add() {
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                        'name' => 'required',
                        'type' => 'required',
                        'baseinventory' => 'required',
                        'paymentdetail' => 'required'
                    ])) {

                $this->session->setFlashdata('message', setMessage('Missing Required Field', 'e'));
            } else {
                $utr = $this->request->getPost('utr');
                $utrstatus = $this->blankModel->checkUTR($utr, 'user_detail');
                if ($utrstatus) {
                    $sponsorid = $this->request->getPost('hidval');
                    $name = $this->request->getPost('name');
                    $type = $this->request->getPost('type');
                    $baseinventory = $this->request->getPost('baseinventory');
                    $paymentdetail = $this->request->getPost('paymentdetail');
                    $address = $this->request->getPost('address');
                    $pincode = $this->request->getPost('pincode');
                    $postoffice = $this->request->getPost('postoffice');
                    $city = $this->request->getPost('city');
                    $district = $this->request->getPost('district');
                    $state = $this->request->getPost('state');
                    $country = $this->request->getPost('country');
                    $mobile = $this->request->getPost('mobile');
                    $whatsappno = $this->request->getPost('whatsappno');
                    $emailid = $this->request->getPost('emailid');
                    $gstno = $this->request->getPost('gstno');
                    $bankacno = $this->request->getPost('bankacno');
                    $bankifsc = $this->request->getPost('bankifsc');
                    $bankname = $this->request->getPost('bankname');
                    $bankbranch = $this->request->getPost('bankbranch');

                    $passphrase = createEpin(6);
                    $passwordnew = $this->encryptString($passphrase);

                    $userdetaildata = array(
                        'utr_no' => $utr,
                        "user_login_key" => $passwordnew,
                        "user_create_date" => date("Y-m-d H:i:s"),
                        "reporting_user_id" => $sponsorid,
                        'user_name' => $name,
                        'user_mobile' => $mobile,
                        'user_whatsappno' => $whatsappno,
                        'is_mobile_verified' => 1,
                        "user_email" => $emailid,
                        "user_address" => $address,
                        "user_pincode" => $pincode,
                        "user_post_office" => $postoffice,
                        "user_district" => $district,
                        "user_city" => $city,
                        "user_state" => $state,
                        "user_country" => $country,
                        "user_type" => 2,
                        "user_bank_ac_no" => $bankacno,
                        "user_bank_ifsc" => $bankifsc,
                        "user_bank_name" => $bankname,
                        "user_bank_branch" => $bankbranch
                    );
                    $iduser = $this->blankModel->createRecordInTable($userdetaildata, 'user_detail');
                    $frcreatearray = array('user_id_user' => $iduser, 'franchise_type' => $type, 'franchise_base_inventory' => $baseinventory, 'franchise_gst_no' => $gstno, 'franchise_balance' => $baseinventory);
                    $this->blankModel->createRecordInTable($frcreatearray, 'franchise_user');
                    $usercode = createUserCode($iduser);
                    $updarray = array('user_code' => $usercode);
                    $this->blankModel->updateRecordInTable($updarray, 'user_detail', 'id_user', $iduser);
                    $walletarray = array('utr_no' => $utr, 'user_id_user' => $iduser, 'wt_credit_amount' => $baseinventory, 'wallet_balance' => $baseinventory, 'wt_transaction_type' => 'Account Opening', 'wt_remark' => $paymentdetail);
                    $this->blankModel->createRecordInTable($walletarray, 'wallet_transaction');
                    $this->blankModel->transComplete();

                    if ($this->blankModel->transStatus() === false) {
                        $this->session->setFlashdata('message', setMessage("Something went wrong, Please try after some time", 'f'));
                        $this->blankModel->transRollback();
                    } else {
                        $this->blankModel->transCommit();
                        $this->session->setFlashdata('message', setMessage("Franchise added Successfully.", 's'));
//------------do  other functionality LINK SMS EMAIL-----
//----------------------------------------
                    }
                } else {
                    $this->session->setFlashdata('message', setMessage("multy time formsubmission not allowed", 'e'));
                }
            }
        }
        $this->data['js'] = 'validation,sweetalert';
        $this->data['css'] = 'validation,sweetalert';
        $this->data['includefile'] = 'franchise/franchiseadd.php,common/common.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\franchise\franchiseadd', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function swalletledger() {
        $this->data['js'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,choices,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'franchise/wallet.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\franchise\wallet', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function getFranchiseDetailById($id) {
        $result = $this->franchiseModel->getFranchiseDetailByCode($id);
        if (!empty($result)) {
            $return['data'] = $result;
            $return['status'] = "success";
            $return['message'] = "Franchise Found";
        } else {
            $return['message'] = "Franchise Not found";
            $return['status'] = "error";
            $return['id_user'] = 0;
        }
        echo json_encode($return);
        exit;
    }

    public function addwalletTransaction() {
        $return = array('message' => 'Unauthorides Access', 'status' => 'error');
        if ($this->request->isAJAX()) {
            $utr = $this->request->getPost('utr');
            $utrstatus = $this->blankModel->checkUTR($utr, 'wallet_transaction');
            if ($utrstatus) {
                $userid = trim($this->request->getPost('userid'));
                $remark = trim($this->request->getPost('remark'));
                $trnfor = trim($this->request->getPost('trnfor'));
                $amount = trim($this->request->getPost('amount'));
                $trntype = trim($this->request->getPost('trntype'));
                $balance = $this->blankModel->getTableData('franchise_balance', 'franchise_user', 'user_id_user=' . $userid);
                $walletarray = array('utr_no' => $utr, 'user_id_user' => $userid, 'wt_transaction_type' => $trnfor, 'wt_remark' => $remark);
                if ($trntype == 1) {
                    $newbalance = $balance->franchise_balance + $amount;
                    $walletarray['wt_credit_amount'] = $amount;
                } else {
                    $newbalance = $balance->franchise_balance - $amount;
                    $walletarray['wt_debit_amount'] = $amount;
                }
                if ($newbalance < 0) {
                    $return = array('message' => 'Insufficient Balance', 'status' => 'error');
                } else {
                    $walletarray['wallet_balance'] = $newbalance;
                    $this->blankModel->createRecordInTable($walletarray, 'wallet_transaction');
                    $updfranchise = array('franchise_balance' => $newbalance);
                    $this->blankModel->updateRecordInTable($updfranchise, 'franchise_user', 'user_id_user', $userid);
                    $return = array('message' => 'Transaction Added Successfuly, New Balance-' . $newbalance, 'status' => 'success');
                }
            } else {
                $return = array('message' => 'Dupliccate Entry', 'status' => 'error');
            }
        }

        echo json_encode($return);
        exit;
    }

    public function order() {
        $this->data['js'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'franchise/franchiseorder.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\franchise\franchiseorder', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function orderData() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $username = trim($this->request->getPost('username'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
            //$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->franchiseModel->selectFranchiseOrder($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedFranchiseOrderdata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    protected function fn_formatedFranchiseOrderdata($data, $offset = 0) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0;
                $x < count($arraydata);
                $x++) {
            $values = array();

            $action = '';
            $action .= '<a class="blue" title="View Detail" href="#" onclick=""><i class="fas fa-search"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

            if ($data[$x]->order_status == 'Approved' || $data[$x]->order_status == 'Dispatched' || $data[$x]->order_status == 'Delivered') {
                $action .= '<a class="blue" title="Print Invoice" href="#" onclick=""><i class="fas fa-print"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }if ($data[$x]->order_status == 'Approved') {
                $action .= '<a class="blue"  title="Dispatch Product" href="#" onclick=""><i class="fas fa-truck-moving"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }if ($data[$x]->order_status == 'Order Placed') {
                $action .= '<a class="blue"  title="Approve Order" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->fo_id) . '&#39;,2);"><i class="fas fa-check-circle"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                $action .= '<a class="blue"  title="Reject Order" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->fo_id) . '&#39;,3);"><i class="fas fa-times-circle"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }


            $arraydata[$x]->action = $action;
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    public function inventory() {
        $this->data['js'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['css'] = 'validation,flatpickr,datatable,sweetalert,alertify';
        $this->data['includefile'] = 'franchise/franchiseinventory.php';
        return view('\Modules\Admin\Views\templates\header', $this->data)
                . view('\Modules\Admin\Views\franchise\franchiseinventory', $this->data)
                . view('\Modules\Admin\Views\templates\footer', $this->data);
    }

    public function inventoryData() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $franchisecode = trim($this->request->getPost('usercode'));
            $productcode = trim($this->request->getPost('productcode'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];

            $data = array('frcode' => $franchisecode, 'prcode' => $productcode,);
            $userlist = $this->franchiseModel->selectFranchiseInventory($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedInventoryData($userlist['data'], $offset, $franchisecode);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    protected function fn_formatedInventoryData($data, $offset = 0, $franchisecode = NULL) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0;
                $x < count($arraydata);
                $x++) {
            $values = array();

            $action = '';
            if (!empty($franchisecode)) {
                if ($data[$x]->status == 'Available') {
                    $action .= '<a class="blue" title="Block Product For Billing" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->fi_id) . '&#39;,2);"><i class="fas fa-lock"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }if ($data[$x]->status == 'Blocked') {
                    $action .= '<a class="blue"  title="Unblock Product For Billing" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->fi_id) . '&#39;,1);"><i class="fas fa-lock-open"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            } else {
                $data[$x]->status = "-Na-";
            }

            $arraydata[$x]->action = $action;
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    public function franchisedata() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $mobile = trim($this->request->getPost('mobile'));
            $username = trim($this->request->getPost('username'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
//$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'mobile' => $mobile, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->franchiseModel->selectFranchise($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedFranchisedata($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function fn_formatedFranchisedata($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0;
                $x < count($arraydata);
                $x++) {
            $values = array();
            $action = '';
            $action .= '<a class="blue" target="_blank" title="Edit Detail"   href="' . ADMINPATH . 'franchise-edit/' . base64_encode($data[$x]->id_user) . '"><i class="fas fa-user-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
            if ($data[$x]->user_status == 'Active') {
                $action .= '<a class="blue" title="Block Account" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->id_user) . '&#39;,2);"><i class="fas fa-lock"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }if ($data[$x]->user_status == 'Blocked') {
                $action .= '<a class="blue"  title="Unblock Account" href="#" onclick="return updateStatus(&#39;' . base64_encode($data[$x]->id_user) . '&#39;,1);"><i class="fas fa-lock-open"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            }

            $arraydata[$x]->action = $action;
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

    public function franchisewalletdata() {
        $returndata = array();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $limit = trim($this->request->getPost('length'));
            $offset = trim($this->request->getPost('start'));
            $draw = trim($this->request->getPost('draw'));
            $name = trim($this->request->getPost('name'));
            $mobile = trim($this->request->getPost('mobile'));
            $username = trim($this->request->getPost('username'));
            $order = $this->request->getPost('order');
            $ordercolumn = $order[0]['column'];
            $orderdirecttion = $order[0]['dir'];
//$this->request->getPost('status') != '' ? $status = implode(',', $this->request->getPost('status')) : $status = '';
            $daterange = generateDateFromDateRange($this->request->getPost('daterange'));
            $data = array('name' => $name, 'mobile' => $mobile, 'username' => $username, 'fromdate' => $daterange['fromdate'], 'todate' => $daterange['todate']);
            $userlist = $this->franchiseModel->selectFranchiseWallet($data, $ordercolumn, $orderdirecttion, $offset, $limit);
            $returndata['data'] = $this->fn_formatedAddSlNo($userlist['data'], $offset);
            $returndata['draw'] = $draw;
            $returndata['recordsTotal'] = $userlist['record_count'];
            $returndata['recordsFiltered'] = $userlist['record_count'];
        }
        echo json_encode($returndata);
        die();
    }

    public function updateFranchiseInventoryStatus() {
        $data = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {

            $invetoryproduct = base64_decode($this->request->getPost('encproductid'));
            $status = $this->request->getPost('status');
            $updarray = array('is_available' => $status);
            if ($status == 1) {
                $message = "Inventory Product Unblocked Successfully";
            }if ($status == 2) {
                $message = "Inventory Product Blocked Successfully";
            }

            $this->adminModel->updateRecordInTable($updarray, 'franchise_inventory', 'fi_id', $invetoryproduct);

            $data = array('status' => 'success', 'message' => $message);
        }
        echo json_encode($data);
        exit;
    }

    public function franchiseInventoryProductsList() {
        $data = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $franchiseid = $this->request->getPost('frid');
            $frproduct = $this->franchiseModel->getFranchiseProduct($franchiseid, 1);
            $data = array('status' => 'success', 'message' => "Products found", "product" => $frproduct);
        }
        echo json_encode($data);
        exit;
    }

    public function addRemoveInventoryTransaction() {
        $return = array('message' => 'Unauthorides Access', 'status' => 'error');
        if ($this->request->isAJAX()) {
            $utr = $this->request->getPost('utr');
            $utrstatus = $this->blankModel->checkUTR($utr, 'franchise_inventory_audit');
            if ($utrstatus) {
                $userid = trim($this->request->getPost('userid'));
                $remark = trim($this->request->getPost('remark'));
                $product = trim($this->request->getPost('product'));
                $quantity = trim($this->request->getPost('quantity'));
                $trntype = trim($this->request->getPost('trntype'));
                $prodtype = trim($this->request->getPost('prodtype'));
                $balance = $this->blankModel->getTableData('fo_stock_amount,ro_stock_amount', 'franchise_inventory', 'fr_id_fr=' . $userid . ' AND product_id_product=' . $product);
                $invarray = array('utr_no' => $utr, 'fr_id_fr' => $userid, 'product_id_product' => $product, 'remark' => $remark, 'trn_type' => $trntype, 'product_type' => $prodtype, 'unit' => $quantity);
                $fonewbalance = $balance->fo_stock_amount;
                $ronewbalance = $balance->ro_stock_amount;
                if ($trntype == 1) {
                    if ($prodtype == 1) {
                        $fonewbalance = $balance->fo_stock_amount + $quantity;
                    } else {
                        $ronewbalance = $balance->ro_stock_amount + $quantity;
                    }
                } else {
                    if ($prodtype == 1) {
                        $fonewbalance = $balance->fo_stock_amount - $quantity;
                    } else {
                        $ronewbalance = $balance->ro_stock_amount - $quantity;
                    }
                }
                if ($prodtype == 1 && $fonewbalance < 0) {
                    $return = array('message' => 'Insufficient Balance', 'status' => 'error');
                } elseif ($prodtype == 2 && $ronewbalance < 0) {
                    $return = array('message' => 'Insufficient Balance', 'status' => 'error');
                } else {
                    $this->blankModel->createRecordInTable($invarray, 'franchise_inventory_audit');
                    $this->franchiseModel->updateInventory($userid, $product, $fonewbalance, $ronewbalance);
                    $return = array('message' => 'Transaction Added Successfuly, New Balance FO-' . $fonewbalance.' RO-'.$ronewbalance, 'status' => 'success');
                }
            } else {
                $return = array('message' => 'Dupliccate Entry', 'status' => 'error');
            }
        }

        echo json_encode($return);
        exit;
    }

    public function confirmRejectFranchiseOrder() {
        $data = array('status' => 'error', 'message' => 'Unauthorised access');
        if ($this->request->isAJAX()) {
            $orderid = base64_decode($this->request->getPost('orderid'));
            $status = $this->request->getPost('status');
            $coment = $this->request->getPost('coment');
            $updarray = array('order_status' => $status, 'order_update_by' => session()->get('userid'), 'remark' => $coment);
            $this->blankModel->updateRecordInTable($updarray, 'franchise_order', 'fo_id', $orderid);
            if ($status == 2) {
                $message = "Order Confirmed Successfully";
            }if ($status == 3) {
                $message = "Order rejected Successfully";
            }
            $data = array('status' => 'success', 'message' => $message);
        }
        echo json_encode($data);
        exit;
    }

}
