<?php
class Funcionalidad 
{
	//echo $strings[
	var $FUNCIONALIDAD_ID;		//Identificador de la funcionalidad
	var $FUNCIONALIDAD_NOM;		//Nombre de la funcionalidad
	
	function __construct($FUNCIONALIDAD_ID, $FUNCIONALIDAD_NOM)
	{
		$this->FUNCIONALIDAD_ID = $FUNCIONALIDAD_ID;
		$this->FUNCIONALIDAD_NOM = $FUNCIONALIDAD_NOM;
		
	}
	
	//Conectarse a la BD
	function ConectarBD()
	{
		include '../Locates/Strings_Español.php';
		//include '../Locates/Strings_Galego.php';
		
		$this->mysqli = new mysqli("localhost", "root", "", "IU_DATABASE");
		if ($this->mysqli->connect_errno) {
			echo $strings['Fallo al conectar a MySQL: ('] . $this->mysqli->connect_errno . $strings[') '] . $this->mysqli->connect_error;
		}
	}
	
	//Anadir una funcionalidad
	function insert_funcionalidad()
	{
		include '../Locates/Strings_Español.php';
		//include '../Locates/Strings_Galego.php';
		
		$this->ConectarBD();
		
		if ($this->FUNCIONALIDAD_ID <> '' )
		{
			$sql = "select * from FUNCIONALIDAD where FUNCIONALIDAD_ID = '".$this->FUNCIONALIDAD_ID."'";
			if (!$result = $this->mysqli->query($sql)){
				return $strings['Error en la consulta sobre la base de datos']; 	
			}	
			else {
				if ($result->num_rows == 0){
					$sql = "INSERT INTO FUNCIONALIDAD (FUNCIONALIDAD_ID, FUNCIONALIDAD_NOM) VALUES (";
					$sql = $sql . "'$this->FUNCIONALIDAD_ID', '$this->FUNCIONALIDAD_NOM')";
				
					$this->mysqli->query($sql);
					return $strings['Anadida con exito']; 	
				}
				else{
					return $strings['La funcionalidad ya existe en la base de datos']; 	
				}
			}
		}
		else{
		return $strings['Introduzca un valor para el identificador de la funcionalidad'];
		}
	}

	//Funcion de destruccion del objeto: se ejecuta automaticamente
	function __destruct()
	{

	}

	//Consultar
	function select_funcionalidad()
	{
		include '../Locates/Strings_Español.php';
		//include '../Locates/Strings_Galego.php';
		
		$this->ConectarBD();
		$sql = "select FUNCIONALIDAD_ID, FUNCIONALIDAD_NOM from FUNCIONALIDAD where FUNCIONALIDAD_ID = '".$this->FUNCIONALIDAD_ID."'";
		if (!($resultado = $this->mysqli->query($sql))){
			return $strings['Error en la consulta sobre la base de datos'];
		}
		else{
			return $resultado;
		}
	}

	//Borrar
	function delete_funcionalidad()
	{
		include '../Locates/Strings_Español.php';
		//include '../Locates/Strings_Galego.php';
		
		$this->ConectarBD();
		$sql = "select * from FUNCIONALIDAD where FUNCIONALIDAD_ID = '".$this->FUNCIONALIDAD_ID."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
			$sql = "delete from FUNCIONALIDAD where FUNCIONALIDAD_ID	= '".$this->FUNCIONALIDAD_ID."'";
			$this->mysqli->query($sql);
			return $strings['La funcionalidad ha sido borrada correctamente'];
		}
		else
			return $strings['La funcionalidad no existe'];
	}

	
	function RellenaDatos()
	{
		include '../Locates/Strings_Español.php';
		//include '../Locates/Strings_Galego.php';
		
		$this->ConectarBD();
		$sql = "select * from FUNCIONALIDAD where FUNCIONALIDAD_ID = '".$this->FUNCIONALIDAD_ID."'";
		if (!($resultado = $this->mysqli->query($sql))){
			return $strings['Error en la consulta sobre la base de datos']; 
		}
		else{
			$result = $resultado->fetch_array();
			return $result;
		}
	}

	//Modificar
	function update_funcionalidad()
	{
		include '../Locates/Strings_Español.php';
		//include '../Locates/Strings_Galego.php';
		
		$this->ConectarBD();
		$sql = "select * from FUNCIONALIDAD where FUNCIONALIDAD_ID = '".$this->FUNCIONALIDAD_ID."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
			$sql = "UPDATE FUNCIONALIDAD SET FUNCIONALIDAD_NOM ='".$this->FUNCIONALIDAD_NOM."', FUNCIONALIDAD_ID ='".$this->FUNCIONALIDAD_ID."' WHERE FUNCIONALIDAD_ID ='".$this->FUNCIONALIDAD_ID."'";
			if (!($resultado = $this->mysqli->query($sql))){
				return $strings['Error en la consulta sobre la base de datos'];
			}
			else{
				return $strings['La funcionalidad se ha modificado con exito'];
			}
		}
		else
			return $strings['La funcionalidad no existe'];
	}
	
	//Listar todas las funcionalidads
	function listar_funcionalidad()
	{
		include '../Locates/Strings_Español.php';
		//include '../Locates/Strings_Galego.php';
		
		$this->ConectarBD();
		//$sql = "select FUNCIONALIDAD_ID, FUNCIONALIDAD_NOM from FUNCIONALIDAD";
		$sql = "select * from FUNCIONALIDAD";
		if (!($resultado = $this->mysqli->query($sql))){
			return $strings['Error en la consulta sobre la base de datos'];
		}
		else{
			return $resultado;
		}
	}

}