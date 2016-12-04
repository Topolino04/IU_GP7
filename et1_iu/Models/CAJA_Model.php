<?php
//Los returns de las distintas funciones de esta clase no se utilizan (a excepción de Ingresos()), están ahí para saber posibles fallos
include '../Functions/LibraryFunctions.php';
class Caja
{

	var $CAJA_ID;
	var $CAJA_FECHA;
	
	function __construct( $CAJA_ID, $CAJA_FECHA,$CAJA_INGRESOS)
	{

		$this->CAJA_ID= $CAJA_ID;
		$this->CAJA_FECHA= $CAJA_FECHA;
		$this->CAJA_INGRESOS= $CAJA_INGRESOS;
		
	}
	
	//Conectarse a la BD
	function ConectarBD()
	{
		$this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
		if ($this->mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
		}
	}
	
	//Anadir una caja
	function Insertar()
	{
		$this->ConectarBD();
		
			$sql = "select CAJA_FECHA from CAJA where CAJA_FECHA = '".$this->CAJA_FECHA."'";
			$resultado = $this->mysqli->query($sql);
			if ($resultado->num_rows==0){
				 $sql = "select COALESCE(MAX(CAJA_ID),0) FROM CAJA";
				 $id = $this->mysqli->query($sql)->fetch_array();
				 $id = $id[0];
				 $id = $id + $this->CAJA_ID;
				 $sql = "INSERT INTO CAJA ( CAJA_ID, CAJA_FECHA, CAJA_INGRESOS, CAJA_GASTOS, CAJA_BALANCE) VALUES (";
				 $sql = $sql. $id . ", '".$this->CAJA_FECHA."', ".$this->CAJA_INGRESOS.",0,0)";
				 if (!($resultado = $this->mysqli->query($sql))){
				 //$this->mysqli->query($sql);				
					return false;
				 }
				 else{
					return 'Anadida con exito';  
				 }
						
			}	
			else {
				return 'Caja ya creada en el dia actual';
			}
	}

	//Funcion de destruccion del objeto: se ejecuta automaticamente
	function __destruct()
	{

	}

	//Consultar una caja
	function Consultar()
	{
		$this->ConectarBD();
		$sql = "select CAJA_FECHA, CAJA_INGRESOS from CAJA where CAJA_FECHA = '".$this->CAJA_FECHA."'";
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

	//Actualizar los ingresos de la caja
	function Actualizar()
	{
		$this->ConectarBD();
		$sql = "select * from CAJA where CAJA_FECHA = '".$this->CAJA_FECHA."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{
			$toret = array();
			$sql = "SELECT * FROM PAGO WHERE PAGO_ESTADO = 'PAGADO' AND PAGO_FECHA LIKE '".$this->CAJA_FECHA."%'";
			if (!($resultado = $this->mysqli->query($sql))) {
				return 'Error en la consulta sobre la base de datos';
			} else {
				//  $resultado['PAGO_DESCUENTO']=100*(1-CalcularDescuentoCliente($this->CLIENTE_ID));
				//$resultado['PAGO_IMPORTE_FINAL']= $this->PAGO_IMPORTE*CalcularDescuentoCliente($this->CLIENTE_ID);
				$i = 0;
				while ($fila = $resultado->fetch_array()) {
					$toret[$i] = $fila; 
					//var_dump($fila);
					$toret[$i]['PAGO_DESCUENTO']=100*(1-CalcularDescuentoCliente($toret[$i]['CLIENTE_ID']));
					$toret[$i]['PAGO_IMPORTE_FINAL']=$toret[$i]['PAGO_IMPORTE']*CalcularDescuentoCliente($toret[$i]['CLIENTE_ID']);
                
					//var_dump($toret[$i]);
					$i++;
				}
            }
			$pagos = 0;
			for($i=0;$i<count($toret);$i++){
				$pagos = $pagos + $toret[$i]['PAGO_IMPORTE_FINAL'];
			}
			
			/*
            $sql ="SELECT ROUND(SUM(PAGO_IMPORTE),2) FROM PAGO WHERE PAGO_FECHA LIKE '".$this->CAJA_FECHA."%' AND PAGO_ESTADO = 'PAGADO'";
            $resultsql = $this->mysqli->query($sql)->fetch_array();
			$pagos = $resultsql[0];
			*/
			$sql ="SELECT CAJA_GASTOS FROM CAJA WHERE CAJA_FECHA LIKE '".$this->CAJA_FECHA."'";
			$resultsql = $this->mysqli->query($sql)->fetch_array();
			$ingresos = $resultsql[0];
			$result = $pagos + $ingresos;
			$sql = "UPDATE CAJA SET CAJA_INGRESOS =".$result." WHERE CAJA_FECHA = '".$this->CAJA_FECHA."'";
			if (!($resultado = $this->mysqli->query($sql))){
				return "Error en la consulta sobre la base de datos";
			}
			else{
				return "La caja se ha modificado con exito";
			}
		}
		else
			return "La caja no existe";
	}
	
	//Listar todas las cajas
    function ConsultarTodo()
    {
        $this->ConectarBD();
        $sql = "select CAJA_FECHA,CAJA_INGRESOS from CAJA ORDER BY CAJA_FECHA";
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
	//Añadir ingresos extra a una caja
	function Ingresos()
	{
		$this->ConectarBD();
		$sql = "select CAJA_INGRESOS from CAJA where CAJA_FECHA = '".$this->CAJA_FECHA."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows == 1)
		{ 
			$sql = "select CAJA_GASTOS from CAJA where CAJA_FECHA = '".$this->CAJA_FECHA."'";
			$sql= $this->mysqli->query($sql)->fetch_array();
			$num = $sql[0];
			$ingresos = $num + $this->CAJA_INGRESOS;
			$sql = "UPDATE CAJA SET CAJA_GASTOS =".$ingresos." WHERE CAJA_FECHA = '".$this->CAJA_FECHA."'";
			$resultado = $this->mysqli->query($sql);
			if (!($resultado = $this->mysqli->query($sql))){
				return "Error en la consulta sobre la base de datos";
			}
			else{
				return "Los ingresos se han añadido con éxito";
			}
		}
		else
			return "La caja no existe";
	}
}
?>