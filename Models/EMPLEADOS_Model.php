<?php
//Clase : USUARIOS_Modelo
//Creado el : 3/10/2016
//Creado por: jrodeiro
//-------------------------------------------------------

class EMPLEADOS_Modelo
{


	var $EMP_USER;
	var $EMP_PASSWORD;
	var $EMP_FECH_NAC;
	var $EMP_EMAIL;
	var $EMP_NOMBRE;
	var $EMP_APELLIDO;
	var $EMP_DNI;
	var $EMP_TELEFONO;
	var $EMP_CUENTA;
	var $EMP_DIRECCION;
	var $EMP_COMENTARIOS;
	var $EMP_TIPO;
	var $EMP_ESTADO;
	var $EMP_FOTO;
	var $EMP_NOMINA;
	var $mysqli;


function __construct($EMP_USER, $EMP_PASSWORD, $EMP_FECH_NAC, $EMP_EMAIL, $EMP_NOMBRE, $EMP_APELLIDO, $EMP_DNI, $EMP_TELEFONO, $EMP_CUENTA, $EMP_DIRECCION, $EMP_COMENTARIOS,  $EMP_TIPO, $EMP_ESTADO, $EMP_FOTO, $EMP_NOMINA)
{
    $this->EMP_USER =  $EMP_USER;
	$this->EMP_PASSWORD = $EMP_PASSWORD;
	$this->EMP_FECH_NAC = $EMP_FECH_NAC;
	$this->EMP_EMAIL = $EMP_EMAIL;
	$this->EMP_NOMBRE =  $EMP_NOMBRE;
	$this->EMP_APELLIDO =  $EMP_APELLIDO;
	$this->EMP_DNI = $EMP_DNI;
	$this->EMP_TELEFONO =  $EMP_TELEFONO;
	$this->EMP_CUENTA =$EMP_CUENTA;
	$this->EMP_DIRECCION =$EMP_DIRECCION;
	$this->EMP_COMENTARIOS =$EMP_COMENTARIOS;
	$this->EMP_TIPO =$EMP_TIPO;
	$this->EMP_ESTADO =$EMP_ESTADO;
	$this->EMP_FOTO=$EMP_FOTO;
	$this->EMP_NOMINA=$EMP_NOMINA;

}


function ConectarBD()
{
    $this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
	
	if ($this->mysqli->connect_errno) {
		echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
	}
}


function Insertar()
{
    $this->ConectarBD();
    if ($this->EMP_USER <> '' ){
		
        $sql = "select * from EMPLEADOS where EMP_USER = '".$this->EMP_USER."'";

		if (!$result = $this->mysqli->query($sql)){
			return 'No se ha podido conectar con la base de datos';
		}
		else {
			if ($result->num_rows == 0){
				
				$sql = "INSERT INTO EMPLEADOS (EMP_USER, EMP_PASSWORD, EMP_FECH_NAC, EMP_EMAIL, EMP_NOMBRE, EMP_APELLIDO, EMP_DNI, EMP_TELEFONO, EMP_CUENTA, EMP_DIRECCION, EMP_COMENTARIOS, EMP_TIPO, EMP_ESTADO, EMP_FOTO, EMP_NOMINA) VALUES ('";
				$sql = $sql . "$this->EMP_USER', '$this->EMP_PASSWORD', '$this->EMP_FECH_NAC', '$this->EMP_EMAIL', '$this->EMP_NOMBRE', '$this->EMP_APELLIDO', '$this->EMP_DNI', '$this->EMP_TELEFONO','$this->EMP_CUENTA', '$this->EMP_DIRECCION', '$this->EMP_COMENTARIOS',  '$this->EMP_TIPO', '$this->EMP_ESTADO', '$this->EMP_FOTO', '$this->EMP_NOMINA')";

				$this->mysqli->query($sql);

				return 'Inserción realizada con éxito'; //operacion de insertado correcta
			}
			else
				return 'El empleado ya existe en la base de datos'; //el usuario ya existe
		}
    }
    else{
        //echo "Introduzca un valor para el usuario git<br>";
	return 'Introduzca un valor para usuario del empleado'; // introduzca un valor para el usuario
}
}

//funcion de destrucción del objeto: se ejecuta automaticamente
//al finalizar el script
function __destruct()
{

}

//funcion Consultar: hace una búsqueda en la tabla jugador con
//los datos de dni y nombre. Si van vacios devuelve todos
function Consultar()
{
    $this->ConectarBD();
    $sql = "select EMP_USER, EMP_PASSWORD, EMP_NOMBRE, EMP_APELLIDO, EMP_DNI, EMP_FECH_NAC, EMP_EMAIL, EMP_TELEFONO, EMP_CUENTA, EMP_DIRECCION, EMP_COMENTARIOS, EMP_TIPO, EMP_FOTO, EMP_NOMINA, EMP_ESTADO from EMPLEADOS where  ((EMP_NOMBRE ="."'$this->EMP_NOMBRE'".") AND (EMP_APELLIDO="."'$this->EMP_APELLIDO'".")) OR (EMP_DNI="."'$this->EMP_DNI'".") OR (EMP_USER="."'$this->EMP_USER'".")";

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
	function ConsultarTodo()
	{
		$this->ConectarBD();
		$sql = "select * from EMPLEADOS";
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

function Borrar()
{
    $this->ConectarBD();
    $sql = "select * from EMPLEADOS where EMP_USER = '".$this->EMP_USER."'";
    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    {
    	if ($this->EMP_ESTADO='Activo') {
			$sql = "UPDATE  EMPLEADOS SET EMP_ESTADO='Inactivo' where EMP_USER = '" . $this->EMP_USER . "'";
			$this->mysqli->query($sql);
			return "El empleado ha sido borrado correctamente";
		}
		else {
			return "El empleado ya no se encuentra contratado";
		}
    }
    else
        return "El empleado no existe";
}

function RellenaDatos()
{
    $this->ConectarBD();
    $sql = "select * from EMPLEADOS where EMP_USER = '".$this->EMP_USER."'";

    if (!($resultado = $this->mysqli->query($sql))){
	return 'Error en la consulta sobre la base de datos';
	}
    else{
	$result = $resultado->fetch_array();
	return $result;
	}
}
//EMP_USER, EMP_PASSWORD, EMP_FECH_NAC, EMP_EMAIL, EMP_NOMBRE, EMP_APELLIDO, EMP_DNI, EMP_TELEFONO, EMP_CUENTA, EMP_DIRECCION, EMP_COMENTARIOS, EMP_LESIONES, EMP_TIPO, EMP_ESTADO
function Modificar()
{
    $this->ConectarBD();
    $sql = "select * from EMPLEADOS where EMP_USER = '".$this->EMP_USER."'";
    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    {
	$sql = "UPDATE EMPLEADOS SET EMP_USER ='".$this->EMP_USER."',EMP_PASSWORD = '".$this->EMP_PASSWORD."',EMP_FECH_NAC ='".$this->EMP_FECH_NAC."',EMP_EMAIL= '".$this->EMP_EMAIL."',EMP_NOMBRE= '".$this->EMP_NOMBRE."',EMP_APELLIDO = '".$this->EMP_APELLIDO."',EMP_DNI= '".$this->EMP_DNI."',EMP_TELEFONO= '".$this->EMP_TELEFONO."',EMP_CUENTA= '".$this->EMP_CUENTA."',EMP_DIRECCION= '".$this->EMP_DIRECCION."',EMP_COMENTARIOS= '".$this->EMP_COMENTARIOS."',EMP_ESTADO= '".$this->EMP_ESTADO."'";
	 if($this->EMP_FOTO!=''){
	 	$sql.=", EMP_FOTO='".$this->EMP_FOTO."'";
	 }
		if($this->EMP_NOMINA!=''){
			$sql.=", EMP_NOMINA='".$this->EMP_NOMINA."'";
		}


	$sql.= " WHERE EMP_USER = '".$this->EMP_USER."'";


		if (!($resultado = $this->mysqli->query($sql))){
		return "Se ha producido un error en la modificación del empleado"; // sustituir por un try
	}
	else{
		return "El empleado se ha modificado con éxito";
	}
    }
    else
    return "El empleado no existe";
}
	function Login(){

		$this->ConectarBD();
		$sql = "select * from EMPLEADOS where EMP_USER = '".$this->EMP_USER."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1){  // existe el usuario
			$tupla = $result->fetch_array();
			if ($tupla['EMP_PASSWORD'] == $this->EMP_PASSWORD){ //  coinciden las password
				return true;
			}
			else{
				return 'La contraseña para este empleado es errónea'; //las passwords no coinciden
			}
		}
		else{
			return "El empleado no existe"; //no existe el usuario
		}

	}



}//fin de clase














?>
