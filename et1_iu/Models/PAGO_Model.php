<?php
include '../Functions/LibraryFunctions.php';

//Clase que define un pago
class PAGO_MODEL
{
	var $PAGO_ID;
	var $PAGO_FECHA;
	var $PAGO_CONCEPTO;
        var $PAGO_IMPORTE;
        var $PAGO_CLIENTE;
        var $CLIENTE_DNI;
	var $mysqli;

//Constructor de la clase pago
function __construct($PAGO_CONCEPTO, $PAGO_IMPORTE, $CLIENTE_DNI, $PAGO_ID, $PAGO_FECHA){
$this->PAGO_CONCEPTO=$PAGO_CONCEPTO;
$this->PAGO_IMPORTE=$PAGO_IMPORTE;
$this->CLIENTE_DNI=$CLIENTE_DNI;
$this->PAGO_ID = $PAGO_ID;
$this->PAGO_FECHA =$PAGO_FECHA;
}

//Función para la conexión a la base de datos
function ConectarBD()
{
    $this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
	
	if ($this->mysqli->connect_errno) {
		echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
	}
}
//Insertar un nuevo pago
    function Insertar() {
        $this->ConectarBD();
        if ($this->PAGO_CONCEPTO <> '') {
            if ($this->PAGO_IMPORTE <> '') {
                if ($this->CLIENTE_DNI <> '') {
                    $sql = "SELECT * FROM CLIENTE WHERE CLIENTE_DNI = $this->CLIENTE_DNI  ";
                    if (!$result = $this->mysqli->query($sql)) {
                        return 'No se ha podido conectar con la base de datos';
                    } else {
                        if ($result->num_rows != 0) {
                            $sql = "INSERT INTO PAGO (PAGO_CONCEPTO, PAGO_IMPORTE, CLIENTE_ID) VALUES ($PAGO_CONCEPTO, $PAGO_IMPORTE," . consultarIDCliente($this->CLIENTE_DNI) . ")";
                            if (!$result = $this->mysqli->query($sql)) {
                                return 'No se ha podido conectar con la base de datos';
                            }
                            return 'Pago registrado correctamente';
                        } else {
                            return 'No existe ningún cliente con el DNI Introducido';
                        }
                    }
                } else {
                    return 'Introduzca el dni del cliente';
                }
            } else {
                return 'Introduzca un importe';
            }
        } else {
            return 'Introduzca una descripción para el concepto de pago';
        }
    }

    
//destrucción del objeto
function __destruct(){}


//Nos devuelve la información de los pagos realizados por un determinado cliente
function Consultar()
{
 //   include '../Locates/Strings_Castellano.php';
    $this->ConectarBD();
    $sql = 'SELECT * from PAGO WHERE ((CLIENTE_DNI ='.$this->CLIENTE_DNI.') OR (PAGO_FECHA='.$this->PAGO_FECHA.')) ORDER BY PAGO_FECHA DESC';
	$resultado = $this->mysqli->query($sql);
	if ($resultado->num_rows===0){
		echo "El cliente con el dni introducido no tiene pagos registrados";
	}
    else{
		$toret=array();
		$toret[0]=$resultado->fetch_array();

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
function Borrar()
{
    $this->ConectarBD();
    $sql = "select * from PAGO where PAGO_ID = '".$this->PAGO_ID."'";
    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    {
        $sql = "delete from ROL where ROL_NOM = '".$this->ROL_NOM."'";
        $this->mysqli->query($sql);
		$sql="delete from ROL_FUNCIOLANIDAD where ROL_ID=".ConsultarIDRol($this->ROL_NOM);
		$this->mysqli->query($sql);
    	return "El rol ha sido borrado correctamente";
    }
    else {
        return "El rol no existe";
    }
}

function RellenaDatos()
{
    $this->ConectarBD();
    $sql = "select ROL_NOM, ROL_ID from ROL where ROL_NOM = '".$this->ROL_NOM."'";
    if (!($resultado = $this->mysqli->query($sql))){
	return 'Error en la consulta sobre la base de datos';
	}
    else{
	$result = $resultado->fetch_array();

	return $result;
	}
}
//Actualizar los datos del rol
function Modificar($ROL_ID, $rol_funcionalidades)
{
    $this->ConectarBD();
    $sql = "select ROL_NOM from ROL where ROL_ID = ".$ROL_ID;


    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    {
	$sql = "UPDATE ROL SET ROL_NOM = '".$this->ROL_NOM."' WHERE ROL_ID = '".$ROL_ID."'";
       $this->mysqli->query($sql);
		$sql="DELETE FROM ROL_FUNCIONALIDAD WHERE ROL_ID=".$ROL_ID;
		$this->mysqli->query($sql);
		for($u=0;$u<count($rol_funcionalidades);$u++){

			$sql2 = "INSERT INTO  ROL_FUNCIONALIDAD(ROL_ID, FUNCIONALIDAD_ID) VALUES (".$ROL_ID.", ".ConsultarIDFuncionalidad($this->rol_funcionalidades[$u]).")";

			$this->mysqli->query($sql2);
		}


		return "El rol se ha modificado con éxito";
	}

    else{
    return "El rol no existe";
    }
}

}
?>
