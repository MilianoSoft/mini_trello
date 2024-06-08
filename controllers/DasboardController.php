<?php

namespace Controllers;

use Model\ActiveRecord;
use Model\Usuario;
use MVC\Router;

class DasboardController extends ActiveRecord{

    public static function index( Router $router){

        session_start();
        
        $router->render('dasboard/index',[

        ]);
    }

}

?>