<?php

class Eventodos
{
	var $IDENTIFICADOR;
	var $EVENTO_NOMBRE;
	var $CLIENTE_DNI;
	var $PAGO_IMPORTE;
	var $PAGO_ESTADO;
	
	function __construct($IDENTIFICADOR,$EVENTO_NOMBRE, $CLIENTE_DNI,$PAGO_IMPORTE,$PAGO_ESTADO)
	{

		$this->IDENTIFICADOR = $IDENTIFICADOR;
		$this->EVENTO_NOMBRE = $EVENTO_NOMBRE;
		$this->CLIENTE_DNI = $CLIENTE_DNI;
		$this->PAGO_IMPORTE = $PAGO_IMPORTE;
		$this->PAGO_ESTADO = $PAGO_ESTADO;
		
	}
	
	//Conectarse a la BD
	function ConectarBD()
	{
		$this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
		if ($this->mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
		}
	}
	
	//Anadir un evento
	function insert_eventopersona()
	{
		$this->ConectarBD();
		
		if ($this->EVENTO_NOMBRE <> '' )
		{//revisar todo
			$sql = "select  * from EVENTO_TIENE_PAGO
			  where EVENTO_NOMBRE = '".$this->EVENTO_NOMBRE."' AND CLIENTE_DNI = '".$this->CLIENTE_DNI."'";
			  echo $sql;//////
			if (!$result = $this->mysqli->query($sql)){
				return 'Error en la consulta sobre la base de datos'; 	
			}	
			else {
				if ($result->num_rows == 0){
					
					
					$sql = "INSERT INTO EVENTO_TIENE_PAGO (IDENTIFICADOR,EVENTO_NOMBRE,CLIENTE_DNI,PAGO_IMPORTE,PAGO_ESTADO) VALUES (";
					$sql = $sql ."'".$this->IDENTIFICADOR."','".$this->EVENTO_NOMBRE."','".$this->CLIENTE_DNI."','".$this->PAGO_IMPORTE."','".$this->PAGO_ESTADO."')";
					echo $sql;/////
				if (!$result = $this->mysqli->query($sql)){
				return 'Error en la consulta sobre la base de datos'; 	
			}	else{
					//$this->mysqli->query($sql);
                    //crearArchivo($this->EVENTO_ID);/////////MIRAR
					return 'Persona añadida al Evento con exito'; 	
				}}
				else{
					return 'La persona ya se agrego al evento'; 	
				}
			}
		}
		else{
			return 'Introduzca un valor para el nombre del evento';
		}
	}

	//Funcion de destruccion del objeto: se ejecuta automaticamente
	function __destruct()
	{

	}

	//Consultar un EVENTO
	function select_eventopersona()
	{

		$this->ConectarBD();
		$sql = "select * from EVENTO_TIENE_PAGO where EVENTO_NOMBRE = '".$this->EVENTO_NOMBRE."'";
        $resultado=$this->mysqli->query($sql);


		    if ($resultado->num_rows===0){
		        echo "";
            }
            else {
                $toret = array();
				
				for($i=0;$i<$resultado->num_rows;$i++)
				{
                $toret[$i] = $resultado->fetch_array();
				//$toret[0] = $resultado->fetch_array();
				}
                return $toret;
            }

	}

	//Borrado de un evento
	function delete_eventopersona()
	{
		$this->ConectarBD();
		$sql = "select * from EVENTO_TIENE_PAGO where EVENTO_NOMBRE = '".$this->EVENTO_NOMBRE."'"."AND CLIENTE_DNI = '".$this->CLIENTE_DNI."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
			$sql = "delete from EVENTO_TIENE_PAGO where EVENTO_NOMBRE	= '".$this->EVENTO_NOMBRE."'"."AND CLIENTE_DNI = '".$this->CLIENTE_DNI."'";
			$this->mysqli->query($sql);
          
			return "El evento ha sido borrado correctamente";
		}
		else
			return "El evento no existe";
	}

	//Devuelve la información correspondiente a un evento
	function RellenaDatospersona()
	{
		$this->ConectarBD();
		$sql = "select * from EVENTO_TIENE_PAGO where IDENTIFICADOR = ".$this->IDENTIFICADOR."";
		if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la consulta sobre la base de datos'; 
		}
		else{
			$result = $resultado->fetch_array();

            
			return $result;
		}
	}

	//Modificar el evento
	function update_eventopersona($IDENTIFICADOR)
	{
		$this->ConectarBD();
		/*$sql = "select  * from EVENTO_TIENE_PAGO
			  where EVENTO_NOMBRE = '".$this->EVENTO_NOMBRE."' AND CLIENTE_DNI = '".$this->CLIENTE_DNI."'";
		/*$s = "select * from EVENTO_TIENE_PAGO where EVENTO_NOMBRE = '".$this->EVENTO_NOMBRE."'"."AND CLIENTE_DNI = '".$this->CLIENTE_DNI."'";
		$r = $this->mysqli->query($s);
		if($r->num_rows == 1)
		{
			return "Evento y DNI cliente en uso";
		}
		else{*/
		$sql = "select * from EVENTO_TIENE_PAGO where IDENTIFICADOR = '".$IDENTIFICADOR."'";
		
		$result = $this->mysqli->query($sql);
		//echo $sql;
		if ($result->num_rows == 1)
		{
            $sql ="SELECT IDENTIFICADOR FROM EVENTO_TIENE_PAGO WHERE IDENTIFICADOR=".$IDENTIFICADOR;
			//$sql1 = "SELECT EVENTO_NOMBRE,CLIENTE_DNI FROM EVENTO_TIENE_PAGO WHERE EVENTO_NOMBRE = '".$EVENTO_NOMBRE."'"."AND CLIENTE_DNI = '".$CLIENTE_DNI."'";
            $result = $this->mysqli->query($sql)->fetch_array();
			//echo $sql;
           // cambiarNombreArchivo($result['EVENTO_ID'],$this->EVENTO_ID);////MIRAR 
			$sql = "UPDATE EVENTO_TIENE_PAGO SET IDENTIFICADOR ='".$this->IDENTIFICADOR."',EVENTO_NOMBRE ='".$this->EVENTO_NOMBRE."', 
				CLIENTE_DNI ='".$this->CLIENTE_DNI."', PAGO_IMPORTE ='".$this->PAGO_IMPORTE."', PAGO_ESTADO ='".$this->PAGO_ESTADO."'
				WHERE IDENTIFICADOR ='".$IDENTIFICADOR."'";///
				
			$result = $this->mysqli->query($sql);	
			if (!($resultado = $this->mysqli->query($sql))){////////////////////////////////
				return "Error en la consulta sobre la base de datos";
			}
			else{
				return "El evento se ha modificado con exito";
			}
		}
		else
			return "El evento no existe";
	//}
	}
	//Listar todas los eventos
    function ConsultarTodopersona()
    {
        $this->ConectarBD();
        $sql = "select * from EVENTO_TIENE_PAGO";
			
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