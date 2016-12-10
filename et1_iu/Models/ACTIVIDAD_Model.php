<?php

class actividad {

    var $ACTIVIDAD_ID;
    var $ACTIVIDAD_NOMBRE;
    var $ACTIVIDAD_PRECIO;
    var $ACTIVIDAD_DESCRIPCION;
    var $CATEGORIA_ID;
    var $ACTIVO;

    function __construct($ACTIVIDAD_ID, $ACTIVIDAD_NOMBRE, $ACTIVIDAD_PRECIO, $ACTIVIDAD_DESCRIPCION, $CATEGORIA_ID, $ACTIVO) {
        $this->ACTIVIDAD_ID = $ACTIVIDAD_ID;
        $this->ACTIVIDAD_NOMBRE = $ACTIVIDAD_NOMBRE;
        $this->ACTIVIDAD_PRECIO = $ACTIVIDAD_PRECIO;
        $this->ACTIVIDAD_DESCRIPCION = $ACTIVIDAD_DESCRIPCION;
        $this->CATEGORIA_ID = $CATEGORIA_ID;
        $this->ACTIVO = $ACTIVO;
    }

    //Conectarse a la BD
    function ConectarBD() {
        $this->mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
        if ($this->mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }

    //Anadir una actividad
    function insert_actividad() {
        $this->ConectarBD();
        $sql = "SELECT * FROM ACTIVIDAD WHERE ACTIVIDAD_NOMBRE = '" . $this->ACTIVIDAD_NOMBRE . "'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return 'La actividad ya existe en la base de datos';
        } else {
            if ($result->num_rows == 0) {
                $sql = "INSERT INTO ACTIVIDAD (ACTIVIDAD_NOMBRE, ACTIVIDAD_PRECIO, ACTIVIDAD_DESCRIPCION, CATEGORIA_ID) VALUES ('" . $this->ACTIVIDAD_NOMBRE . "','" . $this->ACTIVIDAD_PRECIO . "','" . $this->ACTIVIDAD_DESCRIPCION . "','" . $this->CATEGORIA_ID . "');";
                $this->mysqli->query($sql);
                //crearActividad($this->ACTIVIDAD_NOMBRE);
                return 'Añadida con exito';
            }
        }
    }

    //Funcion de destruccion del objeto: se ejecuta automaticamente
    function __destruct() {
        
    }

    //Consultar una actividad
    function select_actividad() {

        $this->ConectarBD();
        $sql = "SELECT * FROM ACTIVIDAD WHERE ACTIVIDAD_NOMBRE = '" . $this->ACTIVIDAD_NOMBRE . "' OR CATEGORIA_ID = '" . $this->CATEGORIA_ID . "'";
        $resultado = $this->mysqli->query($sql);

        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos';
        } else {

            $toret = array();
            $i = 0;

            while ($fila = $resultado->fetch_array()) {


                $toret[$i] = $fila;
                $i++;
            }


            return $toret;
        }
        /* if ($resultado->num_rows===0){
          echo "";
          }
          else {
          $toret = array();
          $toret[0] = $resultado->fetch_array();

          return $toret;
          } */
    }

    //Realiza el borrado lógico de un usuario.
    function delete_actividad() {

        $this->ConectarBD();

        $sql = "UPDATE ACTIVIDAD SET ACTIVO='1' WHERE ACTIVIDAD_NOMBRE='" . $this->ACTIVIDAD_NOMBRE . "';";
        if ($this->mysqli->query($sql) === TRUE) {
            return "La actividad ha sido borrada correctamente";
        } else
            return "La actividad no existe";
    }

    //Borrarado de la actividad
    //function delete_actividad()
    //{
    //	$this->ConectarBD();
    //	$sql = "SELECT * from ACTIVIDAD where ACTIVIDAD_NOMBRE = '".$this->ACTIVIDAD_NOMBRE."'";
    //	$result = $this->mysqli->query($sql);
    //	if ($result->num_rows == 1)
    //	{
    //		$sql = "DELETE FROM ACTIVIDAD WHERE ACTIVIDAD_NOMBRE	= '".$this->ACTIVIDAD_NOMBRE."'";
    //		$this->mysqli->query($sql);
    //		//echo $sql;
    //		return "La actividad ha sido borrada correctamente";
    //	}
    //	else
    //		return "La actividad no existe";
    //}
    //Devuelve la información correspondiente a una página
    function RellenaDatos() {
        $this->ConectarBD();
        $sql = "select * from ACTIVIDAD where ACTIVIDAD_NOMBRE = '" . $this->ACTIVIDAD_NOMBRE . "'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos';
        } else {
            $result = $resultado->fetch_array();


            return $result;
        }
    }

    //Modificar la actividad
    function update_actividad($ACTIVIDAD_ID) {
        $this->ConectarBD();
        $sql = "select * from ACTIVIDAD where ACTIVIDAD_ID = '" . $ACTIVIDAD_ID . "'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            $sql = "SELECT ACTIVIDAD_PRECIO FROM ACTIVIDAD WHERE ACTIVIDAD_ID=" . $ACTIVIDAD_ID;
            $result = $this->mysqli->query($sql)->fetch_array();
            if ($this->ACTIVO == 'Activo') {
                $this->ACTIVO = 0;
            } else {
                $this->ACTIVO = 1;
            }
            $sql = "UPDATE ACTIVIDAD SET ACTIVIDAD_NOMBRE ='" . $this->ACTIVIDAD_NOMBRE . "', ACTIVIDAD_PRECIO ='" . $this->ACTIVIDAD_PRECIO . "',ACTIVIDAD_DESCRIPCION ='" . $this->ACTIVIDAD_DESCRIPCION . "',CATEGORIA_ID ='" . $this->CATEGORIA_ID . "',ACTIVO ='" . $this->ACTIVO . "' WHERE ACTIVIDAD_ID ='" . $ACTIVIDAD_ID . "'";
            //echo $sql;
            if (!($resultado = $this->mysqli->query($sql))) {
                return "Error en la consulta sobre la base de datos";
            } else {
                return "La actividad se ha modificado con exito";
            }
        } else
            return "La actividad no existe";
    }

    //Listar todas las actividads
    function ConsultarTodo() {
        $this->ConectarBD();
        $sql = "SELECT ACTIVIDAD.ACTIVIDAD_NOMBRE,ACTIVIDAD.ACTIVIDAD_PRECIO,ACTIVIDAD.ACTIVIDAD_DESCRIPCION,CATEGORIA.CATEGORIA_NOMBRE,LUGAR.LUGAR_NOMBRE FROM LUGAR ,ACTIVIDAD_ALBERGA_LUGAR ,ACTIVIDAD, CATEGORIA WHERE LUGAR.LUGAR_ID =ACTIVIDAD_ALBERGA_LUGAR.LUGAR_ID AND ACTIVIDAD_ALBERGA_LUGAR.ACTIVIDAD_ID = ACTIVIDAD.ACTIVIDAD_ID AND ACTIVIDAD.CATEGORIA_ID = CATEGORIA.CATEGORIA_ID AND ACTIVIDAD.ACTIVO = 0";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos';
        } else {

            $toret = array();
            $i = 0;

            while ($fila = $resultado->fetch_array()) {


                $toret[$i] = $fila;
                $i++;
            }


            return $toret;
        }
    }

    //Listar todas las actividades inactivas
    function ConsultarBorradas() {
        $this->ConectarBD();
        $sql = "SELECT ACTIVIDAD.ACTIVIDAD_NOMBRE,ACTIVIDAD.ACTIVIDAD_PRECIO,ACTIVIDAD.ACTIVIDAD_DESCRIPCION,CATEGORIA.CATEGORIA_NOMBRE,LUGAR.LUGAR_NOMBRE FROM LUGAR ,ACTIVIDAD_ALBERGA_LUGAR ,ACTIVIDAD, CATEGORIA WHERE LUGAR.LUGAR_ID =ACTIVIDAD_ALBERGA_LUGAR.LUGAR_ID AND ACTIVIDAD_ALBERGA_LUGAR.ACTIVIDAD_ID = ACTIVIDAD.ACTIVIDAD_ID AND ACTIVIDAD.CATEGORIA_ID = CATEGORIA.CATEGORIA_ID AND ACTIVIDAD.ACTIVO = 1";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos';
        } else {

            $toret = array();
            $i = 0;

            while ($fila = $resultado->fetch_array()) {


                $toret[$i] = $fila;
                $i++;
            }


            return $toret;
        }
    }

    function ConsultarClientesActividad() {
        $this->ConectarBD();
        echo $this->ACTIVIDAD_ID;
        $sql = "SELECT CLIENTE_ID, CLIENTE_NOMBRE, CLIENTE_APELLIDOS, CLIENTE_CORREO FROM CLIENTE WHERE CLIENTE_ID IN (SELECT CLIENTE_ID FROM CLIENTE_ASISTE_ACTIVIDAD WHERE ACTIVIDAD_ID = '" . $this->ACTIVIDAD_ID . "')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos';
        } else {

            $toret = array();
            $i = 0;

            while ($fila = $resultado->fetch_array()) {


                $toret[$i] = $fila;
                $i++;
            }
        }
        echo count($toret);
        return $toret;
        
    }

    function ConsultarActividadesMonitor() {
        $this->ConectarBD();
        $sql = "SELECT * FROM ACTIVIDAD WHERE ACTIVIDAD_ID IN (SELECT ACTIVIDAD_ID FROM EMPLEADOS_IMPARTE_ACTIVIDAD WHERE EMP_USER = '" . $_SESSION['login'] . "')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos';
        } else {

            $toret = array();
            $i = 0;

            while ($fila = $resultado->fetch_array()) {


                $toret[$i] = $fila;
                $i++;
            }
        }
        return $toret;
    }
    
    
        //Listar todas las actividads
    function ConsultarTodoIvan() {
        $this->ConectarBD();
        $sql = "SELECT * FROM ACTIVIDAD";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error en la consulta sobre la base de datos';
        } else {

            $toret = array();
            $i = 0;

            while ($fila = $resultado->fetch_array()) {


                $toret[$i] = $fila;
                $i++;
            }


            return $toret;
        }
    }


}
