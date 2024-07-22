<?php
    namespace AdminDashboard;

    require_once 'middleware/validations.php';	
    require_once 'middleware/auth.php';
    require_once 'middleware/processor.php';

    use Processor\Processes;
    use Auth\Authentication;


    class MyAdminDashboard{

        public $process = false;
        public $auth = false;
        
        public function __construct(){
            $this->auth = new  Authentication();
            $this->process = new Processes();
        }
        
        

        // get all users for admin
        public function getUsers() {
            try{
                $sqlQuery = "SELECT * FROM ".$this->process->users."";
                $data = $this->process->loginUsers($sqlQuery);
                return $data;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }


        // get single user for admin
        public function getUser($id) {
            try{
                $sqlQuery = "SELECT * FROM ".$this->process->users." WHERE id = '$id'";
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
        public function searchedAdminProducts($name, $type) {
            try{
                if($type == 'products'){
                    $sqlQuery = "SELECT * FROM ".$this->process->products." WHERE name LIKE '%".$name."%'";
                }elseif($type == 'categories'){
                    $sqlQuery = "SELECT * FROM ".$this->process->categories." WHERE name LIKE '%".$name."%'";
                }elseif($type == 'users'){
                    $sqlQuery = "SELECT * FROM " . $this->process->users . " WHERE fname LIKE '%" . $name . "%' OR lname LIKE '%" . $name . "%' OR mname LIKE '%" . $name . "%'";
                }
                $data = $this->process->loginUsers($sqlQuery);
                return $data;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }
            

        }


        // get similar products for product details page
        public function similarProducts($cat, $id) {
            try{
                $sqlQuery = "SELECT * FROM " . $this->process->products . " WHERE category = '$cat' AND id != '$id' ORDER BY RAND() LIMIT 4";

                $data = $this->process->loginUsers($sqlQuery);
                return $data;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }
            

        }



        // get all orders for user using email
        public function getOrders($email) {
            try{
                $sqlQuery = "SELECT * FROM " . $this->process->orders . " WHERE email = '$email' ORDER BY id DESC";
                $data = $this->process->loginUsers($sqlQuery);
                return $data;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }


        // update paid for orders by user using orderid
        public function updateOrder($orderid) {
            try{
                $sqlQuery = "UPDATE `".$this->process->orders."` SET `paid` = 1 WHERE `orderid` = '$orderid'";
                $data = $this->process->loginUsers($sqlQuery);
                return $data;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }





        // get all products / categories / orders for admin
        public function getShopProducts($offset, $recordsPerPage) {
            try{
                $sqlQuery = "SELECT * FROM ".$this->process->products." LIMIT $offset, $recordsPerPage";
                
                $data = $this->process->loginUsers($sqlQuery);
                return $data;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }

        // get all products / categories / orders for admin
        public function getNumProducts() {
            try{
                $sqlQuery = "SELECT COUNT(*) AS total FROM  ".$this->process->products."";
                $data = $this->process->loginUsers($sqlQuery);
                return $data;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }

    }
    

?>