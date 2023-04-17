<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries;
use App\Models\BlankModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller {

    public function __construct() {
        $router = service('router');
        $trnid = $this->createTransactionId();
        session()->set('trnid', $trnid);
        $this->data['transactionid'] = $trnid;
        $this->session = session();
        $this->blankModel = new BlankModel();
        $this->Mylog = new Libraries\Mylog();
        $this->aesObj = new Libraries\AES(null, 'AeBbCcDdEe12345', 256);
        $this->controller = $router->controllerName();
        $this->method = $router->methodName();
        $this->data['css'] = 'default';
        $this->data['includefile'] = '';
        $this->data['js'] = 'default';
        $this->data['modals'] = [];
        $this->data['title'] = '';
        $this->data['session'] = $this->session;
        $this->data['methodname'] = $this->method;
        $this->data['controllername'] = $this->controller;
    }

    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'url', 'my'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        // E.g.: $this->session = \Config\Services::session();
    }

//---------------------userdefined methods-------------


    protected function createFailwerLogin($username, $password, $reason, $userid = 0) {
        $requestip = $this->request->getIPAddress();
        $platform = $this->request->getUserAgent()->getPlatform();
        $browser = $this->getBrowser(); // Platform info (Windows, Linux, Mac, etc.)
        $data = array("attempt_date_time" => date('Y-m-d H:i:s'), "user_id_user" => $userid, "attempt_user_login_id" => $username, "user_password" => $password, "attempt_ip" => $requestip, "attempt_os" => $platform, "attempt_browser" => $browser, "failwer_reason" => $reason);
        $this->blankModel->createRecordInTable($data, 'user_failwer_login_attempt');
    }

    protected function createSuccessLogin($userid) {
        $requestip = $this->request->getIPAddress();
        $platform = $this->request->getUserAgent()->getPlatform();
        $browser = $this->getBrowser(); // Platform info (Windows, Linux, Mac, etc.)
        $data = array("user_id_user" => $userid, "logged_date" => date('Y-m-d H:i:s'), "logged_ip" => $requestip, "logged_os" => $platform, "logged_browser" => $browser);
        $this->blankModel->createRecordInTable($data, 'user_log_history');
    }

    protected function getBrowser() {
        $agent = $this->request->getUserAgent();
        if ($agent->isBrowser()) {
            $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
        } elseif ($agent->isRobot()) {
            $currentAgent = $agent->getRobot();
        } elseif ($agent->isMobile()) {
            $currentAgent = $agent->getMobile();
        } else {
            $currentAgent = 'Unidentified User Agent';
        }
        return $currentAgent;
    }

    protected function createTransactionId($length = 6, $charset = '') {
        if (empty($charset)) {
            $charset = "123456789abcdefghmnpqrtuwABCDEFGHJKLMNPQRTUVWXY";
        }
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count - 1)];
        }
        return $str;
    }

    public function decryptToken($token) {
        $return = '';
        if (!empty($token)) {
            $this->aesObj->setData($token);
            $string = $this->aesObj->decrypt();
            $return = $string;
        }
        return $return;
    }

    public function encryptString($string) {
        $return = '';
        if (!empty($string)) {
            $this->aesObj->setData($string);
            $token = $this->aesObj->encrypt();
            $return = $token;
        }
        return $return;
    }

    public function fn_formatedAddSlNo($data, $offset) {
        $return = array();
        $arraydata = (array) $data;
        for ($x = 0; $x < count($arraydata); $x++) {
            $values = array();
            $values = array_values((array) $arraydata[$x]);
            $values[0] = $offset + $x + 1;
            $return[] = $values;
        }

        return $return;
    }

}
