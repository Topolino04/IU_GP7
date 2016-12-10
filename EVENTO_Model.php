<?php

class Evento
{

	var $EVENTO_ID;
	var $EVENTO_NOMBRE;
	var $EVENTO_ORGANIZADOR;
	var $EVENTO_DESCRIPCION;
	var $LUGAR_NOMBRE;
	//var $LUGAR_ID;
	function __construct( $EVENTO_ID, $EVENTO_NOMBRE, $EVENTO_ORGANIZADOR, $EVENTO_DESCRIPCION,$LUGAR_NOMBRE)
	{

		$this->EVENTO_ID= $EVENTO_ID;
		$this->EVENTO_NOMBRE = $EVENTO_NOMBRE;
		$this->EVENTO_ORGANIZADOR = $EVENTO_ORGANIZADOR;
		$this->EVENTO_DESCRIPCION = $EVENTO_DESCRIPCION;
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
	
	//Anadir un evento
	function insert_evento()
	{
		$this->ConectarBD();
		
		if ($this->EVENTO_NOMBRE <> '' )
		{
			$sql = "select  * from EVENTO 
			  where EVENTO_NOMBRE = '".$this->EVENTO_NOMBRE."'";
			
			 
			if (!$result = $this->mysqli->query($sql)){
				return 'Error en la consulta sobre la base de datos'; 	
			}	
			else {
				if ($result->num_rows == 0){
					
					
					$sql = "INSERT INTO EVENTO (EVENTO_ID,EVENTO_NOMBRE,EVENTO_ORGANIZADOR,EVENTO_DESCRIPCION,LUGAR_NOMBRE) VALUES (";
					$sql = $sql . "'".$this->EVENTO_ID."','".$this->EVENTO_NOMBRE."','".$this->EVENTO_ORGANIZADOR."','".$this->EVENTO_DESCRIPCION."','".$this->LUGAR_NOMBRE."')";
				
				if (!$result = $this->mysqli->query($sql)){
				return 'Error en la consulta sobre la base de datos'; 	
			}	else{
					//$this->mysqli->query($sql); ESTO SOBRA
                   
					return 'Evento añadido con exito'; 	
				}}
				else{
					return 'El evento ya existe en la base de datos'; 	
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

	//Consultar una EVENTO
	function select_evento()
	{

		$this->ConectarBD();
		$sql = "select * from EVENTO where EVENTO_NOMBRE = '".$this->EVENTO_NOMBRE."'";
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

	//Borrado de un evento
	function delete_evento()
	{
		$this->ConectarBD();
		$sql = "select * from EVENTO where EVENTO_NOMBRE = '".$this->EVENTO_NOMBRE."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
			$sql = "delete from EVENTO where EVENTO_NOMBRE	= '".$this->EVENTO_NOMBRE."'";
			$this->mysqli->query($sql);
           // borrarArchivo($this->EVENTO_ID);//////////MIRAR
			return "El evento ha sido borrado correctamente";
		}
		else
			return "El evento no existe";
	}

	//Devuelve la información correspondiente a un evento
	function RellenaDatos()
	{
		$this->ConectarBD();
		$sql = "select * from EVENTO where EVENTO_NOMBRE = '".$this->EVENTO_NOMBRE."'";
		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos'; 
		}
		else{
			$result = $resultado->fetch_array();

            
			return $result;
		}
	}

	//Modificar el evento
	function update_evento($EVENTO_ID)
	{
		$this->ConectarBD();
		$sql = "select * from EVENTO where EVENTO_ID = '".$EVENTO_ID."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
            $sql ="SELECT EVENTO_ID FROM EVENTO WHERE EVENTO_ID=".$EVENTO_ID;
            $result = $this->mysqli->query($sql)->fetch_array();
           // cambiarNombreArchivo($result['EVENTO_ID'],$this->EVENTO_ID);////MIRAR XD
			$sql = "UPDATE EVENTO SET EVENTO_ID ='".$this->EVENTO_ID."', EVENTO_NOMBRE ='".$this->EVENTO_NOMBRE."', 
				EVENTO_ORGANIZADOR ='".$this->EVENTO_ORGANIZADOR."', EVENTO_DESCRIPCION ='".$this->EVENTO_DESCRIPCION."',
				LUGAR_NOMBRE ='".$this->LUGAR_NOMBRE."' WHERE EVENTO_ID ='".$EVENTO_ID."'";
			if (!($resultado = $this->mysqli->query($sql))){
				return "Error en la consulta sobre la base de datos";
			}
			else{
				return "El evento se ha modificado con exito";
			}
		}
		else
			return "El evento no existe";
	}
	
	//Listar todas los eventos
    function ConsultarTodoEvento()
    {
        $this->ConectarBD();
     
		$sql = "select * from EVENTO";
			 
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