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

    function generarRegistro() {
        $this->ConectarBD();
        if ($this->CLIENTE_ID == '') {
            $sql = "SELECT * FROM REGISTRO_CONSULTA_LESION WHERE EMP_USER = '" . $this->EMP_USER . "'";
        } else {
            $sql = "SELECT * FROM REGISTRO_CONSULTA_LESION WHERE CLIENTE_ID = '" . $this->CLIENTE_ID . "'";
        }
        if (!$resultado = $this->mysqli->query($sql)) {
            return 'No se ha podido conectar con la base de datos';
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
        }

        if ($this->CLIENTE_ID == '') {
            $registro = '../Registros/Registro_' . consultarDNIEmp($this->EMP_USER). '.txt';
        } else {
            $registro = '../Registros/Registro_' . consultarDNICliente($this->CLIENTE_ID). '.txt';
        }

        if (file_exists($registro)) {
            unlink($registro);
        }

        $file = fopen($registro, "w") or die("Problemas");
        fwrite($file, '-------------------------------------------------------------------------------------------------------------------');
        fwrite($file, "\r\n");
        fwrite($file, '-------------------------------------------//   MOOVETT   //-----------------------------------------------------');
        fwrite($file, "\r\n");
        fwrite($file, "-------------------------------------------------------------------------------------------------------------------");
        fwrite($file, "\r\n");
        if ($this->CLIENTE_ID == '') {
            fwrite($file, "REGISTRO DE CONSULTA DEL EMPLEADO: " . consultarNomEmp($this->EMP_USER) . " " . consultarApellidoEmp($this->EMP_USER) . " - " . consultarDNIEmp($this->EMP_USER));
        } else {
            fwrite($file, "REGISTRO DE CONSULTA DEL CLIENTE: " . consultarNomCli($this->CLIENTE_ID) . " " . consultarApellidoCliente($this->CLIENTE_ID) . " - " . consultarDNICliente($this->CLIENTE_ID));
        }
        fwrite($file, "\r\n");
        fwrite($file, '-------------------------------------------------------------------------------------------------------------------');
        fwrite($file, "\r\n");

        for ($j = 0; $j < count($toret); $j++) {
            fwrite($file, "\r\n");
            fwrite($file, "ID del REGISTRO: [REGISTRO_CONSULTA_LESION]    FECHA Y HORA: [REGISTRO_CONSULTA_LESION_FECHAHORA]   REALIZADO POR: [EMP_USER]");
            foreach ($toret [$j] as $clave => $valor) {
                $template = file_get_contents($registro);
                $template = str_replace('[REGISTRO_CONSULTA_LESION]', $toret[$j]['REGISTRO_CONSULTA_LESION_ID'], $template);
                $template = str_replace('[REGISTRO_CONSULTA_LESION_FECHAHORA]', $toret[$j]['REGISTRO_CONSULTA_LESION_FECHAHORA'], $template);
                $template = str_replace('[EMP_USER]', $toret[$j]['USUARIO'], $template);
                file_put_contents($registro, $template);
            }
        }
        fclose($file);

        return ("Registro exportado correctamente");
    }

}

?>
