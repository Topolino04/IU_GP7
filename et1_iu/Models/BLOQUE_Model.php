<?php
include '../Functions/LibraryFunctions.php';

//Clase que define un BLOQUE
class BLOQUE_MODEL
{
	var $BLOQUE_ID;
	var $BLOQUE_HORARIO;
	var $BLOQUE_FECHA;
	var $BLOQUE_DIA;
	var $BLOQUE_HORAI;
	var $BLOQUE_HORAF;
	var $mysqli;

//Constructor de la clase BLOQUE
function __construct($BLOQUE_HORARIO, $BLOQUE_FECHA, $BLOQUE_DIA,$BLOQUE_HORAI, $BLOQUE_HORAF)
{	$this->BLOQUE_HORARIO = $BLOQUE_HORARIO;
	$this->BLOQUE_DIA = $BLOQUE_DIA;
    $this->BLOQUE_FECHA = $BLOQUE_FECHA;
	$this->BLOQUE_HORAI = $BLOQUE_HORAI;
	$this->BLOQUE_HORAF = $BLOQUE_HORAF;


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

		
        $sql = "select * from HORAS_POSIBLES where BLOQUE_HORARIO='". $this->BLOQUE_HORARIO."' AND BLOQUE_DIA = '".$this->BLOQUE_DIA."' AND BLOQUE_HORAI='".$this->BLOQUE_HORAI."' AND BLOQUE_HORAF='".$this->BLOQUE_HORAF."'";


		if (!$result = $this->mysqli->query($sql)){
			return 'No se ha podido conectar con la base de datos';
		}
		else {
	
			if ($result->num_rows == 0){
				$sql="SELECT HORARIO_FECHAI, HORARIO_FECHAF FROM HORARIO WHERE HORARIO_ID='".$this->BLOQUE_HORARIO."'";
				$result=$this->mysqli->query($sql);
				$fila=$result->fetch_array();

				$fechas=crearFechas($fila['HORARIO_FECHAI'],$fila['HORARIO_FECHAF'], $this->BLOQUE_DIA);
				for($i=0;$i<count($fechas);$i++) {

					$sql = "INSERT INTO HORAS_POSIBLES(BLOQUE_HORARIO, BLOQUE_FECHA, BLOQUE_DIA, BLOQUE_HORAI, BLOQUE_HORAF) VALUES ('" . $this->BLOQUE_HORARIO . "','" .$fechas[$i] . "','".$this->BLOQUE_DIA."','".$this->BLOQUE_HORAI."','".$this->BLOQUE_HORAF."')";

					$this->mysqli->query($sql);
				}
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
    $sql = "select * from HORAS_POSIBLES where  BLOQUE_FECHA ='".$this->BLOQUE_FECHA."' OR BLOQUE_HORARIO='".ConsultarIDHorario($this->BLOQUE_HORARIO)."'";

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
		$sql = "select * from HORAS_POSIBLES  ORDER BY BLOQUE_FECHA, BLOQUE_HORAI";
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
    $sql = "select * from HORAS_POSIBLES where BLOQUE_ID='".$BLOQUE_ID."'";
    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    {

		$sql = "delete from CALENDARIO  where CALENDARIO_BLOQUE = '".$BLOQUE_ID."'";
		$this->mysqli->query($sql);
        $sql = "delete from HORAS_POSIBLES  where BLOQUE_ID = '".$BLOQUE_ID."'";

		$this->mysqli->query($sql);



    	return "El BLOQUE ha sido borrado correctamente";
    }
    else
        return "El BLOQUE no existe";
}

function RellenaDatos($BLOQUE_ID)
{
    $this->ConectarBD();
    $sql = "select * from HORAS_POSIBLES where BLOQUE_ID='".$BLOQUE_ID."'";
    if (!($resultado = $this->mysqli->query($sql))){
	return 'Error en la consulta sobre la base de datos';
	}
    else{
	$result = $resultado->fetch_array();
$result['BLOQUE_HORARIO']=ConsultarNomHorario($result['BLOQUE_HORARIO']);
	return $result;
	}
}
//Actualizar los datos del BLOQUE
function Modificar($BLOQUE_ID)
{
    $this->ConectarBD();
    $sql = "select * from HORAS_POSIBLES where BLOQUE_ID= '".$BLOQUE_ID."'";


    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    { //$sql = "select * from HORAS_POSIBLES where BLOQUE_HORARIO='".$this->BLOQUE_HORARIO."' AND BLOQUE_FECHA = '".$this->BLOQUE_FECHA."'  AND BLOQUE_ID!='".$BLOQUE_ID."' AND ((BLOQUE_HORAI>='".$this->BLOQUE_HORAI."' AND BLOQUE_HORAI<'".$this->BLOQUE_HORAF."') OR (BLOQUE_HORAI<'".$this->BLOQUE_HORAI."' AND BLOQUE_HORAF>'".$this->BLOQUE_HORAI."'))";

		//$result = $this->mysqli->query($sql);
		//if ($result->num_rows === 0) {
			$sql = "UPDATE HORAS_POSIBLES SET BLOQUE_HORARIO='". $this->BLOQUE_HORARIO."', BLOQUE_FECHA = '" . $this->BLOQUE_FECHA .  "', BLOQUE_HORAI='" . $this->BLOQUE_HORAI . "', BLOQUE_HORAF='" . $this->BLOQUE_HORAF . "', BLOQUE_DIA='" . date("w", strtotime($this->BLOQUE_FECHA)) . "' WHERE BLOQUE_ID = '" . $BLOQUE_ID . "'";

			$this->mysqli->query($sql);


			return "El BLOQUE se ha modificado con éxito";
		//}
		//else {
		//	return 'El BLOQUE ya está ocupado';
		//}
	}

    else
    return "El BLOQUE no existe";
}



}
?>
