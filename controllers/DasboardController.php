<?php

namespace Controllers;

use Model\ActiveRecord;
use Model\Proyectos;
use Model\Usuario;
use MVC\Router;

class DasboardController extends ActiveRecord{

    public static function index( Router $router){

        $titulo = 'proyectos';
        session_start();
        isAuth();//valida la sesion
        $router->render('dasboard/index',[
           'titulo'=>$titulo
        ]);
    }

    //metodo de crear proyectos
    public static function crear_proyecto( Router $router){

        $alertas=[];
        $titulo = 'crear proyecto';
        session_start();
        isAuth();//valida la sesion
        //si el metodo es post entonce
        if($_SERVER['REQUEST_METHOD']==='POST'){

           $proyecto = new Proyectos($_POST);
          
           //validar proyectos, valida que el campo este lleno
           $alertas = $proyecto->validarProyecto();

           //si el arreglo de alertas esta vacio guardaremos el proyecto
           if(empty($alertas)){
               //genero una url unica para cada proyecto
               //unidid genera un token en base a la hora actual, si dos personas genran el el mismo momento sera el mismo token
               //md5 ya no se usa para hashear paswwor ya que este fue hakeado

               //agregamos una combinacion de uniqid con md5
                $hash= md5(uniqid());
                $proyecto->url = $hash;
               //almaceno el creador del proyecto
                $proyecto->propietarioid = $_SESSION['id'];
 
              
                $proyecto->guardar();

                header('Location: /proyecto?url='. $proyecto->url); //redireciono a proyectos
           }

        }
        //envimos los datos mediante variables a la vista
        $router->render('dasboard/crear_proyecto',[
           'titulo'=>$titulo,
           'alertas'=>$alertas
        ]);
    }
    
    //metodo del perfl del usuario
    public static function perfil( Router $router){

        $titulo = 'perfil';
        session_start();
        isAuth();//valida la sesion
        $router->render('dasboard/perfil',[
           'titulo'=>$titulo
        ]);
    }

}

?>