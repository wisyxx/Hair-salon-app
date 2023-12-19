<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;

$router = new Router();




// Checks if the routes are valid and assings functions in the controller
$router->checkRoutes();