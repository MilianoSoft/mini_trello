<?php

namespace Controllers;

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
        //renderizando la vista  
        //el metodo render es un metodo de nuestro router 
        $router->render('auth/crear',[
            
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
    public static function mensaje()
    {
        echo "hemos enviado un mensaje a tu correo ";
    }
    //metodo logaut del sistema para salir de la seccion
    public static function confirmar()
    {
        echo "confirmamos tu mensaje gracias";
    }
}
