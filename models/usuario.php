<?php

namespace Model;

class Usuario extends ActiveRecord{

    //creamos la tabla en el modelo
    protected static $tabla = 'usurios';

    //creamos las columnas de la tabla
    protected static $columnasDB = ['id','nombre','email','pasword','token','confirmado'];

 public function __construct($arg=[])
 {
        //arg es un arreglo vacio
        $this->id = $arg['id']?? null;
        $this->nombre = $arg['nombre']?? " ";
        $this->email = $arg['email']?? " ";
        $this->password = $arg['password']?? " ";
        $this->token = $arg['token']?? " ";
        $this->confirmado = $arg['confirmado']?? " ";

    }

    //metodo para crear la cuenta
    public function validarNuevaCuenta(){
        //si nombre esta vacio
        if(!$this->nombre){

            // al arreglo alertas agregamos un error
            self::$alertas['error'][]="El nombre del usuario es obligatorio";
        }
          //si nombre esta vacio
        if(!$this->email){

            // al arreglo alertas agregamos un error
            self::$alertas['error'][]="El email es obligatorio";
        }
        //retornamos alerta
        return self::$alertas;
    }

      
}