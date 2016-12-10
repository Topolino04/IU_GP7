<?php
include '../Functions/LibraryFunctions.php';

//Clase que define un rol
class DESCUENTO_MODEL
{
	var $id;
	var $valor;
	var $descripcion;
	var $mysqli;

//Constructor de la clase rol
function __construct( $id,$valor,$descripcion)
{
	$this->id = $id;
    $this->valor = $valor;
	$this->descripcion=$descripcion;

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
function Insertar(){

    $this->ConectarBD();
    if ($this->valor < 100 && $this->valor > 0){
		$sql = "INSERT INTO DESCUENTO( DESCUENTO_VALOR, DESCUENTO_DESCRIPCION) VALUES ('$this->valor','$this->descripcion')";
		if($this->mysqli->query($sql))
			return 'Inserción realizada con éxito';
		else{
			return 'Error en la consulta sobre la base de datos';
			}
	}
	else{
		return 'Introduzca un valor entre 0 y 100';
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
    $sql = "SELECT * from DESCUENTO where  DESCUENTO_ID='{$this->id}'";
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
	$sql = "SELECT * from DESCUENTO";
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
function ConsultarDescuentosDeCliente($CLIENTE_ID)
{
	$this->ConectarBD();
	$sql = "SELECT *,(	SELECT COUNT(*)
          	FROM CLIENTE_TIENE_DESCUENTO C, DESCUENTO D
          	WHERE D.DESCUENTO_ID = C.DESCUENTO_ID AND DESCUENTO.DESCUENTO_ID =C.DESCUENTO_ID AND  C.CLIENTE_ID = {$CLIENTE_ID}) as APLICADO

FROM `DESCUENTO`
WHERE 1
            ";
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
//Borrado de la descuento
function Borrar()
{
    $this->ConectarBD();
    $sql = "SELECT * from DESCUENTO where DESCUENTO_ID = '".$this->id."'";
    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    {
        $sql = "DELETE from DESCUENTO where DESCUENTO_ID = '".$this->id."'";
        $this->mysqli->query($sql);
    	return "El descuento ha sido borrado correctamente";
    }
    else
        return "El descuento no existe";
}

function RellenaDatos()
{
    $this->ConectarBD();
    $sql = "SELECT * from DESCUENTO where DESCUENTO_ID = '".$this->id."'";
    if (!($resultado = $this->mysqli->query($sql))){
		return 'Error en la consulta sobre la base de datos';
	}
    else{
		$result = $resultado->fetch_array();
		return $result;
	}
}
//Actualizar los datos del rol
function Modificar(){
    $this->ConectarBD();
    $sql = "SELECT * from DESCUENTO where DESCUENTO_ID = ".$this->id;
    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1){
		if ($this->valor < 100 && $this->valor > 0){
			$sql = "UPDATE DESCUENTO SET `DESCUENTO_ID` = '{$this->id}', `DESCUENTO_VALOR` = '{$this->valor}', `DESCUENTO_DESCRIPCION` = '{$this->descripcion}' WHERE `DESCUENTO_ID` = '{$this->id}'";
			if($this->mysqli->query($sql))
		   		return "El descuento se ha modificado con éxito";
			else
				return 'Error en la consulta sobre la base de datos';
			}
		else
			return 'Introduzca un valor entre 0 y 100';
	}
    else{
    	return "El descuento no existe";
	}
}

function CalcularDescuentoUsuario($CLIENTE_ID){
	$this->ConectarBD();
	$sql = "SELECT SUM(DESCUENTO.DESCUENTO_VALOR) AS TOTAL
			FROM CLIENTE_TIENE_DESCUENTO, DESCUENTO
			WHERE CLIENTE_TIENE_DESCUENTO.DESCUENTO_ID = DESCUENTO.DESCUENTO_ID
			AND  CLIENTE_TIENE_DESCUENTO.CLIENTE_ID = {$CLIENTE_ID}";
	$result = $this->mysqli->query($sql);
	$resultado = $result->fetch_array();
	$res = 1-(((float)$resultado["TOTAL"])/100);
	if($res < 0)	return 0;
	else return $res;
}
function AsignarDescuentos($CLIENTE_ID , $DESCUENTOS_IDS){
	$this->ConectarBD();
	$sql ="DELETE FROM CLIENTE_TIENE_DESCUENTO WHERE CLIENTE_TIENE_DESCUENTO.CLIENTE_ID = {$CLIENTE_ID};";
	if(sizeof($DESCUENTOS_IDS)>0)
		$sql = $sql."INSERT INTO CLIENTE_TIENE_DESCUENTO (CLIENTE_ID,DESCUENTO_ID) VALUES";
	foreach($DESCUENTOS_IDS as $DESCUENTO_ID){
		$sql = $sql."({$CLIENTE_ID},{$DESCUENTO_ID}),";
	}
	$sql = trim($sql, ',');
	$sql = $sql.";";
	//echo $sql;
	if($result = $this->mysqli->multi_query($sql))
		return "Asignacion de descuentos correcta";
	else
		return 'Error en la consulta sobre la base de datos';
}
}
?>
