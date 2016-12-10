<?php

include '../Models/FACTURA_Model.php';
include '../Models/LINEA_FACTURA_Model.php';
include '../Functions/LibraryFunctions.php';
include '../Views/MENSAJECF_Vista.php';
if (!IsAuthenticated()){
	header('Location:../index.php');
}
include '../Locates/StringsCF_'.$_SESSION['IDIOMA'].'.php';

//Genera los includes según las páginas a las que tiene acceso
$pags=generarIncludes();
for ($z=0;$z<count($pags);$z++){
	include $pags[$z];
}

function get_data_form(){
	//Para insertar
	//Recoge la información del formulario
	include '../Locates/StringsCF_'.$_SESSION['IDIOMA'].'.php';
	$FACTURA_ID = 1;
	$time = time();
	$FACTURA_FECHA = date("Y-m-d H:i:s", $time);
	$CLIENTE_NIF = $_REQUEST['CLIENTE_NIF'];
	$CLIENTE_NOMBRE = $_REQUEST['CLIENTE_NOMBRE'];
	$CLIENTE_APELLIDOS = $_REQUEST['CLIENTE_APELLIDOS'];
	$CLIENTE_ID = consultarID($_REQUEST['CLIENTE_NIF'], $_REQUEST['CLIENTE_NOMBRE'], $_REQUEST['CLIENTE_APELLIDOS']);
	$FACTURA_ESTADO = 'PENDIENTE';
	$accion = $_REQUEST['accion'];
	
	$factura = new Factura($FACTURA_ID, $CLIENTE_ID, $FACTURA_FECHA, $CLIENTE_NIF, $CLIENTE_NOMBRE, $CLIENTE_APELLIDOS, $FACTURA_ESTADO);

	return $factura;
}
function get_data_form2(){
	//Para modificar
	//Recoge la información del formulario
	$FACTURA_ID = $_REQUEST['FACTURA_ID'];
	$CLIENTE_NIF = $_REQUEST['CLIENTE_NIF'];
	$CLIENTE_NOMBRE = $_REQUEST['CLIENTE_NOMBRE'];
	$CLIENTE_APELLIDOS = $_REQUEST['CLIENTE_APELLIDOS'];
	$FACTURA_ESTADO = $_REQUEST['FACTURA_ESTADO'];
	$accion = $_REQUEST['accion'];
	
	$factura = new Factura($FACTURA_ID, '', '', $CLIENTE_NIF, $CLIENTE_NOMBRE, $CLIENTE_APELLIDOS, $FACTURA_ESTADO);

	return $factura;
}

if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	
	Switch ($_REQUEST['accion']) {
		case $stringsCF['Insertar']: 
			//Inserción de facturas
			if (!isset($_REQUEST['CLIENTE_NIF'])) {
				if (!tienePermisos('Factura_Add')) {
					new Mensaje('No tienes los permisos necesarios', 'FACTURA_Controller.php');
				} else {
					new Factura_Add();
				}
			} else {
				if(existeCliente($_REQUEST['CLIENTE_NIF'], $_REQUEST['CLIENTE_NOMBRE'], $_REQUEST['CLIENTE_APELLIDOS'])==true){
					new Mensaje('Aviso2', 'FACTURA_Controller.php');
				}
				else{
				$factura = get_data_form();
				$respuesta = $factura->Insertar();
				new Mensaje($respuesta, 'FACTURA_Controller.php');
				}
			}
			break;
		case $stringsCF['Borrar']: 
				//Borrado de facturas
				if (!tienePermisos('Factura_Default')) {
					new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
				} else {
					$factura = new Factura($_REQUEST['FACTURA_ID'],'','','','','','','');
					$respuesta = $factura->Borrar();
					new Mensaje($respuesta, 'FACTURA_Controller.php');	
				}
				
			break;
		case $stringsCF['Modificar']: 
			//Modificación de facturas
			if (!isset($_REQUEST['CLIENTE_NOMBRE'])) {
				$factura = new Factura($_REQUEST['FACTURA_ID'],'','','','','','','');
				$valores = $factura->RellenaDatos();
				if (!tienePermisos('Factura_Edit')) {
					new Mensaje('No tienes los permisos necesarios', 'FACTURA_Controller.php');
				} else {
					if (sePuedeModificar($_REQUEST['FACTURA_ID'])==true){
						new Factura_Edit($valores, 'FACTURA_Controller.php');
					}
					else{
						new Mensaje('No se puede modificar','FACTURA_Controller.php');
					}
				}
			} else {
				$factura = get_data_form2();
				$respuesta = $factura->Modificar();
				new Mensaje($respuesta, 'FACTURA_Controller.php');
			}
			break;
		case $stringsCF['Consultar/Imprimir']:
				//Consulta de factura, se puede imprimir
				if (!tienePermisos('Factura_Show_Linea_Factura')) {
					new Mensaje('No tienes los permisos necesarios', 'FACTURA_Controller.php');
				} else {
					$factura = new Factura($_REQUEST['FACTURA_ID'],'','','','','','');		
					$datos = $factura->Consultar();
					$lineas = $factura->ConsultarLineasFactura();
					new Factura_Show_Linea_Factura($datos,$lineas);
				}
			break;

		default:
			//La vista por defecto lista todas las facturas
			$factura = new Factura('','','','','','','');
			$datos = $factura->ConsultarTodo();
			if (!tienePermisos('Factura_Default')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
			} else {
				new Factura_Default($datos, '../Views/DEFAULT_Vista.php');

			}

	}

?>
