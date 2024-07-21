<?php
    namespace MyMail;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require_once 'PHPMailer/src/Exception.php';
    require_once 'PHPMailer/src/PHPMailer.php';
    require_once 'PHPMailer/src/SMTP.php';

    class Mailer{
        public $send = false;

        public function __construct(){
            $this->send = new PHPMailer();
            $this->send->isSMTP();
        }

        // send reset mail
        public function regemail($email, $subject, $content){
            $this->send->Host = 'smtp.hostinger.com';            
            $this->send->Port = 465;

            $this->send->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

            $this->send->SMTPAuth = true;

            $this->send->Username = 'example@me.com';            
            $this->send->Password = 'example';

            $this->send->setFrom('example@me.com', 'me'); 
            $this->send->addAddress($email, 'me');

            $this->send->Subject = $subject; 
            $this->send->Body = $content;
            $this->send->isHTML(true);

            if($this->send->send()){
                return true;
            }else{
                return false;
            }
        }


        // send mail for contact
        public function contactemail($email, $subject, $content){
            $this->send->Host = 'smtp.hostinger.com';            
            $this->send->Port = 465;

            $this->send->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

            $this->send->SMTPAuth = true;

            $this->send->Username = 'example@me.com';            
            $this->send->Password = 'example';

            $this->send->setFrom('example@me.com', 'me'); 
            $this->send->addAddress($email, 'me');

            $this->send->Subject = $subject; 
            $this->send->Body = $content;
            $this->send->isHTML(true);

            if($this->send->send()){
                return true;
            }else{
                return false;
            }      
            
        }
    }
?>