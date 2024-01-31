<?php

namespace Controllers;

use Model\Service;

class APIController
{
    protected static $headerJSON = 'Content-type: text/json; charset=UTF-8';

    public static function index()
    {
        header(self::$headerJSON);
        $services = Service::all();
        echo json_encode($services);
    }
    public static function save()
    {
        header(self::$headerJSON);
        $response = [
            'data' => $_POST
        ];

        echo json_encode($response);
    }
}
