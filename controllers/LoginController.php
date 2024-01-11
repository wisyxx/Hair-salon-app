<?php

namespace Controllers;

use Classes\Email;
use Model\User;
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

    public static function register(Router $router)
    {

        $user = new User($_POST);
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->sync($_POST);
            $alerts = $user->validateNewAccount();

            if (empty($alerts)) {
                $result = $user->userExists();

                if ($result->num_rows) {
                    $alerts = User::getAlerts();
                } else {
                    $user->hashPassword();
                    $user->createToken();

                    // Send confirmation email
                    $email = new Email(
                        $user->email,
                        $user->name,
                        $user->token
                    );

                    $email->sendConfirmation();
                }
            }
        }

        $router->render('auth/create-account', [
            'user' => $user,
            'alerts' => $alerts
        ]);
    }

    public static function forgotPassword(Router $router)
    {
        $router->render('auth/forgot-password', []);
    }
}
