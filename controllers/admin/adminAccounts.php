<?php
    namespace AdminAccounts;

    require_once 'middlewares/validations.php';	
    require_once 'middlewares/auth.php';
    require_once 'middlewares/mailer.php';

    use Auth\Authentication;
    use MyMail\Mailer;


    class MyAdminAccount{
        
        public $auth = false;
        public $mail = false;
        
        public function __construct(){
            $this->auth = new  Authentication();
            $this->mail = new Mailer();
        }
        
        

        // admin registration
        public function createUser($post) {

            try{
                if(empty_details($post) == 'false'){
                    $error = "all fields are required";
                    header("Location: /admin/register?error=".$error);
                    return false;
                }else{
    
                    $email = trimData($post['email']);
                    $password = trimData($post['password']);
                    $passcode = trimData($post['passcode']);

                    // Access the variables
                    $saved = $_ENV['PASSCODE'];

                    if($passcode != $saved){
                        $error = "unauthorized access";
                        header("Location: /admin/register?error=".$error);
                        return false;
                    }
                
                    $check = $this->auth->checkEmail($email, 'staffs');
    
                    if($check > 0){
                        $error = "email already taken by another staff";
                        header("Location: /admin/register?error=".$error);
                        return false;
                    }else{
                        $new_pass = password_encrypt($password);
                        $user = $this->auth->registerUser('', '', '', $email, '', $new_pass, '', 'admin');
                        if($user == true) {
                            $success = "now log in with your details";
                            header("Location: /admin/login?success=".$success);
                            return false;
                        }else {
                            $error = "error registering details";
                            header("Location: /admin/register?error=".$error);
                            return false;
                        }
                    }
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }

        
        // admin/super admin login function
        public function logUser($post) {
            try{
                if(empty_details($post) == 'false'){
                    $error = "all fields are required";
                    header("Location: /admin/login?error=".$error);
                    return false;
                }else{

                    $email = trimData($post['email']);
                    $password = trimData($post['password']);

                    $new_pass = password_encrypt($password);
                    
                    $user = $this->auth->loginUsers($email, $new_pass, 'admin');
                    if($user == false) {
                        $error = "account does not exist";
                        header("Location: /admin/login?error=".$error);
                        return false;
                    }else {
                        header("Location: /admin/dashboard");
                        return false;   
                    }
                    
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }



        // admin/super admin forgot password function
        public function forgotPass($post) {
            try{
                if(empty_details($post) == 'false'){
                    $error = "all fields are required";
                    header("Location: /admin/forgot?error=".$error);
                    return false;
                }else{
        
                    $email = trimData($post['email']);
        
        
                    // check admin table for email
                    $check = $this->auth->checkEmail($email, 'admin');
        
                    if($check > 0){

                        $msg = '

                            <!DOCTYPE html>
                            <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>billshub</title>
                            </head>
                            <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
                                <div style="background-color: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 400px; text-align: center;">
                                <h3 style="color: #333; font-family: cursive;"><img src="https://basicassets.netlify.app/img/logo.png" alt="" width="50" height="50"> Billshub</h3>
                                <h5 style="color: #333;">Forgot Password!</h5>
                                <p style="color: #777; font-size: 16px; margin: 10px 0;">we got a request to reset your 
                                password, if this was you, click the link below to reset password or ignore and nothing will happen to your account.<br><br></p><br>
                                <a href="https://www.Billshub.com/admin/recover?email='.$email.'" style="background-color: #2828a7; color: #fff; border: none; padding: 15px; font-size: 16px; border-radius: 5px; cursor: pointer; text-decoration: none;">Password reset</a><br><br>
                                <p><i>Always keep your account safe by not sharing sensitive information like password to anybody...<br><b style="color: blue">Team Billshub</b></i></p>
                                </div>
                            </body>
                            </html>
                            ';
            
                        $subject = 'Forgot Password';
                        $this->mail->regemail($email, $subject, $msg);
            
                        $success = "link to reset password sent to mail";
                        header("Location: /admin/forgot?success=".$success);
                        return false;
        
                    }else{
                        
                        $error = "no registered email found";
                        header("Location: /admin/forgot?error=".$error);
                        return false;
                    }
                

                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }



        // admin password reset function
        public function resetPass($post) {
            try{
                if(empty_details($post) == 'false'){
                    $error = "all fields are required";
                    header("Location: /admin/recover?error=".$error.'&email='.$post['email']);
                    return false;
                }else{
        
                    $email = $post['email'];
                    $conpassword = trimData($post['conpassword']);
                    $password = trimData($post['password']);
                    
                    if($password != $conpassword){
                        $error = "passwords do not match";
                        header("Location: /admin/recover?error=".$error.'&email='.$email);
                        return false;
                    }
        
                    $new_pass = password_encrypt($password);
                    $user = $this->auth->passwordReset($email, $new_pass, 'admin');
                    if($user == true) {
                        $success = "password reset successful";
                        header("Location: /admin/login?success=".$success);
                        return false;
                    }else{
                        $error = "error updating password";
                        header("Location: /admin/recover?error=".$error.'&email='.$email);
                        return false;
                    }
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }


    }
    

?>