<?php
    namespace AdminDashboard;

    require_once 'middlewares/validations.php';	
    require_once 'middlewares/auth.php';
    require_once 'middlewares/processor.php';

    use Processor\Processes;
    use Auth\Authentication;


    class MyAdminDashboard{

        public $process = false;
        public $auth = false;
        
        public function __construct(){
            $this->auth = new  Authentication();
            $this->process = new Processes();
        }
        
        

        // get all users/transactions for admin
        public function getDatas($type, $offset, $recordsPerPage) {
            try{
                if($type == 't'){
                    $sqlQuery = "SELECT * FROM ".$this->process->history." LIMIT $offset, $recordsPerPage";
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
                    $sqlQuery = "SELECT * FROM ".$this->process->history." WHERE ref = '$key' LIMIT $offset, $recordsPerPage";
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
                    $sqlQuery = "SELECT * FROM ".$this->process->history." WHERE id = '$id'";
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
                $data = $this->process->loginUsers($sqlQuery);

                if($data == true) {
                    $success = "details updated";
                    header('location: /admin/user?success=user updated?id='.$id);
                    return false;
                }else {
                    $error = "error updating details";
                    header('location: /admin/user?error=error user updating?id='.$id);
                    return false;
                }

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
        public function getNumSearchData($type, $key) {
            try{
                if($type == 'users'){
                    $sqlQuery = "SELECT COUNT(*) AS total FROM  ".$this->process->users." WHERE ref = '$key'";
                }else{
                    $sqlQuery = "SELECT COUNT(*) AS total FROM  ".$this->process->history." WHERE ref = '$key'";
                }
                
                return $this->process->loginUsers($sqlQuery);

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }

    }
    

?>