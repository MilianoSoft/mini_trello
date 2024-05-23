<?php

namespace classes;

class Email{
    //atributos protejidos solo se acceden desde la clase
    protected $email;
    protected $nombre;
    protected $token;

    //constructor de la clase, toma parametros y se los pasa a los atributos de la classe
    public function __construct($email,$nombre,$token)
    {
        $this->email= $email;
        $this->nombre= $nombre;
        $this->token= $token; 
    }

}






