<?php

namespace classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    //atributos protejidos solo se acceden desde la clase
    protected $email;
    protected $nombre;
    protected $token;

    //constructor de la clase, toma parametros y se los pasa a los atributos de la classe
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        $mailer = new PHPMailer();
        $mailer->isSMTP();
        $mailer->Host = 'sandbox.smtp.mailtrap.io';
        $mailer->SMTPAuth = true;
        $mailer->Port = 2525;
        $mailer->Username = '0c68bcee37d05a';
        $mailer->Password = 'b49945bb25ff2f';

        //quien envia el coreo
        $mailer->setFrom('cuentas@upstask.com');
        $mailer->addAddress('cuentas@uptask.com','upstask.com');
        $mailer->Subject= 'confirma tu cuenta';

        //delaramos que el mail sera html
        $mailer->isHTML(true);
        $mailer->CharSet='UTF-8';

        //declaro una variable con el html
        $contenido = "<html>";
        $contenido .="<p> <strong> hola ". $this->nombre."</strong> has creado tu cuenta en upstask</p>";
        $contenido.='<p>presiona aqui:<a href="http://localhost:3000/confirmar?token='.$this->token.'">confirmar cuenta</a></p>';
        $contenido.="<p> si tu no creaste esta cuenta ignora este mensaje</p>";
        $contenido .="</html>";

        //creamos el cuerpo del mensaje
        $mailer->Body=$contenido;

        //enviamos el mensaje
        $mailer->send();
    }

    
}
