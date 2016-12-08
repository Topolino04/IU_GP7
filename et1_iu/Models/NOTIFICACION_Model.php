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

    //Función para la conexión a la base de datos
    function ConectarBD() {
        $this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

    function Insertar() {
        $this->ConectarBD();
        $sql = "INSERT INTO NOTIFICACION (NOTIFICACION_REMITENTE, NOTIFICACION_DESTINATARIO, EMP_USER) VALUES ('" . $this->NOTIFICACION_REMITENTE . "', '" . $this->NOTIFICACION_DESTINATARIOS . "','" . $_SESSION['login'] . "')";
        if (!$resultado = $this->mysqli->query($sql)) {
            return 'No se ha podido conectar con la base de datos';
        } else {
            return $resultado;
        }
    }

    function Enviar_Email() {

        $cont = 0;

        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 2;
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = "ssl";
        //$this->mail->SMTPSecure = "tls";
        $this->mail->Host = "smtp.gmail.com";
        //$this->mail->Host = gethostbyname('smtp.gmail.com');
        $this->mail->Port = 465;
       //$this->mail->Port = 587;
        $this->mail->Username = $this->NOTIFICACION_REMITENTE;
        $this->mail->Password = $this->NOTIFICACION_PASSWORD;
        $this->mail->setFrom($this->NOTIFICACION_REMITENTE, $this->NOTIFICACION_NOMBRE_REMITENTE);
        $this->mail->addReplyTo($this->NOTIFICACION_REMITENTE, $this->NOTIFICACION_NOMBRE_REMITENTE);
        $this->mail->Subject = $this->NOTIFICACION_ASUNTO;
        $this->mail->msgHTML($this->NOTIFICACION_CUERPO);

        //PARTE QUE LO HACE BIEN PERO NO ENVIA
//        $destinatarios = explode(',', $this->NOTIFICACION_DESTINATARIOS);
//        // var_dump($destinatarios);
//        foreach ($destinatarios as $address) {
//            $this->mail->addAddress($address);
//            if ($this->mail->send()) {
//                $cont = $cont + 1;
//            } else {
//                return ("Ha ocurrido un error durante el envio de las notificaciones");
//            }
//        }
//        if ($cont = count($destinatarios)) {
//            $this->Insertar();
//            return ("Notificacion enviada con exito");
//        }
//   

        $this->mail->addAddress("ivanddf1994@hotmail.com", $this->NOTIFICACION_NOMBRE_REMITENTE);
        if (!$this->mail->send()) {
           return ("Ha ocurrido un error durante el envio de las notificaciones");
        } else
            return ("Notificacion enviada con exito");
    }

}

?>
