<?php


include '../Models/HORARIO_Model.php';

include '../Views/MENSAJE_Vista.php';
include '../Views/HORARIO_SHOW_ALL_Vista.php';
include '../Views/HORARIO_ADD_Vista.php';
include '../Views/HORARIO_EDIT_Vista.php';
include '../Views/HORARIO_SHOW_Vista.php';
include '../Views/HORARIO_DELETE_Vista.php';

if (!IsAuthenticated()){
    header('Location:../index.php');
}
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
//Genera los includes según las páginas a las que tiene acceso

function get_data_form(){
//Recoge la información procedente del formulario
    $titulos=array('HORARIO_NOMBRE', 'HORARIO_FECHAI','HORARIO_FECHAF', 'HORARIO_RANGO1I', 'HORARIO_RANGO1F', 'HORARIO_RANGO2I', 'HORARIO_RANGO2F', 'HORARIO_RANGO3I', 'HORARIO_RANGO3F', 'HORARIO_RANGO4I', 'HORARIO_RANGO4F', 'HORARIO_RANGO5I', 'HORARIO_RANGO5F', 'HORARIO_RANGO6I', 'HORARIO_RANGO6F' );
    foreach($titulos as $titulo){
        if (!isset($_REQUEST[$titulo])){
            $_REQUEST[$titulo]='';
        }
    }
    $HORARIO_RANGOSI=array($_REQUEST['HORARIO_RANGO1I'],$_REQUEST['HORARIO_RANGO2I'],  $_REQUEST['HORARIO_RANGO3I'],  $_REQUEST['HORARIO_RANGO4I'], $_REQUEST['HORARIO_RANGO5I'],  $_REQUEST['HORARIO_RANGO6I']);
    $HORARIO_RANGOSF=array( $_REQUEST['HORARIO_RANGO1F'], $_REQUEST[ 'HORARIO_RANGO2F'], $_REQUEST['HORARIO_RANGO3F'] , $_REQUEST['HORARIO_RANGO4F'], $_REQUEST[ 'HORARIO_RANGO5F'], $_REQUEST[ 'HORARIO_RANGO6F']);

    $HORARIO_NOMBRE = $_REQUEST['HORARIO_NOMBRE'];

    $HORARIO_FECHAI=$_REQUEST['HORARIO_FECHAI'];
    $HORARIO_FECHAF=$_REQUEST['HORARIO_FECHAF'];


    $accion = $_REQUEST['accion'];

    $HORARIO = new HORARIO_MODEL( $HORARIO_NOMBRE,$HORARIO_FECHAI, $HORARIO_FECHAF, $HORARIO_RANGOSI, $HORARIO_RANGOSF);

    return $HORARIO;
}


if (!isset($_REQUEST['accion'])){
    $_REQUEST['accion'] = '';
}
Switch ($_REQUEST['accion']) {
    case $strings['Insertar']: //Inserción de HORARIOes
        if (!isset($_REQUEST['HORARIO_NOMBRE'])) {
            if (!tienePermisos('HORARIO_Insertar')) {
                new Mensaje('No tienes los permisos necesarios', 'HORARIO_Controller.php');
            } else {
                new HORARIO_Insertar();
            }
        } else {

                $HORARIO = get_data_form();
                $respuesta = $HORARIO->Insertar();
                new Mensaje($respuesta, 'HORARIO_Controller.php');

        }

        break;

    case $strings['Borrar']: //Borrado de HORARIOes

        if (!isset($_REQUEST['HORARIO_ID'])) {
            $HORARIO = new HORARIO_MODEL($_REQUEST['HORARIO_NOMBRE'], '','','','');
            $valores = $HORARIO->RellenaDatos();
            if (!tienePermisos('HORARIO_Borrar')) {
                new Mensaje('No tienes los permisos necesarios', 'HORARIO_Controller.php');
            } else {

                    new HORARIO_Borrar($valores, 'HORARIO_Controller.php');

            }
        } else {



            $HORARIO = get_data_form();
            $respuesta = $HORARIO->Borrar($_REQUEST['HORARIO_ID']);
            new Mensaje($respuesta, 'HORARIO_Controller.php');
        }
        break;


    case $strings['Consultar']://Consulta de HORARIOes
        if (!isset($_REQUEST['HORARIO_NOMBRE'])) {
            if (!tienePermisos('HORARIO_Consultar')) {
                new Mensaje('No tienes los permisos necesarios', 'HORARIO_Controller.php');
            } else {

                new HORARIO_Consultar();
            }
        } else {

            $HORARIO = get_data_form();
            $datos = $HORARIO->Consultar();
            new HORARIO_Show($datos, 'HORARIO_Controller.php');
        }


        break;
    default:
        //La vista por defecto lista las funcionalidades
        if (!isset($_REQUEST['HORARIO_NOM'])) {
            $HORARIO = new HORARIO_MODEL('', '', '', '', '');
        } else {
            $HORARIO = get_data_form();

        }
        $datos = $HORARIO->ConsultarTodo();
        if (!tienePermisos('HORARIO_Show')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {

            new HORARIO_Show($datos, '../Views/DEFAULT_Vista.php');
        }
}


?>
