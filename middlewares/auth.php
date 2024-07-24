<?php
    namespace Auth;

    require_once 'processor.php';
    use Processor\Processes;
    

    // check if email exists
    class Authentication{
        public $process = false;

        public function __construct(){
            $this->process = new Processes();
        }


        // check if email exists
        public function checkEmail($email, $type){
            if($type === 'user'){
                $sqlQuery = "SELECT email FROM ".$this->process->users." WHERE email = '$email'";
                return $this->process->checkMailExists($sqlQuery);
            }elseif($type === 'admin'){
                $sqlQuery1 = "SELECT email FROM ".$this->process->admin." WHERE email = '$email'";
                return $this->process->checkMailExists($sqlQuery1);
            }else{
                return false;
            }
        }


        // check if email exists
        public function checkPhone($phone){
            $sqlQuery = "SELECT * FROM ".$this->process->users." WHERE phone = '$phone'";
            return $this->process->checkMailExists($sqlQuery);
        }


        // register user
        public function registerUser($fname, $lname, $uname, $email, $phone, $password, $rfflink, $type){
            if($type === 'user'){
                $sqlQuery = "INSERT INTO ".$this->process->users." (fname, lname, uname, email, phone, password, rflink) VALUES('$fname', '$lname', '$uname', '$email', '$phone', '$password', '$rfflink')";
                return $this->process->registerUser($sqlQuery);

            }elseif($type === 'admin'){
                $sqlQuery1 = "INSERT INTO ".$this->process->admin." (email, password) VALUES('$email', '$password')";
                return $this->process->registerUser($sqlQuery1);

            }else{
                return false;
            }
        }


        // update user
        public function updateUser($fname, $lname, $uname, $phone, $id){

            $sqlQuery = "UPDATE ".$this->process->users." SET `fname` = '$fname', `lname` = '$lname', `uname` = '$uname', `phone` = '$phone' WHERE `id` = '$id'";
            $data =  $this->process->registerUser($sqlQuery);
            if($data == false){
                return false;
            }else{
                $sqlQuery2 = "SELECT * FROM ".$this->process->users." WHERE id = '$id'";
                $data2 =  $this->process->loginUsers($sqlQuery2);
                if($data2 == false){
                    return false;
                }else{
                    $_SESSION['user'] = $data2[0];
                    return true;
                }
            }
        }


        // check user existing password and update
        public function checkAndUserPass($cpass, $npass, $id, $type){
            if($type == 'check'){
                $sqlQuery2 = "SELECT * FROM ".$this->process->users." WHERE id = '$id' AND password = '$cpass'";
                $data2 =  $this->process->loginUsers($sqlQuery2);
                if($data2 == false){
                    return false;
                }else{
                    return true;
                }
            }else{
                $sqlQuery2 = "UPDATE ".$this->process->users." SET `password` = '$npass' WHERE `id` = '$id'";
                $data2 =  $this->process->registerUser($sqlQuery2);
                if($data2 == false){
                    return false;
                }else{
                    return true;
                }
            }
        }



        // login user
        public function loginUsers($email, $password, $type){

            if($type == 'user'){
                $sqlQuery = "SELECT * FROM ".$this->process->users." WHERE email = '$email' AND password = '$password' AND active = 1";
                $data =  $this->process->loginUsers($sqlQuery);

                if($data == false){
                    return false;
                }else{
                    $_SESSION['user'] = $data[0];
                    return true;
                }
            }elseif($type == 'admin'){
                $sqlQuery = "SELECT * FROM ".$this->process->admin." WHERE email = '$email' AND password = '$password'";
                $data =  $this->process->loginUsers($sqlQuery);
                
                if($data == false){                       
                    return false;

                }else{
                    $_SESSION['admin'] = $data[0];
                    return true;
                }
            }
            
        }

        // password reset
        public function passwordReset($email, $password, $type){
            if($type == 'user'){
                $sqlQuery = "UPDATE `".$this->process->users."` SET `password` = '$password' WHERE `email` = '$email'";
                return $this->process->passResetUser($sqlQuery);
            }elseif($type == 'admin'){
                $sqlQuery1 = "UPDATE `".$this->process->admin."` SET `password` = '$password' WHERE `email` = '$email'";
                return $this->process->passResetUser($sqlQuery1);
            }
        }

    }

?>