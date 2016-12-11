<?php

include '../Models/FISIO_Model.php';
include '../Locates/Strings_Castellano.php';
include '../Functions/LibraryFunctions.php';
include '../Views/MENSAJE_Vista.php';
include '../Views/FISIO_ADD_HORAS_Vista.php';
include '../Views/FISIO_ADD_Vista.php';
include '../Views/FISIO_DELETE_Vista.php';
include '../Views/FISIO_EDIT_Vista.php';
include '../Views/FISIO_DEFAULT_Vista.php';
include '../Views/FISIO_SHOW_Vista.php';
include '../Views/FISIO_SHOW_INVITADOS_Vista.php';

if (!IsAuthenticated()){
    header('Location:../index.php');
}
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';

//Genera los includes según las fisioes a las que tiene acceso
//$fisioes=generarIncludes();
//for ($z=0;$z<count($fisioes);$z++){
//	include $fisioes[$z];
//}


function get_data_form(){
    include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';

//Recoge la información del formulario

    if(isset($_REQUEST['FISIO_ID'])){
        $FISIO_ID = $_REQUEST['FISIO_ID'];
    }else{
        $FISIO_ID=null;
    }
    if(isset($_REQUEST['FISIO_ORGANIZADOR'])){
        $FISIO_ORGANIZADOR = $_REQUEST['FISIO_ORGANIZADOR'];
    }else{
        $FISIO_ORGANIZADOR=null;
    }

    if(isset($_REQUEST['FISIO_LUGAR'])){
        $FISIO_LUGAR= $_REQUEST['FISIO_LUGAR'];
    }else{
        $FISIO_LUGAR=null;
    }
    if(isset($_REQUEST['FISIO_HORARIO'])){
        $FISIO_HORARIO = $_REQUEST['FISIO_HORARIO'];
    }else{
        $FISIO_HORARIO=null;
    }

    if(isset($_REQUEST['FISIO_FECHA'])){
        $FISIO_FECHA = $_REQUEST['FISIO_FECHA'];
    }else{
        $FISIO_FECHA=null;
    }

    if(isset($_REQUEST['FISIO_NOMBRE'])){
        $FISIO_NOMBRE = $_REQUEST['FISIO_NOMBRE'];
    }else{
        $FISIO_NOMBRE=null;
    }
    if(isset($_REQUEST['FISIO_DESCRIPCION'])){
        $FISIO_DESCRIPCION = $_REQUEST ['FISIO_DESCRIPCION'];
    }else{
        $FISIO_DESCRIPCION=null;
    }
    if(isset($_REQUEST['FISIO_BLOQUE'])){
        $FISIO_BLOQUE = $_REQUEST ['FISIO_BLOQUE'];
    }else{
        $FISIO_BLOQUE=null;
    }
    $accion = $_REQUEST['accion'];

    $fisio = new fisio($FISIO_NOMBRE,$FISIO_DESCRIPCION,$FISIO_LUGAR,$FISIO_ORGANIZADOR,$FISIO_BLOQUE,$FISIO_HORARIO,$FISIO_FECHA);

    return $fisio;
}

if (!isset($_REQUEST['accion'])){
    $_REQUEST['accion'] = '';
}

Switch ($_REQUEST['accion']) {
    case $strings['Continuar']:
    case $strings['Insertar']:

//Inserción de fisioes
        if (!isset($_REQUEST['FISIO_NOMBRE'])) {

            if (!tienePermisos('Fisio_Add')) {
                new Mensaje('No tienes los permisos necesarios', 'FISIO_Controller.php');
            } else {
                new Fisio_Add();
            }

        } else {

            if (!isset($_REQUEST['FISIO_BLOQUE'])) {
                $fisio = get_data_form();
                //var_dump($fisio);
                new Fisio_Add_Horas($fisio);
            } else {
                $fisio = get_data_form();
                $respuesta = $fisio->insert_fisio();
                new Mensaje($respuesta, 'FISIO_Controller.php');
            }

        }
        break;
    case $strings['Borrar']: //Borrado de fisioes
        if (!isset($_REQUEST['FISIO_ID'])) {
            $fisio = new fisio( $_REQUEST['FISIO_NOMBRE'], '','','','','','',null,'','');
            $valores = $fisio->RellenaDatos();
            if (!tienePermisos('Fisio_Delete')) {
                new Mensaje('No tienes los permisos necesarios', 'FISIO_Controller.php');
            } else {
                new Fisio_Delete($valores, 'FISIO_Controller.php');
            }
        } else {


            $fisio = get_data_form();
            $respuesta = $fisio->delete_fisio();
            new Mensaje($respuesta, 'FISIO_Controller.php');
        }
        break;
    case $strings['Modificar']: //Modificación de fisioes

        if (!isset($_REQUEST['FISIO_ID'])) {

            $fisio = new fisio( $_REQUEST['FISIO_NOMBRE'], '', '','','','','',null,'','');
            $valores = $fisio->RellenaDatos();

            if (!tienePermisos('FISIO_Edit')) {
                new Mensaje('No tienes los permisos necesarios', 'FISIO_Controller.php');
            } else {

                new Fisio_Edit($valores, 'FISIO_Controller.php');
            }
        } else {

            $fisio = get_data_form();

            $respuesta = $fisio->update_fisio($_REQUEST['FISIO_ID']);
            new Mensaje($respuesta, 'FISIO_Controller.php');

        }
        break;
    case $strings['Consultar']: //Consulta de fisioes
        if (!isset($_REQUEST['FISIO_NOMBRE'])) {
            new Fisio_Show();
        } else {
            $fisio = get_data_form();
            $datos = $fisio->select_fisio();
            if (!tienePermisos('FISIO_Show')) {
                new Mensaje('No tienes los permisos necesarios', 'FISIO_Controller.php');
            } else {

                new Fisio_default($datos, 'FISIO_Controller.php');
            }
        }
        break;
    case $strings['CONSULTAR BORRADO']: //Consulta de fisioes ocultas
        if (!isset($_REQUEST['FISIO_NOMBRE'])) {
            $fisio = new fisio('', '', '','','','','',null,'','');
        } else {
            $fisio = get_data_form();
        }

        $datos = $fisio->ConsultarBorradas();

        if (!tienePermisos('Fisio_default_borradas')) {
            new Mensaje('No tienes los permisos necesarios', 'FISIO_Controller.php');
        } else {
            //var_dump($datos);
            new Fisio_default_borradas($datos, 'FISIO_Controller.php');
        }
        break;
    case $strings['Invitados']:

        if (!isset($_REQUEST['FISIO_NOMBRE'])) {
            $fisio = new fisio('', '','','','','','',null,'','');
        } else {
            $fisio = get_data_form();
        }
        $datos = $fisio->ListarInscripciones($_GET['FISIO_ID']);
        if (!tienePermisos('Fisio_Default')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            new FISIO_Show_Invitados($datos, '../Controllers/FISIO_Controller.php');
        }
        break;
    case $strings['Guardar']:
        $fisio = new fisio('', '','','','','','',null,'','');
        if(!isset($_REQUEST['invitados']))$_REQUEST['invitados']= array();
          $datos = $fisio->UpdateInvitados($_GET['FISIO_ID'],$_REQUEST['invitados']);
        new Mensaje($datos, './FISIO_Controller.php');
        break;
    default:
        //La vista por defecto lista todas las fisioes
        if (!isset($_REQUEST['FISIO_NOMBRE'])) {
            $fisio = new fisio('', '','','','','','',null,'','');
        } else {
            $fisio = get_data_form();
        }
        $datos = $fisio->ConsultarTodo();

        if (!tienePermisos('Fisio_Default')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            new Fisio_default($datos, '../Views/DEFAULT_Vista.php');

        }

}

?>
