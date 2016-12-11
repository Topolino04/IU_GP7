<?php

include '../Models/EVENTO_Model.php';
include '../Locates/Strings_Castellano.php';
include '../Functions/LibraryFunctions.php';
include '../Views/MENSAJE_Vista.php';
include '../Views/EVENTO_ADD_HORAS_Vista.php';
include '../Views/EVENTO_ADD_Vista.php';
include '../Views/EVENTO_DELETE_Vista.php';
include '../Views/EVENTO_EDIT_Vista.php';
include '../Views/EVENTO_DEFAULT_Vista.php';
include '../Views/EVENTO_SHOW_Vista.php';
include '../Views/EVENTO_SHOW_INVITADOS_Vista.php';

if (!IsAuthenticated()){
    header('Location:../index.php');
}
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';

//Genera los includes según las eventoes a las que tiene acceso
//$eventoes=generarIncludes();
//for ($z=0;$z<count($eventoes);$z++){
//	include $eventoes[$z];
//}


function get_data_form(){
    include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';

//Recoge la información del formulario

    if(isset($_REQUEST['EVENTO_ID'])){
        $EVENTO_ID = $_REQUEST['EVENTO_ID'];
    }else{
        $EVENTO_ID=null;
    }
    if(isset($_REQUEST['EVENTO_ORGANIZADOR'])){
        $EVENTO_ORGANIZADOR = $_REQUEST['EVENTO_ORGANIZADOR'];
    }else{
        $EVENTO_ORGANIZADOR=null;
    }

    if(isset($_REQUEST['EVENTO_LUGAR'])){
        $EVENTO_LUGAR= $_REQUEST['EVENTO_LUGAR'];
    }else{
        $EVENTO_LUGAR=null;
    }
    if(isset($_REQUEST['EVENTO_HORARIO'])){
        $EVENTO_HORARIO = $_REQUEST['EVENTO_HORARIO'];
    }else{
        $EVENTO_HORARIO=null;
    }

    if(isset($_REQUEST['EVENTO_FECHA'])){
        $EVENTO_FECHA = $_REQUEST['EVENTO_FECHA'];
    }else{
        $EVENTO_FECHA=null;
    }

    if(isset($_REQUEST['EVENTO_NOMBRE'])){
        $EVENTO_NOMBRE = $_REQUEST['EVENTO_NOMBRE'];
    }else{
        $EVENTO_NOMBRE=null;
    }
    if(isset($_REQUEST['EVENTO_DESCRIPCION'])){
        $EVENTO_DESCRIPCION = $_REQUEST ['EVENTO_DESCRIPCION'];
    }else{
        $EVENTO_DESCRIPCION=null;
    }
    if(isset($_REQUEST['EVENTO_BLOQUE'])){
        $EVENTO_BLOQUE = $_REQUEST ['EVENTO_BLOQUE'];
    }else{
        $EVENTO_BLOQUE=null;
    }
    $accion = $_REQUEST['accion'];

    $evento = new evento($EVENTO_NOMBRE,$EVENTO_DESCRIPCION,$EVENTO_LUGAR,$EVENTO_ORGANIZADOR,$EVENTO_BLOQUE,$EVENTO_HORARIO,$EVENTO_FECHA);

    return $evento;
}

if (!isset($_REQUEST['accion'])){
    $_REQUEST['accion'] = '';
}

Switch ($_REQUEST['accion']) {
    case $strings['Continuar']:
    case $strings['Insertar']:

//Inserción de eventoes
        if (!isset($_REQUEST['EVENTO_NOMBRE'])) {

            if (!tienePermisos('Evento_Add')) {
                new Mensaje('No tienes los permisos necesarios', 'EVENTO_Controller.php');
            } else {
                new Evento_Add();
            }

        } else {

            if (!isset($_REQUEST['EVENTO_BLOQUE'])) {
                $evento = get_data_form();

                new Evento_Add_Horas($evento);
            } else {
                $evento = get_data_form();
                $respuesta = $evento->insert_evento();
                new Mensaje($respuesta, 'EVENTO_Controller.php');
            }

        }
        break;
    case $strings['Borrar']: //Borrado de eventoes
        if (!isset($_REQUEST['EVENTO_ID'])) {
            $evento = new evento( $_REQUEST['EVENTO_NOMBRE'], '','','','','','',null,'','');
            $valores = $evento->RellenaDatos();
            if (!tienePermisos('Evento_Delete')) {
                new Mensaje('No tienes los permisos necesarios', 'EVENTO_Controller.php');
            } else {
                new Evento_Delete($valores, 'EVENTO_Controller.php');
            }
        } else {


            $evento = get_data_form();
            $respuesta = $evento->delete_evento();
            new Mensaje($respuesta, 'EVENTO_Controller.php');
        }
        break;
    case $strings['Modificar']: //Modificación de eventoes

        if (!isset($_REQUEST['EVENTO_ID'])) {

            $evento = new evento( $_REQUEST['EVENTO_NOMBRE'], '', '','','','','',null,'','');
            $valores = $evento->RellenaDatos();

            if (!tienePermisos('EVENTO_Edit')) {
                new Mensaje('No tienes los permisos necesarios', 'EVENTO_Controller.php');
            } else {

                new Evento_Edit($valores, 'EVENTO_Controller.php');
            }
        } else {

            $evento = get_data_form();

            $respuesta = $evento->update_evento($_REQUEST['EVENTO_ID']);
            new Mensaje($respuesta, 'EVENTO_Controller.php');

        }
        break;
    case $strings['Consultar']: //Consulta de eventoes
        if (!isset($_REQUEST['EVENTO_NOMBRE'])) {
            new Evento_Show();
        } else {
            $evento = get_data_form();
            $datos = $evento->select_evento();
            if (!tienePermisos('EVENTO_Show')) {
                new Mensaje('No tienes los permisos necesarios', 'EVENTO_Controller.php');
            } else {

                new Evento_default($datos, 'EVENTO_Controller.php');
            }
        }
        break;
    case $strings['CONSULTAR BORRADO']: //Consulta de eventoes ocultas
        if (!isset($_REQUEST['EVENTO_NOMBRE'])) {
            $evento = new evento('', '', '','','','','',null,'','');
        } else {
            $evento = get_data_form();
        }

        $datos = $evento->ConsultarBorradas();

        if (!tienePermisos('Evento_default_borradas')) {
            new Mensaje('No tienes los permisos necesarios', 'EVENTO_Controller.php');
        } else {
            //var_dump($datos);
            new Evento_default_borradas($datos, 'EVENTO_Controller.php');
        }
        break;
    case $strings['Invitados']:

        if (!isset($_REQUEST['EVENTO_NOMBRE'])) {
            $evento = new evento('', '','','','','','',null,'','');
        } else {
            $evento = get_data_form();
        }
        $datos = $evento->ListarInscripciones($_GET['EVENTO_ID']);
        if (!tienePermisos('Evento_Default')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            new EVENTO_Show_Invitados($datos, '../Controllers/EVENTO_Controller.php');
        }
        break;
    case $strings['Guardar']:
        $evento = new evento('', '','','','','','',null,'','');
        $datos = $evento->UpdateInvitados($_GET['EVENTO_ID'],$_REQUEST['invitados']);
        new Mensaje($datos, './EVENTO_Controller.php');
        break;
    default:
        //La vista por defecto lista todas las eventoes
        if (!isset($_REQUEST['EVENTO_NOMBRE'])) {
            $evento = new evento('', '','','','','','',null,'','');
        } else {
            $evento = get_data_form();
        }
        $datos = $evento->ConsultarTodo();
        if (!tienePermisos('Evento_Default')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            new Evento_default($datos, '../Views/DEFAULT_Vista.php');

        }

}

?>
