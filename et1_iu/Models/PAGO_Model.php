<?php

include '../Functions/LibraryFunctions.php';

//Clase que maneja la informacion un pago
class PAGO_MODEL {

    var $PAGO_ID;
    var $PAGO_FECHA;
    var $PAGO_CONCEPTO;
    var $PAGO_IMPORTE;
    var $CLIENTE_ID; //???
    var $CLIENTE_DNI; //???
    var $mysqli;

//Constructor de la clase pago
    function __construct($PAGO_ID, $PAGO_FECHA, $PAGO_CONCEPTO, $PAGO_IMPORTE, $CLIENTE_ID, $CLIENTE_DNI) {
        $this->PAGO_ID = $PAGO_ID;
        $this->PAGO_FECHA = $PAGO_FECHA;
        $this->PAGO_CONCEPTO = $PAGO_CONCEPTO;
        $this->PAGO_IMPORTE = $PAGO_IMPORTE;
        $this->CLIENTE_ID = $CLIENTE_ID; //??? USADO EN GETDATAFORM()
        $this->CLIENTE_DNI = $CLIENTE_DNI; //???
    }

//Función para la conexión a la base de datos
    function ConectarBD() {
        $this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

//Insertar un nuevo pago
    function Insertar() {                        //NOTA: El formulario ya comprueba si se han rellenado los campos en el navegador.
        $this->ConectarBD();
//        if ($this->PAGO_CONCEPTO != '') { //CAMBIAR ORDEN DE LOS MENSAJES
//            if ($this->PAGO_IMPORTE != '') {
//                if ($this->CLIENTE_ID != '') {
        if ($this->CLIENTE_ID == '') {
            return 'No existe ningún cliente con el DNI introducido';
        } else {
            $sql = "SELECT * FROM CLIENTE WHERE CLIENTE_ID = $this->CLIENTE_ID  ";
            if (!$result = $this->mysqli->query($sql)) {
                return 'No se ha podido conectar con la base de datos';
            } else {
                $sql = "INSERT INTO PAGO (PAGO_CONCEPTO, PAGO_IMPORTE, CLIENTE_ID) VALUES ($this->PAGO_CONCEPTO, $this->PAGO_IMPORTE, $this->CLIENTE_ID)";
                if (!$result = $this->mysqli->query($sql)) {
                    return 'No se ha podido conectar con la base de datos';
                } else {
                    return 'Pago registrado correctamente';
                }
            }
        }
    }

//                } else {
//                    return 'Debe introducir el dni del cliente';
//                }
//            } else {
//                return 'Debe introducir un importe';
//            }
//        } else {
//            return 'Debe introducir una descripción para el concepto de pago';
//        }
//destrucción del objeto
    function __destruct() {
        
    }

//Nos devuelve la información de los pagos realizados por un determinado cliente
    function Consultar() {
        //   include '../Locates/Strings_Castellano.php';
        $this->ConectarBD();
        $sql = 'SELECT * from PAGO WHERE ((PAGO_CLIENTE =' . $this->CLIENTE_DNI . ') OR (PAGO_FECHA=' . $this->PAGO_FECHA . ')) ORDER BY PAGO_FECHA DESC';
        $resultado = $this->mysqli->query($sql);
        if ($resultado->num_rows === 0) {
            echo "El cliente con el dni introducido no tiene pagos registrados";
        } else {
            $toret = array();
            $toret[0] = $resultado->fetch_array();

            return $toret;
        }
    }

//Devuelve la lista de todos los pagos realizados
    function ConsultarTodo() {
        $this->ConectarBD();
        $sql = "select * from PAGO ORDER BY PAGO_FECHA DESC";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos';
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

//Borrado de un pago
    function Borrar() {
        $this->ConectarBD();
        $sql = "select * from PAGO where PAGO_ID = '" . $this->PAGO_ID . "'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            $sql = "delete from PAGO where PAGO_ID = '" . $this->PAGO_ID . "'";
            $this->mysqli->query($sql);
            return "El pago ha sido borrado correctamente";
        } else {
            return "El pago buscado para borrar no existe";
        }
    }

    function RellenaDatos() {
        $this->ConectarBD();
        $sql = "SELEC * FROM PAGO WHERE PAGO_ID ='" . $this->PAGO_ID . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }

//Actualizar los datos del rol
//function Modificar($ROL_ID, $rol_funcionalidades)
    //function Modificar($PAGO_ID, $PAGO_IMPORTE, $PAGO_CONCEPTO, $PAGO_CLIENTE, $PAGO_FECHA)
    function Modificar() {
        $this->ConectarBD();
        $sql = "select * FROM PAGO WHERE PAGO_ID = " . $PAGO_ID;
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            $sql = "UPDATE PAGO SET PAGO_IMPORTE = '" . $this->PAGO_IMPORTE . 'PAGO_CONCEPTO =' . $this->PAGO_CONCEPTO . ' PAGO_CLIENTE =' . $this->PAGO_CLIENTE . 'PAGO_FECHA=' . $this->PAGO_FECHA . "' WHERE PAGO_ID = '" . $this->PAGO_ID . "'";
            $this->mysqli->query($sql);

            return "El pago se ha modificado correctamente";
        } else {
            return "El pago buscado para modificar no existe";
        }
    }

}

?>
