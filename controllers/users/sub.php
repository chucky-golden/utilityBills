<?php
    namespace Subs;

    require_once 'middlewares/validations.php';	
    require_once 'middlewares/auth.php';
    require_once 'middlewares/processor.php';
    require_once 'middlewares/mailer.php';

    use Processor\Processes;
    use Auth\Authentication;
    use MyMail\Mailer;


    class SubData{

        public $process = false;
        public $auth = false;
        public $mail = false;
        
        public function __construct(){
            $this->auth = new  Authentication();
            $this->process = new Processes();
            $this->mail = new Mailer();
        }
        

        // get all users transactions
        public function getHistory($id) {
            try{
                $sqlQuery = "SELECT * FROM " . $this->process->history . " WHERE userid = '$id' ORDER BY id DESC LIMIT 25";
                $data = $this->process->loginUsers($sqlQuery);
                return $data;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }


        // post user transaction
        public function postHistory($post) {
            try{
                $userid = trimData($post['userid']);
                $email = trimData($post['email']);
                $ref = trimData($post['ref']);
                $package = trimData($post['package']);
                $amount = trimData($post['amount']);
                $actbal = trimData($post['actbal']);

                $actbal -= $amount;

                $createddate = date('d-m-Y H:i:sa');

                $sqlQuery = "INSERT INTO ".$this->process->history." (userid, ref, package, amount, createddate) VALUES('$userid', '$ref', '$package', '$amount', '$createddate')";
                
                $saved = $this->process->registerUser($sqlQuery);
                if($saved){

                    $sqlQuery = "UPDATE `".$this->process->users."` SET `actbal` = '$actbal' WHERE `id` = '$userid'";
                    $this->process->registerUser($sqlQuery);

                    $msg = '
                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Welcome Message</title>
                        </head>
                        <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
                            <div style="background-color: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 400px;">
                                <h3 style="color: #333; font-family: cursive; text-align: center;">YuzTech</h3>
                                <h5 style="color: #333;">Transaction Complete</h5>
                                <p style="color: #777; font-size: 10px;">Your request has been processed and transaction completed. see details of transaction below.</p><br>
                                <p style="color: #777; font-size: 10px; display: flex; justify-content: space-between;"><b>Package:</b> <span>'.$package.'</span></p>
                                <hr><br>
                                <p style="color: #777; font-size: 10px; display: flex; justify-content: space-between;"><b>Amount:</b> <span><s>N</s>'.$amount.'</span></p><hr><br>
                                <p style="color: #777; font-size: 10px; display: flex; justify-content: space-between;"><b>Reference Code:</b> <span>'.$ref.'</span></p><hr><br>
                                <p style="color: #777; font-size: 10px; display: flex; justify-content: space-between;"><b>Time Stamp:</b> <span>'.$createddate.'</span></p>
                            </div>
                        </body>
                        </html>

                    ';

                    $subject = 'Completed Transaction';

                    // $this->mail->regemail($email, $subject, $msg);
                    echo 'true';
                }else{
                    echo 'false';
                }

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }
    }
    

?>