<?php
    namespace Subs;

    require_once 'middleware/validations.php';	
    require_once 'middleware/auth.php';
    require_once 'middleware/processor.php';

    use Processor\Processes;
    use Auth\Authentication;


    class SubData{

        public $process = false;
        public $auth = false;
        
        public function __construct(){
            $this->auth = new  Authentication();
            $this->process = new Processes();
        }
        

        // get all orders for user using email
        public function getHistory($id) {
            try{
                $sqlQuery = "SELECT * FROM " . $this->process->history . " WHERE userid = '$id' ORDER BY id DESC";
                $data = $this->process->loginUsers($sqlQuery);
                return $data;

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        }


        
    }
    

?>