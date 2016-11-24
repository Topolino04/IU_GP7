<?php
//Clase : USUARIOS_Modelo
//Creado el : 3/10/2016
//Creado por: jrodeiro
//-------------------------------------------------------
include '../Functions/LibraryFunctions.php';

class EMPLEADOS_Modelo
{

//Parámetros de la clase empleado
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

//Constructor de la clase empleado
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

//Función para conectarnos a la Base de datos
function ConectarBD()
{
    $this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
	
	if ($this->mysqli->connect_errno) {
		echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
	}
}

//Insertar empleado
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

				//Insertamos en la tabla EMPLEADOS
				$sql = "INSERT INTO EMPLEADOS (EMP_USER, EMP_PASSWORD, EMP_FECH_NAC, EMP_EMAIL, EMP_NOMBRE, EMP_APELLIDO, EMP_DNI, EMP_TELEFONO, EMP_CUENTA, EMP_DIRECCION, EMP_COMENTARIOS, EMP_TIPO, EMP_ESTADO, EMP_FOTO, EMP_NOMINA) VALUES ('";

				$sql = $sql . "$this->EMP_USER', '".md5($this->EMP_PASSWORD)."', '$this->EMP_FECH_NAC', '$this->EMP_EMAIL', '$this->EMP_NOMBRE', '$this->EMP_APELLIDO', '$this->EMP_DNI', '$this->EMP_TELEFONO','$this->EMP_CUENTA', '$this->EMP_DIRECCION', '$this->EMP_COMENTARIOS',  '$this->EMP_TIPO', '$this->EMP_ESTADO', '$this->EMP_FOTO', '$this->EMP_NOMINA')";

				$this->mysqli->query($sql);
				//Cogemos las páginas que le corresponden por pertenecer a un determinado rol
				$sql = "SELECT DISTINCT PAGINA.PAGINA_ID FROM EMPLEADOS, ROL_FUNCIONALIDAD, FUNCIONALIDAD_PAGINA, PAGINA  WHERE EMPLEADOS.EMP_TIPO=ROL_FUNCIONALIDAD.ROL_ID AND ROL_FUNCIONALIDAD.FUNCIONALIDAD_ID=FUNCIONALIDAD_PAGINA.FUNCIONALIDAD_ID AND PAGINA.PAGINA_ID=FUNCIONALIDAD_PAGINA.PAGINA_ID AND EMP_USER='" . $this->EMP_USER."'";

				if (!($resultado = $this->mysqli->query($sql))) {
					echo 'Error en la consulta sobre la base de datos';
				} else {
					while ($tupla=$resultado->fetch_array()){
						//Insertamos esas páginas en la tabla EMPLEADOS_PÁGINA de la que se van a recoger las acciones permitidas
						$sql="INSERT INTO EMPLEADOS_PAGINA (EMP_USER, PAGINA_ID) VALUES('".$this->EMP_USER."',".$tupla['PAGINA_ID'].")";

						$this->mysqli->query($sql);
					}

				}

				return 'Inserción realizada con éxito';
			}
			else
				return 'El empleado ya existe en la base de datos';
		}
    }
    else{

	return 'Introduzca un valor para usuario del empleado';
}
}

//destrucción del objeto
function __destruct()
{

}

//Consulta por nombre y apellido, o por dni o por nombre de usuario devolviendo todos los empleados que cumplan la condición
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
//Devuelve la información de todos los empleados
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
//Realiza el borrado lógico de un empleado cambiando su estado a Inactivo
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
//Devuelve los valores almacenados para un determinado usuario para posteriormente rellenar un formulario
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
//Actualiza en la base de datos la información de un determinado empleado
function Modificar()
{
    $this->ConectarBD();
    $sql = "select * from EMPLEADOS where EMP_USER = '".$this->EMP_USER."'";
    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    {if ($this->EMP_USER==='ADMIN') {
    	$this->EMP_TIPO=1;
	}
	$sql = "UPDATE EMPLEADOS SET EMP_PASSWORD = '".md5($this->EMP_PASSWORD)."',EMP_FECH_NAC ='".$this->EMP_FECH_NAC."',EMP_EMAIL= '".$this->EMP_EMAIL."',EMP_NOMBRE= '".$this->EMP_NOMBRE."',EMP_APELLIDO = '".$this->EMP_APELLIDO."',EMP_DNI= '".$this->EMP_DNI."',EMP_TELEFONO= '".$this->EMP_TELEFONO."',EMP_CUENTA= '".$this->EMP_CUENTA."',EMP_DIRECCION= '".$this->EMP_DIRECCION."',EMP_COMENTARIOS= '".$this->EMP_COMENTARIOS."',EMP_ESTADO= '".$this->EMP_ESTADO."'";
	 if($this->EMP_FOTO!=''){
	 	$sql.=", EMP_FOTO='".$this->EMP_FOTO."'";
	 }
		if($this->EMP_NOMINA!=''){
			$sql.=", EMP_NOMINA='".$this->EMP_NOMINA."'";
		}
		$sql.=" WHERE EMP_USER='".$this->EMP_USER."'";





		if (!($resultado = $this->mysqli->query($sql))){
		return "Se ha producido un error en la modificación del empleado"; // sustituir por un try
	}
	else{
		$sql= "DELETE FROM EMPLEADOS_PAGINA WHERE EMP_USER='".$this->EMP_USER."'";

		$this->mysqli->query($sql);

		$sql = "SELECT DISTINCT PAGINA.PAGINA_ID FROM EMPLEADOS, ROL_FUNCIONALIDAD, FUNCIONALIDAD_PAGINA, PAGINA  WHERE EMPLEADOS.EMP_TIPO=ROL_FUNCIONALIDAD.ROL_ID AND ROL_FUNCIONALIDAD.FUNCIONALIDAD_ID=FUNCIONALIDAD_PAGINA.FUNCIONALIDAD_ID AND PAGINA.PAGINA_ID=FUNCIONALIDAD_PAGINA.PAGINA_ID AND EMP_USER='" . $this->EMP_USER."'";

		if (!($resultado = $this->mysqli->query($sql))) {
			echo 'Error en la consulta sobre la base de datos';
		} else {
			while ($tupla=$resultado->fetch_array()){

				$sql="INSERT INTO EMPLEADOS_PAGINA (EMP_USER, PAGINA_ID) VALUES('".$this->EMP_USER."',".$tupla['PAGINA_ID'].")";

				$this->mysqli->query($sql);
			}

		}

		return "El empleado se ha modificado con éxito";
	}
    }
    else
    return "El empleado no existe";
}
//Nos permite modificar las acciones que puede realizar un determinado usuario
	function ModificarPaginas($pags){
		$this->ConectarBD();
		$sql="DELETE FROM EMPLEADOS_PAGINA WHERE EMP_USER='".$this->EMP_USER."'";
		$this->mysqli->query($sql);
		for ($i=0;$i<count($pags);$i++){
			$sql="INSERT INTO  EMPLEADOS_PAGINA(EMP_USER,PAGINA_ID) VALUES ('".$this->EMP_USER."', ".ConsultarIDPagina($pags[$i]).")";

			$this->mysqli->query($sql);
		}
	}
	//Comprueba que el usuario pueda loguearse
	function Login(){

		$this->ConectarBD();
		$sql = "select * from EMPLEADOS where EMP_USER = '".$this->EMP_USER."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1 ){
			$tupla = $result->fetch_array();
			if ($tupla['EMP_PASSWORD'] == md5($this->EMP_PASSWORD)){
				return true;
			}
			else{
				return 'La contraseña para este empleado es errónea';
			}
		}
		else{
			return "El empleado no existe";
		}

	}
//Nos devuelve las páginas a las que tiene acceso el usuario
	function ConsultarPaginas()
	{
		$this->ConectarBD();

		$sql = "select PAGINA_ID from EMPLEADOS_PAGINA WHERE EMP_USER='".$this->EMP_USER."'";

		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos';
		}
		else{


			$toret=array();
			$i=0;

			while ($fila= $resultado->fetch_array()) {


				$toret[$i]=ConsultarNOMPagina($fila['PAGINA_ID']);
				$i++;

			}


			return $toret;

		}
	}




}













?>
