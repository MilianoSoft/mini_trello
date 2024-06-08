<?php

namespace Controllers;

use classes\Email;
use Model\Usuario;
use MVC\Router;

//creo la clase Login Controller
class LoginController
{

    //funsion publica para acceder desde cualquier lugar
    //funsion estatica desde se llama sintener que instanciar la clase
    public static function login(Router $router)
    { 
        $alertas=[];
        
        // si el servidor envia un metodo post entonces 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //cremos el usuario de aut
            $auth = new Usuario($_POST);
            
            //validar que el correo sea valido
               $alertas = $auth->validarLogin();
            //

            //si las alertas estan vacia y pasa la validacion de campos
            if(empty($alertas)){
               
                //verificamos que el usuario existe
                $usuario= Usuario::where('email',$auth->email);
                
                //si el usuario no existe
                if(!$usuario){
                    $alertas= Usuario::setAlerta('error','no existe el usuario');
                }else{
                    //el susuario existe verificamos el password

                   if( password_verify($_POST['password'],$usuario->password)){
                    
                    //iniciamos la ssion
                    session_start();
                    //agregamos datos a la session
                    $_SESSION['id']= $usuario->id;
                    $_SESSION['nombre']= $usuario->nombre;
                    $_SESSION['email']= $usuario->email;
                    $_SESSION['login']= true;

                    header('Location: /dasboard');

                   }else{
                      $alertas = Usuario::setAlerta('error','password incorrecto');
                   }

                }

            }
            
        }

        $alertas= Usuario::getAlertas();
        //renderizando la vista  
        //el metodo render es un metodo de nuestro router 
        $router->render('auth/login', [
            'titulo' => 'iniciar sesion',
            'alertas'=>$alertas
        ]);
    }

    //metodo logaut del sistema para salir de la seccion
    public static function logout()
    {

       
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
                    $usuario->obtenerToken();
                    //eliminar la propiedad no necesaria del usuario 
                    unset($usuario->password2);
                  
                    // entonces creamos un nuevo usuario
                   $resultado= $usuario->guardar(); 

                   $email = new Email($usuario->email,$usuario->nombre,$usuario->token);

                   $email->enviarConfirmacion();

                   //verifico que halla un resultado
                   if($resultado){
                    //redireciono al mensaje
                    header('Location:/mensaje');
                   }

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
        $alertas =[];
        if($_SERVER['REQUEST_METHOD']==='POST'){

            //creo u nueo usuario
            $usuario = new Usuario($_POST);
            $alertas=$usuario ->validarEmail();
            //verifico si alerta esta vacio
            if(empty($alertas)){
                //busco el usuario
                $usuario=Usuario::where('email',$usuario->email);
                
                if($usuario && $usuario->confirmado){
                    //encontre el usuario verdad ahora
                    //generamos un nuevo token
                      $usuario->obtenerToken();
                      unset($usuario->password2);
                      
                    //actualizamos el usuario
                       $usuario->guardar();
                    //envimos el email de confirmacion
                    $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
                    $email->enviarInstruciones();

                    //imprimimos la alerta de confrimacion
                     Usuario::setAlerta('exito','te enviamos un email con los pasos a seguir');
                }else{
                    Usuario::setAlerta('error','el usuario no existe o no esta confirmado');
                   
                }
            }
            $alertas = Usuario::getAlertas();
        }
        //vistas de la aplicacion
        $router->render('auth/olvide', [
            'alertas'=>$alertas
        ]);
    }

    //metodo logaut del sistema para salir de la seccion
    public static function restablecer(Router $router)
    {
        $alertas=[];
        $mostrar=true;
        //verifico el token
        $token = s($_GET['token']);
        //si no hay token envio al usuario al location
        if(!$token){
            header('Location: /');
        }

        //identificar el susuario
       $usuario= Usuario::where('token',$token);

        if(empty($usuario)){
            $alertas = Usuario::setAlerta('error','usuario no valido');
            $mostrar= false;
        }
       $alertas= Usuario::getAlertas();

       //si el metodo es post enviamos el usuario
       if($_SERVER['REQUEST_METHOD']=='POST'){
         $usuario->sincronizar($_POST);
         $alertas=$usuario->validarPassword(); //valida que la contrasenia cumpla con los caracteres

         if(empty($alertas)){
            //hashamos el nuevo password
              $usuario->hashPassword();
            // eliminamos el token
              $usuario->token=null;
            //guardamos el usuario
              $resultado = $usuario->guardar();
            //redirecionamos al login
            if($resultado){
                header('Location:/');
            }
            debuguear($usuario);
         }
       }

        $router->render('auth/restablecer', [
            'alertas'=>$alertas,
            'mostrar'=>$mostrar
        ]);
    }


    //metodo logaut del sistema para salir de la seccion
    public static function mensaje(Router $router)
    {
        //enviamos el mensaje por correo electronico

        $router->render('auth/mensaje', []);
    }
    //metodo logaut del sistema para salir de la seccion
    public static function confirmar(Router $router)
    {
        //obtengo el token de la url
        $token =  $_GET['token'];
        //confirmo que hay token
        if(!$token){
           header('Location: /'); 
        }
        //encuentro al usuario con el token
        $usuario = Usuario::where('token',$token);

        if(empty($usuario)){
            //usuario no existe
            Usuario::setAlerta('error','token no valido');
        } else{

            $usuario->confirmado=1; //confirmo el usuario
            $usuario->token = null; // elmino el token
            unset($usuario->password2); //elimino la segunda contrasenia

            //guardo el usuario
            $usuario->guardar();
            Usuario::setAlerta('exito','cuenta creada correctamente');

        }
        
        $alertas = Usuario::getAlertas();


        $router->render('auth/confirmar', [
            'alertas'=>$alertas
        ]);
    }
}
