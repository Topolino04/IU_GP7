<?php

include '../Models/LUGAR_Model.php';
include '../Locates/Strings_Castellano.php';
include '../Functions/LibraryFunctions.php';
include '../Views/MENSAJE_Vista.php';

if (!IsAuthenticated()){
	header('Location:../index.php');
}

include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';

//Genera los includes según los lugares a las que tiene acceso
$pags=generarIncludes();
for ($z=0;$z<count($pags);$z++){
	include $pags[$z];
}

function get_data_form(){

//Recoge la información del formulario
if(isset($_REQUEST['LUGAR_ID'])){
	$LUGAR_ID = $_REQUEST['LUGAR_ID'];
}else {
	$LUGAR_ID = null;
}

	$LUGAR_NOMBRE = $_REQUEST['LUGAR_NOMBRE'];
	$accion = $_REQUEST['accion'];

	$lugar = new Lugar($LUGAR_ID, $LUGAR_NOMBRE);

	return $lugar;
}

if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	
	Switch ($_REQUEST['accion']) {
		case $strings['Insertar']: //Inserción de lugares
			if (!isset($_REQUEST['LUGAR_NOMBRE'])) {
				if (!tienePermisos('FUNCIONALIDAD_Show')) {
					new Mensaje('No tienes los permisos necesarios', 'LUGAR_Controller.php');
				} else {
					new Lugar_Add();//vamos a la vista
				}
			} else {

				$lugar = get_data_form();
				$respuesta = $lugar->insert_lugar();
				new Mensaje($respuesta, 'LUGAR_Controller.php');

			}
			break;
		case $strings['Borrar']: //Borrado de lugares
			if (!isset($_REQUEST['LUGAR_ID'])) {
				$lugar = new Lugar('', $_REQUEST['LUGAR_NOMBRE']);
				$valores = $lugar->RellenaDatos();
				if (!tienePermisos('Lugar_Delete')) {
					new Mensaje('No tienes los permisos necesarios', 'LUGAR_Controller.php');
				} else {
					new Lugar_Delete($valores, 'LUGAR_Controller.php');
				}
			} else {


				$lugar = get_data_form();
				$respuesta = $lugar->delete_lugar();
				new Mensaje($respuesta, 'LUGAR_Controller.php');
			}
			break;
		case $strings['Modificar']: //Modificación de páginas

			if (!isset($_REQUEST['LUGAR_ID'])) {

				$lugar = new Lugar('', $_REQUEST['LUGAR_NOMBRE']);
				$valores = $lugar->RellenaDatos();

				if (!tienePermisos('Lugar_Delete')) {
					new Mensaje('No tienes los permisos necesarios', 'LUGAR_Controller.php');
				} else {

					new Lugar_Edit($valores, 'LUGAR_Controller.php');
				}
			} else {

				$lugar = get_data_form();

				$respuesta = $lugar->update_lugar($_REQUEST['LUGAR_ID']);
				new Mensaje($respuesta, 'LUGAR_Controller.php');

			}
			break;
		case $strings['Consultar']: //Consulta de páginas
			if (!isset($_REQUEST['LUGAR_NOMBRE'])) {
				new Lugar_Show();
			} else {
				$lugar = get_data_form();
				$datos = $lugar->select_lugar();
				if (!tienePermisos('Lugar_Show')) {
					new Mensaje('No tienes los permisos necesarios', 'LUGAR_Controller.php');
				} else {

					new Lugar_default($datos, 'LUGAR_Controller.php');
				}
			}
			break;

		default:
			//La vista por defecto lista todas las páginas
			if (!isset($_REQUEST['LUGAR_NOMBRE'])) {
				$lugar = new Lugar('', '');
			} else {
				$lugar = get_data_form();
			}
			$datos = $lugar->listar_lugares();
			if (!tienePermisos('Lugar_Default')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');//peta por esto
			} else {
				new Lugar_Default($datos, '../Views/DEFAULT_Vista.php');

			}

	}

?>
