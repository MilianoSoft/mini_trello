<?php

namespace Model;

class Usuario extends ActiveRecord{

    //creamos la tabla en el modelo
    protected static $tabla = 'usuarios';

    //creamos las columnas de la tabla
    protected static $columnasDB = ['id','nombre','email','password','token','confirmado'];

 public function __construct($arg=[])
 {
        //arg es un arreglo vacio
        $this->id = $arg['id']?? null;
        $this->nombre = $arg['nombre']?? " ";
        $this->email = $arg['email']?? " ";
        $this->password = $arg['password']?? " ";
        $this->password2 = $arg['password2']?? " ";
        $this->token = $arg['token']?? " ";
        $this->confirmado = $arg['confirmado']?? 0;

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
        //validaciones para el password que no este vacio
        if(!$this->password){
             // al arreglo alertas agregamos un error
             self::$alertas['error'][]="El password no puede ir vacio";
        }
        //validaciones para el password numero de caracteres minimo
        if(strlen( $this->password)< 6){
             // al arreglo alertas agregamos un error
             self::$alertas['error'][]="El password debe tener almenos 6 caractetes";
        }
        //validaciones para el password que no este vacio
        if($this->password != $this->password2){
             // al arreglo alertas agregamos un error
             self::$alertas['error'][]="los password  no coinciden";
        }
        //retornamos alerta
        return self::$alertas;
    }

    //metodo solo de usurio el cual hashea el password
    public function hashPassword(){
        $this->password = password_hash($this->password,PASSWORD_BCRYPT);

    }

    //metodo para generar el token del usuario a registrar
    public function obtenerToken(){
        $this->token = uniqid($this->token);
    }

}