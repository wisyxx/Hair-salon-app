<?php

namespace Controllers;

use Model\Apointment;
use Model\ApointmentsServices;
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

        // Saves the apointment and returns a response
        $apointment = new Apointment($_POST);
        $result = $apointment->save();
        $id = $result['id'];

        // Saves the apointment services and returns a response
        $servicesId = explode(",", $_POST['services']);
        foreach ($servicesId as $serviceId) {
            $args = [
                'apointmentId' => $id,
                'serviceId' => $serviceId
            ];

            $apointmentsservices = new ApointmentsServices($args);
            $apointmentsservices->save();
        }

        $response = [
            'result' => $result,
        ];

        echo json_encode($response);
    }
}
