<?php
include '../Functions/LibraryFunctions.php';

//Clase que define un HORARIO
class HORARIO_MODEL
{
    var $HORARIO_ID;
    var $HORARIO_NOMBRE;
    var $HORARIO_FECHAI;
    var $HORARIO_FECHAF;
    var $HORARIO_RANGOSI;
    var $HORARIO_RANGOSF;


    var $mysqli;

//Constructor de la clase HORARIO
    function __construct( $HORARIO_NOMBRE, $HORARIO_FECHAI, $HORARIO_FECHAF,$HORARIO_RANGOSI,$HORARIO_RANGOSF )
    {

        $this->HORARIO_NOMBRE = $HORARIO_NOMBRE;
        $this->HORARIO_FECHAI=$HORARIO_FECHAI;
        $this->HORARIO_FECHAF=$HORARIO_FECHAF;
        $this->HORARIO_RANGOSI=$HORARIO_RANGOSI;
        $this->HORARIO_RANGOSF=$HORARIO_RANGOSF;
    }

//Función para la conexión a la base de datos
    function ConectarBD()
    {
        $this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");

        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }
//Insertar un nuevo HORARIO
    function Insertar()
    {
        $this->ConectarBD();


        $sql = "select * from HORARIO where HORARIO_NOMBRE = '".$this->HORARIO_NOMBRE."'";

        if (!$result = $this->mysqli->query($sql)){
            return 'No se ha podido conectar con la base de datos';
        }
        else {

            if ($result->num_rows == 0){

                $sql = "INSERT INTO HORARIO(HORARIO_NOMBRE, HORARIO_FECHAI, HORARIO_FECHAF) VALUES ('" . $this->HORARIO_NOMBRE . "', '" . $this->HORARIO_FECHAI . "', '" . $this->HORARIO_FECHAF . "')";
                $this->mysqli->query($sql);
                $sql="SELECT HORARIO_ID FROM HORARIO WHERE HORARIO_NOMBRE='". $this->HORARIO_NOMBRE."'";
                $result=$this->mysqli->query($sql);
                $id=$result->fetch_array()['HORARIO_ID'];

                for($u=1;$u<7;$u++) {
                    $fechas[$u]=crearFechas($this->HORARIO_FECHAI,$this->HORARIO_FECHAF, $u);
                    $horasi[$u][0]=$this->HORARIO_RANGOSI[$u-1];
                   $horasf[$u][0]=date('H:i',strtotime('+1 hour', strtotime($this->HORARIO_RANGOSI[$u-1])));

                    $i=0;
                    while ($horasf[$u][$i] < $this->HORARIO_RANGOSF[$u-1]) {
                        $horasi[$u][$i+1] = date('H:i',strtotime('+1 hour', strtotime($horasi[$u][$i])));
                        $horasf[$u][$i+1] = date('H:i',strtotime('+1 hour', strtotime($horasf[$u][$i])));

                        $i++;
                    }
                }






                for($u=1;$u<7;$u++) {
                            for($i=0;$i<count($fechas[$u]);$i++) {
                                for($z=0;$z<count($horasi[$u]);$z++) {
                                    $sql = "INSERT INTO HORAS_POSIBLES(BLOQUE_HORARIO, BLOQUE_FECHA, BLOQUE_DIA, BLOQUE_HORAI, BLOQUE_HORAF) VALUES ('" . $id . "','" . $fechas[$u][$i] . "','" . $u . "','" . $horasi[$u][$z] . "','" . $horasf[$u][$z] . "')";

                                    $this->mysqli->query($sql);
                                }
                            }
                }
                return 'Inserción realizada con éxito';
            }
            else
                return 'El HORARIO ya está ocupado';
        }


    }

//destrucción del objeto
    function __destruct()
    {

    }

//Nos devuelve la información de un HORARIO determinado
    function Consultar()
    {
        include '../Locates/Strings_Castellano.php';
        $this->ConectarBD();
        $sql = "select * from HORARIO where HORARIO_NOMBRE ='".$this->HORARIO_NOMBRE."'";

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
        $sql = "select * from HORARIO ORDER BY HORARIO_FECHAI";
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

    
    function Borrar($BLOQUE_HORARIO)
    {
        $this->ConectarBD();
        $sql = "select * from HORARIO where HORARIO_NOMBRE='".$this->HORARIO_NOMBRE."'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1)
        {
            $sql = "delete from HORARIO  where HORARIO_NOMBRE = '".$this->HORARIO_NOMBRE."'";
            $this->mysqli->query($sql);
            $sql="DELETE FROM CALENDARIO WHERE CALENDARIO_BLOQUE IN (SELECT BLOQUE_ID FROM HORAS_POSIBLES WHERE BLOQUE_HORARIO='".$BLOQUE_HORARIO."')";
            $this->mysqli->query($sql);
            $sql="delete from HORAS_POSIBLES  where BLOQUE_HORARIO = '".$BLOQUE_HORARIO."'";
            $this->mysqli->query($sql);
            return "El HORARIO ha sido borrado correctamente";
        }
        else
            return "El HORARIO no existe";
    }

    function RellenaDatos()
    {
        $this->ConectarBD();
        $sql = "select * from HORARIO where HORARIO_NOMBRE='".$this->HORARIO_NOMBRE."'";
        if (!($resultado = $this->mysqli->query($sql))){
            return 'Error en la consulta sobre la base de datos';
        }
        else{
            $result = $resultado->fetch_array();

            return $result;
        }
    }
//Actualizar los datos del HORARIO
    function Modificar($HORARIO_ID)
    {
        $this->ConectarBD();
        $sql = "select * from HORARIO where HORARIO_ID= '".$HORARIO_ID."'";


        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1)
        {


                $sql = "UPDATE HORARIO SET HORARIO_NOMBRE='".$this->HORARIO_NOMBRE."', HORARIO_FECHAI = '" . $this->HORARIO_FECHAI . "', HORARIO_FECHAF='" . $this->HORARIO_FECHAF .  "' WHERE HORARIO_ID = '" . $HORARIO_ID . "'";

                $this->mysqli->query($sql);


                return "El HORARIO se ha modificado con éxito";

        }

        else
            return "El HORARIO no existe";
    }




}
?>
