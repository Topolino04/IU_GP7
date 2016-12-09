<?php

include ('../Functions/class.phpmailer.php');
include ('../Functions/class.smtp.php');

//Clase que maneja la informacion una Notificacion
class NOTIFICACION_Model {

    var $NOTIFICACION_REMITENTE;
    var $NOTIFICACION_PASSWORD;
    var $NOTIFICACION_NOMBRE_REMITENTE;
    var $NOTIFICACION_DESTINATARIOS;
    var $NOTIFICACION_ASUNTO;
    var $NOTIFICACION_CUERPO;
    var $mail;
    var $mysqli;
    var $NOTIFICACION_FECHAHORA1;
    var $NOTIFICACION_FECHAHORA2;
    var $EMP_USER;

//Constructor de la clase Notificacion
    function __construct($NOTIFICACION_REMITENTE, $NOTIFICACION_PASSWORD, $NOTIFICACION_NOMBRE_REMITENTE, $NOTIFICACION_DESTINATARIOS, $NOTIFICACION_ASUNTO, $NOTIFICACION_CUERPO, $NOTIFICACION_FECHAHORA1, $NOTIFICACION_FECHAHORA2, $EMP_USER) {

        $this->NOTIFICACION_REMITENTE = $NOTIFICACION_REMITENTE;
        $this->NOTIFICACION_PASSWORD = $NOTIFICACION_PASSWORD;
        $this->NOTIFICACION_NOMBRE_REMITENTE = $NOTIFICACION_NOMBRE_REMITENTE;
        $this->NOTIFICACION_DESTINATARIOS = $NOTIFICACION_DESTINATARIOS;
        $this->NOTIFICACION_ASUNTO = $NOTIFICACION_ASUNTO;
        $this->NOTIFICACION_CUERPO = $NOTIFICACION_CUERPO;
        $this->NOTIFICACION_FECHAHORA1 = $NOTIFICACION_FECHAHORA1;
        $this->NOTIFICACION_FECHAHORA2 = $NOTIFICACION_FECHAHORA2;
        $this->EMP_USER = $EMP_USER;
        $this->mail = new PHPMailer();
    }


    //Función para la conexión a la base de datos
    function ConectarBD() {
        $this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

    function Insertar($address) {
        $this->ConectarBD();
        $sql = "INSERT INTO NOTIFICACION (NOTIFICACION_REMITENTE, NOTIFICACION_DESTINATARIO, EMP_USER) VALUES ('" . $this->NOTIFICACION_REMITENTE . "', '" .$address. "','" . $_SESSION['login'] . "')";
        if (!$resultado = $this->mysqli->query($sql)) {
            return 'No se ha podido conectar con la base de datos';
        } else {
            return $resultado;
        }
    }

    function Consultar() {
        $this->ConectarBD();
        
        if ($this->NOTIFICACION_REMITENTE == '' && $this->NOTIFICACION_FECHAHORA1 == '' && $this->NOTIFICACION_DESTINATARIOS == '' && $this->EMP_USER == '') { //0000
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION ";
        } else if ($this->NOTIFICACION_REMITENTE == '' && $this->NOTIFICACION_FECHAHORA1 == '' && $this->NOTIFICACION_DESTINATARIOS == '' && $this->EMP_USER != '') { //0001
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION WHERE EMP_USER = '" . $this->EMP_USER . "'";
        } else if ($this->NOTIFICACION_REMITENTE == '' && $this->NOTIFICACION_FECHAHORA1 == '' && $this->NOTIFICACION_DESTINATARIOS != '' && $this->EMP_USER == '') { //0010
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION WHERE NOTIFICACION_DESTINATARIO = '" . $this->NOTIFICACION_DESTINATARIOS . "'";
        } else if ($this->NOTIFICACION_REMITENTE == '' && $this->NOTIFICACION_FECHAHORA1 == '' && $this->NOTIFICACION_DESTINATARIOS != '' && $this->EMP_USER != '') { //0011
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION WHERE NOTIFICACION_DESTINATARIO = '" . $this->NOTIFICACION_DESTINATARIOS . " AND EMP_USER = '" . $this->EMP_USER . "'";
        } else if ($this->NOTIFICACION_REMITENTE == '' && $this->NOTIFICACION_FECHAHORA1 != '' && $this->NOTIFICACION_DESTINATARIOS == '' && $this->EMP_USER == '') { //0100
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION WHERE NOTIFICACION_FECHAHORA BETWEEN  '" . $this->NOTIFICACION_FECHAHORA1 . "' AND '" . $this->NOTIFICACION_FECHAHORA2 . "'";
        } else if ($this->NOTIFICACION_REMITENTE == '' && $this->NOTIFICACION_FECHAHORA1 != '' && $this->NOTIFICACION_DESTINATARIOS == '' && $this->EMP_USER != '') { //0101
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION WHERE (NOTIFICACION_FECHAHORA BETWEEN  '" . $this->NOTIFICACION_FECHAHORA1 . "' AND '" . $this->NOTIFICACION_FECHAHORA2 . "') AND EMP_USER = '" . $this->EMP_USER . "'";
        } else if ($this->NOTIFICACION_REMITENTE == '' && $this->NOTIFICACION_FECHAHORA1 != '' && $this->NOTIFICACION_DESTINATARIOS != '' && $this->EMP_USER == '') { //0110
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION WHERE (NOTIFICACION_FECHAHORA BETWEEN  '" . $this->NOTIFICACION_FECHAHORA1 . "' AND '" . $this->NOTIFICACION_FECHAHORA2 . "') AND NOTIFICACION_DESTINATARIO = '" . $this->NOTIFICACION_DESTINATARIOS . "'";
        } else if ($this->NOTIFICACION_REMITENTE == '' && $this->NOTIFICACION_FECHAHORA1 != '' && $this->NOTIFICACION_DESTINATARIOS != '' && $this->EMP_USER != '') { //0111
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION WHERE (NOTIFICACION_FECHAHORA BETWEEN  '" . $this->NOTIFICACION_FECHAHORA1 . "' AND '" . $this->NOTIFICACION_FECHAHORA2 . "') AND NOTIFICACION_DESTINATARIO = '" . $this->NOTIFICACION_DESTINATARIOS . "'AND EMP_USER = '" . $this->EMP_USER . "'";
        } else if ($this->NOTIFICACION_REMITENTE != '' && $this->NOTIFICACION_FECHAHORA1 == '' && $this->NOTIFICACION_DESTINATARIOS == '' && $this->EMP_USER == '') { //1000
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION WHERE  NOTIFICACION_REMITENTE = '" . $this->NOTIFICACION_REMITENTE . "'";
        } else if ($this->NOTIFICACION_REMITENTE != '' && $this->NOTIFICACION_FECHAHORA1 == '' && $this->NOTIFICACION_DESTINATARIOS == '' && $this->EMP_USER != '') { //1001
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION WHERE  NOTIFICACION_REMITENTE = '" . $this->NOTIFICACION_REMITENTE . "' AND EMP_USER = '" . $this->EMP_USER . "'";
        } else if ($this->NOTIFICACION_REMITENTE != '' && $this->NOTIFICACION_FECHAHORA1 == '' && $this->NOTIFICACION_DESTINATARIOS != '' && $this->EMP_USER == '') { //1010
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION WHERE  NOTIFICACION_REMITENTE = '" . $this->NOTIFICACION_REMITENTE . "' AND NOTIFICACION_DESTINATARIO = '" . $this->NOTIFICACION_DESTINATARIOS . "'";
        } else if ($this->NOTIFICACION_REMITENTE != '' && $this->NOTIFICACION_FECHAHORA1 == '' && $this->NOTIFICACION_DESTINATARIOS != '' && $this->EMP_USER != '') { //1011
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION WHERE  NOTIFICACION_REMITENTE = '" . $this->NOTIFICACION_REMITENTE . "' AND EMP_USER = '" . $this->NOTIFICACION_DESTINATARIOS . "' AND EMP_USER = '" . $this->EMP_USER . "'";
        } else if ($this->NOTIFICACION_REMITENTE != '' && $this->NOTIFICACION_FECHAHORA1 != '' && $this->NOTIFICACION_DESTINATARIOS == '' && $this->EMP_USER == '') { //1100
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION WHERE  NOTIFICACION_REMITENTE = '" . $this->NOTIFICACION_REMITENTE . "' AND (NOTIFICACION_FECHAHORA BETWEEN  '" . $this->NOTIFICACION_FECHAHORA1 . "' AND '" . $this->NOTIFICACION_FECHAHORA2 . "')";
        } else if ($this->NOTIFICACION_REMITENTE != '' && $this->NOTIFICACION_FECHAHORA1 != '' && $this->NOTIFICACION_DESTINATARIOS == '' && $this->EMP_USER != '') { //1101
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION WHERE  NOTIFICACION_REMITENTE = '" . $this->NOTIFICACION_REMITENTE . "' AND (NOTIFICACION_FECHAHORA BETWEEN  '" . $this->NOTIFICACION_FECHAHORA1 . "' AND '" . $this->NOTIFICACION_FECHAHORA2 . "') AND EMP_USER = '" . $this->EMP_USER . "'";
        } else if ($this->NOTIFICACION_REMITENTE != '' && $this->NOTIFICACION_FECHAHORA1 != '' && $this->NOTIFICACION_DESTINATARIOS != '' && $this->EMP_USER == '') { //1110
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION WHERE  NOTIFICACION_REMITENTE = '" . $this->NOTIFICACION_REMITENTE . "' AND (NOTIFICACION_FECHAHORA BETWEEN  '" . $this->NOTIFICACION_FECHAHORA1 . "' AND '" . $this->NOTIFICACION_FECHAHORA2 . "') AND NOTIFICACION_DESTINATARIO = '" . $this->NOTIFICACION_DESTINATARIOS . "'";
        } else if ($this->NOTIFICACION_REMITENTE != '' && $this->NOTIFICACION_FECHAHORA1 != '' && $this->NOTIFICACION_DESTINATARIOS != '' && $this->EMP_USER != '') { //1111
            $sql = "SELECT NOTIFICACION_REMITENTE, NOTIFICACION_FECHAHORA, NOTIFICACION_DESTINATARIO, EMP_USER FROM NOTIFICACION WHERE  NOTIFICACION_REMITENTE = '" . $this->NOTIFICACION_REMITENTE . "' AND (NOTIFICACION_FECHAHORA BETWEEN  '" . $this->NOTIFICACION_FECHAHORA1 . "' AND '" . $this->NOTIFICACION_FECHAHORA2 . "') AND NOTIFICACION_DESTINATARIO = '" . $this->NOTIFICACION_DESTINATARIOS . "' AND EMP_USER = '" . $this->EMP_USER . "'";
        }

        if (!$resultado = $this->mysqli->query($sql)) {
            return 'No se ha podido conectar con la base de datos';
        } else {
            $toret = array();
            $i = 0;
            while ($fila = $resultado->fetch_array()) {
                $toret[$i] = $fila;
                $i++;
            }
            return $toret;
        }
    }

    function Enviar_Email() {

        $cont = 0;

        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = "ssl";
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->Port = 465;
        $this->mail->Username = $this->NOTIFICACION_REMITENTE;
        $this->mail->Password = $this->NOTIFICACION_PASSWORD;
        $this->mail->setFrom($this->NOTIFICACION_REMITENTE, $this->NOTIFICACION_NOMBRE_REMITENTE);
        $this->mail->addReplyTo($this->NOTIFICACION_REMITENTE, $this->NOTIFICACION_NOMBRE_REMITENTE);
        $this->mail->Subject = $this->NOTIFICACION_ASUNTO;
        $this->mail->msgHTML($this->NOTIFICACION_CUERPO);
        $this->mail->CharSet = "UTF-8";

        $destinatarios = explode(',', $this->NOTIFICACION_DESTINATARIOS); //Ya que en la vista convertimos el array de los checkbox a un string para pasarlo sin problemas al controlador y ahora al modelo, volvemos a convertir en un array los correos de destinatarios

        foreach ($destinatarios as $address) {
            $this->mail->addAddress($address, $this->NOTIFICACION_NOMBRE_REMITENTE);
            if ($this->mail->send()) {
                $cont = $cont + 1;
                $this->mail->clearAddresses();
                $this->Insertar($address);
            } else {
                return ("Ha ocurrido un error durante el envio de las notificaciones");
            }
        }

        if ($cont = count($destinatarios)) {
            
            return ("Notificacion enviada con exito");
        }
    }

}

?>
