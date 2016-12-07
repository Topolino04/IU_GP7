<?php
//Clase : USUARIOS_Modelo
//Creado el : 3/10/2016
//Creado por: jrodeiro
//-------------------------------------------------------
//Clase Cliente que modeliza un cliente inscrito en el gimnasio
class CLIENTE_Modelo
{
	var $CLIENTE_ID; //Identificador único para cada cliente
	var $CLIENTE_DNI; //Dni del cliente
	var $CLIENTE_NOMBRE; //Nombre del cliente
	var $CLIENTE_APELLIDOS;//Apellidos del cliente
	var $CLIENTE_FECH_NAC; //Fecha de nacimiento del cliente
	var $CLIENTE_TELEFONO1; //Telefono 1 del cliente
	var $CLIENTE_TELEFONO2; //Telefono 2 del cliente
	var $CLIENTE_TELEFONO3; //Telefono 3 del cliente
	var $CLIENTE_CORREO; //Cuenta de correo electronico del cliente
	var $CLIENTE_PROFESION; //Profesion del cliente
	var $CLIENTE_DIRECCION; //Direccion postal del cliente
	var $CLIENTE_COMENTARIOS; //Espacio para incluir comentarios sobre el cliente
	var $CLIENTE_ESTADO; //Atributo que nos indica si el empleado está activo o inactivo
	var $CLIENTE_DOM; //Documento de domiciliación bancaria
	var $CLIENTE_LOPD; //Documento de la ley de proteccion de datos
	var $CLIENTE_TIPO; //1 si el cliente es interno,0 si es externo
	var $mysqli; //Base de datos

//Constructor de la clase
function __construct( $CLIENTE_DNI,$CLIENTE_NOMBRE, $CLIENTE_APELLIDOS, $CLIENTE_FECH_NAC,  $CLIENTE_TELEFONO1,$CLIENTE_TELEFONO2,$CLIENTE_TELEFONO3,  $CLIENTE_CORREO, $CLIENTE_PROFESION,  $CLIENTE_DIRECCION, $CLIENTE_COMENTARIOS, $CLIENTE_ESTADO,$CLIENTE_TIPO, $CLIENTE_DOM,$CLIENTE_LOPD)
{	
    $this->CLIENTE_FECH_NAC =  $CLIENTE_FECH_NAC;
	$this->CLIENTE_CORREO = $CLIENTE_CORREO;
	$this->CLIENTE_NOMBRE = $CLIENTE_NOMBRE;
	$this->CLIENTE_APELLIDOS = $CLIENTE_APELLIDOS;
	$this->CLIENTE_DNI = $CLIENTE_DNI;
	$this->CLIENTE_TELEFONO1 = $CLIENTE_TELEFONO1;
	$this->CLIENTE_TELEFONO2 = $CLIENTE_TELEFONO2;
	$this->CLIENTE_TELEFONO3 = $CLIENTE_TELEFONO3;
	$this->CLIENTE_PROFESION = $CLIENTE_PROFESION;
	$this-> CLIENTE_DIRECCION =  $CLIENTE_DIRECCION;
	$this->CLIENTE_COMENTARIOS = $CLIENTE_COMENTARIOS;
	$this->CLIENTE_ESTADO = $CLIENTE_ESTADO;
	$this->CLIENTE_DOM = $CLIENTE_DOM;
	$this->CLIENTE_LOPD = $CLIENTE_LOPD;
	$this->CLIENTE_TIPO=$CLIENTE_TIPO;

}

//Función para la conexión con la base de datos
function ConectarBD()
{
    $this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
	
	if ($this->mysqli->connect_errno) {
		echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
	}
}

//Inserción de un nuevo cliente
function Insertar()
{
    $this->ConectarBD();
    if ($this->CLIENTE_DNI <> '' ){ //Si tiene dni asignado se comprueba que no exista ya en la bd

        $sql = "select * from CLIENTE where CLIENTE_DNI = '".$this->CLIENTE_DNI."'";

		if (!$result = $this->mysqli->query($sql)){
			return 'No se ha podido conectar con la base de datos';
		}
		else {
			if ($result->num_rows == 0){ //Si no existe se inserta
				
				$sql = "INSERT INTO CLIENTE ( CLIENTE_DNI,CLIENTE_NOMBRE, CLIENTE_APELLIDOS, CLIENTE_FECH_NAC,  CLIENTE_TELEFONO1,CLIENTE_TELEFONO2,CLIENTE_TELEFONO3,  CLIENTE_CORREO, CLIENTE_PROFESION,  CLIENTE_DIRECCION, CLIENTE_COMENTARIOS, CLIENTE_ESTADO, CLIENTE_TIPO, CLIENTE_DOM,CLIENTE_LOPD) VALUES ('";
				$sql = $sql . "$this->CLIENTE_DNI', '$this->CLIENTE_NOMBRE', '$this->CLIENTE_APELLIDOS', '$this->CLIENTE_FECH_NAC', '$this->CLIENTE_TELEFONO1', '$this->CLIENTE_TELEFONO2', '$this->CLIENTE_TELEFONO3', '$this->CLIENTE_CORREO', '$this->CLIENTE_PROFESION', '$this->CLIENTE_DIRECCION', '$this->CLIENTE_COMENTARIOS', '$this->CLIENTE_ESTADO', '$this->CLIENTE_TIPO','$this->CLIENTE_DOM', '$this->CLIENTE_LOPD')";

				$this->mysqli->query($sql);
				return 'Inserción realizada con éxito';
			}
			else
				return 'El cliente ya existe en la base de datos';
		}
    }
    else{

	return 'Introduzca un valor para el dni del cliente';
}
}

//Destruye el objeto, se ejecuta al final
function __destruct()
{

}

//Nos devuelve toda la información de un cliente en forma de array asociativo
function Consultar()
{
    $this->ConectarBD();
    $sql = "select CLIENTE_ID, CLIENTE_DNI,CLIENTE_NOMBRE, CLIENTE_APELLIDOS, CLIENTE_FECH_NAC,  CLIENTE_TELEFONO1,CLIENTE_TELEFONO2,CLIENTE_TELEFONO3,  CLIENTE_CORREO, CLIENTE_PROFESION,  CLIENTE_DIRECCION, CLIENTE_COMENTARIOS, CLIENTE_ESTADO, CLIENTE_TIPO, CLIENTE_DOM,CLIENTE_LOPD from CLIENTE where  ((CLIENTE_NOMBRE ="."'$this->CLIENTE_NOMBRE'".") AND (CLIENTE_APELLIDOS="."'$this->CLIENTE_APELLIDOS'".")) OR (CLIENTE_DNI="."'$this->CLIENTE_DNI'".")";

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

//Nos devuelve la información de todos los CLIENTE de la base de datos
	function ConsultarTodo()
	{
		$this->ConectarBD();
		$sql = "select  CLIENTE_ID, CLIENTE_DNI,CLIENTE_NOMBRE, CLIENTE_APELLIDOS, CLIENTE_FECH_NAC,  CLIENTE_TELEFONO1,CLIENTE_TELEFONO2,CLIENTE_TELEFONO3,  CLIENTE_CORREO, CLIENTE_PROFESION,  CLIENTE_DIRECCION, CLIENTE_COMENTARIOS, CLIENTE_ESTADO, CLIENTE_TIPO, CLIENTE_DOM,CLIENTE_LOPD from CLIENTE";

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
//Realiza el borrado lógico de uno de los clientes
function Borrar()
{    $this->ConectarBD();
	$sql = "select * from CLIENTE where CLIENTE_DNI = '".$this->CLIENTE_DNI."'";
	$result = $this->mysqli->query($sql);
	if ($result->num_rows == 1)
	{
		if ($this->EMP_ESTADO='Activo') { //Si existe y tiene estado Activo, se lo cambiamos a Inactivo
			$sql = "UPDATE  CLIENTE SET CLIENTE_ESTADO='Inactivo', CLIENTE_COMENTARIOS='".$this->CLIENTE_COMENTARIOS."' where CLIENTE_DNI = '" . $this->CLIENTE_DNI . "'";
			$this->mysqli->query($sql);
			return "El cliente ha sido borrado correctamente";
		}
		else { //Si tiene el estado como Inactivo informamos que ya está como no activo
			return "El cliente ya no se encuentra acivo";
		}
	}
	else //Informamos en caso de que no nos duevuelva ninguna tupla la consulta
		return "El cliente no existe";;
}

//Nos devuelve todos los datos de un empleado a partir de su DNI
function RellenaDatos()
{
    $this->ConectarBD();
    $sql = "select * from CLIENTE where CLIENTE_DNI = '".$this->CLIENTE_DNI."'";

    if (!($resultado = $this->mysqli->query($sql))){
	return 'Error en la consulta sobre la base de datos';
	}
    else{
	$result = $resultado->fetch_array();
		if($result['CLIENTE_TELEFONO2']==='0'){
			$result['CLIENTE_TELEFONO2']='';
		}
		if($result['CLIENTE_TELEFONO3']==='0'){
			$result['CLIENTE_TELEFONO3']='';
		}
	return $result;
	}
}

	function ConsultarActividades()
	{
		$this->ConectarBD();
		$CLIENTE_ID=consultarIDCliente($this->CLIENTE_DNI);
		$sql = "select ACTIVIDAD_ID from CLIENTE_ASISTE_ACTIVIDAD WHERE CLIENTE_ID=".$CLIENTE_ID;

		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos';
		}
		else{


			$toret=array();
			$i=0;

			while ($fila= $resultado->fetch_array()['ACTIVIDAD_ID']) {


				$toret[$i]=consultarNomActividad($fila);
				$i++;

			}


			return $toret;

		}
	}
	function ConsultarLesiones()
	{
		$this->ConectarBD();
		$CLIENTE_ID=consultarIDCliente($this->CLIENTE_DNI);
		$sql = "select LESION_ID from LESION WHERE CLIENTE_ID=".$CLIENTE_ID;

		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos';
		}
		else{


			$toret=array();
			$i=0;

			while ($fila= $resultado->fetch_array()['LESION_ID']) {


				$toret[$i]=consultarNomLesion($fila);
				$i++;

			}


			return $toret;

		}
	}
//Actualizamos la información de un cliente con la nueva información que se nos pasa
function Modificar()
{
    $this->ConectarBD();
    $sql = "select * from CLIENTE where CLIENTE_DNI = '".$this->CLIENTE_DNI."'";
    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    {
	$sql = "UPDATE CLIENTE SET CLIENTE_DNI = '".$this->CLIENTE_DNI."',CLIENTE_NOMBRE ='".$this->CLIENTE_NOMBRE."',CLIENTE_APELLIDOS= '".$this->CLIENTE_APELLIDOS."',CLIENTE_FECH_NAC= '".$this->CLIENTE_FECH_NAC."',CLIENTE_TELEFONO1 = '".$this->CLIENTE_TELEFONO1."',CLIENTE_TELEFONO2= '".$this->CLIENTE_TELEFONO2."',CLIENTE_TELEFONO3 ='".$this->CLIENTE_TELEFONO3."',CLIENTE_CORREO= '".$this->CLIENTE_CORREO."',CLIENTE_PROFESION= '".$this->CLIENTE_PROFESION."',CLIENTE_DIRECCION= '".$this->CLIENTE_DIRECCION."',CLIENTE_COMENTARIOS= '".$this->CLIENTE_COMENTARIOS."',CLIENTE_ESTADO= '".$this->CLIENTE_ESTADO."'";
		if($this->CLIENTE_DOM!=''){
			$sql.=", CLIENTE_DOM='".$this->CLIENTE_DOM."'";
		}
		if($this->CLIENTE_LOPD!=''){
			$sql.=", CLIENTE_LOPD='".$this->CLIENTE_LOPD."'";
		}
		$sql.=" WHERE CLIENTE_DNI='".$this->CLIENTE_DNI."'";
		if (!($resultado = $this->mysqli->query($sql))){
		return "Se ha producido un error en la modificación del cliente";
	}
	else{
		return "El cliente se ha modificado con éxito";
	}
    }
    else
    return "El cliente no existe";
}



}














?>
