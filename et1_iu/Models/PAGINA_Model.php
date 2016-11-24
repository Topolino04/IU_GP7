<?php

class Pagina
{

	var $PAGINA_ID;
	var $PAGINA_LINK;
	var $PAGINA_NOM;
	
	function __construct( $PAGINA_LINK, $PAGINA_NOM)
	{

		$this->PAGINA_LINK= $PAGINA_LINK;
		$this->PAGINA_NOM = $PAGINA_NOM;
		
	}
	
	//Conectarse a la BD
	function ConectarBD()
	{
		$this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
		if ($this->mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
		}
	}
	
	//Anadir una pagina
	function insert_pagina()
	{
		$this->ConectarBD();
		
		if ($this->PAGINA_NOM <> '' )
		{
			$sql = "select * from PAGINA where PAGINA_NOM = '".$this->PAGINA_NOM."'";
			if (!$result = $this->mysqli->query($sql)){
				return 'Error en la consulta sobre la base de datos'; 	
			}	
			else {
				if ($result->num_rows == 0){
					$sql = "INSERT INTO PAGINA ( PAGINA_LINK, PAGINA_NOM) VALUES (";
					$sql = $sql . "'$this->PAGINA_LINK', '$this->PAGINA_NOM')";
				
					$this->mysqli->query($sql);
                    crearArchivo($this->PAGINA_LINK);
					return 'Anadida con exito'; 	
				}
				else{
					return 'La pagina ya existe en la base de datos'; 	
				}
			}
		}
		else{
			return 'Introduzca un valor para el nombre de la pagina';
		}
	}

	//Funcion de destruccion del objeto: se ejecuta automaticamente
	function __destruct()
	{

	}

	//Consultar una pagina
	function select_pagina()
	{

		$this->ConectarBD();
		$sql = "select PAGINA_ID, PAGINA_NOM, PAGINA_LINK from PAGINA where PAGINA_NOM = '".$this->PAGINA_NOM."'";
        $resultado=$this->mysqli->query($sql);


		    if ($resultado->num_rows===0){
		        echo "";
            }
            else {
                $toret = array();
                $toret[0] = $resultado->fetch_array();

                return $toret;
            }

	}

	//Borrarado de la pagina
	function delete_pagina()
	{
		$this->ConectarBD();
		$sql = "select * from PAGINA where PAGINA_NOM = '".$this->PAGINA_NOM."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
			$sql = "delete from PAGINA where PAGINA_NOM	= '".$this->PAGINA_NOM."'";
			$this->mysqli->query($sql);
            borrarArchivo($this->PAGINA_LINK);
			return "La pagina ha sido borrada correctamente";
		}
		else
			return "La pagina no existe";
	}

	//Devuelve la información correspondiente a una página
	function RellenaDatos()
	{
		$this->ConectarBD();
		$sql = "select * from PAGINA where PAGINA_NOM = '".$this->PAGINA_NOM."'";
		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos'; 
		}
		else{
			$result = $resultado->fetch_array();

            
			return $result;
		}
	}

	//Modificar la pagina
	function update_pagina($PAGINA_ID)
	{
		$this->ConectarBD();
		$sql = "select * from PAGINA where PAGINA_ID = '".$PAGINA_ID."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
            $sql ="SELECT PAGINA_LINK FROM PAGINA WHERE PAGINA_ID=".$PAGINA_ID;
            $result = $this->mysqli->query($sql)->fetch_array();
            cambiarNombreArchivo($result['PAGINA_LINK'],$this->PAGINA_LINK);
			$sql = "UPDATE PAGINA SET PAGINA_LINK ='".$this->PAGINA_LINK."', PAGINA_NOM ='".$this->PAGINA_NOM."' WHERE PAGINA_ID ='".$PAGINA_ID."'";
			if (!($resultado = $this->mysqli->query($sql))){
				return "Error en la consulta sobre la base de datos";
			}
			else{
				return "La pagina se ha modificado con exito";
			}
		}
		else
			return "La pagina no existe";
	}
	
	//Listar todas las paginas
    function ConsultarTodo()
    {
        $this->ConectarBD();
        $sql = "select PAGINA_ID, PAGINA_NOM, PAGINA_LINK from PAGINA ORDER BY PAGINA_ID";
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