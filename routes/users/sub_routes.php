<?php

    // 9mobile route (GET)
    $router->addRoute('GET', '/9mobile', function () {
        if(isset($_SESSION['user'])){
            require_once "views/users/9mobile.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });


    // airteldata route (GET)
    $router->addRoute('GET', '/airteldata', function () {
        if(isset($_SESSION['user'])){
            require_once "views/users/airteldata.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });

    // airtime route (GET)
    $router->addRoute('GET', '/airtime', function () {
        if(isset($_SESSION['user'])){
            require_once "views/users/airtime.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });


    // deposit route (GET)
    $router->addRoute('GET', '/deposit', function () {
        if(isset($_SESSION['user'])){
            require_once "views/users/deposit.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });

    // dstv route (GET)
    $router->addRoute('GET', '/dstv', function () {
        if(isset($_SESSION['user'])){
            require_once "views/users/dstv.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });


    // electricity route (GET)
    $router->addRoute('GET', '/electricity', function () {
        if(isset($_SESSION['user'])){
            require_once "views/users/electricity.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });


    // glodata route (GET)
    $router->addRoute('GET', '/glodata', function () {
        if(isset($_SESSION['user'])){
            require_once "views/users/glodata.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });


    // glodata2 route (GET)
    $router->addRoute('GET', '/glodata2', function () {
        if(isset($_SESSION['user'])){
            require_once "views/users/glodata2.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });


    // gotv route (GET)
    $router->addRoute('GET', '/gotv', function () {
        if(isset($_SESSION['user'])){
            require_once "views/users/gotv.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });

    // mtndata route (GET)
    $router->addRoute('GET', '/mtndata', function () {
        if(isset($_SESSION['user'])){
            require_once "views/users/mtndata.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });


    // startimes route (GET)
    $router->addRoute('GET', '/startimes', function () {
        if(isset($_SESSION['user'])){
            require_once "views/users/startimes.php";
            exit;
        }else{
            header('location: /');
            exit;
        }
    });







    // post routes
    // add history route (POST)
    $router->addRoute('POST', '/history', function () {
        global $sub;
        $sub->postHistory($_POST);
        exit;
    });
    

?>