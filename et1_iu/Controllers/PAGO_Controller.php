<?php

include '../Models/PAGO_Model.php';
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
//Recoge la información procedente del formulario

    $PAGO_CONCEPTO = $_REQUEST['PAGO_CONCEPTO'];
    $PAGO_IMPORTE = $_REQUEST['PAGO_IMPORTE'];
    // $PAGO_FECHA = $_REQUEST['PAGO_FECHA']; //AUTOMATICO BD
    if (isset($_REQUEST['CLIENTE_DNI'])) {
        $CLIENTE_DNI = $_REQUEST['CLIENTE_DNI'];
        $CLIENTE_ID = consultarIDCliente($CLIENTE_DNI);
    } else {
        $CLIENTE_ID = $_REQUEST['CLIENTE_ID'];
    }
    //$CLIENTE_ID = consultarIDCliente($_REQUEST['CLIENTE_DNI']);
    $accion = $_REQUEST['accion'];
    if (isset($_REQUEST['PAGO_ID'])) {
        $PAGO_ID = $_REQUEST['PAGO_ID']; //AUTOMATICO BD
        $pago = new PAGO_MODEL($PAGO_ID, '', $PAGO_CONCEPTO, $PAGO_IMPORTE, $CLIENTE_ID, ''); //DEFINIR NUEVO CONSTRUCTOR ???
    } else {
        $pago = new PAGO_MODEL('', '', $PAGO_CONCEPTO, $PAGO_IMPORTE, $CLIENTE_ID, ''); //DEFINIR NUEVO CONSTRUCTOR ???
    }
    //$pago = new PAGO_MODEL('', '', $PAGO_CONCEPTO, $PAGO_IMPORTE, 300, ''); //DEFINIR NUEVO CONSTRUCTOR ???
    return $pago;
}

if (!isset($_REQUEST['accion'])) {
    $_REQUEST['accion'] = '';
}
Switch ($_REQUEST['accion']) {





    case $strings['Insertar']: //Inserción de pagos
        if (!isset($_REQUEST['PAGO_CONCEPTO'])) {
            if (!tienePermisos('PAGO_Insertar')) {
                new Mensaje('No tienes los permisos necesarios', 'PAGO_Controller.php');
            } else {
                new PAGO_Insertar();
            }
        } else {
            $pago = get_data_form();
            $respuesta = $pago->Insertar();
            new Mensaje($respuesta, 'PAGO_Controller.php');
        }
        break;






    case $strings['Borrar']: //Borrado de roles
        if (!isset($_REQUEST['PAGO_CONCEPTO'])) {
            $pago = new PAGO_MODEL($_REQUEST['PAGO_ID'], '', '', '', '', '');
            $valores = $pago->RellenaDatos();
            if (!tienePermisos('PAGO_Borrar')) {
                new Mensaje('No tienes los permisos necesarios', 'PAGO_Controller.php');
            } else {
                new PAGO_Borrar($valores, 'PAGO_Controller.php');
            }
        } else {
            $pago = get_data_form();
            $respuesta = $pago->Borrar();
            new Mensaje($respuesta, 'PAGO_Controller.php');
        }
        break;





    case $strings['Modificar']: //Modificación de pagos

        if (!isset($_REQUEST['PAGO_CONCEPTO'])) {
            $pago = new PAGO_MODEL($_REQUEST['PAGO_ID'], '', '', '', '', '');
            $valores = $pago->RellenaDatos();
            if (!tienePermisos('PAGO_Modificar')) {
                new Mensaje('No tienes los permisos necesarios', 'PAGO_Controller.php');
            } else {
                new PAGO_Modificar($valores, 'PAGO_Controller.php');
            }
        } else {
            $pago = get_data_form();
            $respuesta = $pago->Modificar();
            // $respuesta = $pago->Modificar($_REQUEST['ROL_ID'], $rol->rol_funcionalidades);
            new Mensaje($respuesta, 'PAGO_Controller.php');
        }


        break;








    case $strings['Consultar']:  //Consulta de pagos
        if (!isset($_REQUEST['PAGO_CONCEPTO'])) {
            if (!tienePermisos('PAGO_Consultar')) {
                new Mensaje('No tienes los permisos necesarios', 'PAGO_Controller.php');
            } else {
                new PAGO_Consultar();
            }
        } else {
            $pago = get_data_form();
            $datos = $pago->Consultar();
            // if(!$datos){ //EN EL CASO DE SER NECESARIO, DE ESTA FORMA SE MOSTRARÍA UN MENSAJE POR PANTALLA
            //    new Mensaje('No existen pagos que tengan los datos introducido', 'PAGO_Controller.php');
            // }
            // else {
            new PAGO_Show($datos, 'PAGO_Controller.php');
            // }
        }
        break;










    case $strings['Generar Recibo']: //AÑADIR FUNCIONALIDAD
        break;








    default:
        //La vista por defecto lista las funcionalidades
        if (!isset($_REQUEST['PAGO_CONCEPTO'])) {
            $pago = new PAGO_MODEL('', '', '', '', '', ''); //PARA QUÉ SIRVE???
        } else {
            $pago = get_data_form();
        }
        $datos = $pago->ConsultarTodo();
        if (!tienePermisos('PAGO_Show')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            new PAGO_Show($datos, '../Views/DEFAULT_Vista.php');
        }
}
?>
