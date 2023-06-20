<?php

namespace App\Controllers;

#use Razorpay\Api\Api;
#use Razorpay\Api\Errors\SignatureVerificationError;
use App\Libraries;

class UserController extends WebController {

    public function __construct() {
        parent::__construct();
        $this->keyId = 'rzp_test_rZSAbrBcnr1KG7';
        $this->keySecret = 'VJNd6lTlPZ3VVJzdWgytFr8s';
    }



   

   
   
//-----------------helper function section--------------
//    protected function rozerpayCheckout($paymentamount, $orderno) {
//        $userprofile = $this->webModel->getUserProfile($this->session->get('userid'));
//
//        $api = new Api($this->keyId, $this->keySecret);
//        $orderData = [
//            'receipt' => $orderno,
//            'amount' => $paymentamount * 100, // 2000 rupees in paise
//            'currency' => 'INR',
//            'payment_capture' => 1 // auto capture
//        ];
//
//        $razorpayOrder = $api->order->create($orderData);
//        $razorpayOrderId = $razorpayOrder['id'];
//        $amount = $orderData['amount'];
//        $data = [
//            "key" => $this->keyId,
//            "amount" => $amount,
//            "name" => "Medserve",
//            "description" => "",
//            "image" => CUSTOMPATH . "assets/img/pg_logo.PNG",
//            "prefill" => [
//                "name" => $userprofile->user_name,
//                "email" => $userprofile->user_email,
//                "contact" => $userprofile->user_mobile,
//            ],
//            "notes" => [
//                "address" => "",
//                "merchant_order_id" => $orderno,
//            ],
//            "theme" => [
//                "color" => "#F37254"
//            ],
//            "order_id" => $razorpayOrderId,
//        ];
//
//        $this->data['rz_data'] = $data;
//        $this->session->set('rzp_orderid', $razorpayOrderId);
//    }

}
