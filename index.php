<?php
    session_start();
    require_once 'middlewares/vendor/autoload.php';
    // Load the .env file
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    
    require_once "router.php";
    require_once "controllers/users/accounts.php";
    require_once "controllers/users/sub.php";
    require_once "controllers/admin/adminAccounts.php";
    require_once "controllers/admin/adminDashboard.php";

    $account = new Accounts\MyAccount();
    $sub = new Subs\SubData();
    
    $adminAccount = new AdminAccounts\MyAdminAccount();
    $adminDash = new AdminDashboard\MyAdminDashboard();    
    
    $router = new Router();
    // register route files
    require_once "routes/users/basic_routes.php";
    require_once "routes/users/dashboard_routes.php";
    require_once "routes/users/sub_routes.php";
    
    require_once "routes/admin/account_routes.php";
    require_once "routes/admin/dashboard_routes.php";


    // match the route
    try {
        $router->matchRoute();
    } catch (Exception $e) {
        require_once "views/404.php";
        exit;
    }
?>