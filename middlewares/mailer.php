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
        public $username;
        public $password;
        public $port;
        public $host;

        public function __construct(){
            $this->send = new PHPMailer();
            $this->send->isSMTP();

            $this->username = $_ENV['MYUSER'];
            $this->password = $_ENV['MYPASS'];
            $this->port = $_ENV['PORT'];
            $this->host = $_ENV['HOST'];
        }

        // send reset mail
        public function regemail($email, $subject, $content){
            $this->send->Host = $this->host;            
            $this->send->Port = $this->port;

            $this->send->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

            $this->send->SMTPAuth = true;

            $this->send->Username = $this->username;            
            $this->send->Password = $this->password;

            $this->send->setFrom($this->username, 'BillzHub'); 
            $this->send->addAddress($email, 'BillzHub');

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
            $this->send->Host = $this->host;            
            $this->send->Port = $this->port;

            $this->send->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

            $this->send->SMTPAuth = true;

            $this->send->Username = $this->username;            
            $this->send->Password = $this->password;

            $this->send->setFrom($this->username, 'BillzHub'); 
            $this->send->addAddress($email, 'BillzHub');

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