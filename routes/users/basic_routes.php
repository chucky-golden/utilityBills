<?php
    // index route
    $router->addRoute('GET', '/', function () {
        require_once "views/index.php";
        exit;
    });

    // login route (GET)
    $router->addRoute('GET', '/login(.*)', function () {
    require_once "views/login.php";
        exit;
    });

    // forgot password route (GET)
    $router->addRoute('GET', '/forgot(.*)', function () {
        require_once "views/forgot.php";
        exit;
    });

    // passwordreset route (GET)
    $router->addRoute('GET', '/recover(.*)', function () {
        require_once "views/recover.php";
        exit;
    });

    // register route (GET)
    $router->addRoute('GET', '/register(.*)', function () {
        require_once "views/register.php";
        exit;
    });




    // post routes

    // login route (POST)
    $router->addRoute('POST', '/login', function () {
        global $account;
        $account->logUser($_POST);
        exit;
    });

    // passwordreset route (POST)
    $router->addRoute('POST', '/recover', function () {
        global $account;
        $account->resetPass($_POST);
        exit;
    });

    // forgot password route (POST)
    $router->addRoute('POST', '/forgot', function () {
        global $account;
        $account->forgotPass($_POST);
        exit;
    });

    // register route (POST)
    $router->addRoute('POST', '/signup', function () {
        global $account;
        $account->createUser($_POST);
        exit;
    });

?>