<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\ApointmentsController;
use Controllers\LoginController;
use Controllers\ServiceController;
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
$router->get('/reset', [LoginController::class, 'reset']);
$router->post('/reset', [LoginController::class, 'reset']);

/* REGISTER */
$router->get('/create-account', [LoginController::class, 'register']);
$router->post('/create-account', [LoginController::class, 'register']);
$router->get('/verify-account', [LoginController::class, 'verify']);
$router->get('/message', [LoginController::class, 'message']);

/*===> APOINTMENTS <===*/
$router->get('/apointments', [ApointmentsController::class, 'index']);

/*===> APOINTMENTS API <===*/
$router->get('/api/services', [APIController::class, 'index']);
$router->post('/api/apointments', [APIController::class, 'save']);
$router->post('/api/delete', [APIController::class, 'delete']);

/*======> ADMIN PANEL <======*/
$router->get('/admin-panel', [AdminController::class, 'index']);
$router->get('/services', [ServiceController::class, 'index']);
$router->get('/services/create', [ServiceController::class, 'create']);
$router->post('/services/create', [ServiceController::class, 'create']);
$router->get('/services/update', [ServiceController::class, 'update']);
$router->post('/services/update', [ServiceController::class, 'update']);
$router->post('/services/delete', [ServiceController::class, 'delete']);

// Checks if the routes are valid and assings functions in the controller
$router->checkRoutes();