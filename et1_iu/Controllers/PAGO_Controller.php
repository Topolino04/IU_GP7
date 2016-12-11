<?php

include '../Models/PAGO_Model.php';
include '../Views/MENSAJE_Vista.php';
include '../Views/RECIBO_Vista.php';

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
if(isset($_REQUEST['PAGO_CONCEPTO'])){
    $PAGO_CONCEPTO = $_REQUEST['PAGO_CONCEPTO'];
}
else {
    $PAGO_CONCEPTO ='';
}
if(isset($_REQUEST['PAGO_IMPORTE'])){
    $PAGO_IMPORTE = $_REQUEST['PAGO_IMPORTE'];

}
else {
    $PAGO_IMPORTE='';
}
    
    
    if (isset($_REQUEST['PAGO_ESTADO'])) {
        $PAGO_ESTADO = $_REQUEST['PAGO_ESTADO'];
    } else {
        $PAGO_ESTADO = '';
    }
    if (isset($_REQUEST['PAGO_METODO'])) {
        $PAGO_METODO = $_REQUEST['PAGO_METODO'];
    } else {
        $PAGO_METODO = '';
    }

    if (isset($_REQUEST['CLIENTE_DNI'])) {
        $CLIENTE_DNI = $_REQUEST['CLIENTE_DNI'];
        $CLIENTE_ID = consultarIDCliente($CLIENTE_DNI);
    } else {
        $CLIENTE_ID = $_REQUEST['CLIENTE_ID'];
    }
    $accion = $_REQUEST['accion'];
    if (isset($_REQUEST['PAGO_ID'])) {
        $PAGO_ID = $_REQUEST['PAGO_ID']; //AUTOMATICO BD

        $pago = new PAGO_MODEL($PAGO_ID, $CLIENTE_ID, '', $PAGO_CONCEPTO, $PAGO_METODO, $PAGO_ESTADO, $PAGO_IMPORTE, ''); //DEFINIR NUEVO CONSTRUCTOR ???


    } else {
        $pago = new PAGO_MODEL('', $CLIENTE_ID, '', $PAGO_CONCEPTO, $PAGO_METODO, $PAGO_ESTADO, $PAGO_IMPORTE, ''); //DEFINIR NUEVO CONSTRUCTOR ???
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
           // $pago->generarRecibo(); //GENERA EL RECIBO
            new Mensaje($respuesta, 'PAGO_Controller.php');
        }
        break;






    case $strings['Borrar']: //Borrado de roles
        if (!isset($_REQUEST['PAGO_CONCEPTO'])) {
            $pago = new PAGO_MODEL($_REQUEST['PAGO_ID'], '', '', '', '', '', '', '');
            $valores = $pago->RellenaDatos();
            if (!tienePermisos('PAGO_Borrar')) {
                new Mensaje('No tienes los permisos necesarios', 'PAGO_Controller.php');
            } else {
                new PAGO_Borrar($valores, 'PAGO_Controller.php');
            }
        } else {
            $pago = get_data_form();
            $respuesta = $pago->Borrar();
//$pago->borrarRecibo();
            new Mensaje($respuesta, 'PAGO_Controller.php');
        }
        break;





    case $strings['Modificar']: //Modificación de pagos

        if (!isset($_REQUEST['PAGO_CONCEPTO'])) {
            $pago = new PAGO_MODEL($_REQUEST['PAGO_ID'], '', '', '', '', '', '', '');
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
            new PAGO_Show($datos, 'PAGO_Controller.php');
            // }
        }
        break;



case $strings['Generar Recibo']: //$_REQUEST['PAGO_ID'] DISPONIBLE

        $pago = new PAGO_MODEL($_REQUEST['PAGO_ID'], '', '', '', '', '', '', '');
        $mensaje = $pago->generarRecibo();
        new Mensaje($mensaje, 'PAGO_Controller.php');
break;







    case $strings['Ver Recibo']: //$_REQUEST['PAGO_ID'] DISPONIBLE
        //  $pago = new PAGO_MODEL($_REQUEST['PAGO_ID'], '', '', '', '', '');
        $recibo_link = '../Recibos/Recibo_' . $_REQUEST['PAGO_ID'] . '.txt';
        //$mensaje = $pago->verRecibo($recibo_link);
        new ReciboVista($recibo_link);
        break;

    case $strings['Generar Recibo']: //$_REQUEST['PAGO_ID'] DISPONIBLE

        $pago = new PAGO_MODEL($_REQUEST['PAGO_ID'], '', '', '', '', '');
        $mensaje = $pago->generarRecibo();
        new Mensaje($mensaje, 'PAGO_Controller.php');

        break;

//    case $strings ['Domiciliaciones pendientes']: 
//        $pago=new PAGO_MODEL('', '', '', '', '', '', '', '');
//        $pago->generarDocDomiciliaciones();
//        new ReciboVista('../Recibos/Doc_Domiciliaciones.txt');
//        break;

    case $strings['Pagos Atrasados']:
        $pago = new PAGO_MODEL('', '', '', '', '', '', '', '');
        $datos = $pago->consultarPagosAtrasados();
        new PAGO_Show($datos, 'PAGO_Controller.php');
        break;




    default:
        //La vista por defecto lista las funcionalidades
        //NO HACE FALTA EL IF!!
        $pago = new PAGO_MODEL('', '', '', '', '', '', '', '');
        $datos = $pago->ConsultarTodo();
        if (!tienePermisos('PAGO_Show')) {
            new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
        } else {
            new PAGO_Show($datos, '../Views/DEFAULT_Vista.php');
        }
}
?>
