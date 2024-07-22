<?php
    // admin dashboard route (GET)
    $router->addRoute('GET', '/admin/dashboard', function () {
        if(isset($_SESSION['admin'])){
            require_once "views/admin/index.php";
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
            $users = $adminDash->getUsers();

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
            $user = $adminDash->getUser($userid);
            
            require_once "views/admin/user.php";
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
                header('location: /admin/user?success=user updated?userid='.$userId);
                exit;
            }else{
                header('location: /admin/user?error=error updating user account?userid='.$userId);
                exit;
            }
        }else{
            header('location: /');
            exit;
        }
    });
















    // POST
    // admin add product route (POST)
    $router->addRoute('POST', '/admin/addproduct', function () {
        global $adminDash;
        $adminDash->addproduct($_POST, $_FILES);
        exit;
    });
    
    
    // admin add category route (POST)
    $router->addRoute('POST', '/admin/addcategory', function () {
        global $adminDash;
        $adminDash->category($_POST, 'add');
        exit;
    });
    
    
    // admin edit product route (POST)
    $router->addRoute('POST', '/admin/editproduct', function () {
        global $adminDash;
        $adminDash->editproduct($_POST, $_FILES);
        exit;
    });

    // admin add category route (POST)
    $router->addRoute('POST', '/admin/editcategory', function () {
        global $adminDash;
        $adminDash->category($_POST, 'edit');
        exit;
    });

    // admin add category route (POST)
    $router->addRoute('POST', '/admin/manageorder', function () {
        global $adminDash;
        $adminDash->editStatus($_POST);
        exit;
    });

?>