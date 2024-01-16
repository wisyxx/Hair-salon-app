<?php

namespace Controllers;

use MVC\Router;

class ApointmentsController 
{
    public static function index(Router $router)
    {
        $router->render('apointments/index', []);
    }
}