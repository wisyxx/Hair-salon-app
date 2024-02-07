<?php

namespace Controllers;

use Model\Service;
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

        $service = new Service;
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $service->sync($_POST);

            $alerts = $service->validate();

            if (empty($alerts)) {
                $service->save();
                header('Location: /services');
            }
        }

        $router->render('services/create', [
            'service' => $service,
            'alerts' => $alerts
        ]);
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