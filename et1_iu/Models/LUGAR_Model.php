<?php
class Lugar
{
	var $LUGAR_ID;		//Identificador del lugar
	var $LUGAR_NOMBRE;	//Nombre del lugar
	
	function __construct($LUGAR_ID,$LUGAR_NOMBRE)
	{
		$this->LUGAR_ID = $LUGAR_ID;
		$this->LUGAR_NOMBRE = $LUGAR_NOMBRE;
		
	}
	
	//Conectarse a la BD
	function ConectarBD()
	{
		$this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
		if ($this->mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
		}
	}
	
	//Anadir un lugar
	function insert_lugar()
	{
		$this->ConectarBD();
		
		if ($this->LUGAR_NOMBRE <> '' )
		{
			$sql = "select * from LUGAR where LUGAR_NOMBRE = '".$this->LUGAR_NOMBRE."'";
			
			
			if (!$result = $this->mysqli->query($sql)){
				return 'Error en la consulta sobre la base de datos'; 	
			}	
			else {
				if ($result->num_rows == 0){
					$sql = "INSERT INTO LUGAR (LUGAR_NOMBRE) VALUES (";
					$sql = $sql . "'$this->LUGAR_NOMBRE')";
					$this->mysqli->query($sql);
					
					
					
					//crearArchivo($this->LUGAR_ID);/////
					
					return 'Lugar Añadido con exito'; 	
					
				}
				else{
					return 'El lugar ya existe en la base de datos'; 	
				}
			}
		}
		else{
			return 'Introduzca un valor para el nombre del evento';
		}
	}

	//Funcion de destruccion del objeto: se ejecuta automaticamente
	function __destruct()
	{

	}

	//Consultar un lugar
		function select_lugar()
	{

		$this->ConectarBD();
		$sql = "select LUGAR_ID, LUGAR_NOMBRE from LUGAR where LUGAR_NOMBRE = '".$this->LUGAR_NOMBRE."'";
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

	//Borrar
	/*function delete_lugar()
	{
		$this->ConectarBD();
		$sql = "select * from LUGAR where LUGAR_ID = '".$this->LUGAR_ID."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
			$sql = "delete from LUGAR where LUGAR_ID	= '".$this->LUGAR_ID."'";
			$this->mysqli->query($sql);
			return "El lugar ha sido borrado correctamente";
		}
		else
			return "El lugar no existe";
	}*/
function delete_lugar()
	{
		$this->ConectarBD();
		$sql = "select * from LUGAR where LUGAR_NOMBRE = '".$this->LUGAR_NOMBRE."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
			$sql = "delete from LUGAR where LUGAR_NOMBRE	= '".$this->LUGAR_NOMBRE."'";
			if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos'; 
		}	ELSE{
			//$this->mysqli->query($sql);
           // borrarArchivo($this->LUGAR_ID);//MIRAR EN CASA
			return "El lugar ha sido borrado correctamente";
		}
		}
		else
			return "El lugar no existe";
	}

	
	function RellenaDatos()
	{
		$this->ConectarBD();
		$sql = "select * from LUGAR where LUGAR_NOMBRE = '".$this->LUGAR_NOMBRE."'";
		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos'; 
		}
		else{
			$result = $resultado->fetch_array();
			return $result;
		}
	}

	//Modificar
	function update_lugar()
	{
		$this->ConectarBD();
		$sql = "select * from LUGAR where LUGAR_ID = '".$this->LUGAR_ID."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
			$sql = "UPDATE LUGAR SET LUGAR_NOMBRE ='".$this->LUGAR_NOMBRE."', LUGAR_ID ='".$this->LUGAR_ID."' WHERE LUGAR_ID ='".$this->LUGAR_ID."'";
			
			if (!($resultado = $this->mysqli->query($sql))){
				return "Error en la consulta sobre la base de datos";
			}
			else{
				return "El lugar se ha modificado con exito";
			}
		}
		else
			return "El lugar no existe";
	}
	
	function listar_lugares()
    {
        $this->ConectarBD();
        $sql = "select LUGAR_ID, LUGAR_NOMBRE from LUGAR ORDER BY LUGAR_ID";
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

}