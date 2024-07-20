<?php
namespace Model;
use Model\ActiveRecord;

class Proyectos extends ActiveRecord{
//creo la tabla del proyectos
protected static $tabla = 'proyectos';
protected static $columnasDB=['id','nombre','url','propietarioid'];

//creo el constructor de la clase
 public function __construct($arg=[]) {
    $this->id = $arg['id']??null;
    $this->nombre = $arg['nombre']??null;
    $this->url = $arg['url']??null;
    $this->propietarioid = $arg['propietarioid']??null;

}

//validar proyectos

public function validarProyecto(){
    if(!$this->nombre){
        self::$alertas['error'][]='el nombre del proyecto es obligatorio';
    }

    return self::$alertas;
}


}
?>