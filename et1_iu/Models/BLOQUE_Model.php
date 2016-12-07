<?php
include '../Functions/LibraryFunctions.php';

//Clase que define un BLOQUE
class BLOQUE_MODEL
{
	var $BLOQUE_ID;
	var $BLOQUE_FECHA;
	var $BLOQUE_DIA;
	var $BLOQUE_HORAI;
	var $BLOQUE_HORAF;
	var $BLOQUE_LUGAR;
	var $BLOQUE_ACT1;
	var $BLOQUE_ACT2;
	var $BLOQUE_ACT3;
	var $BLOQUE_EV1;
	var $BLOQUE_EV2;
	var $BLOQUE_EV3;
	var $mysqli;

//Constructor de la clase BLOQUE
function __construct( $BLOQUE_FECHA, $BLOQUE_HORAI, $BLOQUE_HORAF,  $BLOQUE_LUGAR,$BLOQUE_ACT1,$BLOQUE_ACT2,$BLOQUE_ACT3,$BLOQUE_EV1,$BLOQUE_EV2,$BLOQUE_EV3)
{

    $this->BLOQUE_FECHA = $BLOQUE_FECHA;
	$this->BLOQUE_ACT1=$BLOQUE_ACT1;
	$this->BLOQUE_ACT2=$BLOQUE_ACT2;
	$this->BLOQUE_ACT3=$BLOQUE_ACT3;
	$this->BLOQUE_EV1=$BLOQUE_EV1;
	$this->BLOQUE_EV2=$BLOQUE_EV2;
	$this->BLOQUE_EV3=$BLOQUE_EV3;
	$this->BLOQUE_HORAI = $BLOQUE_HORAI;
	$this->BLOQUE_HORAF = $BLOQUE_HORAF;
	$this->BLOQUE_LUGAR = $BLOQUE_LUGAR;

}

//Función para la conexión a la base de datos
function ConectarBD()
{
    $this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
	
	if ($this->mysqli->connect_errno) {
		echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
	}
}
//Insertar un nuevo BLOQUE
function Insertar()
{
    $this->ConectarBD();

		
        $sql = "select * from HORARIO where BLOQUE_FECHA = '".$this->BLOQUE_FECHA."' AND BLOQUE_LUGAR='".$this->BLOQUE_LUGAR."' AND ((BLOQUE_HORAI>='".$this->BLOQUE_HORAI."' AND BLOQUE_HORAI<'".$this->BLOQUE_HORAF."') OR (BLOQUE_HORAI<'".$this->BLOQUE_HORAI."' AND BLOQUE_HORAF>'".$this->BLOQUE_HORAI."'))";


		if (!$result = $this->mysqli->query($sql)){
			return 'No se ha podido conectar con la base de datos';
		}
		else {
	
			if ($result->num_rows == 0){

					$sql = "INSERT INTO HORARIO(BLOQUE_FECHA, BLOQUE_DIA, BLOQUE_HORAI, BLOQUE_HORAF,  BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1,BLOQUE_EV2,BLOQUE_EV3) VALUES ('" . $this->BLOQUE_FECHA . "', '" . date("w", strtotime($this->BLOQUE_FECHA)) . "', '" . $this->BLOQUE_HORAI . "', '" . $this->BLOQUE_HORAF . "', '" . $this->BLOQUE_LUGAR . "', '" . $this->BLOQUE_ACT1 . "', '" . $this->BLOQUE_ACT2 . "', '" . $this->BLOQUE_ACT3 . "', '" . $this->BLOQUE_EV1 . "', '" . $this->BLOQUE_EV2 . "', '" . $this->BLOQUE_EV3 . "')";

					$this->mysqli->query($sql);
				return 'Inserción realizada con éxito';
			}
			else
				return 'El BLOQUE ya está ocupado';
		}


}

//destrucción del objeto
function __destruct()
{

}

//Nos devuelve la información de un BLOQUE determinado
function Consultar()
{
    include '../Locates/Strings_Castellano.php';
    $this->ConectarBD();
    $sql = "select * from HORARIO where BLOQUE_FECHA ='".$this->BLOQUE_FECHA."'";

	$resultado = $this->mysqli->query($sql);

	if ($resultado->num_rows===0){
		echo "";
	}
    else{$toret=array();
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
		$sql = "select * from HORARIO ORDER BY BLOQUE_ID";
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

	//Nos devuelve la información de las funcionalidades asignadas a ese BLOQUE


//Borrado de la funcionalidad
function Borrar($BLOQUE_ID)
{
    $this->ConectarBD();
    $sql = "select * from HORARIO where BLOQUE_ID='".$BLOQUE_ID."'";
    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    {
        $sql = "delete from HORARIO  where BLOQUE_ID = '".$BLOQUE_ID."'";
        $this->mysqli->query($sql);

    	return "El BLOQUE ha sido borrado correctamente";
    }
    else
        return "El BLOQUE no existe";
}

function RellenaDatos($BLOQUE_ID)
{
    $this->ConectarBD();
    $sql = "select * from HORARIO where BLOQUE_ID='".$BLOQUE_ID."'";
    if (!($resultado = $this->mysqli->query($sql))){
	return 'Error en la consulta sobre la base de datos';
	}
    else{
	$result = $resultado->fetch_array();
	$result['BLOQUE_LUGAR']=consultarNomLugar($result['BLOQUE_LUGAR']);
	return $result;
	}
}
//Actualizar los datos del BLOQUE
function Modificar($BLOQUE_ID)
{
    $this->ConectarBD();
    $sql = "select * from HORARIO where BLOQUE_ID= '".$BLOQUE_ID."'";


    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    { $sql = "select * from HORARIO where BLOQUE_FECHA = '".$this->BLOQUE_FECHA."' AND BLOQUE_LUGAR='".$this->BLOQUE_LUGAR."' AND BLOQUE_ID!='".$BLOQUE_ID."' AND ((BLOQUE_HORAI>='".$this->BLOQUE_HORAI."' AND BLOQUE_HORAI<'".$this->BLOQUE_HORAF."') OR (BLOQUE_HORAI<'".$this->BLOQUE_HORAI."' AND BLOQUE_HORAF>'".$this->BLOQUE_HORAI."'))";


		$result = $this->mysqli->query($sql);
		if ($result->num_rows === 0) {
			$sql = "UPDATE HORARIO SET BLOQUE_FECHA = '" . $this->BLOQUE_FECHA . "', BLOQUE_LUGAR='" . $this->BLOQUE_LUGAR . "', BLOQUE_ACT1='" . $this->BLOQUE_ACT1 . "', BLOQUE_ACT2='" . $this->BLOQUE_ACT2 . "', BLOQUE_ACT3='" . $this->BLOQUE_ACT3 . "', BLOQUE_EV1='" . $this->BLOQUE_EV1 . "', BLOQUE_EV2='" . $this->BLOQUE_EV2 . "', BLOQUE_EV3='" . $this->BLOQUE_EV3 . "', BLOQUE_HORAI='" . $this->BLOQUE_HORAI . "', BLOQUE_HORAF='" . $this->BLOQUE_HORAF . "', BLOQUE_DIA='" . date("w", strtotime($this->BLOQUE_FECHA)) . "' WHERE BLOQUE_ID = '" . $BLOQUE_ID . "'";

			$this->mysqli->query($sql);


			return "El BLOQUE se ha modificado con éxito";
		}
		else {
			return 'El BLOQUE ya está ocupado';
		}
	}

    else
    return "El BLOQUE no existe";
}



function ConsultarActEv($BLOQUE_ID)
{
	$this->ConectarBD();
$toret=array();
	$sql = "select BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3 from HORARIO WHERE BLOQUE_ID=".$BLOQUE_ID;

	if (!($resultado = $this->mysqli->query($sql))){
		return 'Error en la consulta sobre la base de datos';
	}
	else{

		$lista=array('BLOQUE_ACT1', 'BLOQUE_ACT2', 'BLOQUE_ACT3');

		$i=0;

		$fila= $resultado->fetch_array();


		foreach($fila as $clave=>$valor){
			if(in_array($clave, $lista) && $valor!=='0' && $clave!==0) {
				$toret['ACTIVIDADES'][$i] = consultarNomActividad($valor);
				$i++;
			}

		}

		$sql = "select BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3 from HORARIO WHERE BLOQUE_ID=".$BLOQUE_ID;


		$resultado = $this->mysqli->query($sql);

		$lista=array('BLOQUE_EV1', 'BLOQUE_EV2', 'BLOQUE_EV3');


			$i = 0;

			$fila = $resultado->fetch_array();

			foreach ($fila as $clave => $valor) {
				if (in_array($clave, $lista) && $valor!='0'  && $clave!==0) {
					$toret['EVENTOS'][$i] = consultarNomEvento($valor);
					$i++;
				}
			}

		return $toret;
		}



	}
}
?>
