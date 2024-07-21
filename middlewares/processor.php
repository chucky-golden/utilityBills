<?php
    namespace Processor;

    require_once 'db.php';
    use Connect\Connection;
    

    class Processes extends Connection{    

        private function getData($sqlQuery) {
            $num = $this->getNumRows($sqlQuery);

            if($num > 0){

                $result = $this->dbConnect->query($sqlQuery);
                
                $data= array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;            
                }
                return $data;
                
            }else{
                return false;
            }
            
        }


        private function getNumRows($sqlQuery) {
            $result = $this->dbConnect->query($sqlQuery);
            if(!$result){
                echo $this->dbConnect->error;
                return false; 
            }
            return $result->num_rows;
        }


        public function checkMailExists($sqlQuery){
            return  $this->getNumRows($sqlQuery);
        }


        public function loginUsers($sqlQuery){ 
            return  $this->getData($sqlQuery);
        }


        public function registerUser($sqlQuery) {
            $result = $this->dbConnect->query($sqlQuery);
            if(!$result){
                echo $this->dbConnect->error;
                return false;
            } else {
                return  true;  
            }
            
        }

        
        public function passResetUser($sqlQuery) {
            $result = $this->dbConnect->query($sqlQuery);
            if(!$result){
                echo $this->dbConnect->error;
                return false;
            } else {
                return  true;  
            }
            
        }

    }

?>