<?php

include '../Models/NOTIFICACION_Model.php';
include '../Models/EMPLEADO_Model.php';
include '../Locates/Strings_Castellano.php';
include '../Views/MENSAJE_Vista.php';


if (!IsAuthenticated()) {
    header('Location:../index.php');
}
include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';

//Genera los includes según las páginas a las que tiene acceso
$pags = generarIncludes();
for ($z = 0; $z < count($pags); $z++) {
    include $pags[$z];
}

//function get_data_form_email() {
//
//    //var_dump($_REQUEST['email']);
//    if (!empty($_REQUEST['email'])) {
//        $NOTIFICACION_DESTINATARIOS = $_REQUEST['email'];
//    }
//    return $NOTIFICACION_DESTINATARIOS;
//}

//function get_data_form_actividad() {
//
//
//    $ACTIVIDAD_ID = $_REQUEST['actividad'];
//    echo $ACTIVIDAD_ID;
//
//    return $ACTIVIDAD_ID;
//}

function get_data_form() {
    //Recogemos el array de emails seleccionados y se lo mandamos al Modelo.

    if (!empty($_REQUEST['email']) && !isset($_REQUEST['NOTIFICACION_ASUNTO'])) {
        $NOTIFICACION_DESTINATARIOS = $_REQUEST['email'];
        return $NOTIFICACION_DESTINATARIOS;
    } elseif (isset($_REQUEST['actividad'])) {

        $ACTIVIDAD_ID = $_REQUEST['actividad'];
        //echo $ACTIVIDAD_ID;
        return $ACTIVIDAD_ID;
        
    } else {
        $NOTIFICACION_REMITENTE = $_REQUEST['NOTIFICACION_REMITENTE'];
        $NOTIFICACION_PASSWORD = $_REQUEST['NOTIFICACION_PASSWORD'];
        $NOTIFICACION_NOMBRE_REMITENTE = $_REQUEST['NOTIFICACION_NOMBRE_REMITENTE'];
        $NOTIFICACION_DESTINATARIOS = $_REQUEST['NOTIFICACION_DESTINATARIOS'];
        $NOTIFICACION_ASUNTO = $_REQUEST['NOTIFICACION_ASUNTO'];
        $NOTIFICACION_CUERPO = $_REQUEST['NOTIFICACION_CUERPO'];

        $notificacion = new NOTIFICACION_Model($NOTIFICACION_REMITENTE, $NOTIFICACION_PASSWORD, $NOTIFICACION_NOMBRE_REMITENTE, $NOTIFICACION_DESTINATARIOS, $NOTIFICACION_ASUNTO, $NOTIFICACION_CUERPO);

        return $notificacion;
    }
}

if (!isset($_REQUEST['accion'])) {
    $_REQUEST['accion'] = '';
}

Switch ($_REQUEST['accion']) {


    case $strings['Clientes']:
        if (empty($_POST["email"])) {
            if (!tienePermisos('NOTIFICACION_Select')) {
                new Mensaje('No tienes los permisos necesarios', 'NOTIFICACION_Controller.php');
            } else {
                $modelo = new EMPLEADOS_Modelo('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
                $datos = $modelo->ConsultarTodo();
                new NOTIFICACION_SELECT($datos, '../Controllers/NOTIFICACION_Controller.php');
            }
        } else {
            $notificacion = get_data_form();
            new NOTIFICACION_EMAIL($notificacion, '../Controllers/NOTIFICACION_Controller.php?accion=Clientes');
        }
        break;

    case $strings['Enviar']: //Borrado de páginas
        if (isset($_REQUEST['NOTIFICACION_ASUNTO'])) {
            $notificacion = get_data_form();
            $respuesta = $notificacion->Enviar_Email();
            new Mensaje($respuesta, 'NOTIFICACION_Controller.php');
        }
        break;


    case $strings['Actividad']: //Modificación de páginas

        if (isset($_REQUEST['actividad'])) {
            if (!tienePermisos('NOTIFICACION_Select')) {
                new Mensaje('No tienes los permisos necesarios', 'NOTIFICACION_Controller.php');
            } else {
                //echo $_REQUEST["actividad"];
                $actividad = get_data_form();
                //$datos = $modelo->ConsultarTodo(); //Funcion que devuelve los clientes 
                // new NOTIFICACION_SELECT($datos, '../Controllers/NOTIFICACION_Controller.php');
            }
        }
        break;
//			break;
//		case $strings['Consultar']: //Consulta de páginas
//			if (!isset($_REQUEST['PAGINA_NOM'])) {
//				new Pagina_Show();
//			} else {
//				$pagina = get_data_form();
//				$datos = $pagina->select_pagina();
//				if (!tienePermisos('Pagina_Delete')) {
//					new Mensaje('No tienes los permisos necesarios', 'PAGINA_Controller.php');
//				} else {
//
//					new Pagina_default($datos, 'PAGINA_Controller.php');
//				}
//			}
//			break;

    default:
        //La vista por defecto lista todas las páginas
        if (!tienePermisos('NOTIFICACION_Default')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            new NOTIFICACION_Default('../Views/DEFAULT_Vista.php');
        }
}
?>
