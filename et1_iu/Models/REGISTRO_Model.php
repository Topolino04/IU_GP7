<?php

//Clase para Registro de Lesiones
class REGISTRO_MODEL {

    var $REGISTRO_CONSULTA_LESION_ID;
    var $REGISTRO_CONSULTA_LESION_FECHAHORA1;
    var $REGISTRO_CONSULTA_LESION_FECHAHORA2;
    var $USUARIO;
    var $CLIENTE_ID;
    var $EMP_USER;

//Constructor de la clase lesion
    function __construct($REGISTRO_CONSULTA_LESION_ID, $REGISTRO_CONSULTA_LESION_FECHAHORA1, $REGISTRO_CONSULTA_LESION_FECHAHORA2, $USUARIO, $CLIENTE_ID, $EMP_USER) {
        $this->REGISTRO_CONSULTA_LESION_ID = $REGISTRO_CONSULTA_LESION_ID;
        $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 = $REGISTRO_CONSULTA_LESION_FECHAHORA1;
        $this->REGISTRO_CONSULTA_LESION_FECHAHORA2 = $REGISTRO_CONSULTA_LESION_FECHAHORA2;
        $this->USUARIO = $USUARIO;
        $this->CLIENTE_ID = $CLIENTE_ID;
        $this->EMP_USER = $EMP_USER;
    }

//Función para la conexión a la base de datos
    function ConectarBD() {
        $this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

    function Consultar() {
        $this->ConectarBD();
       
        if ($this->CLIENTE_ID == '') {
            if ($this->REGISTRO_CONSULTA_LESION_ID == '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 == '' && $this->USUARIO == '') { //000
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE EMP_USER = '" . $this->EMP_USER . "' ";
            } elseif ($this->REGISTRO_CONSULTA_LESION_ID == '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 == '' && $this->USUARIO != '') { //001
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE EMP_USER = '" . $this->EMP_USER . "' AND USUARIO = '" . $this->USUARIO . "'";
            } elseif ($this->REGISTRO_CONSULTA_LESION_ID == '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 != '' && $this->USUARIO == '') { //010
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE EMP_USER = '" . $this->EMP_USER . "' AND (REGISTRO_CONSULTA_LESION_FECHAHORA BETWEEN  '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 . "' AND '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA2 . "')";
            } elseif ($this->REGISTRO_CONSULTA_LESION_ID == '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 != '' && $this->USUARIO != '') { //011
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE EMP_USER = '" . $this->EMP_USER . "' AND (REGISTRO_CONSULTA_LESION_FECHAHORA BETWEEN  '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 . "' AND '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA2 . "') AND USUARIO = '" . $this->USUARIO . "'";
            } elseif ($this->REGISTRO_CONSULTA_LESION_ID != '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 == '' && $this->USUARIO == '') { //100
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE EMP_USER = '" . $this->EMP_USER . "' AND REGISTRO_CONSULTA_LESION_ID = '" . $this->REGISTRO_CONSULTA_LESION_ID . "'";
            } elseif ($this->REGISTRO_CONSULTA_LESION_ID != '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 == '' && $this->USUARIO != '') { //101
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE EMP_USER = '" . $this->EMP_USER . "' AND REGISTRO_CONSULTA_LESION_ID = '" . $this->REGISTRO_CONSULTA_LESION_ID . "' AND USUARIO = '" . $this->USUARIO . "'";
            } elseif ($this->REGISTRO_CONSULTA_LESION_ID != '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 != '' && $this->USUARIO == '') { //110
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE EMP_USER = '" . $this->EMP_USER . "' AND REGISTRO_CONSULTA_LESION_ID = '" . $this->REGISTRO_CONSULTA_LESION_ID . "' AND (REGISTRO_CONSULTA_LESION_FECHAHORA BETWEEN  '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 . "' AND '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA2 . "')";
            } elseif ($this->REGISTRO_CONSULTA_LESION_ID != '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 != '' && $this->USUARIO != '') { //111
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE EMP_USER = '" . $this->EMP_USER . "' AND REGISTRO_CONSULTA_LESION_ID = '" . $this->REGISTRO_CONSULTA_LESION_ID . "' AND (REGISTRO_CONSULTA_LESION_FECHAHORA BETWEEN  '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 . "' AND '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA2 . "') AND USUARIO = '" . $this->USUARIO . "'";
            }
        } else {
            if ($this->REGISTRO_CONSULTA_LESION_ID == '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 == '' && $this->USUARIO == '') { //000
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE CLIENTE_ID = '" . $this->CLIENTE_ID . "' ";
            } elseif ($this->REGISTRO_CONSULTA_LESION_ID == '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 == '' && $this->USUARIO != '') { //001
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE CLIENTE_ID = '" . $this->CLIENTE_ID . "' AND USUARIO = '" . $this->USUARIO . "'";
            } elseif ($this->REGISTRO_CONSULTA_LESION_ID == '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 != '' && $this->USUARIO == '') { //010
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE CLIENTE_ID = '" . $this->CLIENTE_ID . "' AND REGISTRO_CONSULTA_LESION_FECHAHORA BETWEEN  '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 . "' AND '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA2 . "'";
            } elseif ($this->REGISTRO_CONSULTA_LESION_ID == '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 != '' && $this->USUARIO != '') { //011
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE CLIENTE_ID = '" . $this->CLIENTE_ID . "' AND REGISTRO_CONSULTA_LESION_FECHAHORA BETWEEN  '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 . "' AND '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA2 . "' AND USUARIO = '" . $this->USUARIO . "'";
            } elseif ($this->REGISTRO_CONSULTA_LESION_ID != '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 == '' && $this->USUARIO == '') { //100
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE ECLIENTE_ID = '" . $this->CLIENTE_ID . "' AND REGISTRO_CONSULTA_LESION_ID = '" . $this->REGISTRO_CONSULTA_LESION_ID . "'";
            } elseif ($this->REGISTRO_CONSULTA_LESION_ID != '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 == '' && $this->USUARIO != '') { //101
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE CLIENTE_ID = '" . $this->CLIENTE_ID . "' AND REGISTRO_CONSULTA_LESION_ID = '" . $this->REGISTRO_CONSULTA_LESION_ID . "' AND USUARIO = '" . $this->USUARIO . "'";
            } elseif ($this->REGISTRO_CONSULTA_LESION_ID != '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 != '' && $this->USUARIO == '') { //110
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE CLIENTE_ID = '" . $this->CLIENTE_ID . "' AND REGISTRO_CONSULTA_LESION_ID = '" . $this->REGISTRO_CONSULTA_LESION_ID . "' AND REGISTRO_CONSULTA_LESION_FECHAHORA BETWEEN  '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 . "' AND '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA2 . "'";
            } elseif ($this->REGISTRO_CONSULTA_LESION_ID != '' && $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 != '' && $this->USUARIO != '') { //111
                $sql = "SELECT REGISTRO_CONSULTA_LESION_ID, REGISTRO_CONSULTA_LESION_FECHAHORA, USUARIO FROM REGISTRO_CONSULTA_LESION WHERE CLIENTE_ID = '" . $this->CLIENTE_ID . "' AND REGISTRO_CONSULTA_LESION_ID = '" . $this->REGISTRO_CONSULTA_LESION_ID . "' AND REGISTRO_CONSULTA_LESION_FECHAHORA BETWEEN  '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA1 . "' AND '" . $this->REGISTRO_CONSULTA_LESION_FECHAHORA2 . "' AND USUARIO = '" . $this->USUARIO . "'";
            }
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

}

?>
