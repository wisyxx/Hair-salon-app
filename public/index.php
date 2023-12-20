<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;

$router = new Router();

/*===> ACCOUNTS <===*/

/* LOGIN */
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

/* ACCOUNT RECOVERY */
$router->get('/forgot-password', [LoginController::class, 'forgotPassword']);
$router->post('/forgot-password', [LoginController::class, 'forgotPassword']);
$router->get('/recover', [LoginController::class, 'recover']);
$router->post('/recover', [LoginController::class, 'recover']);

/* REGISTER */
$router->get('/create-account', [LoginController::class, 'register']);
$router->post('/create-account', [LoginController::class, 'register']);

// Checks if the routes are valid and assings functions in the controller
$router->checkRoutes();