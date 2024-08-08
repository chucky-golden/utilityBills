<?php
    namespace AdminDashboard;

    require_once 'middlewares/validations.php';	
    require_once 'middlewares/auth.php';
    require_once 'middlewares/processor.php';
    require_once 'middlewares/mailer.php';

    use Processor\Processes;
    use Auth\Authentication;
    use MyMail\Mailer;


    class MyAdminDashboard{

        public $process = false;
        public $auth = false;
        public $mail = false;
        
        public function __construct(){
            $this->auth = new  Authentication();
            $this->process = new Processes();
            $this->mail = new Mailer();
        }
        
        

        // get all users/transactions for admin
        public function getDatas($type, $offset, $recordsPerPage) {
            try{
                if($type == 't'){
                    $sqlQuery = "
                        SELECT h.*, CONCAT(u.fname, ' ', u.lname) AS fullname
                        FROM ".$this->process->history." h
                        JOIN ".$this->process->users." u ON h.userid = u.id
                        ORDER BY h.id DESC
                        LIMIT $offset, $recordsPerPage
                    ";
                }else{
                    $sqlQuery = "SELECT * FROM ".$this->process->users." LIMIT $offset, $recordsPerPage";
                }
                
                $data = $this->process->loginUsers($sqlQuery);
                return $data;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }


        // get all users/transactions for admin
        public function searchedDatas($type, $key, $offset, $recordsPerPage) {
            try{
                if($type == 'transactions'){
                    $sqlQuery = "
                        SELECT h.*, CONCAT(u.fname, ' ', u.lname) AS fullname
                        FROM ".$this->process->history." h
                        JOIN ".$this->process->users." u ON h.userid = u.id
                        WHERE ref = '$key'
                        ORDER BY h.id DESC
                        LIMIT $offset, $recordsPerPage
                    ";
                }else{
                    $sqlQuery = "SELECT * FROM ".$this->process->users." WHERE email LIKE '%".$key."%' LIMIT $offset, $recordsPerPage";
                }
                
                $data = $this->process->loginUsers($sqlQuery);
                return $data;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }

        // get limited users/transactions for admin
        public function getLimitedData($type) {
            try{
                if($type == 't'){
                    $sqlQuery = "
                        SELECT h.*, CONCAT(u.fname, ' ', u.lname) AS fullname
                        FROM ".$this->process->history." h
                        JOIN ".$this->process->users." u ON h.userid = u.id
                        ORDER BY h.id DESC
                        LIMIT 10
                    ";
                }else{
                    $sqlQuery = "SELECT * FROM ".$this->process->users." ORDER BY id DESC LIMIT 10";
                }
                
                $data = $this->process->loginUsers($sqlQuery);
                return $data;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }


        // get single user/transaction for admin
        public function getData($type, $id) {
            try{
                if($type == 't'){
                    $sqlQuery = "SELECT * FROM ".$this->process->history." WHERE userid = '$id'";
                }else{
                    $sqlQuery = "SELECT * FROM ".$this->process->users." WHERE id = '$id'";
                }
                
                $data = $this->process->loginUsers($sqlQuery);
                return $data;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }


        // delete single product / category / order by admin
        public function actionUser($id, $action) {
            try{
                if($action == 'enable'){
                    $sqlQuery1 = "UPDATE `".$this->process->users."` SET `active` = 1 WHERE `id` = '$id'";
                }else{
                    $sqlQuery1 = "UPDATE `".$this->process->users."` SET `active` = 0 WHERE `id` = '$id'";
                }
                return $this->process->registerUser($sqlQuery1);

            } catch (\Exception $e) {
                echo $e->getMessage();
            }
            

        }


        // delete single user by admin
        public function deleteUser($id) {
            try{
                $sqlQuery = "DELETE FROM ".$this->process->users." WHERE id = '$id'";
                $data = $this->process->registerUser($sqlQuery);
                if($data != false){
                    return true;
                }else{
                    return false;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }




        // get searched products / categories / users for admin
        public function searchedAdminProducts($name) {
            try{
                $sqlQuery = "SELECT * FROM " . $this->process->users . " WHERE fname LIKE '%" . $name . "%' OR lname LIKE '%" . $name . "%' OR uname LIKE '%" . $name . "%'";
                
                $data = $this->process->loginUsers($sqlQuery);
                return $data;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }
            

        }


        // update paid for orders by user using orderid
        public function editUserBalance($post) {
            try{
                $actbal = trimData($post['actbal']);
                $amount = trimData($post['amount']);
                $id = $post['id'];

                $actbal += $amount;

                $sqlQuery = "UPDATE `".$this->process->users."` SET `actbal` = '$actbal' WHERE `id` = '$id'";
                $data = $this->process->registerUser($sqlQuery);

                if($data == true) {
                    header('location: /admin/user?success=user updated&id='.$id);
                    return false;
                }else {
                    header('location: /admin/user?error=error updating balance&id='.$id);
                    return false;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }
        

        // get total number of users for admin
        public function getTotalTransaction() {
            try {
                $amt = 0;
                $sqlQuery = "SELECT * FROM " . $this->process->history . "";
                
                $result = $this->process->loginUsers($sqlQuery);

                foreach ($result as $res){
                    $amt += $res['amount'];
                }
                
                return $amt;
        
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }


        // get total number of users for admin
        public function getNumData($type) {
            try{
                if($type == 'users'){
                    $sqlQuery = "SELECT COUNT(*) AS total FROM  ".$this->process->users."";
                }else{
                    $sqlQuery = "SELECT COUNT(*) AS total FROM  ".$this->process->history."";
                }
                
                return $this->process->loginUsers($sqlQuery);

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }

        // get total number of users for admin
        public function getNumSearchData($type, $key, $offset, $recordsPerPage) {
            try{
                if($type == 'users'){
                    $sqlQuery = "SELECT COUNT(*) AS total FROM  ".$this->process->users." WHERE email LIKE '%".$key."%' LIMIT $offset, $recordsPerPage";
                }else{
                    $sqlQuery = "SELECT COUNT(*) AS total FROM  ".$this->process->history." WHERE ref = '$key'";
                }
                
                return $this->process->loginUsers($sqlQuery);

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }

        // broadcast message to all users
        public function broadcastMessage($post) {
            try{
                $message = trimData($post['message']);

                $sqlQuery = "SELECT * FROM ".$this->process->users."";                
                $users = $this->process->loginUsers($sqlQuery);

                $msg = '
                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>billzhub</title>
                        </head>
                        <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
                            <div style="background-color: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 400px;">
                                <h3 style="color: #333; font-family: cursive; text-align: center;"><img src="https://www.billzhub.com/views/basicassets/img/logo.png" alt="" width="50" height="50"> billzhub</h3>
                                <h5 style="color: #333;">From BillzHub Technologies</h5>
                                <p style="color: #777; font-size: 10px;">'.$message.'</p><br>
                            </div>
                        </body>
                        </html>

                    ';

                    $subject = 'Completed Transaction';

                    foreach ($users as $user) {
                        $email = $user['email'];
                        $data = $this->mail->regemail($email, $subject, $msg);
                        if (!$data) {
                            header('location: /admin/broadcast?error=error sending message to '.$email);
                            return false;
                        }
                    }
                    // If all emails are sent successfully
                    header('location: /admin/broadcast?success=messages sent');
                    return true;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }

    }
    

?>