<?php
class Pagina 
{
	var $PAGINA_ID;		//Identificador de la pagina
	var $PAGINA_LINK;	//Link de la pagina
	var $PAGINA_NOM;	//Nombre de la pagina
	
	function __construct($PAGINA_ID, $PAGINA_LINK, $PAGINA_NOM)
	{
		$this->PAGINA_ID = $PAGINA_ID;
		$this->PAGINA_LINK= $PAGINA_LINK;
		$this->PAGINA_NOM = $PAGINA_NOM;
		
	}
	
	//Conectarse a la BD
	function ConectarBD()
	{
		$this->mysqli = new mysqli("localhost", "root", "", "IU_DATABASE");
		if ($this->mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
		}
	}
	
	//Anadir una pagina
	function insert_pagina()
	{
		$this->ConectarBD();
		
		if ($this->PAGINA_ID <> '' )
		{
			$sql = "select * from PAGINA where PAGINA_ID = '".$this->PAGINA_ID."'";
			if (!$result = $this->mysqli->query($sql)){
				return 'Error en la consulta sobre la base de datos'; 	
			}	
			else {
				if ($result->num_rows == 0){
					$sql = "INSERT INTO PAGINA (PAGINA_ID, PAGINA_LINK, PAGINA_NOM) VALUES (";
					$sql = $sql . "'$this->PAGINA_ID', '$this->PAGINA_LINK', '$this->PAGINA_NOM')";
				
					$this->mysqli->query($sql);
					return 'Anadida con exito'; 	
				}
				else{
					return 'La pagina ya existe en la base de datos'; 	
				}
			}
		}
		else{
			return 'Introduzca un valor para el identificador de la pagina';
		}
	}

	//Funcion de destruccion del objeto: se ejecuta automaticamente
	function __destruct()
	{

	}

	//Consultar un lugar
	function select_pagina()
	{
		$this->ConectarBD();
		$sql = "select PAGINA_ID, PAGINA_NOM, PAGINA_LINK from PAGINA where PAGINA_ID = '".$this->PAGINA_ID."'";
		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos';
		}
		else{
			return $resultado;
		}
	}

	//Borrar
	function delete_pagina()
	{
		$this->ConectarBD();
		$sql = "select * from PAGINA where PAGINA_ID = '".$this->PAGINA_ID."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
			$sql = "delete from PAGINA where PAGINA_ID	= '".$this->PAGINA_ID."'";
			$this->mysqli->query($sql);
			return "La pagina ha sido borrada correctamente";
		}
		else
			return "La pagina no existe";
	}

	
	function RellenaDatos()
	{
		$this->ConectarBD();
		$sql = "select * from PAGINA where PAGINA_ID = '".$this->PAGINA_ID."'";
		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos'; 
		}
		else{
			$result = $resultado->fetch_array();
			return $result;
		}
	}

	//Modificar
	function update_pagina()
	{
		$this->ConectarBD();
		$sql = "select * from PAGINA where PAGINA_ID = '".$this->PAGINA_ID."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
			$sql = "UPDATE PAGINA SET PAGINA_LINK ='".$this->PAGINA_LINK."', PAGINA_NOM ='".$this->PAGINA_NOM."', PAGINA_ID ='".$this->PAGINA_ID."' WHERE PAGINA_ID ='".$this->PAGINA_ID."'";
			if (!($resultado = $this->mysqli->query($sql))){
				return "Error en la consulta sobre la base de datos";
			}
			else{
				return "La pagina se ha modificado con exito";
			}
		}
		else
			return "La pagina no existe";
	}
	
	//Listar todas las paginas
	function listar_pagina()
	{
		$this->ConectarBD();
		//$sql = "select PAGINA_ID, PAGINA_NOM, PAGINA_LINK from PAGINA";
		$sql = "select * from PAGINA";
		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos';
		}
		else{
			return $resultado;
		}
	}

}