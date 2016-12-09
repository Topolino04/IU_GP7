<?php

include_once '../Models/EVENTO_Model.php';
include_once '../Models/LUGAR_Model.php';
include_once '../Locates/Strings_Castellano.php';
include_once '../Functions/LibraryFunctions.php';
include_once '../Views/MENSAJE_Vista.php';
if (!IsAuthenticated()){
	header('Location:../index.php');
}
include_once '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';

//Genera los includes según los eventos a las que tiene acceso
$pags=generarIncludes();
for ($z=0;$z<count($pags);$z++){
	include $pags[$z];
}

function get_data_form(){

//Recoge la información del formulario
if(isset($_REQUEST['EVENTO_ID'])){
	$EVENTO_ID = $_REQUEST['EVENTO_ID'];
}else {
	$EVENTO_ID = null;
}
if(isset($_REQUEST['EVENTO_ORGANIZADOR'])){
	$EVENTO_ORGANIZADOR = $_REQUEST['EVENTO_ORGANIZADOR'];
}else {
	$EVENTO_ORGANIZADOR = null;
}
if(isset($_REQUEST['EVENTO_DESCRIPCION'])){
	$EVENTO_DESCRIPCION = $_REQUEST['EVENTO_DESCRIPCION'];
}else {
	$EVENTO_DESCRIPCION = null;
}
if(isset($_REQUEST['LUGAR_ID'])){
	$LUGAR_ID = $_REQUEST['LUGAR_ID'];
}else {
	$LUGAR_ID = null;
}

	
	$EVENTO_NOMBRE = $_REQUEST['EVENTO_NOMBRE'];
	$accion = $_REQUEST['accion'];

	$evento = new Evento($EVENTO_ID,$EVENTO_NOMBRE,$EVENTO_ORGANIZADOR,$EVENTO_DESCRIPCION,$LUGAR_ID);

	return $evento;
}

if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	
	Switch ($_REQUEST['accion']) {
		case $strings['Insertar']: //Inserción de eventos
			if (!isset($_REQUEST['EVENTO_NOMBRE'])) {
				if (!tienePermisos('FUNCIONALIDAD_Show')) {
					new Mensaje('No tienes los permisos necesarios', 'EVENTO_Controller.php');
				} else {
					$lugar = new Lugar('', '');
					$lugares = $lugar->listar_lugares();
					new Evento_Add($lugares);
				}
			} else {

				$evento = get_data_form();
				$respuesta = $evento->insert_evento();
				new Mensaje($respuesta, 'EVENTO_Controller.php');

			}
			break;
		case $strings['Borrar']: //Borrado de eventos
			if (!isset($_REQUEST['EVENTO_ID'])) {
				$evento = new Evento('', $_REQUEST['EVENTO_NOMBRE'],'','','');
				$valores = $evento->RellenaDatos();
				if (!tienePermisos('Evento_Delete')) {
					new Mensaje('No tienes los permisos necesarios', 'EVENTO_Controller.php');
				} else {
					$lugar = new Lugar('', '');
					$lugares = $lugar->listar_lugares();
					//new Evento_Add($lugares);
					new Evento_Delete($lugares,$valores, 'EVENTO_Controller.php');
				}
			} else {


				$evento = get_data_form();
				$respuesta = $evento->delete_evento();
				new Mensaje($respuesta, 'EVENTO_Controller.php');
			}
			break;
		case $strings['Modificar']: //Modificación de EVENTOS

			if (!isset($_REQUEST['EVENTO_ID'])) {

				$evento = new Evento('', $_REQUEST['EVENTO_NOMBRE'],'','','');
				$valores = $evento->RellenaDatos();

				if (!tienePermisos('Evento_Delete')) {
					new Mensaje('No tienes los permisos necesarios', 'EVENTO_Controller.php');
				} else {
					$lugar = new Lugar('', '');
					$lugares = $lugar->listar_lugares();
					
					new Evento_Edit($lugares,$valores, 'EVENTO_Controller.php');
				}
			} else {

				$evento = get_data_form();

				$respuesta = $evento->update_evento($_REQUEST['EVENTO_ID']);
				new Mensaje($respuesta, 'EVENTO_Controller.php');

			}
			break;
		case $strings['Consultar']: //Consulta de EVENTOS
			if (!isset($_REQUEST['EVENTO_NOMBRE'])) {
				new Evento_Show();
			} else {
				$evento = get_data_form();
				$datos = $evento->select_evento();
				if (!tienePermisos('Evento_Delete')) {
					new Mensaje('No tienes los permisos necesarios', 'EVENTO_Controller.php');
				} else {

					new Evento_default($datos, 'EVENTO_Controller.php');
				}
			}
			break;
			
		case $strings['Listar personas']: //Listar de EVENTOS con personas y pagos
			if (!isset($_REQUEST['EVENTO_NOMBRE'])) {
				header('Location: EVENTO_Controllerdos.php'); 
			} else {
				$evento = get_data_form();
				$datos = $evento->listar_evento();
				if (!tienePermisos('Evento_Delete')) {
					new Mensaje('No tienes los permisos necesarios', 'EVENTO_Controller.php');
				} else {

					new Evento_default($datos, 'EVENTO_Controller.php');
				}
			}
			break;	

		default:
			//La vista por defecto lista todas lOS EVENTOS
			if (!isset($_REQUEST['EVENTO_NOMBRE'])) {
				$evento = new Evento('','','','','');
			} else {
				$evento = get_data_form();
			}
			$datos = $evento->ConsultarTodoEvento();////////
			if (!tienePermisos('Evento_Default')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
			} else {
				new Evento_Default($datos, '../Views/DEFAULT_Vista.php');

			}

	}

?>
