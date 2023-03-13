<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



// Application specific global variables

class Globals

{

    private static $authenticatedMemberId = null;

    private static $initialized = false;

    private static function initialize()

    {

        if (self::$initialized)

            return;



        self::$authenticatedMemberId = null;

        self::$initialized = true;
    }



    public static function setAuthenticatedMemeberId($memberId)

    {

        self::initialize();

        self::$authenticatedMemberId = $memberId;
    }





    public static function authenticatedMemeberId()

    {

        self::initialize();

        return self::$authenticatedMemberId;
    }
    function sendEmail($to, $name, $subject, $content)
    {
        require_once(APPPATH . '/libraries/phpmailer/class.phpmailer.php');
        require_once(APPPATH . '/libraries/phpmailer/class.smtp.php');
        $usernameSmtp = 'mations88@gmail.com'; //  AKIA4H45CLBRDNNBQ4NW
        $passwordSmtp = 'ytsptbaatkcovtxc';  // amkbkhqvdvjfoojb BBhUIbTmBLQkalYzuYFoRFjnWZRXhzkiyod+qfGtxvME
        $host = 'smtp.gmail.com';
        $port = 587;
        $sender = 'no-reply@timviec365.com.vn';
        $senderName = 'Zendo.vn';

        $mail             = new PHPMailer(true);

        $mail->SMTPSecure = 'ssl'; //secure transfer enabled
        $mail->IsSMTP();
        $mail->SetFrom($sender, $senderName);
        $mail->Username   = $usernameSmtp;  // khai bao dia chi email
        $mail->Password   = $passwordSmtp;              // khai bao mat khau   
        $mail->Host       = $host;    // sever gui mail.
        $mail->Port       = $port;         // cong gui mail de nguyen 
        $mail->SMTPAuth   = true;    // enable SMTP authentication
        $mail->SMTPSecure = "tls";   // sets the prefix to the servier        
        $mail->CharSet  = "utf-8";
        $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
        // xong phan cau hinh bat dau phan gui mail
        $mail->isHTML(true);
        $mail->Subject    = $subject; // tieu de email 
        $mail->Body       = $content;
        $mail->addAddress($to, $name);
        // var_dump($mail);
        // echo 1;
        // die;
        if (!$mail->Send()) {
            echo $mail->ErrorInfo;
        } else {
            return true;
        }
    }
}
