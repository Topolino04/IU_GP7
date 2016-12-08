<?php

include ('../Functions/class.phpmailer.php');
include ('../Functions/class.smtp.php');

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

        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 2;
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'ssl';
        //$this->mail->SMTPSecure = 'tls';
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->Port = 465;
        //$this->mail->Port = 587;
        $this->mail->Username = $this->NOTIFICACION_REMITENTE;
        $this->mail->Password = $this->NOTIFICACION_PASSWORD;
        $this->mail->setFrom($this->NOTIFICACION_REMITENTE, $this->NOTIFICACION_NOMBRE_REMITENTE);
        $this->mail->addReplyTo($this->NOTIFICACION_REMITENTE, $this->NOTIFICACION_NOMBRE_REMITENTE);
        $this->mail->Subject = $this->NOTIFICACION_ASUNTO;
        $this->mail->msgHTML($this->NOTIFICACION_CUERPO);

        //indico destinatario

        //$this->NOTIFICACION_DESTINATARIOS = explode(',', $this->NOTIFICACION_DESTINATARIOS);
        //var_dump($this->NOTIFICACION_DESTINATARIOS);

//        foreach ($this->NOTIFICACION_DESTINATARIOS as $address) {
//            $this->mail->addAddress($address);
//           // echo $address;
//            if ($this->mail->send()) {
//                return ("Notificacion enviada con exito");
//            } else
//                return ("Ha ocurrido un error durante el envio de las notificaciones");
//        }
        
        $this->mail->addAddress("ivanddf1994@hotmail.com", $this->NOTIFICACION_NOMBRE_REMITENTE);
        $this->mail->send();



//        if (mail($this->NOTIFICACION_DESTINATARIOS, $this->NOTIFICACION_ASUNTO, $this->NOTIFICACION_CUERPO)) { //Funcion para mandar el email
//            return ("Notificacion enviada con exito");
//        } else
//            return ("Ha ocurrido un error durante el envio de las notificaciones");
    }

}

?>
