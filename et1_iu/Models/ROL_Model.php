<?php
include '../Functions/LibraryFunctions.php';

//Clase que define un rol
class ROL_MODEL
{
	var $ROL_ID;
	var $ROL_NOM;
	var $rol_funcionalidades;
	var $mysqli;

//Constructor de la clase rol
function __construct( $ROL_NOM,$rol_funcionalidades)
{

    $this->ROL_NOM = $ROL_NOM;
	$this->rol_funcionalidades=$rol_funcionalidades;
}

//Función para la conexión a la base de datos
function ConectarBD()
{
    $this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
	
	if ($this->mysqli->connect_errno) {
		echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
	}
}
//Insertar un nuevo rol
function Insertar()
{
    $this->ConectarBD();
    if ($this->ROL_NOM <> '' ){
		
        $sql = "select * from ROL where ROL_NOM = '".$this->ROL_NOM."'";


		if (!$result = $this->mysqli->query($sql)){
			return 'No se ha podido conectar con la base de datos';
		}
		else {
	
			if ($result->num_rows == 0){
				
				$sql = "INSERT INTO ROL( ROL_NOM) VALUES ('";
				$sql = $sql . "$this->ROL_NOM')";

				$this->mysqli->query($sql);

				for($u=0;$u<count($this->rol_funcionalidades);$u++){
					$ROL_ID=ConsultarIDRol($this->ROL_NOM);
					$sql2 = "INSERT INTO ROL_FUNCIONALIDAD(ROL_ID, FUNCIONALIDAD_ID) VALUES (".$ROL_ID.", ".ConsultarIDFuncionalidad($this->rol_funcionalidades[$u]).")";

					$this->mysqli->query($sql2);
				}


				return 'Inserción realizada con éxito';
			}
			else
				return 'El rol ya existe';
		}
    }
    else{

	return 'Introduzca un valor para el nombre del rol';
}
}

//destrucción del objeto
function __destruct()
{

}

//Nos devuelve la información de un rol determinado
function Consultar()
{
    include '../Locates/Strings_Castellano.php';
    $this->ConectarBD();
    $sql = "select * from ROL where  ROL_NOM='".$this->ROL_NOM."'";

	$resultado = $this->mysqli->query($sql);
	if ($resultado->num_rows===0){
		echo "";
	}
    else{
		$toret=array();
		$toret[0]=$resultado->fetch_array();

	return $toret;
	}
}
	function ConsultarTodo()
	{
		$this->ConectarBD();
		$sql = "select * from ROL ORDER BY ROL_ID";
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

	//Nos devuelve la información de las funcionalidades asignadas a ese rol
	function ConsultarFuncionalidades()
	{
		$this->ConectarBD();
		$ROL_ID=ConsultarIDRol($this->ROL_NOM);
		$sql = "select FUNCIONALIDAD_ID from ROL_FUNCIONALIDAD WHERE ROL_ID=".$ROL_ID;

		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos';
		}
		else{


			$toret=array();
			$i=0;

			while ($fila= $resultado->fetch_array()['FUNCIONALIDAD_ID']) {


				$toret[$i]=ConsultarNOMFuncionalidad($fila);
				$i++;

			}


			return $toret;

		}
	}

//Borrado de la funcionalidad
function Borrar()
{
    $this->ConectarBD();
    $sql = "select * from ROL where ROL_NOM = '".$this->ROL_NOM."'";
    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    {
        $sql = "delete from ROL where ROL_NOM = '".$this->ROL_NOM."'";
        $this->mysqli->query($sql);
		$sql="delete from ROL_FUNCIOLANIDAD where ROL_ID=".ConsultarIDRol($this->ROL_NOM);
		$this->mysqli->query($sql);
    	return "El rol ha sido borrado correctamente";
    }
    else
        return "El rol no existe";
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

    else
    return "El rol no existe";
}

}
?>
