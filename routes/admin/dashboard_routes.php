<?php
    // admin dashboard route (GET)
    $router->addRoute('GET', '/admin/dashboard', function () {
        if(isset($_SESSION['admin'])){

            global $adminDash;
            $usersTotal = $adminDash->getNumData('users')[0]['total'];
            $historyTotal = $adminDash->getNumData('history')[0]['total'];

            $limitedUsers = $adminDash->getLimitedData('u');
            $limitedTransactions = $adminDash->getLimitedData('t');            

            require_once "views/admin/dashboard.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });
   
    
    // admin get all users route (GET)
    $router->addRoute('GET', '/admin/users', function () {
        if(isset($_SESSION['admin'])){

            global $adminDash;
            $users = $adminDash->getUsers('u');

            require_once "views/admin/users.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });
   
    
    // admin get single user details route (GET)
    $router->addRoute('GET', '/admin/user(.*)', function () {
        if(isset($_SESSION['admin'])){
            $userid = $_GET['id'] ?? null;

            global $adminDash;
            $user = $adminDash->getUser('u', $userid);
            
            require_once "views/admin/user.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });
   
    
    // admin get all transactions route (GET)
    $router->addRoute('GET', '/admin/transactions', function () {
        if(isset($_SESSION['admin'])){

            global $adminDash;
            $transactions = $adminDash->getDatas('t');

            require_once "views/admin/transactions.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });
   
    
    // admin get single transaction details route (GET)
    $router->addRoute('GET', '/admin/transaction(.*)', function () {
        if(isset($_SESSION['admin'])){
            $transactionid = $_GET['id'] ?? null;

            global $adminDash;
            $transaction = $adminDash->getData('t', $transactionid);
            
            require_once "views/admin/transaction.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });
    
    
    // admin delete user route (GET)
    $router->addRoute('GET', '/admin/deleteuser(.*)', function () {
        if(isset($_SESSION['admin'])){
            $userId = $_GET['id'] ?? null;

            global $adminDash;
            $user = $adminDash->deleteUser($userId);
            
            if($user == true){
                header('location: /admin/users?success=user deleted');
                exit;
            }else{
                header('location: /admin/users?error=error deleting user');
                exit;
            }
        }else{
            header('location: /');
            exit;
        }
    });



    // edit user route: enable/disable (GET)
    $router->addRoute('GET', '/admin/toggle(.*)', function () {
        if(isset($_SESSION['admin'])){
            $userId = $_GET['id'] ?? null;
            $action = $_GET['action'] ?? null;

            global $adminDash;
            $user = $adminDash->actionUser($userId, $action);
            
            if($user == true){                
                header('location: /admin/user?success=user updated?id='.$userId);
                exit;
            }else{
                header('location: /admin/user?error=error updating user account?id='.$userId);
                exit;
            }
        }else{
            header('location: /');
            exit;
        }
    });


    // logout route (GET)
    $router->addRoute('GET', '/admin/logout', function () {
        session_unset();
        session_destroy();
        
        header('location: /admin/login');
        exit;
    });






    // POST
    // admin edit product route (POST)
    $router->addRoute('POST', '/admin/edituserBalance', function () {
        global $adminDash;
        $adminDash->editUserBalance($_POST);
        exit;
    });

?>