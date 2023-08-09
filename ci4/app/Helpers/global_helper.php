<?php
require_once APPPATH."Libraries/PHPMailer/Exception.php";
require_once APPPATH."Libraries/PHPMailer/PHPMailer.php";
require_once APPPATH."Libraries/PHPMailer/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;

if(!function_exists('sendMail')){
    function sendMail($to, $subject, $body){
        mail(
            $to,
            $subject,
            $body,
            array(
                'Content-type' => 'text/html; charset=iso-8859-1',
                'From' => '',
                'Reply-To' => '',
                'X-Mailer' => 'PHP/' . phpversion()
            )
        );

    }
}
