<?php

namespace Controllers;

use MVC\Router;

class ServiceController
{
    public static function index (Router $router)
    {
        session_start();

        $router->render('services/index', []);
    }
    public static function create(Router $router)
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {

        }

        $router->render('services/create', []);
    }
    public static function update(Router $router)
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }

        $router->render('services/update', []);
    }
    public static function delete(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }
    }
}