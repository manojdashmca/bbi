<?php

namespace App\Libraries;

class EmailTemplate {

    function __construct() {
        
    }

    /*     * ******************************* 
     * Purpose : To create the reset password template
     * @param : $newpassword, $userid, $logid = NULL, $idkey = NULL
     * @return: true or false
     * Author: Manoj 
     * Created on : 10/05/2016
     * last modified: 10/05/2016
     * last modified by: Manoj
     * version : 1.0
     * ****************************** */

    public function emailHeader() {
        $content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <title>' . COMPANYNAME . ' Mailer</title>
                        </head>
                        <body>
                            <table width="750" border="0" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;" cellpadding="0" cellspacing="0">
                                <tr style="background: url(' . base_url() . '/mailer/header_bg.jpg); height:90px; width:100%">
                                    <td  width="310" align="left" style="padding-left:10px;"><img height="46" src="' . base_url() . '/mailer/logo.png"/></td>
                                    <td width="430" align="right" style="padding-right:10px;">
                                        Office No.13, Amrut Madhura,<br>
                                        RSC 28, Sector 3, Opp. Apna Bazaar,<br/>
                                        Charkop Market,Kandivali West<br/>
                                        Mumbai, Maharastra, India-400067<br/>
                                        +91 816 949 1109,+91 937 239 0109 <br/>
					Email- support@sskbbi.in<br/>
                                        Website- www.sskbbi.in
                                    </td>
                                </tr>
                                <tr>
                                <td colspan="2" valign="top" style="padding-top:20px; padding-left:15px;">';
        return $content;
    }

    /*     * ******************************* 
     * Purpose : To create the reset password template
     * @param : $newpassword, $userid, $logid = NULL, $idkey = NULL
     * @return: true or false
     * Author: Manoj 
     * Created on : 10/05/2016
     * last modified: 10/05/2016
     * last modified by: Manoj
     * version : 1.0
     * ****************************** */

    public function emailFooter() {
        $content = '</td>
                    </tr>
                    <tr>
                        <td style="padding-bottom:20px; padding-left:15px;" colspan="2">    
                            <br/><br/><br/>Best regards,<br/><br/>SSK Bharat BBI
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td colspan="2"><br/>This email was sent from an email address that can\'t receive emails. Please don\'t reply to this email. <i>The information in this e-mail may be confidential and/or legally privileged.  It is intended solely for the use of the addressee.  Access to this e-mail by anyone else is unauthorized.  If you are not the intended recipient, any disclosure, copying, distribution or any action taken or omitted to be taken in reliance on it, is prohibited and may be unlawful</i></td>
                    </tr>
                    <td style="background: url(' . base_url() . '/mailer/footer_bg.png) repeat-x; height:60px; width:100%"  colspan="2"  ><span style="float:left; padding-left:20px; margin-top:35px;">All right reserved, Allay Healthcare 2010-' . date('Y') . '</span>
                        <span style="float:right; padding-right:20px; padding-top:15px;">
                            <p style="text-align:center">
                                    <!--Facebook icon-->
                                    <a href="http://facebook.com" target="_blank"><img alt="" src="' . base_url() . '/mailer/facebook.png" style="height:30px; width:30px" /></a>&nbsp;&nbsp;&nbsp;
                                    <!--Google+ icon-->
                                    <a href="http://plus.google.com" target="_blank"><img alt="" src="' . base_url() . '/mailer/g+.png" style="height:30px; width:30px" /></a>&nbsp;&nbsp;&nbsp;
                                    <!--Twitter icon-->
                                    <a href="http://twitter.com" target="_blank"><img alt="" src="' . base_url() . '/mailer/twitter.png" style="height:30px; width:30px" /></a>&nbsp;&nbsp;&nbsp;
                                    <!--Linkedin icon-->
                                    <a href="http://linkedin.com" target="_blank"><img alt="" src="' . base_url() . '/mailer/linkedin.png" style="height:30px; width:30px" /></a>&nbsp;&nbsp;&nbsp;
                                    <!--You tube icon-->
                                    <a href="http://youtube.com" target="_blank"><img alt="" src="' . base_url() . '/mailer/youtube.png" style="height:30px; width:30px" /></a>
                              </p>
                        </span></td>
                    </tr>
                    
                    </table>
                    </body>
                    </html>';
        return $content;
    }

    /*     * ******************************* 
     * Purpose : To create the reset password template
     * @param : $newpassword, $userid, $logid = NULL, $idkey = NULL
     * @return: true or false
     * Author: Manoj 
     * Created on : 10/05/2016
     * last modified: 10/05/2016
     * last modified by: Manoj
     * version : 1.0
     * ****************************** */

    public function createTemplate($body) {
        $template = $this->emailHeader() . $body . $this->emailFooter();
        return $template;
    }

    public function changePasswordEmail($username) {
        $contentdata = "Dear " . $username . ",";
        $contentdata .= "<p>You just changed your password, If not done please contact to site admin. </p>";
        $content = $this->createTemplate($contentdata);
        return $content;
    }

//    public function resetPasswordLink($username, $link) {
//        $contentdata = "Dear " . $username . ",";
//        $contentdata .= "<p>A request was received, hopefully from you, to reset your accounts password. Please go to the below page to reset your password and be able to access the application</p>";
//        $contentdata .= "<p><a href='" . $link . "'>" . $link . "</a></p>";
//        $contentdata .= "<p>Please ignore this message if you did not request to reset your account password.</p>";
//        $content = $this->createTemplate($contentdata);
//        return $content;
//    }

    public function registrationEmail($username, $emailid, $password) {
        $contentdata = "Dear " . $username . ",";
        $contentdata .= "<p>Below is your login cridential to login to the application. Please change your password on first login.<p>";
        $contentdata .= "<p>URL-: " . base_url() . "</p>";
        $contentdata .= "<p>User Name-: " . $emailid . "</p>";
        $contentdata .= "<p>Password-: " . $password . "</p>";
        $contentdata .= "<p>Note-: Account activation is subject to payment confirmation, Once the payment get confirmed you will get communicated.</p>";
        $template = $this->createTemplate($contentdata);
        return $template;
    }

    public function welcomeEmail($username) {
        $contentdata = "Dear " . $username . ",";
        $contentdata .= "<p>On behalf of the entire team at SSK BHARAT BBI, I am delighted to welcome you to our organization! We are thrilled that you have decided to join our team and be a part of our business building initiative.<p>";
        $contentdata .= "<p>At SSK BHARAT BBI, our mission is to help business people like you connect with others in the industry, and provide a nurturing environment for growth and success. Our goal is to help you expand your network, find new opportunities, and take your business to new heights.</p>";
        $contentdata .= "<p>We understand that every member of our organization has unique skills and talents, and we are committed to providing the resources and support you need to thrive. We believe that by working together, we can achieve great things and make a positive impact on the business world.</p>";
        $contentdata .= "<p>We look forward to getting to know you and working with you to achieve your goals. Please feel free to reach out to us if you have any questions or if there is anything we can do to support you.</p>";
        $contentdata .= "<p>Once again, welcome to SSK BHARAT BBI. We are excited to have you as a part of our team and look forward to working with you!</p>";
        $template = $this->createTemplate($contentdata);
        return $template;
    }

    public function forgotpasswordEmail($username, $password) {
        $contentdata = "Dear " . $username . ",";
        $contentdata .= "<p>A request was received, hopefully from you, to reset your accounts password. Below is user login password and use the same to access the application</p>";
        $contentdata .= "<p>Password:- $password</p>";
        $contentdata .= "<p>To ensure your account security, please change the password.</p>";
        $content = $this->createTemplate($contentdata);
        return $content;
    }

    public function paymentStatusEmail($username, $status) {
        $contentdata = "Dear " . $username . ",";
        if ($status == 2) {
            $contentdata .= "<p>Your Payment has been approved. Now you can login to your SSK Bharat BBI account. </p>";
            $contentdata .= "<p>Note-To ensure your account security, please change the password after your first login.</p>";
        } else {
            $contentdata .= "<p>Your Payment has been rejected by admin. For more detail please conctact support team on the mentioned communication detail. </p>";
        }
        $content = $this->createTemplate($contentdata);
        return $content;
    }

}
