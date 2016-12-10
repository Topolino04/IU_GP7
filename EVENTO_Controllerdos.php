<?php

include '../Models/EVENTODOS_Model.php';
include '../Models/EVENTO_Model.php';
include '../Models/CLIENTE_Model.php';
include '../Locates/Strings_Castellano.php';
include '../Functions/LibraryFunctions.php';
include '../Views/MENSAJE_Vista.php';
if (!IsAuthenticated()){
	header('Location:../index.php');
}
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';

//Genera los includes según los eventos a las que tiene acceso
$pags=generarIncludes();
for ($z=0;$z<count($pags);$z++){
	include $pags[$z];
}

function get_data_form(){

//Recoge la información del formulario
if(isset($_REQUEST['IDENTIFICADOR'])){
	$IDENTIFICADOR = $_REQUEST['IDENTIFICADOR'];
}else {
	$IDENTIFICADOR = null;
}
if(isset($_REQUEST['CLIENTE_DNI'])){
	$CLIENTE_DNI = $_REQUEST['CLIENTE_DNI'];
}else {
	$CLIENTE_DNI = null;
}
if(isset($_REQUEST['PAGO_IMPORTE'])){
	$PAGO_IMPORTE = $_REQUEST['PAGO_IMPORTE'];
}else {
	$PAGO_IMPORTE = null;
}
if(isset($_REQUEST['PAGO_ESTADO'])){
	$PAGO_ESTADO = $_REQUEST['PAGO_ESTADO'];
}else {
	$PAGO_ESTADO = null;
}
/*if(isset($_REQUEST['EVENTO_NOMBRE'])){
	$EVENTO_NOMBRE = $_REQUEST['EVENTO_NOMBRE'];
}else {
	$EVENTO_NOMBRE = null;
}*/
	
	$EVENTO_NOMBRE = $_REQUEST['EVENTO_NOMBRE'];
	$accion = $_REQUEST['accion'];

	$evento = new Eventodos($IDENTIFICADOR,$EVENTO_NOMBRE,$CLIENTE_DNI,$PAGO_IMPORTE,$PAGO_ESTADO);

	return $evento;
}

if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	
	Switch ($_REQUEST['accion']) {
		case $strings['Insertar']: //Inserción de eventos persona
			if (!isset($_REQUEST['EVENTO_NOMBRE'])) {
				if (!tienePermisos('FUNCIONALIDAD_Show')) {
					new Mensaje('No tienes los permisos necesarios', 'EVENTO_Controllerdos.php');
				} else {
					$evento = new Evento('','','','','');
					$eventos = $evento->ConsultarTodoEvento();
					//new Evento_Add($lugares);
					$cliente = new Cliente_Modelo('','','','','','','','','','','','','','','');
					$clientes = $cliente->ConsultarTodo();
					//var_dump($clientes);
					new Eventodos_Add($eventos,$clientes);
				}
			} else {

				$evento = get_data_form();
				$respuesta = $evento->insert_eventopersona();
				new Mensaje($respuesta, 'EVENTO_Controllerdos.php');

			}
			break;
		case $strings['Borrar']: //Borrado de personas en eventos 
			if (!isset($_REQUEST['IDENTIFICADOR'])) {
				$evento = new Eventodos( '',$_REQUEST['EVENTO_NOMBRE'],'','','');
				$valores = $evento->RellenaDatospersona();
				if (!tienePermisos('Eventodos_Delete')) {
					new Mensaje('No tienes los permisos necesarios', 'EVENTO_Controllerdos.php');
				} else {
					$evento = new Evento('','','','','');
					$eventos = $evento->ConsultarTodoEvento();
					//new Evento_Add($lugares);
					$cliente = new Cliente_Modelo('','','','','','','','','','','','','','','');
					$clientes = $cliente->ConsultarTodo();
					new Eventodos_Delete($eventos,$clientes,$valores, 'EVENTO_Controllerdos.php');
				}
			} else {


				$evento = get_data_form();
				$respuesta = $evento->delete_eventopersona();
				new Mensaje($respuesta, 'EVENTO_Controllerdos.php');
			}
			break;
		case $strings['Modificar']: //Modificación de EVENTOS

			if (!isset($_REQUEST['IDENTIFICADOR'])) {

				$evento = new Eventodos( '',$_REQUEST['EVENTO_NOMBRE'],'','','');
				$valores = $evento->RellenaDatospersona();
				
				if (!tienePermisos('Eventodos_Delete')) {
					new Mensaje('No tienes los permisos necesarios', 'EVENTO_Controllerdos.php');
				} else {
					$evento = new Evento('','','','','');
					$eventos = $evento->ConsultarTodoEvento();
					$cliente = new Cliente_Modelo('','','','','','','','','','','','','','','');
					$clientes = $cliente->ConsultarTodo();
					new Eventodos_Edit($eventos,$clientes,$valores, 'EVENTO_Controllerdos.php');
				}
			} else {

				$evento = get_data_form();

				$respuesta = $evento->update_eventopersona($_REQUEST['IDENTIFICADOR']);
				new Mensaje($respuesta, 'EVENTO_Controllerdos.php');

			}
			break;
		case $strings['Consultar']: //Consulta de EVENTOS
			if (!isset($_REQUEST['EVENTO_NOMBRE'])) {
				new Eventodos_Show();
			} else {
				$evento = get_data_form();
				$datos = $evento->select_eventopersona();
				if (!tienePermisos('Eventodos_Delete')) {
					new Mensaje('No tienes los permisos necesarios', 'EVENTO_Controllerdos.php');
				} else {

					new Evento_defaultdos($datos, 'EVENTO_Controllerdos.php');
				}
			}
			break;
		/*	
		
*/
		default:
			//La vista por defecto lista todas lOS EVENTOS
			if (!isset($_REQUEST['EVENTO_NOMBRE'])) {
				$evento = new Eventodos('','','','','');
			} else {
				$evento = get_data_form();
			}
			$datos = $evento->ConsultarTodopersona();////////
			if (!tienePermisos('Evento_Defaultdos')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
			} else {
				new Evento_defaultdos($datos, '../Views/DEFAULT_Vista.php');

			}

	}

?>
