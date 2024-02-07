<?php

namespace Controllers;

use Model\Service;
use MVC\Router;

class ServiceController
{
    public static function index(Router $router)
    {
        session_start();

        isAdmin();

        $services = Service::all();

        $router->render('services/index', [
            'services' => $services
        ]);
    }
    public static function create(Router $router)
    {
        session_start();

        isAdmin();

        $service = new Service;
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

        isAdmin();

        if (!is_numeric($_GET['id'])) {
            return;
        }

        $service = Service::find($_GET['id']);
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $service->sync($_POST);

            $alerts = $service->validate();

            if (empty($alerts)) {
                $service->save();
                header('Location: /services');
            }
        }

        $router->render('services/update', [
            'service' => $service,
            'alerts' => $alerts
        ]);
    }
    public static function delete()
    {
        session_start();

        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $service = Service::find($id);
            $service->delete();
            header('Location: /services');
        }
    }
}
