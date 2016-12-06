<?php

include '../Functions/LibraryFunctions.php';

//Clase para Lesiones
class LESION_MODEL {

    var $LESION_ID;
    var $LESION_NOM;
    var $LESION_DESC;
    var $LESION_ESTADO;
    var $EMP_USER;
    var $CLIENTE_ID;
    var $mysqli;

//Constructor de la clase lesion
    function __construct($LESION_ID, $LESION_NOM, $LESION_DESC, $LESION_ESTADO, $EMP_USER, $CLIENTE_ID) {
        $this->LESION_ID = $LESION_ID;
        $this->LESION_NOM = $LESION_NOM;
        $this->LESION_DESC = $LESION_DESC;
        $this->LESION_ESTADO = $LESION_ESTADO;
        $this->EMP_USER = $EMP_USER;
        $this->CLIENTE_ID = $CLIENTE_ID;
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
        if ($this->CLIENTE_ID == '') {
            $sql = "INSERT INTO LESION VALUES ('', '" . $this->LESION_NOM . "', '" . $this->LESION_DESC . "', '" . $this->LESION_ESTADO . "', '" . $this->EMP_USER . "', NULL) ";
        } else {
            $sql = "INSERT INTO LESION VALUES ('', '" . $this->LESION_NOM . "', '" . $this->LESION_DESC . "','" . $this->LESION_ESTADO . "', NULL, '" . $this->CLIENTE_ID . "') ";
        }
        if (!$result = $this->mysqli->query($sql)) {
            return 'No se ha podido conectar con la base de datos';
        } else {
            return 'Lesion registrada correctamente';
        }
    }

//destrucción del objeto
    function __destruct() {
        
    }

    function InsertarRegistro() { //Esta funcion se ocupa de insertar en el registro el EMP_USER(PK de EMPLEADO) y la fecha y hora a la que un empleado consulto las lesiones de algun usuario. (Cumplir la LOPD)
        $this->ConectarBD();
        $sql = "INSERT INTO REGISTRO_CONSULTA_LESION VALUES('','','" . $_SESSION['login'] . "')";
        $resultado = $this->mysqli->query($sql);
        return $resultado;
    }

//Esta funcion la utilizamos para filtrar dentro de todas las lesiones de un usuario y poder buscar por algun parametro en concreto
    function Consultar() {
        $this->ConectarBD();
        if ($this->CLIENTE_ID == '') {
            $sql = "SELECT LESION_ID, LESION_NOM, LESION_DESC, LESION_ESTADO FROM LESION WHERE EMP_USER = '" . $this->EMP_USER . "' AND LESION_ID ='" . $this->LESION_ID . "' OR LESION_NOM ='" . $this->LESION_NOM . "' OR LESION_DESC LIKE '" . $this->LESION_DESC . "' OR LESION_ESTADO ='" .$this->LESION_ESTADO . "' ";
        } else {
            $sql = "SELECT LESION_ID, LESION_NOM, LESION_DESC, LESION_ESTADO FROM LESION WHERE CLIENTE_ID = '" . $this->CLIENTE_ID . "' AND LESION_ID ='" . $this->LESION_ID . "' OR LESION_NOM ='" . $this->LESION_NOM . "' OR LESION_DESC LIKE '" . $this->LESION_DESC . "' OR LESION_ESTADO ='" .$this->LESION_ESTADO . "' ";
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

//Esta funcion devuelve una lista con todas las lesiones del usuario seleccionado
    function ConsultarTodo() {

        $this->ConectarBD();
        if ($this->CLIENTE_ID == '') {
            $sql = "SELECT LESION_ID, LESION_NOM, LESION_DESC, LESION_ESTADO FROM LESION WHERE EMP_USER = '" . $this->EMP_USER . "' ";
        } else {
            $sql = "SELECT LESION_ID, LESION_NOM, LESION_DESC, LESION_ESTADO FROM LESION WHERE CLIENTE_ID = '" . $this->CLIENTE_ID . "' ";
        }

        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos';
        } else {
            $toret = array();
            $i = 0;
            while ($fila = $resultado->fetch_array()) {
                $toret[$i] = $fila;
                $i++;
            }
            $this->InsertarRegistro();
            return $toret;
        }
    }

//Esta funcion borra de la BD la lesion seleccionada 
    function Borrar() {
        $this->ConectarBD();
        if ($this->CLIENTE_ID == '') {
            $sql = "DELETE FROM LESION WHERE LESION_ID ='" . $this->LESION_ID . "' AND EMP_USER = '" . $this->EMP_USER . "'";
        } else {
            $sql = "DELETE FROM LESION WHERE LESION_ID ='" . $this->LESION_ID . "' AND CLIENTE_ID = '" . $this->CLIENTE_ID . "'";
        }
        if (!$resultado = $this->mysqli->query($sql)) {
            return 'Error en la consulta sobre la base de datos';
        } else {
            return 'Lesion borrada correctamente';
        }
    }

//Esta funcion completa los campos del formulario con los datos de la lesion
    function RellenaDatos() {
        $this->ConectarBD();
        if ($this->CLIENTE_ID == '') {
            $sql = "SELECT LESION_ID, LESION_NOM, LESION_DESC, LESION_ESTADO FROM LESION WHERE LESION_ID ='" . $this->LESION_ID . "' AND EMP_USER = '" . $this->EMP_USER . "'";
        } else {
            $sql = "SELECT LESION_ID, LESION_NOM, LESION_DESC, LESION_ESTADO FROM LESION WHERE LESION_ID ='" . $this->LESION_ID . "' AND CLIENTE_ID = '" . $this->CLIENTE_ID . "'";
        }
        if (!$resultado = $this->mysqli->query($sql)) {
            return 'Error en la consulta sobre la base de datos';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

//Esta funcion modifica los datos de un usuario con otros datos que introducimos por formulario
    function Modificar() {
        $this->ConectarBD();
        if ($this->CLIENTE_ID == '') {
            $sql = "UPDATE LESION SET LESION_NOM = '" . $this->LESION_NOM . "', LESION_DESC ='" . $this->LESION_DESC . "', LESION_ESTADO = '" . $this->LESION_ESTADO . "' WHERE LESION_ID = '" . $this->LESION_ID . "'";
        } else {
            $sql = "UPDATE LESION SET LESION_NOM = '" . $this->LESION_NOM . "', LESION_DESC ='" . $this->LESION_DESC . "', LESION_ESTADO = '" . $this->LESION_ESTADO . "' WHERE LESION_ID = '" . $this->LESION_ID . "'";
        }
        if (!$resultado = $this->mysqli->query($sql)) {
            return 'Error en la consulta sobre la base de datos';
        } else {
            return 'Lesion modificada correctamente';
        }
    }

}

?>
