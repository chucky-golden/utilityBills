<?php
    namespace Connect;
    
    class Connection{

        const HOST = 'localhost';
        const USER = 'root';
        const PASSWORD  = "";
        const DATABASE  = "bills";   
        public $dbConnect = false;

        // tables
        public $users = 'users';
        public $admin = 'admin';
        public $history = 'history';

        public function __construct(){
            if(!$this->dbConnect){ 
                $conn = new \mysqli(self::HOST, self::USER, self::PASSWORD, self::DATABASE);
                if($conn->connect_error){
                    die("Error failed to connect to MySQL: " . $conn->connect_error);
                }else{
                    $this->dbConnect = $conn;
                }
            }
        }
    }
?>
