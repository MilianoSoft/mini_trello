<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;

//creo la clase Login Controller
class LoginController
{

    //funsion publica para acceder desde cualquier lugar
    //funsion estatica desde se llama sintener que instanciar la clase
    public static function login(Router $router)
    {
        // si el servidor envia un metodo post entonces 
        if ($_SERVER['REQUEST_METHOD'] === 'post') {
        }
        //renderizando la vista  
        //el metodo render es un metodo de nuestro router 
        $router->render('auth/login', [
            'titulo' => 'iniciar sesion',
        ]);
    }

    //metodo logaut del sistema para salir de la seccion
    public static function logout()
    {
        echo "cerrando session";
    }

    //metodo logaut del sistema para salir de la seccion
    public static function crear(Router $router)
    {
        $alertas = [];
        //instanciamos el usurio
        $usuario = new Usuario;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //sincronizo el usuario con el post
            $usuario->sincronizar($_POST);

            //llamo el metodo de validacion de cuenta
            $alertas = $usuario->validarNuevaCuenta();
            // si alerta esta vacion no hay campos vacios ejecuta el codigo de validar usuario
            if (empty($alertas)) {
                //si la validaciones de que no hay campos vacios son correctas entonce
                //verifico si el usuario existe en la base de datos 
                $existeUsuario = Usuario::where('email', $usuario->email);

                //si existe el usurio
                if ($existeUsuario) {
                    Usuario::setAlerta('error', 'el usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                }else{
                    //hashear password
                    $usuario->hashPassword();

                    //eliminar la propiedad no necesaria del usuario 
                    unset($usuario->password2);
                    // entonces creamos un nuevo usuario
                    debuguear($usuario);
                }
            }
        }
        //renderizando la vista  
        //el metodo render es un metodo de nuestro router 
        $router->render('auth/crear', [
            'usuario' => $usuario,
            'alertas' => $alertas,
        ]);
    }

    //metodo logaut del sistema para salir de la seccion
    public static function olvide(Router $router)
    {
        $router->render('auth/olvide', []);
    }

    //metodo logaut del sistema para salir de la seccion
    public static function restablecer(Router $router)
    {

        $router->render('auth/restablecer', []);
    }
    //metodo logaut del sistema para salir de la seccion
    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje', []);
    }
    //metodo logaut del sistema para salir de la seccion
    public static function confirmar(Router $router)
    {
        $router->render('auth/confirmar', []);
    }
}
