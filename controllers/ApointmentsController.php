<?php

namespace Controllers;

use MVC\Router;

class ApointmentsController 
{
    public static function index(Router $router)
    {
        session_start();
        $router->render('apointments/index', [
            'name' => $_SESSION['name'],
            'id' => $_SESSION['id']
        ]);
    }
}