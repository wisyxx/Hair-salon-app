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

                    /* Account verifing process */
                    $user->createToken();
                    $email = new Email(
                        $user->email,
                        $user->name,
                        $user->token
                    );
                    $email->sendConfirmation();

                    // Create user
                    $result = $user->save();
                    if ($result) {
                        header('Location: /message');
                    }
                }
            }
        }

        $router->render('auth/create-account', [
            'user' => $user,
            'alerts' => $alerts
        ]);
    }

    public static function verify(Router $router) {
        $alerts = [];

        $token = s($_GET['token']);

        $user = User::where('token', $token);

        if (empty($user)) {
            User::setAlert('error', 'It seems that the token isn\'t valid');
        } else {
            $user->confirmed = 1;
            $user->token = null;
            
            $user->save();
            User::setAlert('succeed', 'Account verified!');
        }

        $alerts = User::getAlerts();
        $router->render('auth/verify-account', [
            'alerts' => $alerts
        ]);
    }

    public static function forgotPassword(Router $router)
    {
        $router->render('auth/forgot-password', []);
    }

    public static function message(Router $router) {
        $router->render('auth/message', []);
    }
}
