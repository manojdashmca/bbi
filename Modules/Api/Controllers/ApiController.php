<?php

namespace Modules\Api\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Libraries;

class ApiController extends ResourceController {

    protected $format = 'json';

    public function __construct() {
        //parent::__construct();


        $this->aesObj = new Libraries\AES(null, null, 256);
        $this->aesObj->setKey('AlAbAmAzAtA');        
        $this->Mylog = new Libraries\Mylog();
    }

    public function index() {
//        echo "<br/>" . base_url();
//        echo "<br/>" . ROOTPATH;
//        echo "<br/>" . SYSTEMPATH;
//        echo "<br/>" . APPPATH;
//
//        $this->aesObj->setData('ManojDash');
//        echo "<br/>" . $token = $this->aesObj->encrypt();
//        $this->aesObj->setData($token);
//        echo "<br/>" . $this->aesObj->decrypt();
//
//        $this->data['methodname'] = 'dffdf';
//        $this->data['controllername'] = 'ddffdf';
//        $this->data['transactionid'] = createEpin();
//        $this->Mylog->debug('function executed successfully', $this->data);
        $data = array('name' => 'Manoj', 'age' => 24, 'father' => 'chintamani');
        return $this->respond($data);
    }

}
