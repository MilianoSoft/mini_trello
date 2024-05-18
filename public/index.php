<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
$router = new Router();

//LOGIN METODOS 
//metodo para llamar el login
$router->get('/',[LoginController::class,'login']);
//metodo para enviar el login
$router->post('/',[LoginController::class,'login']);
//logaut para cerrrar la sesion del usuario
$router->get('/logout',[LoginController::class,'logout']);

//PARTE DE CREAR CUENTA
//creando la cuenta
$router->get('/crear',[LoginController::class,'crear']);
$router->post('/crear',[LoginController::class,'crear']);

//OVIDE MI PASSWORD
//rutas para olvidar la contrasenia
$router->get('/olvide',[LoginController::class,'olvide']);
$router->post('/olvide',[LoginController::class,'olvide']);

//RESTABLECER PASSWORD
//rutas para olvidar la contrasenia
$router->get('/restablecer',[LoginController::class,'restablecer']);
$router->post('/restablecer',[LoginController::class,'restablecer']);


//MENSAJE DE CONFIRMACION
//rutas para enviar el mensaje para confirmar tu password
$router->get('/mensaje',[LoginController::class,'mensaje']);
$router->get('/confirmar',[LoginController::class,'confirmar']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();