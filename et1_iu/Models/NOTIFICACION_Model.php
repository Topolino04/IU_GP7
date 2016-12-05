<?php

require_once('../Functions/class.phpmailer.php');
require_once('../Functions/class.smtp.php');

//Clase que maneja la informacion un pago
class NOTIFICACION_Model {

    var $NOTIFICACION_REMITENTE;
    var $NOTIFICACION_PASSWORD;
    var $NOTIFICACION_NOMBRE_REMITENTE;
    var $NOTIFICACION_DESTINATARIOS;
    var $NOTIFICACION_ASUNTO;
    var $NOTIFICACION_CUERPO;
    var $mail;
    var $mysqli;

//Constructor de la clase pago
    function __construct($NOTIFICACION_REMITENTE, $NOTIFICACION_PASSWORD, $NOTIFICACION_NOMBRE_REMITENTE, $NOTIFICACION_DESTINATARIOS, $NOTIFICACION_ASUNTO, $NOTIFICACION_CUERPO) {

        $this->NOTIFICACION_REMITENTE = $NOTIFICACION_REMITENTE;
        $this->NOTIFICACION_PASSWORD = $NOTIFICACION_PASSWORD;
        $this->NOTIFICACION_NOMBRE_REMITENTE = $NOTIFICACION_NOMBRE_REMITENTE;
        $this->NOTIFICACION_DESTINATARIOS = $NOTIFICACION_DESTINATARIOS;
        $this->NOTIFICACION_ASUNTO = $NOTIFICACION_ASUNTO;
        $this->NOTIFICACION_CUERPO = $NOTIFICACION_CUERPO;
        $this->mail = new PHPMailer();
    }

    function Enviar_Email() {


//        echo $this->NOTIFICACION_REMITENTE;
//        echo "<br>";
//        echo $this->NOTIFICACION_PASSWORD;
//        echo "<br>";
//        echo $this->NOTIFICACION_NOMBRE_REMITENTE;
//        echo "<br>";
//        echo $this->NOTIFICACION_DESTINATARIOS;
//        echo "<br>";
//        echo $this->NOTIFICACION_ASUNTO;
//        echo "<br>";
//        echo $this->NOTIFICACION_CUERPO;
//        echo "<br>";

        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 2;
        $this->mail->SMTPAuth = true;
       //  $this->mail->SMTPSecure = "tls";
        $this->mail->SMTPSecure = "tls";
        $this->mail->Host = "smtp.gmail.com";
        //$this->mail->Port = 465; //->Para ssl
        $this->mail->Port = 587; //Para tls
        $this->mail->Username = $this->NOTIFICACION_REMITENTE;
        $this->mail->Password = $this->NOTIFICACION_PASSWORD;
        $this->mail->setFrom($this->NOTIFICACION_REMITENTE);
        $this->mail->addReplyTo($this->NOTIFICACION_REMITENTE);
        $this->mail->Subject = $this->NOTIFICACION_ASUNTO;
        $this->mail->msgHTML($this->NOTIFICACION_CUERPO);
        
        $this->mail->addAddress($this->NOTIFICACION_DESTINATARIOS);
        
        if(!$this->mail->send()){
             return ("Notificacion enviada con exito");
        } else 
            return ("Ha ocurrido un error durante el envio de las notificaciones");


//        if (mail($this->NOTIFICACION_DESTINATARIOS, $this->NOTIFICACION_ASUNTO, $this->NOTIFICACION_CUERPO)) { //Funcion para mandar el email
//            return ("Notificacion enviada con exito");
//        } else
//            return ("Ha ocurrido un error durante el envio de las notificaciones");
    }

}

?>
