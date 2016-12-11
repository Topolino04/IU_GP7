<?php

class categoria
{

	var $CATEGORIA_ID;
	var $CATEGORIA_NOMBRE;


	function __construct($CATEGORIA_ID,$CATEGORIA_NOMBRE)
	{
		$this->CATEGORIA_ID = $CATEGORIA_ID;
        $this->CATEGORIA_NOMBRE = $CATEGORIA_NOMBRE;


	}

	//Conectarse a la BD
	function ConectarBD()
	{
		$this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
		if ($this->mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
		}
	}

	//Anadir una categoria
	function insert_categoria()
	{
		$this->ConectarBD();
		$sql = "SELECT * FROM CATEGORIA WHERE CATEGORIA_NOMBRE = '".$this->CATEGORIA_NOMBRE."'";
		$result = $this->mysqli->query($sql);
		if($result->num_rows == 1){
				return 'La categoria ya existe en la base de datos';
			}else{
					if ($result->num_rows == 0){
						$sql = "INSERT INTO CATEGORIA (CATEGORIA_ID, CATEGORIA_NOMBRE) VALUES ('". $this->CATEGORIA_ID ."','". $this->CATEGORIA_NOMBRE ."');";
						$this->mysqli->query($sql);

						return 'Añadida con exito';
					}
			}
	}




	//Funcion de destruccion del objeto: se ejecuta automaticamente
	function __destruct()
	{

	}

	//Consultar una categoria
	function select_categoria()
	{

		$this->ConectarBD();
		$sql = "SELECT * FROM CATEGORIA WHERE CATEGORIA_NOMBRE = '".$this->CATEGORIA_NOMBRE."' OR CATEGORIA_ID = '". $this->CATEGORIA_ID . "'";
        $resultado=$this->mysqli->query($sql);

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
		    /*if ($resultado->num_rows===0){
		        echo "";
            }
            else {
                $toret = array();
                $toret[0] = $resultado->fetch_array();

                return $toret;
            }*/

	}


	//Realiza el borrado de una categoria
	function delete_categoria(){

		$this->ConectarBD();

		$sql = "DELETE FROM CATEGORIA  WHERE CATEGORIA_NOMBRE='".$this->CATEGORIA_NOMBRE."';";
		if($this->mysqli->query($sql) === TRUE) {
			return "La categoria ha sido borrada correctamente";
		}else
			return "La categoria no existe";
	}
	

	//Devuelve la información correspondiente a una categoria
	function RellenaDatos()
	{
		$this->ConectarBD();
		$sql = "select * from CATEGORIA where CATEGORIA_NOMBRE = '".$this->CATEGORIA_NOMBRE."'";
		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos';
		}
		else{
			$result = $resultado->fetch_array();


			return $result;
		}
	}


	//Modificar la categoria
	function update_categoria($CATEGORIA_ID)
	{
		$this->ConectarBD();
		$sql = "select * from CATEGORIA where CATEGORIA_ID = '".$CATEGORIA_ID."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
				$sql = "UPDATE CATEGORIA SET CATEGORIA_NOMBRE ='".$this->CATEGORIA_NOMBRE."'WHERE CATEGORIA_ID='" . $CATEGORIA_ID . "';";
			
			if (!($resultado = $this->mysqli->query($sql))){
				return "Error en la consulta sobre la base de datos";
			}
			else{
				return "La categoria se ha modificado con exito";
			}
		}
		else
			return "La categoria no existe";
	}

	//Listar todas las categorias
    function ConsultarTodo()
    {
        $this->ConectarBD();
        $sql = "SELECT CATEGORIA_ID, CATEGORIA_NOMBRE FROM CATEGORIA;";
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


}
