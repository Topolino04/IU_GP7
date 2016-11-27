<?php

include '../Functions/LibraryFunctions.php';

//Clase que maneja la informacion un pago
class PAGO_MODEL {

    var $PAGO_ID;
    var $PAGO_FECHA;
    var $PAGO_CONCEPTO;
    var $PAGO_IMPORTE;
    var $CLIENTE_ID;
    var $CLIENTE_DNI;
    var $mysqli;

//Constructor de la clase pago
    function __construct($PAGO_ID, $PAGO_FECHA, $PAGO_CONCEPTO, $PAGO_IMPORTE, $CLIENTE_ID, $CLIENTE_DNI) {
        $this->PAGO_ID = $PAGO_ID;
        $this->PAGO_FECHA = $PAGO_FECHA;
        $this->PAGO_CONCEPTO = $PAGO_CONCEPTO;
        $this->PAGO_IMPORTE = $PAGO_IMPORTE;
        $this->CLIENTE_ID = $CLIENTE_ID;
        $this->CLIENTE_DNI = $CLIENTE_DNI;
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
        if ($this->CLIENTE_ID === FALSE) {
            return 'No existe ningún cliente con el DNI introducido';
        } else {
            $sql = "INSERT INTO PAGO (PAGO_CONCEPTO, PAGO_IMPORTE, CLIENTE_ID) VALUES ('" . $this->PAGO_CONCEPTO . "', '" . $this->PAGO_IMPORTE . "', '" . $this->CLIENTE_ID . "')";
            if (!$result = $this->mysqli->query($sql)) {
                return 'No se ha podido conectar con la base de datos';
            } else {
                return 'Pago registrado correctamente';
            }
        }
    }

//destrucción del objeto
    function __destruct() {
        
    }

//Nos devuelve la información de los pagos realizados por un determinado cliente o id
    function Consultar() {
        $this->ConectarBD();
        $sql = "SELECT * FROM PAGO WHERE CLIENTE_ID ='" . $this->CLIENTE_ID . "' OR PAGO_CONCEPTO ='" . $this->PAGO_CONCEPTO . "' OR PAGO_IMPORTE = '" . $this->PAGO_IMPORTE . "' ORDER BY PAGO_FECHA DESC";
        if (!$resultado = $this->mysqli->query($sql)) { //----- LA CONSULTA DEVUELVE TRUE SIEMPRE -----
            return FALSE; //CAMBIAR AVISO //Abraham tenía un echo
        } else {
            if ($this->CLIENTE_ID === FALSE) {
                return FALSE;
            }
            $toret = array();
            $i = 0;
            while ($fila = $resultado->fetch_array()) {
                $toret[$i] = $fila;
                $i++;
            }
            return $toret;
            //$toret = array();
            //$toret[0] = $resultado->fetch_array();
            // return $toret;
        }
    }

//Devuelve la lista de todos los pagos realizados
    function ConsultarTodo() {
        $this->ConectarBD();
        $sql = "SELECT * FROM PAGO ORDER BY PAGO_FECHA DESC";
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
//        $sql = "SELECT * FROM PAGO WHERE PAGO_ID = '" . $this->PAGO_ID . "'";
//        $result = $this->mysqli->query($sql);
//        if ($result->num_rows == 1) {
        $sql = "DELETE FROM PAGO WHERE PAGO_ID='" . $this->PAGO_ID . "'";
        if (!$resultado = $this->mysqli->query($sql)) {
            return 'Error en la consulta sobre la base de datos';
        } else {
            //exit(var_dump($this->PAGO_ID)); ------ HERRAMIENTA ------
            return 'El pago ha sido borrado correctamente';
        }
    }

    function RellenaDatos() { //Completa el formulario visible con los datos del pago
        $this->ConectarBD();
        $CLIENTE_ID= consultarIDClientePAGO("$this->PAGO_ID");
        $CLIENTE_DNI= consultarDNICliente($CLIENTE_ID);
        $sql = "SELECT * FROM PAGO WHERE PAGO_ID ='" . $this->PAGO_ID . "'";
        if (!$resultado = $this->mysqli->query($sql)) {
            return 'Error en la consulta sobre la base de datos';
        } else {
            $result = $resultado->fetch_array();
        $result['CLIENTE_DNI']=$CLIENTE_DNI;
          return $result; 
        }
    }
        
        
//        $sql = "SELECT * FROM PAGO WHERE PAGO_ID ='" . $this->PAGO_ID . "'";
//        if (!$resultado = $this->mysqli->query($sql)) {
//            return 'Error en la consulta sobre la base de datos';
//        } else {
//            $result = $resultado->fetch_array();
//            $sql="SELECT * FROM PAGO WHERE PAGO_ID='".$this->PAGO_ID."'";
//            $result['CLIENTE_DNI'] = consultarDNICliente($this->mysqli->query($sql)->);
//            //CAMBIAR ORDEN DEL FETCH ARRAY???
//            exit(var_dump($result));//----- HERRAMIENTA -----
//            return $result; 
//        }
//    }

//Modifica los datos del pago
//function Modificar($ROL_ID, $rol_funcionalidades)
    //function Modificar($PAGO_ID, $PAGO_IMPORTE, $PAGO_CONCEPTO, $PAGO_CLIENTE, $PAGO_FECHA)
    function Modificar() {
        $this->ConectarBD();
        $sql = "SELECT * FROM CLIENTE WHERE CLIENTE_ID='" . $this->CLIENTE_ID . "'";
        if (!$resultado = $this->mysqli->query($sql)) {
            return 'El DNI introducido no pertenece a ningun cliente';
        } else {
            $sql = "UPDATE PAGO SET PAGO_IMPORTE = '" . $this->PAGO_IMPORTE . "', PAGO_CONCEPTO ='" . $this->PAGO_CONCEPTO . "', CLIENTE_ID ='" . $this->CLIENTE_ID . "' WHERE PAGO_ID = '" . $this->PAGO_ID . "'";
            if (!$resultado = $this->mysqli->query($sql)) {
                return 'Error en la consulta sobre la base de datos';
            } else {
                //exit(var_dump($this->PAGO_ID)); ------ HERRAMIENTA ------
                return 'El pago se ha modificado correctamente';
            }
        }
    }

}

?>
