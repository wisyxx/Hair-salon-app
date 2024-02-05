<?php

namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new User($_POST);

            $alerts = $auth->validateLogin();

            if (empty($alerts)) {
                $user = User::where('email', $auth->email);

                if ($user) {
                    if ($user->checkPasswordAndVerificated($auth->password)) {
                        session_start();

                        $_SESSION['id'] = $user->id;
                        $_SESSION['name'] = $user->name . ' ' . $user->surname;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['login'] = true;

                        if ($user->admin === "1") {
                            $_SESSION['admin'] = $user->admin ?? null;
                            header('Location: /admin-panel');
                        } else {
                            header('Location: /apointments');
                        }

                        debug($_SESSION);
                    }
                } else {
                    User::setAlert('error', 'User doesn\'t exist');
                }
            }
        }

        $alerts = User::getAlerts();

        $router->render('auth/login', [
            'alerts' => $alerts
        ]);
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

    public static function verify(Router $router)
    {
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
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new User($_POST);
            $alerts = $auth->validateEmail();

            if (empty($alerts)) {
                $user = User::where('email', $auth->email);

                if ($user) {
                    $user->createToken();
                    $user->save();

                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendInstructions();

                    User::setAlert('succeed', 'Check your inbox!');
                } else {
                    $alerts = User::setAlert('error', 'The user doesn\'t exist or it isn\'t confirmed');
                }
            }
        }

        $alerts = User::getAlerts();

        $router->render('auth/forgot-password', [
            'alerts' => $alerts
        ]);
    }

    public static function reset(Router $router)
    {
        $alerts = [];
        $error = false;
        $token = s($_GET['token']);

        $user = User::where('token', $token);

        if (empty($user)) {
            User::setAlert('error', 'Invalid token');
            $error = true;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = new User($_POST);
            $alerts = $password->validatePassword();

            if (empty($alerts)) {
                $user->password = null;
                $user->password = $password->password;

                $user->hashPassword();
                $user->token = null;
                
                $result = $user->save();

                if ($result) {
                    header('Location: /');
                }
            }
        }

        $alerts = User::getAlerts();

        $router->render('auth/reset', [
            'alerts' => $alerts,
            'error' => $error
        ]);
    }

    public static function message(Router $router)
    {
        $router->render('auth/message', []);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}
