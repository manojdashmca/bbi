<?php

namespace App\Helpers;

class Myhelper {
    /*     * ******************************* 
     * Purpose : To generate QRcode
     * @param : $data, $text
     * @return: NA
     * Author: Manoj 
     * Created on : 10/05/2016
     * last modified: 10/05/2016
     * last modified by: Manoj
     * version : 1.0    
     * ****************************** */

    public function generateQRcode($url, $text) {
        require_once APPPATH . 'vendor/PHPBarQrCode/BarcodeQR.php';
        $qr = new \BarcodeQR();
        $qr->url($url);
        $qr->draw(150, './public/dist/img/invoiceimg/qr_' . $text . '.png');
        return 'dist/img/invoiceimg/qr_' . $text . '.png';
    }

    /*     * ******************************* 
     * Purpose : Matches with is the string available tn the array or not
     * @param : $passwordarray, $newpassword
     * @return: true or false
     * Author: Manoj 
     * Created on : 10/05/2016
     * last modified: 10/05/2016
     * last modified by: Manoj
     * version : 1.0
     * ****************************** */

    public function matchLastPasswords($passwordarray, $newpassword) {
        $return = false;
        for ($x = 0; $x < count($passwordarray); $x++) {
            if (trim($passwordarray[$x]->user_password) == trim($newpassword)) {
                $return = true;
            }
        }
        return $return;
    }

    /*     * ******************************* 
     * Purpose : To generate a hexdecimal string from the given string
     * @param : $string
     * @return: hexa decimal string $hex
     * Author: Manoj 
     * Created on : 10/05/2016
     * last modified: 10/05/2016
     * last modified by: Manoj
     * version : 1.0
     * ****************************** */

    public function String2Hex($string) {
        $hex = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $hex .= dechex(ord($string[$i]));
        }
        return $hex;
    }

    /*     * ******************************* 
     * Purpose : to decode hexadecimal string to get the actual string
     * @param : $hex
     * @return: decoded hexademal string $string
     * Author: Manoj 
     * Created on : 10/05/2016
     * last modified: 10/05/2016
     * last modified by: Manoj
     * version : 1.0
     * ****************************** */

    public function Hex2String($hex) {
        $string = '';
        for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
            $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
        }
        return $string;
    }

    /*     * ******************************* 
     * Purpose : To generate micro time
     * @param : NA
     * @return: m-d-Y H:i:s.u
     * Author: Manoj 
     * Created on : 10/05/2016
     * last modified: 10/05/2016
     * last modified by: Manoj
     * version : 1.0
     * ****************************** */

    public function getMicrotime() {
        $now = DateTime::createFromFormat('U.u', microtime(true));
        $date = $now->format("m-d-Y H:i:s.u");
        return $date;
    }

    /*     * ******************************* 
     * Purpose : To change the date format
     * @param : $date, $format = 'd-m-Y H:i:s'
     * @return: formated date as $return
     * Author: Manoj 
     * Created on : 10/05/2016
     * last modified: 10/05/2016
     * last modified by: Manoj
     * version : 1.0
     * ****************************** */

    public function makeDate($date, $format = 'd-m-Y H:i:s') {
        if (empty($date)) {
            $return = '';
        } else {
            $date = str_replace('/', '-', $date);
            $return = date($format, strtotime($date));
        }
        return $return;
    }

    /*     * ******************************* 
     * Purpose : To resize an image and mentain the aspect ratio
     * @param : $imagepath(Source Path), $resizewidth(Target Width)
     * @return: NA
     * Author: Manoj 
     * Created on : 10/05/2016
     * last modified: 10/05/2016
     * last modified by: Manoj
     * version : 1.0
     * ****************************** */

    public function no_to_words($no) {
        $words = array('0' => '', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine', '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'forteen', '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty', '30' => 'thirty', '40' => 'fourty',
            '50' => 'fifty', '60' => 'sixty', '70' => 'seventy', '80' => 'eighty', '90' => 'ninty',
            '100' => 'hundred ', '1000' => 'thousand', '100000' => 'lakh', '10000000' => 'crore');
        if ($no == 0) {
            return ' ';
        } else {
            $novalue = '';
            $highno = $no;
            $remainno = 0;
            $value = 100;
            $value1 = 1000;
            while ($no >= 100) {
                if (($value <= $no) && ($no < $value1)) {
                    $novalue = $words["$value"];
                    $highno = (int) ($no / $value);
                    $remainno = $no % $value;
                    break;
                }
                $value = $value1;
                $value1 = $value * 100;
            }
            if (array_key_exists("$highno", $words)) {
                return $words["$highno"] . " " . $novalue . " " . $this->no_to_words($remainno);
            } else {
                $unit = $highno % 10;
                $ten = (int) ($highno / 10) * 10;
                return $words["$ten"] . " " . $words["$unit"] . " " . $novalue . " " . $this->no_to_words($remainno);
            }
        }
    }

    public function indianMoney($number) {
        //$number = 190908100.25;
        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                        " " . $digits[$counter] . $plural . " " . $hundred :
                        $words[floor($number / 10) * 10]
                        . " " . $words[$number % 10] . " "
                        . $digits[$counter] . $plural . " " . $hundred;
            } else
                $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ?
                " " . $words[$point / 10] . " " .
                $words[$point = $point % 10] : '';
        return ucwords(strtolower($result . "Rupees  " . $points . " Paise only"));
    }

    /*     * ******************************* 
     * Purpose : To resize an image and mentain the aspect ratio
     * @param : $imagepath(Source Path), $resizewidth(Target Width)
     * @return: NA
     * Author: Manoj 
     * Created on : 10/05/2016
     * last modified: 10/05/2016
     * last modified by: Manoj
     * version : 1.0
     * ****************************** */

    public function createids($id) {
        if ($id > 0 && $id < 10) {
            $nid = "000" . $id;
        }
        if ($id > 9 && $id < 100) {
            $nid = "00" . $id;
        }
        if ($id > 99 && $id < 1000) {
            $nid = "0" . $id;
        }
        if ($id > 999 && $id < 10000) {
            $nid = $id;
        }

        $userid = "USER" . "-" . $nid;
        return $userid;
    }

    /*     * ******************************* 
     * Purpose : To resize an image and mentain the aspect ratio
     * @param : $imagepath(Source Path), $resizewidth(Target Width)
     * @return: NA
     * Author: Manoj 
     * Created on : 10/05/2016
     * last modified: 10/05/2016
     * last modified by: Manoj
     * version : 1.0
     * ****************************** */

    public function get_random_numbers($limit = 0) {
        if ($limit > 0) {
            $this->random_numbers_length = $limit;
        }
        $result = '';
        for ($i = 0; $i < $this->random_numbers_length; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }

    /*     * ******************************* 
     * Purpose : To resize an image and mentain the aspect ratio
     * @param : $imagepath(Source Path), $resizewidth(Target Width)
     * @return: NA
     * Author: Manoj 
     * Created on : 10/05/2016
     * last modified: 10/05/2016
     * last modified by: Manoj
     * version : 1.0
     * ****************************** */

    public function sendSMS($mobile, $msgtxt, $templateid) {
        if (SEND_SMS) {
            $mobile = ltrim($mobile, '0');
            if (strlen($mobile) == 10) {
                try {
                    $authKey = "151305ApYCgRCjNo3o590c1351";
                    $mobileNumber = $mobile;
                    $senderId = SMS_SENDER_ID;
                    $message = urlencode($msgtxt);
                    $route = 4;

                    $postData = array(
                        'authkey' => $authKey,
                        'mobiles' => '91' . $mobileNumber,
                        'message' => $message,
                        'sender' => $senderId,
                        'route' => $route,
                        'DLT_TE_ID' => $templateid
                    );

                    $url = "http://sms.adityahosting.com/api/sendhttp.php";
                    $ch = curl_init();
                    curl_setopt_array($ch, array(
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POST => true,
                        CURLOPT_POSTFIELDS => $postData
                            //,CURLOPT_FOLLOWLOCATION => true
                    ));

                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    return $output;
                } catch (Exception $e) {
                    return "Error In message Sending";
                }
            } else {
                return "Invalid Mobile No";
            }
        } else {
            return "SMS Blocked";
        }
    }

    /*     * ******************************* 
     * Purpose : To resize an image and mentain the aspect ratio
     * @param : $imagepath(Source Path), $resizewidth(Target Width)
     * @return: NA
     * Author: Manoj 
     * Created on : 10/05/2016
     * last modified: 10/05/2016
     * last modified by: Manoj
     * version : 1.0
     * ****************************** */

    public function createEpin($length = 6, $charset = '') {
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

    public function setMessage($text, $type = 'i') {
        $array = array("s" => "alert-success", "4" => "alert-success", "i" => "alert-info", "2" => "alert-info", "e" => "alert-danger", "1" => "alert-danger", "w" => "alert-warning", "3" => "alert-warning");
        $texts = array("s" => "Success!", "4" => "Success!", "i" => "Note!", "2" => "Note!", "e" => "Error!", "1" => "Error!", "w" => "Warning!", "3" => "Warning");
        $msg = '<div class="alert ' . $array[$type] . ' alert-dismissable fade show" role="alert">';
        $msg .= '<strong>' . $texts[$type] . ' </strong>';
        $msg .= $text;
        $msg .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        $msg .= '</div>';
        return $msg;
    }

    function sendEmail($data) {
        require_once __DIR__ . '/../ThirdParty/PHPMailer/smtp.php';
        require_once __DIR__ . '/../ThirdParty/PHPMailer/phpmailer.php';
        $template = $data['template'];
        $tomailid = $data['to'];
        array_key_exists("cc", $data) ? $cc = $data['cc'] : $cc = '';
        array_key_exists("bcc", $data) ? $bcc = $data['bcc'] : $bcc = '';
        array_key_exists("heading", $data) ? $heading = $data['heading'] : $heading = '';
        array_key_exists("attachment", $data) ? $attachment = $data['attachment'] : $attachment = '';
        $subject = $data['subject'];
        $deliverytime = NULL;
        $status = false;
        $mail = new \PHPMailer();
        $mail->IsSMTP();                               // Set mailer to use SMTP
        $mail->Host = 'mail.indiangeniussearch.com';              // Specify main and backup server
        $mail->Port = 465;              // Set the SMTP port
        $mail->SMTPAuth = true;                        // Enable SMTP authentication
        $mail->Username = 'registration@indiangeniussearch.com';          // SMTP username
        $mail->Password = 'India@2022';      // SMTP password
        $mail->SMTPSecure = 'ssl';        // Enable encryption, 'ssl' also accepted

        $mail->From = 'registration@indiangeniussearch.com';
        $mail->FromName = 'Team Indian Genious Search';
        $mail->AddAddress($tomailid);  // Add a recipient
        $mail->IsHTML(true);           // Set email format to HTML
        if (!empty($attachment)) {
            for ($x = 0; $x < count($attachment); $x++)
                $mail->AddAttachment($attachment[$x]);
        }
        //$mail->MailerDebug = true;
        //$mail->SMTPDebug = 4;
        $mail->Subject = $subject; //'Here is the subject';
        $mail->Body = $template; //'This is the HTML message body <strong>in bold!</strong>';
        $mail->AltBody = '';
        try {
            if (!$mail->Send()) {
                //echo 'Mailer Error: ' . $mail->ErrorInfo;
                $status = false;
                //exit;
            } else {
                $status = true;
            }
        } catch (Exception $e) {
            $status = false;
        }

        return $status;
    }

    function yearMonthDiff($startyr, $endyr = '') {        
        if(empty($endyr)){
            $endyr=date('m-Y');
        }

        $date_diff = abs(strtotime($endyr) - strtotime($startyr));

        $years = floor($date_diff / (365 * 60 * 60 * 24));
        $months = floor(($date_diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        
       $string=$years. 'Year/s '.$months .'Month/s';
       return $string;
    }

}
