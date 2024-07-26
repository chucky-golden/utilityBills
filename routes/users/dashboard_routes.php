<?php

    // dashboard route (GET)
    $router->addRoute('GET', '/dashboard', function () {
        if(isset($_SESSION['user'])){
            global $sub;
            $amt = $sub->getTotalTransaction($_SESSION['user']['id']);

            require_once "views/users/dashboard.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });


    // editprofile route (GET)
    $router->addRoute('GET', '/profile', function () {
        if(isset($_SESSION['user'])){
            require_once "views/users/profile.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });


    // editprofile route (GET)
    $router->addRoute('GET', '/history(.*)', function () {
        if(isset($_SESSION['user'])){
            $ref = $_GET['ref'] ?? "";
            $success = $_GET['success'] ?? "";
            $amount = $_GET['amount'] ?? 0;

            $actbal = $_SESSION['user']['actbal'];
            $actbal -= $amount;

            global $sub;
            $history = $sub->getHistory($success, $ref, $_SESSION['user']['id'], $actbal);
            
            require_once "views/users/history.php";
            exit;
            
        }else{
            header('location: /');
            exit;
        }
    });


    // logout route (GET)
    $router->addRoute('GET', '/logout', function () {
        session_unset();
        session_destroy();
        
        header('location: /');
        exit;
    });









    // post routes

    // editprofile route (POST)
    $router->addRoute('POST', '/editprofile', function () {
        global $account;
        $account->updateUser($_POST, 'profile');
        exit;
    });

    
    // changepassword route (POST)
    $router->addRoute('POST', '/changepassword', function () {
        global $account;
        $account->updateUser($_POST, 'pass');
        exit;
    });


?>