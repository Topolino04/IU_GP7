<?php

class Linea_Factura
{

	var $FACTURA_ID;
	var $LINEA_FACTURA_CONCEPTO;
	var $LINEA_FACTURA_UNIDADES;
	var	$LINEA_FACTURA_PRECIOUD;
	var	$LINEA_FACTURA_ID;
	
	function __construct($LINEA_FACTURA_ID, $LINEA_FACTURA_CONCEPTO, $LINEA_FACTURA_UNIDADES, $LINEA_FACTURA_PRECIOUD, $FACTURA_ID)
	{
		$this->FACTURA_ID = $FACTURA_ID;
		$this->LINEA_FACTURA_CONCEPTO = $LINEA_FACTURA_CONCEPTO;
		$this->LINEA_FACTURA_UNIDADES = $LINEA_FACTURA_UNIDADES;
		$this->LINEA_FACTURA_PRECIOUD =	$LINEA_FACTURA_PRECIOUD;
		$this->LINEA_FACTURA_ID =	$LINEA_FACTURA_ID;
	}
	
	//Conectarse a la BD
	function ConectarBD()
	{
		$this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
		if ($this->mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
		}
	}
	
	//Anadir una línea de factura
	function Insertar()
	{
		$this->ConectarBD();
		
		if ($this->LINEA_FACTURA_ID <> '' )
		{
			$sql = "select * from LINEA_FACTURA where LINEA_FACTURA_ID =".$this->LINEA_FACTURA_ID."";
			if (!$result = $this->mysqli->query($sql)){
				return 'Error en la consulta sobre la base de datos'; 	
			}	
			else {
				$sql = "select * from LINEA_FACTURA where LINEA_FACTURA_CONCEPTO='".$this->LINEA_FACTURA_CONCEPTO."' AND FACTURA_ID=".$this->FACTURA_ID."";
				$result = $this->mysqli->query($sql);
				if ($result->num_rows == 0){
					$sql = "SELECT COALESCE(MAX(LINEA_FACTURA_ID)) AS MAXIMO FROM LINEA_FACTURA";
					$result = $this->mysqli->query($sql)->fetch_array();
					$result = $result['MAXIMO'] + $this->LINEA_FACTURA_ID;
					$sql = "INSERT INTO LINEA_FACTURA (LINEA_FACTURA_ID, LINEA_FACTURA_CONCEPTO, LINEA_FACTURA_UNIDADES, LINEA_FACTURA_PRECIOUD, FACTURA_ID) VALUES (";
					$sql = $sql.$result.", '".$this->LINEA_FACTURA_CONCEPTO."', ".$this->LINEA_FACTURA_UNIDADES.", ".$this->LINEA_FACTURA_PRECIOUD.",".$this->FACTURA_ID.")";
				
					$this->mysqli->query($sql);
					return 'Anadida con exito'; 	
				}
				else{
					return 'La linea de factura ya existe'; 	
				}
			}
		}
		else{
			return false;
		}
	}

	//Funcion de destruccion del objeto: se ejecuta automaticamente
	function __destruct()
	{

	}
	
	//Devuelve la información correspondiente a una  línea de factura
	function RellenaDatos()
	{
		$this->ConectarBD();
		$sql = "SELECT * FROM LINEA_FACTURA WHERE LINEA_FACTURA_ID = ".$this->LINEA_FACTURA_ID."";
		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos'; 
		}
		else{
			$result = $resultado->fetch_array();
			return $result;
		}
	}

	//Modificar la linea de Factura
	function Modificar()
	{
		$this->ConectarBD();
		$sql = "select * from LINEA_FACTURA where LINEA_FACTURA_ID = ".$this->LINEA_FACTURA_ID."";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
 			$sql = "UPDATE LINEA_FACTURA SET LINEA_FACTURA_CONCEPTO ='".$this->LINEA_FACTURA_CONCEPTO."', LINEA_FACTURA_UNIDADES=".$this->LINEA_FACTURA_UNIDADES.", LINEA_FACTURA_PRECIOUD=".$this->LINEA_FACTURA_PRECIOUD." WHERE LINEA_FACTURA_ID =".$this->LINEA_FACTURA_ID."";
			if (!($resultado = $this->mysqli->query($sql))){
				return "Error en la consulta sobre la base de datos";
			}
			else{
				return "La linea de factura se ha modificado con exito";
			}
		}
		else
			return "La linea de factura no existe";
	}
	
	//Borrar Linea de Factura
	function Borrar()
	{
		$this->ConectarBD();
		$sql = "select * from LINEA_FACTURA where LINEA_FACTURA_ID = ".$this->LINEA_FACTURA_ID."";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
			$sql = "delete from LINEA_FACTURA where LINEA_FACTURA_ID = ".$this->LINEA_FACTURA_ID."";
			//$this->mysqli->query($sql);
			if (!($resultado = $this->mysqli->query($sql)))
			{
				return "Error en la consulta sobre la base de datos";
			}
			else {
				
				return 'La linea de factura ha sido borrada correctamente';
			}
		}
		else{
			return true;
		}
	}
	
	//Consultar lineas factura asociadas a una factura
	 function ConsultarTodo()
    {
        $this->ConectarBD();
        $sql = "select LINEA_FACTURA_ID, LINEA_FACTURA_CONCEPTO, LINEA_FACTURA_UNIDADES, LINEA_FACTURA_PRECIOUD from LINEA_FACTURA WHERE FACTURA_ID =".$this->FACTURA_ID." ORDER BY FACTURA_ID";
        if (!($resultado = $this->mysqli->query($sql))){
            return 'Error en la consulta sobre la base de datos';
        }
        else{

            $toret=array();
            $i=0;

            while ($fila= $resultado->fetch_array()) {


                $toret[$i]=$fila;
                $i++;

            }


            return $toret;

        }
    }
	//Consultar id de la factura asociada
	 function idFactura()
    {
        $this->ConectarBD();
        $sql = "select FACTURA_ID from LINEA_FACTURA WHERE LINEA_FACTURA_ID =".$this->LINEA_FACTURA_ID."";
        if (!($resultado = $this->mysqli->query($sql))){
            return 'Error en la consulta sobre la base de datos';
        }
        else{

            return $resultado->fetch_array();

        }
    }
}
?>