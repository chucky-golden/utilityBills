<?php
    namespace Accounts;

    require_once 'middlewares/validations.php';	
    require_once 'middlewares/auth.php';
    require_once 'middlewares/mailer.php';

    use Auth\Authentication;
    use MyMail\Mailer;


    class MyAccount{
        
        public $auth = false;
        public $mail = false;
        
        public function __construct(){
            $this->auth = new  Authentication();
            $this->mail = new Mailer();
        }
        
        

        // registration
        public function createUser($post) {

            try{
                if(empty_details($post) == 'false'){
                    $error = "all fields are required";
                    header("Location: /register?error=".$error);
                    return false;
                }else{
    
                    $fname = ucfirst(trimData($post['firstName']));
                    $lname = ucfirst(trimData($post['lastName']));
                    $uname = ucfirst(trimData($post['userName']));
                    $email = trimData($post['email']);
                    $phone = trimData($post['phone']);
                    $password = trimData($post['password']);
                
                    $check = $this->auth->checkEmail($email, 'user');
                    $check2 = $this->auth->checkPhone($phone);

                    if($check2 > 0){
                        $error = "phone number already used";
                        header("Location: /register?error=".$error);
                        return false;
                    }
    
                    if($check > 0){
                        $error = "email already taken by another user";
                        header("Location: /register?error=".$error);
                        return false;
                    }else{
                        $new_pass = password_encrypt($password);

                        $ref = "";

                        for ($i=0; $i < 10; $i++) { 
                            $ref .= $num[$i] = rand(0, 9);
                        }

                        $rfflink = "https://www.YuzTech.com/register?ref=".$ref;

                        $user = $this->auth->registerUser($fname, $lname, $uname, $email, $phone, $new_pass, $rfflink, 'user');
                        if($user == true) {

                            $msg = '
                                    <!DOCTYPE html>
                                    <html lang="en">
                                    <head>
                                        <meta charset="UTF-8">
                                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                        <title>Welcome Message</title>
                                    </head>
                                    <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
                                        <div style="background-color: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 400px; text-align: center;">
                                            <h3 style="color: #333; font-family: cursive;">YuzTech</h3>
                                            <h5 style="color: #333;">Welcome to Our Service!</h5>
                                            <p style="color: #777; font-size: 16px; margin: 10px 0;">We\'re delighted to have you with us. Our platform offers a wide range of features designed to provide you with the best experience. <br><br>Certain things are hard; making payments shouldn\'t be one of them. VTpass.com helps you make payments for services you enjoy right from the comfort of your home or office. The experience of total convenience, fast service delivery and easy payment is just at your fingertips.</p><br>
                                            <a href="https://www.YuzTech.com" style="background-color: #2828a7; color: #fff; border: none; padding: 15px; font-size: 16px; border-radius: 5px; cursor: pointer; text-decoration: none;">Get Started</a>
                                        </div>
                                    </body>
                                    </html>

                                ';
            
                            $subject = 'Welcome';

                            // $this->mail->regemail($email, $subject, $msg);


                            $success = "now log in with your details";
                            header("Location: /login?success=".$success);
                            return false;
                        }else {
                            $error = "error registering details";
                            header("Location: /register?error=".$error);
                            return false;
                        }
                    }
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }



        
        // login function
        public function logUser($post) {
            try{
                if(empty_details($post) == 'false'){
                    $error = "all fields are required";
                    header("Location: /login?error=".$error);
                    return false;
                }else{

                    $email = trimData($post['email']);
                    $password = trimData($post['password']);

                    $new_pass = password_encrypt($password);
                    
                    $user = $this->auth->loginUsers($email, $new_pass, 'user');
                    if($user == false) {
                        $error = "user does not exist";
                        header("Location: /login?error=".$error);
                        return false;
                    }else {
                        header("Location: /dashboard");
                        return false;
                    }
                    
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }



        // forgot password function
        public function forgotPass($post) {
            try{
                if(empty_details($post) == 'false'){
                    $error = "all fields are required";
                    header("Location: /forgot?error=".$error);
                    return false;
                }else{
        
                    $email = trimData($post['email']);
        
        
                    $check = $this->auth->checkEmail($email, 'user');
        
                    if($check > 0){
                        
                        $msg = '

                                <!DOCTYPE html>
                                    <html lang="en">
                                    <head>
                                        <meta charset="UTF-8">
                                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                        <title>Welcome Message</title>
                                    </head>
                                    <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
                                        <div style="background-color: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 400px; text-align: center;">
                                        <h3 style="color: #333; font-family: cursive;">YuzTech</h3>
                                        <h5 style="color: #333;">Forgot Password!</h5>
                                        <p style="color: #777; font-size: 16px; margin: 10px 0;">we got a request to reset your 
                                        password, if this was you, click the link below to reset password or ignore and nothing will happen to your account.<br><br></p><br>
                                        <a href="https://www.YuzTech.com/recover?email='.$email.'" style="background-color: #2828a7; color: #fff; border: none; padding: 15px; font-size: 16px; border-radius: 5px; cursor: pointer; text-decoration: none;">Password reset</a><br><br>
                                        <p><i>Always keep your account safe by not sharing sensitive information like password to anybody...<br><b style="color: blue">Team YuzTech</b></i></p>
                                        </div>
                                    </body>
                                    </html>
                                ';
            
                        $subject = 'Forgot Password';

                        $this->mail->regemail($email, $subject, $msg);
            
                        $success = "link to reset password sent to mail";
                        header("Location: /forgot?success=".$success);
                        return false;
        
                    }else{
                        
                        $error = "no registered email found";
                        header("Location: /forgot?error=".$error);
                        return false;
                        
                    }
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }



        // password reset function
        public function resetPass($post) {
            try{
                if(empty_details($post) == 'false'){
                    $error = "all fields are required";
                    header("Location: /recover?error=".$error.'&email='.$post['email']);
                    return false;
                }else{
        
                    $email = $post['email'];
                    $conpassword = trimData($post['conpassword']);
                    $password = trimData($post['password']);
                    
                    if($password != $conpassword){
                        $error = "passwords do not match";
                        header("Location: /recover?error=".$error.'&email='.$email);
                        return false;
                    }
        
                    $new_pass = password_encrypt($password);
                    $user = $this->auth->passwordReset($email, $new_pass, 'user', '');
                    if($user == true) {
                        $success = "password reset successful";
                        header("Location: /login?success=".$success);
                        return false;
                    }else{
                        $error = "error updating password";
                        header("Location: /recover?error=".$error.'&email='.$email);
                        return false;
                    }
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }



        // updating account
        public function updateUser($post, $type) {
            try{
                if($type == 'profile'){
                    if(empty_details($post) == 'false'){
                        $error = "all fields are required";
                        header("Location: /profile?error=".$error);
                        return false;
                    }else{
                        $fname = ucfirst(trimData($post['firstName']));
                        $lname = ucfirst(trimData($post['lastName']));
                        $uname = ucfirst(trimData($post['userName']));
                        $phone = trimData($post['phone']);
                        $id = $post['id'];
                    
                        $user = $this->auth->updateUser($fname, $lname, $uname, $phone, $id);
                        if($user == true) {
                            $success = "details updated";
                            header("Location: /profile?success=".$success);
                            return false;
                        }else {
                            $error = "error updating details";
                            header("Location: /profile?error=".$error);
                            return false;
                        }
                    }

                }else{
                    if(empty_details($post) == 'false'){
                        $error = "all fields are required";
                        header("Location: /profile?error=".$error);
                        return false;
                    }else{
                        $cpass = trimData($post['cpassword']);
                        $npass = trimData($post['npassword']);
                        $cnpass = trimData($post['cnpassword']);
                        $id = $post['id'];

                        $cpass = password_encrypt($cpass);
                    
                        $user = $this->auth->checkAndUserPass($cpass, '', $id, 'check');
                        if($user == true) {
                            if($npass != $cnpass){
                                $error = "password and confirm password mismatch";
                                header("Location: /profile?error=".$error);
                                return false;
                            }else{
                                $npass = password_encrypt($npass);
                                $user2 = $this->auth->checkAndUserPass('', $npass, $id, 'update');
                                if($user2 == true) {
                                    $success = "password updated";
                                    header("Location: /profile?success=".$success);
                                    return false;
                                }else{
                                    $error = "error updating password";
                                    header("Location: /profile?error=".$error);
                                    return false;
                                }
                            }

                        }else {
                            $error = "incorrect existing password";
                            header("Location: /changepassword?error=".$error);
                            return false;
                        }
                    }
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }

    }
    

?>