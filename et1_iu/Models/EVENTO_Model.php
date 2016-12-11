<?php

class evento
{

    var $EVENTO_ID;
    var $EVENTO_NOMBRE;
    var $EVENTO_PRECIO;
    var $EVENTO_DESCRIPCION;
    var $EVENTO_LUGAR;
    var $EVENTO_ORGANIZADOR;
    var $EVENTO_BLOQUE;
    var $EVENTO_HORARIO;
    var $EVENTO_DIA;

    function __construct($EVENTO_NOMBRE, $EVENTO_DESCRIPCION, $EVENTO_LUGAR, $EVENTO_ORGANIZADOR, $EVENTO_BLOQUE, $EVENTO_HORARIO, $EVENTO_DIA)
    {include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
        $semana=array($strings['Domingo'],$strings['Lunes'],$strings['Martes'],$strings['Miercoles'],$strings['Jueves'],$strings['Viernes'], $strings['Sabado']);


        if (isset($EVENTO_BLOQUE) && $EVENTO_BLOQUE != '' ) {
            $horas = explode("-", $EVENTO_BLOQUE);
            $this->EVENTO_BLOQUE= consultarBloques($EVENTO_HORARIO, array_search($EVENTO_DIA, $semana), $horas[0], $horas[1])[0];
        }
        else {
            $this->EVENTO_BLOQUE=$EVENTO_BLOQUE;
        }

        $this->EVENTO_NOMBRE = $EVENTO_NOMBRE;
        $this->EVENTO_DESCRIPCION = $EVENTO_DESCRIPCION;
        $this->EVENTO_LUGAR=$EVENTO_LUGAR;
        $this->EVENTO_ORGANIZADOR=$EVENTO_ORGANIZADOR;
        $this->EVENTO_DIA=$EVENTO_DIA;
        $this->EVENTO_HORARIO=$EVENTO_HORARIO;

    }

    //Conectarse a la BD
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

    //Anadir una evento
    function insert_evento()
    {
        $this->ConectarBD();
        $sql = "SELECT * FROM EVENTO WHERE EVENTO_NOMBRE = '".$this->EVENTO_NOMBRE."'";
        $result = $this->mysqli->query($sql);
        if($result->num_rows == 1){
            return 'El evento ya existe en la base de datos';
        }else{
            if ($result->num_rows == 0){
                $sql = "INSERT INTO EVENTO (EVENTO_FISIO,EVENTO_NOMBRE,EVENTO_ORGANIZADOR, EVENTO_DESCRIPCION) VALUES (0,'". $this->EVENTO_NOMBRE ."','{$this->EVENTO_ORGANIZADOR}','". $this->EVENTO_DESCRIPCION ."');";
                //echo $sql."<br>";
                $this->mysqli->query($sql);

                $sql = "SELECT EVENTO_ID FROM EVENTO WHERE EVENTO_NOMBRE = '".$this->EVENTO_NOMBRE."'";
                //echo $sql."<br>";
                $result= $this->mysqli->query($sql);
                $ID=$result->fetch_array();

                $sql="INSERT INTO EVENTO_ALBERGA_LUGAR (EVENTO_ID, LUGAR_ID) VALUES ('".$ID['EVENTO_ID']."','".ConsultarIDLugar($this->EVENTO_LUGAR)."');";
                //echo $sql."<br>";
                if( !$this->mysqli->query($sql))
                    return 'Error en la consulta sobre la base de datos';

                $sql = "INSERT INTO CALENDARIO (CALENDARIO_EVENTO,CALENDARIO_BLOQUE) VALUES ('" . $ID['EVENTO_ID'] . "','" . $this->EVENTO_BLOQUE . "');";
                //echo $sql."<br>";
                if( !$this->mysqli->query($sql))
                    return 'Error en la consulta sobre la base de datos';

                return 'Evento añadido con exito';
            }
        }
    }




    //Funcion de destruccion del objeto: se ejecuta automaticamente
    function __destruct()
    {

    }

    //Consultar una evento
    function select_evento()
    {

        $this->ConectarBD();
        $sql = "SELECT * FROM EVENTO WHERE EVENTO_NOMBRE = '".$this->EVENTO_NOMBRE."'";
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


    //Borrarado de el evento
    function delete_evento()
    {
    	$this->ConectarBD();
    	$sql = "SELECT * from EVENTO where EVENTO_NOMBRE = '".$this->EVENTO_NOMBRE."'";
    	$result = $this->mysqli->query($sql);
    	if ($result->num_rows == 1)
    	{
    		$sql = "DELETE FROM EVENTO WHERE EVENTO_NOMBRE	= '".$this->EVENTO_NOMBRE."'";
    		$this->mysqli->query($sql);
    		echo $sql."<br>";
    		return "El evento ha sido borrado correctamente";
    	}
    	else
    		return "El evento no existe";
    }

    //Devuelve la información correspondiente a una página
    function RellenaDatos()
    {
        $this->ConectarBD();
        $sql = "select * from EVENTO where EVENTO_NOMBRE = '".$this->EVENTO_NOMBRE."'";
        if (!($resultado = $this->mysqli->query($sql))){
            return 'Error en la consulta sobre la base de datos';
        }
        else{
            $result = $resultado->fetch_array();


            return $result;
        }
    }


    //Modificar el evento
    function update_evento($EVENTO_ID)
    {
        $this->ConectarBD();
        $sql = "select * from EVENTO where EVENTO_ID = '".$EVENTO_ID."'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1){
            $sql = "UPDATE EVENTO SET EVENTO_NOMBRE ='".$this->EVENTO_NOMBRE."',EVENTO_DESCRIPCION ='".$this->EVENTO_DESCRIPCION."' WHERE EVENTO_ID ='".$EVENTO_ID."'";
            //echo $sql;
            if (!($resultado = $this->mysqli->query($sql))){
                return "Error en la consulta sobre la base de datos";
            }
            else{
                return "El evento se ha modificado con exito";
            }
        }
        else
            return "El evento no existe";
    }

    //Listar todas los eventos
    function ConsultarTodo(){
        $this->ConectarBD();
        $sql = "SELECT * FROM EVENTO WHERE EVENTO_FISIO = 0 ORDER BY EVENTO_ID";
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
    //Listar todas los eventos
    function ListarInscripciones($EVENTO_ID){
        $this->ConectarBD();
        $sql = "SELECT *,(	SELECT COUNT(*)
          	FROM CLIENTE_PARTICIPA_EVENTO C, CLIENTE D
          	WHERE D.CLIENTE_ID = C.CLIENTE_ID AND C.CLIENTE_ID = CLIENTE.CLIENTE_ID  AND C.EVENTO_ID = {$EVENTO_ID}) as APLICADO
			FROM `CLIENTE`
			WHERE 1
            ";
        //echo $sql;
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
    function UpdateInvitados($EVENTO_ID , $CLIENTES_ID){
        $this->ConectarBD();
        $sql ="DELETE FROM CLIENTE_PARTICIPA_EVENTO WHERE CLIENTE_PARTICIPA_EVENTO.EVENTO_ID = {$EVENTO_ID};";
        if(sizeof($CLIENTES_ID)>0)
            $sql = $sql."INSERT INTO CLIENTE_PARTICIPA_EVENTO (EVENTO_ID,CLIENTE_ID) VALUES";
        foreach($CLIENTES_ID as $CLIENTE_ID){
            $sql = $sql."({$EVENTO_ID},{$CLIENTE_ID}),";
        }
        $sql = trim($sql, ',');
        $sql = $sql.";";
       //echo $sql;
        if($result = $this->mysqli->multi_query($sql))
            return "Asignacion de invitados correcta";
        else
            return 'Error en la consulta sobre la base de datos';
    }
}