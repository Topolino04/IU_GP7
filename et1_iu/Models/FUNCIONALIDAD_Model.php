<?php
include '../Functions/LibraryFunctions.php';



//Clase que define las funcionalidades
class FUNCIONALIDAD_MODEL
{
	var $FUNCIONALIDAD_ID;
	var $FUNCIONALIDAD_NOM;
	var $funcionalidad_paginas;
	var $mysqli;


//Constructor al que se le pasa el nombre de la funcionalidad y las páginas que tiene asignadas
function __construct( $FUNCIONALIDAD_NOM,$funcionalidad_paginas)
{

    $this->FUNCIONALIDAD_NOM = $FUNCIONALIDAD_NOM;

	$this->funcionalidad_paginas=$funcionalidad_paginas;
}

//Método para la conexión a la base de datos
function ConectarBD()
{
    $this->mysqli = new mysqli( "localhost", "iu2016", "iu2016", "IU2016");
	
	if ($this->mysqli->connect_errno) {
		echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
	}
}
//Inserción de funcionalidades
function Insertar()
{
    $this->ConectarBD();
    if ($this->FUNCIONALIDAD_NOM <> '' ){
		//Comprueba que no exista ya
        $sql = "select * from FUNCIONALIDAD where FUNCIONALIDAD_NOM = '".$this->FUNCIONALIDAD_NOM."'";


		if (!$result = $this->mysqli->query($sql)){
			return 'No se ha podido conectar con la base de datos';

		}
		else {
	
			if ($result->num_rows == 0){
				//Inserta la funcionalidad en la tabla FUNCIONALIDAD
				$sql = "INSERT INTO FUNCIONALIDAD( FUNCIONALIDAD_NOM) VALUES ('";
				$sql = $sql . "$this->FUNCIONALIDAD_NOM')";

				$this->mysqli->query($sql);
				//Por cada página que tiene asignada crea una tupla en la tabla FUNCIONALIDAD_PAGINA
				for($u=0;$u<count($this->funcionalidad_paginas);$u++){
					$FUNCIONALIDAD_ID=ConsultarIDFuncionalidad($this->FUNCIONALIDAD_NOM);
					$sql2 = "INSERT INTO FUNCIONALIDAD_PAGINA (FUNCIONALIDAD_ID, PAGINA_ID) VALUES (".$FUNCIONALIDAD_ID.", ".ConsultarIDPagina($this->funcionalidad_paginas[$u]).")";

					$this->mysqli->query($sql2);
				}
					//Crea automáticamente un controlador por cada funcionalidad
					$link=GenerarLinkControlador($this->FUNCIONALIDAD_NOM);
				crearArchivo($link);

				return 'Inserción realizada con éxito';
			}
			else
				return 'La funcionalidad ya existe';
		}
    }
    else{

	return 'Introduzca un valor para el nombre de la funcionalidad';
}
}

//Destruye el objeto
function __destruct()
{

}

//Nos devuelve la información de una funcionalidad
function Consultar()
{
    $this->ConectarBD();
    $sql = "select * from FUNCIONALIDAD where  (FUNCIONALIDAD_NOM LIKE '%".$this->FUNCIONALIDAD_NOM."%')";
   $resultado = $this->mysqli->query($sql);
	  if ($resultado->num_rows===0){
		  echo "";
	  }
    else{
		$toret=array();
		$toret[0]=$resultado->fetch_array();

	return $toret;
	}
} //Nos devuelve la información de todas las funcionalidades
	function ConsultarTodo()
	{
		$this->ConectarBD();
		$sql = "select * from FUNCIONALIDAD ORDER BY FUNCIONALIDAD_ID";
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
	//Nos informa de las páginas que están asociadas a una funcionalidad
	function ConsultarPaginas()
	{
		$this->ConectarBD();
		$FUNCIONALIDAD_ID=ConsultarIDFuncionalidad($this->FUNCIONALIDAD_NOM);
		$sql = "select PAGINA_ID from FUNCIONALIDAD_PAGINA WHERE FUNCIONALIDAD_ID=".$FUNCIONALIDAD_ID;

		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos';
		}
		else{


			$toret=array();
			$i=0;

			while ($fila= $resultado->fetch_array()['PAGINA_ID']) {


				$toret[$i]=ConsultarNOMPagina($fila);
				$i++;

			}


			return $toret;

		}
	}

//Borrado de funcionalidades
function Borrar()
{
    $this->ConectarBD();
    $sql = "select * from FUNCIONALIDAD where FUNCIONALIDAD_NOM = '".$this->FUNCIONALIDAD_NOM."'";
    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    {
        $sql = "delete from FUNCIONALIDAD where FUNCIONALIDAD_NOM = '".$this->FUNCIONALIDAD_NOM."'";
        $this->mysqli->query($sql);
		$sql="delete from FUNCIONALIDAD_PAGINA where FUNCIONALIDAD_ID=".ConsultarIDFuncionalidad($this->FUNCIONALIDAD_NOM);
		$this->mysqli->query($sql);
		$link=GenerarLinkControlador($this->FUNCIONALIDAD_NOM);
		borrarArchivo($link);
    	return "La funcionalidad ha sido borrada correctamente";
    }
    else
        return "La funcionalidad no existe";
}
//Devuelve toda la información para una determinada funcionalidad
function RellenaDatos()
{
    $this->ConectarBD();
    $sql = "select FUNCIONALIDAD_NOM, FUNCIONALIDAD_ID from FUNCIONALIDAD where FUNCIONALIDAD_NOM = '".$this->FUNCIONALIDAD_NOM."'";
    if (!($resultado = $this->mysqli->query($sql))){
	return 'Error en la consulta sobre la base de datos';
	}
    else{
	$result = $resultado->fetch_array();

	return $result;
	}
}
//Nos permite actualizar la información de una determinada funcionalidad
function Modificar($FUNCIONALIDAD_ID, $funcionalidad_paginas)
{
    $this->ConectarBD();
    $sql = "select  FUNCIONALIDAD_NOM from FUNCIONALIDAD where FUNCIONALIDAD_ID = ".$FUNCIONALIDAD_ID;


    $result = $this->mysqli->query($sql);
    if ($result->num_rows == 1)
    {
	$sql = "UPDATE FUNCIONALIDAD SET FUNCIONALIDAD_NOM = '".$this->FUNCIONALIDAD_NOM."' WHERE FUNCIONALIDAD_ID = '".$FUNCIONALIDAD_ID."'";
       $this->mysqli->query($sql);
		$sql="DELETE FROM FUNCIONALIDAD_PAGINA WHERE FUNCIONALIDAD_ID=".$FUNCIONALIDAD_ID;
		$this->mysqli->query($sql);
		for($u=0;$u<count($funcionalidad_paginas);$u++){

			$sql2 = "INSERT INTO  FUNCIONALIDAD_PAGINA (FUNCIONALIDAD_ID, PAGINA_ID) VALUES (".$FUNCIONALIDAD_ID.", ".ConsultarIDPagina($this->funcionalidad_paginas[$u]).")";

			$this->mysqli->query($sql2);
		}


		return "La funcionalidad se ha modificado con éxito";
	}

    else
    return "La funcionalidad no existe";
}

}
?>
