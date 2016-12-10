<?php

class Factura
{

	var $CLIENTE_ID;
	var $FACTURA_FECHA;
	var $FACTURA_ID;
	var	$CLIENTE_CLIENTE_NOMBRE;
	var	$CLIENTE_NIF;
	var $CLIENTE_APELLIDOS;
	var $FACTURA_ESTADO;
	
	function __construct($FACTURA_ID, $CLIENTE_ID, $FACTURA_FECHA, $CLIENTE_NIF, $CLIENTE_NOMBRE, $CLIENTE_APELLIDOS, $FACTURA_ESTADO)
	{
		$this->CLIENTE_ID= $CLIENTE_ID;	
		$this->FACTURA_FECHA = $FACTURA_FECHA;
		$this->FACTURA_ID= $FACTURA_ID;	
		$this->CLIENTE_NOMBRE = $CLIENTE_NOMBRE;
		$this->CLIENTE_NIF = $CLIENTE_NIF;
		$this->CLIENTE_APELLIDOS = $CLIENTE_APELLIDOS;
		$this->FACTURA_ESTADO = $FACTURA_ESTADO;
	}
	
	//Conectarse a la BD
	function ConectarBD()
	{
		$this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
		if ($this->mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
		}
	}
	
	//Anadir una factura
	function Insertar()
	{
		$this->ConectarBD();
		
		if ($this->CLIENTE_ID <> '' )
		{
			$sql = "select * from FACTURA where CLIENTE_ID = ".$this->CLIENTE_ID." AND FACTURA_FECHA = '".$this->FACTURA_FECHA."'";	
			$result=$this->mysqli->query($sql);
			if ($result->num_rows == 0){
				$sql = "SELECT COALESCE(MAX(FACTURA_ID),0) AS MAXIMO FROM FACTURA";
				$resultado = $this->mysqli->query($sql);
				$result = $resultado->fetch_array();
				$max = $result['MAXIMO'];
				$result = $max + $this->FACTURA_ID;
				$sql = "INSERT INTO FACTURA (FACTURA_ID, CLIENTE_ID, FACTURA_FECHA, CLIENTE_NIF, CLIENTE_NOMBRE, CLIENTE_APELLIDOS, FACTURA_ESTADO) VALUES (";
				$sql = $sql.$result.", ".$this->CLIENTE_ID.", '".$this->FACTURA_FECHA."', '".$this->CLIENTE_NIF."', '".$this->CLIENTE_NOMBRE."','".$this->CLIENTE_APELLIDOS."','".$this->FACTURA_ESTADO."')";
				
				$this->mysqli->query($sql);
				return 'Anadida con exito'; 	
			}
			else{
				return 'La factura ya existe'; 	
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

	//Consultar una factura
	function Consultar()
	{

		$this->ConectarBD();
		$sql = "select * from FACTURA where FACTURA_ID = ".$this->FACTURA_ID."";
        $resultado=$this->mysqli->query($sql);


		    if ($resultado->num_rows===0){
		        echo "";
            }
            else {
                $toret = array();
                $toret[0] = $resultado->fetch_array();

                return $toret;
            }

	}
	
	
	//Borrado de la pagina
	function Borrar()
	{	
		$this->ConectarBD();
		$sql = "select * from FACTURA where FACTURA_ID = ".$this->FACTURA_ID."";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
			$sql = "DELETE FROM FACTURA WHERE FACTURA_ID = ".$this->FACTURA_ID."";
			//$this->mysqli->query($sql);
			if (!($resultado = $this->mysqli->query($sql)))
			{
				return "Error en la consulta sobre la base de datos";
			}
			else {
				
				return "La factura ha sido borrada correctamente";
			}
		}
		else{
			return "La factura no existe";
		}
	}

	//Devuelve la información correspondiente a una página
	function RellenaDatos()
	{
		$this->ConectarBD();
		$sql = "SELECT * FROM FACTURA where FACTURA_ID = ".$this->FACTURA_ID."";
		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos'; 
		}
		else{
			$result = $resultado->fetch_array();
			return $result;
			
		}
	}

	//Modificar la pagina
	function Modificar()
	{
		$this->ConectarBD();
		$sql = "select * from FACTURA where FACTURA_ID = ".$this->FACTURA_ID."";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
 			$sql = "UPDATE FACTURA SET CLIENTE_NIF ='".$this->CLIENTE_NIF."', CLIENTE_NOMBRE ='".$this->CLIENTE_NOMBRE."', CLIENTE_APELLIDOS='".$this->CLIENTE_APELLIDOS."', FACTURA_ESTADO='".$this->FACTURA_ESTADO."' WHERE FACTURA_ID =".$this->FACTURA_ID."";
			if (!($resultado = $this->mysqli->query($sql))){
				return "Error en la consulta sobre la base de datos";
			}
			else{
				return "La factura se ha modificado con exito";
			}
		}
		else
			return "La factura no existe";
	}
	
	//Listar todas las paginas
    function ConsultarTodo()
    {
        $this->ConectarBD();
        $sql = "select * from FACTURA ORDER BY FACTURA_FECHA";
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
	
	//Consultar las lineas de factura asociadas a una factura
	function ConsultarLineasFactura()
	{

		$this->ConectarBD();
		$sql = "SELECT LINEA_FACTURA_CONCEPTO, LINEA_FACTURA_UNIDADES, LINEA_FACTURA_PRECIOUD FROM LINEA_FACTURA WHERE FACTURA_ID = ".$this->FACTURA_ID."";
        $resultado=$this->mysqli->query($sql);


		    if ($resultado->num_rows===0){
		        echo "";
            }
            else {
                $toret = array();
				$i=0;
                while ($fila= $resultado->fetch_array()) {
					$toret[$i]=$fila;
					$i++;

				}	

                return $toret;
            }

	}
}