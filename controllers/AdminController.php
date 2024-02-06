<?php

namespace Controllers;

use Model\AdminApointment;
use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        session_start();

        $date = $_GET['date'] ?? $date = date('Y-m-d');
        $dates = explode('-', $date);

        if (!checkdate($dates[1], $dates[2], $dates[0])) {
            header('Location: /404');
        }

        $query = "SELECT apointments.id, apointments.hour, CONCAT( users.name, ' ', users.surname) as client, ";
        $query .= " users.email, users.phone, services.name as service, services.price  ";
        $query .= " FROM apointments  ";
        $query .= " LEFT OUTER JOIN users ";
        $query .= " ON apointments.userId = users.id  ";
        $query .= " LEFT OUTER JOIN apointmentsservices ";
        $query .= " ON apointmentsservices.apointmentId = apointments.id ";
        $query .= " LEFT OUTER JOIN services ";
        $query .= " ON services.id = apointmentsservices.serviceId ";
        $query .= " WHERE date =  '$date' ";

        $apointments = AdminApointment::SQL($query);

        $router->render('admin/index', [
            'apointments' => $apointments,
            'date' => $date
        ]);
    }
}
