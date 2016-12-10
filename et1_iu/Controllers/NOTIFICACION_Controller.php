<?php

include '../Models/NOTIFICACION_Model.php';
include '../Models/EMPLEADO_Model.php';
include '../Models/CLIENTE_Model.php';
include '../Models/ACTIVIDAD_Model.php';
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

function get_data_form() {
    //Recogemos el array de emails seleccionados y se lo mandamos al Modelo.

    if (!empty($_REQUEST['email']) && !isset($_REQUEST['NOTIFICACION_ASUNTO'])) {
        $NOTIFICACION_DESTINATARIOS = $_REQUEST['email'];
        return $NOTIFICACION_DESTINATARIOS;
    } elseif (isset($_REQUEST['actividad'])) {
        $ACTIVIDAD_ID = $_REQUEST['actividad'];
        $actividad = new actividad($ACTIVIDAD_ID, '', '', '', '', '');
        return $actividad;
    } elseif (isset($_REQUEST['evento'])) {
        $EVENTO_ID = $_REQUEST['evento'];
        $evento = ConsultarClientesEvento($EVENTO_ID);
        return $evento;
    } else {
        $NOTIFICACION_REMITENTE = $_REQUEST['NOTIFICACION_REMITENTE'];
        $NOTIFICACION_PASSWORD = $_REQUEST['NOTIFICACION_PASSWORD'];
        $NOTIFICACION_NOMBRE_REMITENTE = $_REQUEST['NOTIFICACION_NOMBRE_REMITENTE'];
        $NOTIFICACION_DESTINATARIOS = $_REQUEST['NOTIFICACION_DESTINATARIOS'];
        $NOTIFICACION_ASUNTO = $_REQUEST['NOTIFICACION_ASUNTO'];
        $NOTIFICACION_CUERPO = $_REQUEST['NOTIFICACION_CUERPO'];

        $notificacion = new NOTIFICACION_Model($NOTIFICACION_REMITENTE, $NOTIFICACION_PASSWORD, $NOTIFICACION_NOMBRE_REMITENTE, $NOTIFICACION_DESTINATARIOS, $NOTIFICACION_ASUNTO, $NOTIFICACION_CUERPO,'','','');

        return $notificacion;
    }
}

function get_data_form1() {

        $NOTIFICACION_REMITENTE = $_REQUEST['NOTIFICACION_REMITENTE'];
        $NOTIFICACION_FECHAHORA1 = $_REQUEST['NOTIFICACION_FECHAHORA1'];
        $NOTIFICACION_FECHAHORA2 = $_REQUEST['NOTIFICACION_FECHAHORA2'];
        $NOTIFICACION_DESTINATARIOS = $_REQUEST['NOTIFICACION_DESTINATARIO'];
        $EMP_USER = $_REQUEST['EMP_USER'];

        $notificacion = new NOTIFICACION_Model($NOTIFICACION_REMITENTE, '', '', $NOTIFICACION_DESTINATARIOS, '','', $NOTIFICACION_FECHAHORA1, $NOTIFICACION_FECHAHORA2, $EMP_USER);
        return $notificacion;
}

if (!isset($_REQUEST['accion'])) {
    $_REQUEST['accion'] = '';
}

Switch ($_REQUEST['accion']) {

    case $strings['Clientes']:  //Notificaciones sobre Clientes
        if (empty($_POST["email"])) {
            if (!tienePermisos('NOTIFICACION_USER_Select')) {
                new Mensaje('No tienes los permisos necesarios', 'NOTIFICACION_Controller.php');
            } else {
                $modelo = new CLIENTE_Modelo('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
                $datos = $modelo->ConsultarTodo();
                new NOTIFICACION_USER_Select($datos, '../Controllers/NOTIFICACION_Controller.php', 'CLIENTE');
            }
        } else {
            $notificacion = get_data_form();
            new NOTIFICACION_EMAIL($notificacion, '../Controllers/NOTIFICACION_Controller.php?accion=', $strings['Clientes']);
        }
        break;

    case $strings['Empleados']: //Notificaciones sobre Empleados
        if (empty($_POST["email"])) {
            if (!tienePermisos('NOTIFICACION_USER_Select')) {
                new Mensaje('No tienes los permisos necesarios', 'NOTIFICACION_Controller.php');
            } else {
                $modelo = new EMPLEADOS_Modelo('', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
                $datos = $modelo->ConsultarTodo();
                new NOTIFICACION_USER_Select($datos, '../Controllers/NOTIFICACION_Controller.php', 'EMP');
            }
        } else {
            $notificacion = get_data_form();
            new NOTIFICACION_EMAIL($notificacion, '../Controllers/NOTIFICACION_Controller.php?accion=', $strings['Empleados']);
        }
        break;



    case $strings['Actividad']: //Notificacion sobre Clientes de una Actividad
        if (empty($_POST['email'])) {
            if (empty($_POST["actividad"])) {
                if (!tienePermisos('NOTIFICACION_ACTIVIDAD_Select')) {
                    new Mensaje('No tienes los permisos necesarios', 'NOTIFICACION_Controller.php');
                } else {
                    $modelo = new actividad('', '', '', '', '', '');
                    $datos = $modelo->ConsultarTodoIvan();
                    new NOTIFICACION_ACTIVIDAD_Select($datos, '../Controllers/NOTIFICACION_Controller.php', $strings['Actividad']);
                }
            } else {
                $actividad = get_data_form();
                $datos = $actividad->ConsultarClientesActividad();
                new NOTIFICACION_CLIENTE_ACTIVIDAD_Show($datos, '../Controllers/NOTIFICACION_Controller.php?accion=', $strings['Actividad']);
            }
        } else {
            $notificacion = get_data_form();
            new NOTIFICACION_EMAIL($notificacion, '../Controllers/NOTIFICACION_Controller.php?accion=', $strings['Actividad']);
        }
        break;


        case $strings['Actividad_Monitor']: //Notificacion sobre Clientes de una Actividad
        if (empty($_POST['email'])) {
            if (empty($_POST["actividad"])) {
                if (!tienePermisos('NOTIFICACION_ACTIVIDAD_Select')) {
                    new Mensaje('No tienes los permisos necesarios', 'NOTIFICACION_Controller.php');
                } else {
                    $modelo = new actividad('', '', '', '', '', '');
                    $datos = $modelo->ConsultarActividadesMonitor();
                    new NOTIFICACION_ACTIVIDAD_Select($datos, '../Controllers/NOTIFICACION_Controller.php', $strings['Actividad_Monitor']);
                }
            } else {
                $actividad = get_data_form();
                $datos = $actividad->ConsultarClientesActividad();
                new NOTIFICACION_CLIENTE_ACTIVIDAD_Show($datos, '../Controllers/NOTIFICACION_Controller.php?accion=', $strings['Actividad_Monitor']);
            }
        } else {
            $notificacion = get_data_form();
            new NOTIFICACION_EMAIL($notificacion, '../Controllers/NOTIFICACION_Controller.php?accion=', $strings['Actividad_Monitor']);
        }
        break;



 case $strings['Evento']: //Notificacion sobre Clientes de una Actividad
        if (empty($_POST['email'])) {
            if (empty($_POST["evento"])) {
                if (!tienePermisos('NOTIFICACION_EVENTO_Select')) {
                    new Mensaje('No tienes los permisos necesarios', 'NOTIFICACION_Controller.php');
                } else {
                    $datos = ConsultarEventos();
                    new NOTIFICACION_EVENTO_Select($datos, '../Controllers/NOTIFICACION_Controller.php');
                }
            } else {
                $evento = get_data_form();
                new NOTIFICACION_CLIENTE_ACTIVIDAD_Show($evento, '../Controllers/NOTIFICACION_Controller.php?accion=', $strings['Evento']);
            }
        } else {
            $notificacion = get_data_form();
            new NOTIFICACION_EMAIL($notificacion, '../Controllers/NOTIFICACION_Controller.php?accion=', $strings['Evento']);
        }
        break;


    case $strings['Enviar']: //Enviar Email
        if (isset($_REQUEST['NOTIFICACION_ASUNTO'])) {
            $notificacion = get_data_form();
            $respuesta = $notificacion->Enviar_Email();
            new Mensaje($respuesta, 'NOTIFICACION_Controller.php');
        }
        break;

    case $strings['Registro']: //Mostrar todo el contenido de la tabla de Registro de Notificaciones
            $notificacion = new NOTIFICACION_Model("", "", "", "", "", "", "", "", "");
            $datos = $notificacion->Consultar();
            if(!tienePermisos('NOTIFICACION_Select')){
               new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
            } else {
                new NOTIFICACION_Select($datos, '../Controllers/NOTIFICACION_Controller.php', '');
            }

        break;

    case $strings['Consultar']: //Filtrar resultados segun campos o combinacion de campos
        if (!isset($_REQUEST['NOTIFICACION_REMITENTE'])) {
            if (!tienePermisos('NOTIFICACION_Consultar')) {
                new Mensaje('No tienes los permisos necesarios', 'NOTIFICACION_Controller.php');
            } else {
                new NOTIFICACION_Consultar('../Controllers/NOTIFICACION_Controller.php?accion=', $strings['Registro']);
                }
        } else {
            $notificacion = get_data_form1();
            $datos = $notificacion->Consultar();
            new NOTIFICACION_Select($datos, '../Controllers/NOTIFICACION_Controller.php?accion=', $strings['Registro']);
        }
        break;


    default:
        //La vista por defecto lista todas las páginas
        if (!tienePermisos('NOTIFICACION_Default')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            new NOTIFICACION_Default('../Views/DEFAULT_Vista.php');
        }
}
?>
