<?php

class fisio
{

    var $FISIO_ID;
    var $FISIO_NOMBRE;
    var $FISIO_PRECIO;
    var $FISIO_DESCRIPCION;
    var $FISIO_LUGAR;
    var $FISIO_ORGANIZADOR;
    var $FISIO_BLOQUE;
    var $FISIO_HORARIO;
    var $FISIO_FECHA;

    function __construct($FISIO_NOMBRE, $FISIO_DESCRIPCION, $FISIO_LUGAR, $FISIO_ORGANIZADOR, $FISIO_BLOQUE, $FISIO_HORARIO, $FISIO_FECHA)
    {include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';

        if (isset($FISIO_BLOQUE) && $FISIO_BLOQUE != '' ) {
            $horas = explode("-", $FISIO_BLOQUE);
            $this->FISIO_BLOQUE= consultarBloquesFecha($FISIO_HORARIO, $FISIO_FECHA, $horas[0], $horas[1])[0];
        }
        else {
            $this->FISIO_BLOQUE=$FISIO_BLOQUE;
        }

        $this->FISIO_NOMBRE = $FISIO_NOMBRE;
        $this->FISIO_DESCRIPCION = $FISIO_DESCRIPCION;
        $this->FISIO_LUGAR=$FISIO_LUGAR;
        $this->FISIO_ORGANIZADOR=$FISIO_ORGANIZADOR;
        $this->FISIO_FECHA=$FISIO_FECHA;
        $this->FISIO_HORARIO=$FISIO_HORARIO;

    }

    //Conectarse a la BD
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

    //Anadir una fisio
    function insert_fisio()
    {
        $this->ConectarBD();
        $sql = "SELECT * FROM EVENTO WHERE EVENTO_NOMBRE = '".$this->FISIO_NOMBRE."'";
        $result = $this->mysqli->query($sql);
        if($result->num_rows == 1){
            return 'El fisio ya existe en la base de datos';
        }else{
            if ($result->num_rows == 0){
                $sql = "INSERT INTO EVENTO (EVENTO_FISIO,EVENTO_NOMBRE,EVENTO_ORGANIZADOR, EVENTO_DESCRIPCION) VALUES (1,'". $this->FISIO_NOMBRE ."','{$this->FISIO_ORGANIZADOR}','". $this->FISIO_DESCRIPCION ."');";
                echo $sql."<br>";
                $this->mysqli->query($sql);

                $sql = "SELECT EVENTO_ID AS FISIO_ID FROM EVENTO WHERE EVENTO_NOMBRE = '".$this->FISIO_NOMBRE."'";
                echo $sql."<br>";
                $result= $this->mysqli->query($sql);
                $ID=$result->fetch_array();

                $sql="INSERT INTO EVENTO_ALBERGA_LUGAR (EVENTO_ID, LUGAR_ID) VALUES ('".$ID['FISIO_ID']."','".ConsultarIDLugar($this->FISIO_LUGAR)."');";
                echo $sql."<br>";
                if( !$this->mysqli->query($sql))
                    return 'Error en la consulta sobre la base de datos';

                $sql = "INSERT INTO CALENDARIO (CALENDARIO_EVENTO,CALENDARIO_BLOQUE) VALUES ('" . $ID['FISIO_ID'] . "','" . $this->FISIO_BLOQUE . "');";
                echo $sql."<br>";
                if( !$this->mysqli->query($sql))
                    return 'Error en la consulta sobre la base de datos';

                return 'Fisio añadido con exito';
            }
        }
    }




    //Funcion de destruccion del objeto: se ejecuta automaticamente
    function __destruct()
    {

    }

    //Consultar una fisio
    function select_fisio()
    {

        $this->ConectarBD();
        $sql = "SELECT EVENTO_ID AS FISIO_ID, EVENTO_FISIO as FISIO_FISIO, EVENTO_NOMBRE as FISIO_NOMBRE, EVENTO_ORGANIZADOR AS FISIO_ORGANIZADOR, EVENTO_DESCRIPCION as FISIO_DESCRIPCION FROM EVENTO WHERE EVENTO_NOMBRE = '".$this->FISIO_NOMBRE."'";
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


    //Borrarado de el fisio
    function delete_fisio()
    {
        $this->ConectarBD();
        $sql = "SELECT * from EVENTO where EVENTO_NOMBRE = '".$this->FISIO_NOMBRE."'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1)
        {
            $sql = "DELETE FROM EVENTO WHERE EVENTO_NOMBRE	= '".$this->FISIO_NOMBRE."'";
            $this->mysqli->query($sql);
            echo $sql."<br>";
            return "El fisio ha sido borrado correctamente";
        }
        else
            return "El fisio no existe";
    }

    //Devuelve la información correspondiente a una página
    function RellenaDatos()
    {
        $this->ConectarBD();
        $sql = "select EVENTO_ID AS FISIO_ID, EVENTO_FISIO as FISIO_FISIO, EVENTO_NOMBRE as FISIO_NOMBRE, EVENTO_ORGANIZADOR AS FISIO_ORGANIZADOR, EVENTO_DESCRIPCION as FISIO_DESCRIPCION from EVENTO where EVENTO_NOMBRE = '".$this->FISIO_NOMBRE."'";
        if (!($resultado = $this->mysqli->query($sql))){
            return 'Error en la consulta sobre la base de datos';
        }
        else{
            $result = $resultado->fetch_array();


            return $result;
        }
    }


    //Modificar el fisio
    function update_fisio($FISIO_ID)
    {
        $this->ConectarBD();
        $sql = "select * from EVENTO where EVENTO_ID = '".$FISIO_ID."'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1){
            $sql = "UPDATE EVENTO SET EVENTO_NOMBRE ='".$this->FISIO_NOMBRE."',EVENTO_DESCRIPCION ='".$this->FISIO_DESCRIPCION."' WHERE EVENTO_ID ='".$FISIO_ID."'";
            echo $sql;
            if (!($resultado = $this->mysqli->query($sql))){
                return "Error en la consulta sobre la base de datos";
            }
            else{
                return "El fisio se ha modificado con exito";
            }
        }
        else
            return "El fisio no existe";
    }

    //Listar todas los fisios
    function ConsultarTodo(){
        $this->ConectarBD();
        $sql = "SELECT EVENTO_ID AS FISIO_ID, EVENTO_FISIO as FISIO_FISIO, EVENTO_NOMBRE as FISIO_NOMBRE, EVENTO_ORGANIZADOR AS FISIO_ORGANIZADOR, EVENTO_DESCRIPCION as FISIO_DESCRIPCION FROM EVENTO WHERE EVENTO_FISIO = 1 ORDER BY EVENTO_ID";
        echo $sql;
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
    //Listar todas los fisios
    function ListarInscripciones($FISIO_ID){
        $this->ConectarBD();
        $sql = "SELECT *,(	SELECT COUNT(*)
          	FROM CLIENTE_PARTICIPA_EVENTO C, CLIENTE D
          	WHERE D.CLIENTE_ID = C.CLIENTE_ID AND C.CLIENTE_ID = CLIENTE.CLIENTE_ID  AND C.EVENTO_ID = {$FISIO_ID}) as APLICADO
			FROM `CLIENTE`
			WHERE 1
            ";
        echo $sql;
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
    function UpdateInvitados($FISIO_ID , $CLIENTES_ID){
        $this->ConectarBD();
        $sql ="DELETE FROM CLIENTE_PARTICIPA_EVENTO WHERE CLIENTE_PARTICIPA_EVENTO.EVENTO_ID = {$FISIO_ID};";
        if(sizeof($CLIENTES_ID)>0)
            $sql = $sql."INSERT INTO CLIENTE_PARTICIPA_EVENTO (EVENTO_ID,CLIENTE_ID) VALUES";
        foreach($CLIENTES_ID as $CLIENTE_ID){
            $sql = $sql."({$FISIO_ID},{$CLIENTE_ID}),";
        }
        $sql = trim($sql, ',');
        $sql = $sql.";";
        echo $sql;
        if($result = $this->mysqli->multi_query($sql))
            return "Asignacion de invitados correcta";
        else
            return 'Error en la consulta sobre la base de datos';
    }
}