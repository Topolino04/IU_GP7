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
 //   $PAGO_ID = $_REQUEST['PAGO_ID'];
    $PAGO_CONCEPTO = $_REQUEST['PAGO_CONCEPTO'];
    $PAGO_IMPORTE = $_REQUEST['PAGO_IMPORTE'];
   // $PAGO_FECHA = $_REQUEST['PAGO_FECHA'];
    $CLIENTE_DNI=$_REQUEST['CLIENTE_DNI'];
    $CLIENTE_ID= consultarIDCliente($CLIENTE_DNI);
    //$CLIENTE_ID = consultarIDCliente($_REQUEST['CLIENTE_DNI']);
    $accion = $_REQUEST['accion'];
    
    $pago = new PAGO_MODEL('', '', $PAGO_CONCEPTO, $PAGO_IMPORTE, $CLIENTE_ID, ''); //DEFINIR NUEVO CONSTRUCTOR ???
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
            $pago = new PAGO_MODEL('', '', $_REQUEST ['PAGO_CONCEPTO'], $_REQUEST ['PAGO_IMPORTE'], $_REQUEST ['CLIENTE_ID'], ''); // $_REQUEST ???
            $valores = $pago->RellenaDatos();
            if (!tienePermisos('PAGO_Borrar')) {
                new Mensaje('No tienes los permisos necesarios', 'PAGO_Controller.php');
            } else {
                    new PAGO_Borrar($valores, 'PAGO_Controller.php');
            }
        } else {
            $_REQUEST['rol_funcionalidades'] = array('');
            $rol = get_data_form();
            $respuesta = $rol->Borrar();
            new Mensaje($respuesta, 'ROL_Controller.php');
        }
        break;

        
        
        
        
    case $strings['Modificar']: //Modificación de roles

        if (!isset($_REQUEST['ROL_ID'])) {

            $rol = new ROL_MODEL($_REQUEST['ROL_NOM'], '');
            $valores = $rol->RellenaDatos();
            if (!tienePermisos('ROL_Modificar')) {
                new Mensaje('No tienes los permisos necesarios', 'ROL_Controller.php');
            } else {


                new ROL_Modificar($valores, 'EMPLEADOS_Controller.php');
            }
        } else {
            if (!isset($_REQUEST['rol_funcionalidades'])) {
                new Mensaje('No funcionalidad', 'ROL_Controller.php');
            } else {
                $rol = get_data_form();

                $respuesta = $rol->Modificar($_REQUEST['ROL_ID'], $rol->rol_funcionalidades);
                new Mensaje($respuesta, 'ROL_Controller.php');
            }
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
            $_REQUEST['rol_funcionalidades'] = array('');
            $rol = get_data_form();
            $datos = $rol->Consultar();
            new ROL_Show($datos, 'ROL_Controller.php');
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
