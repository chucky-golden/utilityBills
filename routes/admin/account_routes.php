<?php
    // get routes
    // admin login route (GET)
    $router->addRoute('GET', '/admin/login(.*)', function () {
        require_once "views/admin/login.php";
        exit;
    });

    // admin forgot password route (GET)
    $router->addRoute('GET', '/admin/forgot(.*)', function () {
        require_once "views/admin/forgot.php";
        exit;
    });

    // admin passwordreset route (GET)
    $router->addRoute('GET', '/admin/recover(.*)', function () {
        require_once "views/admin/recover.php";
        exit;
    });

    // admin register route (GET)
    $router->addRoute('GET', '/admin/register(.*)', function () {
        require_once "views/admin/register.php";
        exit;
    });







    // post routes

    // admin login route (POST)
    $router->addRoute('POST', '/admin/login', function () {
        global $adminAccount;
        $adminAccount->logUser($_POST);
        exit;
    });

    // admin passwordreset route (POST)
    $router->addRoute('POST', '/admin/recover', function () {
        global $adminAccount;
        $adminAccount->resetPass($_POST);
        exit;
    });

    // admin forgot password route (POST)
    $router->addRoute('POST', '/admin/forgot', function () {
        global $adminAccount;
        $adminAccount->forgotPass($_POST);
        exit;
    });

    // admin register route (POST)
    $router->addRoute('POST', '/admin/register', function () {
        global $adminAccount;
        $adminAccount->createUser($_POST);
        exit;
    });


?>