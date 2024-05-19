<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;

//creo la clase Login Controller
class LoginController
{

    //funsion publica para acceder desde cualquier lugar
    //funsion estatica desde se llama sintener que instanciar la clase
    public static function login( Router $router)
    {
        // si el servidor envia un metodo post entonces 
        if ($_SERVER['REQUEST_METHOD'] === 'post') {
        }
        //renderizando la vista  
        //el metodo render es un metodo de nuestro router 
        $router->render('auth/login',[
            'titulo'=>'iniciar sesion',
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
        //instanciamos el usurio
        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD']==='POST'){
            //sincronizo el usuario con el post
            $usuario->sincronizar($_POST);
        
            //llamo el metodo de validacion de cuenta
            $alerta = $usuario->validarNuevaCuenta();
            debuguear($alerta);
           
        }
        //renderizando la vista  
        //el metodo render es un metodo de nuestro router 
        $router->render('auth/crear',[
            'usuario'=>$usuario,
        ]);

    }

    //metodo logaut del sistema para salir de la seccion
    public static function olvide(Router $router)
    {
        $router->render('auth/olvide',[

        ]);
    }

    //metodo logaut del sistema para salir de la seccion
    public static function restablecer(Router $router)
    {
        
        $router->render('auth/restablecer',[

        ]);
    }
    //metodo logaut del sistema para salir de la seccion
    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje',[

        ]);
    }
    //metodo logaut del sistema para salir de la seccion
    public static function confirmar(Router $router)
    {
        $router->render('auth/confirmar',[

        ]);
    }
}
