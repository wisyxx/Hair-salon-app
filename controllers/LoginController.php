<?php

namespace Controllers;

use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        }

        $router->render('auth/login', []);
    }
    public static function logout()
    {
        session_start();

        $_SESSION = [];

        header('Location: /');
    }

    public static function register(Router $router) {
        $router->render('auth/create-account', []);
    }

    public static function forgotPassword(Router $router)
    {
        $router->render('auth/forgot-password', []);
    }
}