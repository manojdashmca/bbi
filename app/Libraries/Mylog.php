<?php

namespace App\Libraries;
use CodeIgniter\I18n\Time;
class Mylog {

    protected $_date_fmt = 'D, d M y H:i:s.u';

    public function __construct($name = '', $options = null) {
        
    }

    /*
     * 1=>critical
     * 2=>alert
     * 3=>error
     * 4=>warning
     * 5=>notice
     * 6=>info
     * 7=>debug
     * 8=>custom
     * 9=>special
     */

    public function logInternal($message, $type, $time, array $context = []) {
        //define(LOGFILEPATH, './writable/Mylog/' . date("Y-m-d"));
        $logpath = '../writable/Mylog/' . date("Y-m-d");
        $logfile = "log";        
        $type_str = '';
        if ($type == 'error' || $type == 'ERROR' || $type == 3) {
            if (!file_exists($logpath . '/error/')) {
                mkdir($logpath . '/error', 0777, true);
            }
            $filepath = $logpath . '/error/' . $logfile . '.log';
            $type_str = 'ERROR';
        } else if ($type == 'debug' || $type == 'DEBUG' || $type == 7) {
            if (!file_exists($logpath . '/debug')) {                
                mkdir($logpath . '/debug', 0777, true);
            }
            $filepath = $logpath . '/debug/' . $logfile . '.log';
            $type_str = 'DEBUG';
        } else if ($type == 'info' || $type == 'INFO' || $type == 6) {
            if (!file_exists($logpath . '/info')) {
                mkdir($logpath . '/info', 0777, true);
            }
            $filepath = $logpath . '/info/' . $logfile . '.log';
            $type_str = 'INFO';
        } else if ($type == 'warning' || $type == 'WARNING' || $type == 4) {
            if (!file_exists($logpath . '/warning')) {
                mkdir($logpath . '/warning', 0777, true);
            }
            $filepath = $logpath . '/warning/' . $logfile . '.log';
            $type_str = 'WARNING';
        } else {
            if (!file_exists($logpath . '/all')) {
                mkdir($logpath . '/all', 0777, true);
            }
            $filepath = $logpath . '/all/' . $logfile . '.log';
            $type_str = 'ALL';
        }
        if (!$fp = @fopen($filepath, 'ab')) {
            return FALSE;
        }

        $msg = '';
        if ($context != null && count($context) > 0) {
            $msg .= '[' . $time . '][' . $type_str . '][' . $context['transactionid'] . ']';
            $msg .= '[' . $context['controllername'] . '->' . $context['methodname'] . '()]';
            if ($type == 'error' || $type == 'ERROR' || $type == 3) {
                $msg .= '[' . $context['status'] . ']' . $message . "\n";
            } else {
                $msg .= $message . "/" . "\n";
            }
        } else {
            $msg .= '[' . $time . '][' . $type_str . ']';
            $msg .= $message . "\n";
        }


        flock($fp, LOCK_EX);
        fwrite($fp, $msg);
        flock($fp, LOCK_UN);
        fclose($fp);

        @chmod($filepath, FILE_WRITE_MODE);
        return TRUE;
    }

    public function debug($message, array $context = []) {
        $time = $this->getMicrotime();
        $type = "DEBUG";
        $this->logInternal($message, $type, $time, $context);
    }

    public function error($message, array $context = []) {
        $time = $this->getMicrotime();
        $type = "ERROR";
        $this->logInternal($message, $type, $time, $context);
    }

    public function getMicrotime() {
        $now= Time::createFromFormat('U.u', microtime(true), 'Asia/Kolkata');;
        //$now = DateTime::createFromFormat('U.u', microtime(true));
        $date = $now->format($this->_date_fmt);
        return $date;
    }

}

?>