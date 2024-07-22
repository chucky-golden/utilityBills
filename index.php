<?php
    session_start();
    require_once "router.php";
    require_once "controllers/users/accounts.php";
    require_once "controllers/users/sub.php";
    require_once "controllers/adminAccounts.php";
    require_once "controllers/adminDashboard.php";

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