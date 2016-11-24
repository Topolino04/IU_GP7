<?php

include '../Models/PAGINA_Model.php';
include '../Locates/Strings_Castellano.php';
include '../Functions/LibraryFunctions.php';
include '../Views/MENSAJE_Vista.php';
if (!IsAuthenticated()){
	header('Location:../index.php');
}
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';

//Genera los includes según las páginas a las que tiene acceso
$pags=generarIncludes();
for ($z=0;$z<count($pags);$z++){
	include $pags[$z];
}

function get_data_form(){

//Recoge la información del formulario
	$PAGINA_LINK = GenerarLinkPagina($_REQUEST['PAGINA_NOM']);
	$PAGINA_NOM = $_REQUEST['PAGINA_NOM'];
	$accion = $_REQUEST['accion'];

	$pagina = new Pagina($PAGINA_LINK, $PAGINA_NOM);

	return $pagina;
}

if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	
	Switch ($_REQUEST['accion']) {
		case $strings['Insertar']: //Inserción de páginas
			if (!isset($_REQUEST['PAGINA_NOM'])) {
				if (!tienePermisos('FUNCIONALIDAD_Show')) {
					new Mensaje('No tienes los permisos necesarios', 'PAGINA_Controller.php');
				} else {
					new Pagina_Add();
				}
			} else {

				$pagina = get_data_form();
				$respuesta = $pagina->insert_pagina();
				new Mensaje($respuesta, 'PAGINA_Controller.php');

			}
			break;
		case $strings['Borrar']: //Borrado de páginas
			if (!isset($_REQUEST['PAGINA_ID'])) {
				$pagina = new Pagina('', $_REQUEST['PAGINA_NOM']);
				$valores = $pagina->RellenaDatos();
				if (!tienePermisos('Pagina_Delete')) {
					new Mensaje('No tienes los permisos necesarios', 'PAGINA_Controller.php');
				} else {
					new Pagina_Delete($valores, 'PAGINA_Controller.php');
				}
			} else {


				$pagina = get_data_form();
				$respuesta = $pagina->delete_pagina();
				new Mensaje($respuesta, 'PAGINA_Controller.php');
			}
			break;
		case $strings['Modificar']: //Modificación de páginas

			if (!isset($_REQUEST['PAGINA_ID'])) {

				$pagina = new Pagina('', $_REQUEST['PAGINA_NOM']);
				$valores = $pagina->RellenaDatos();

				if (!tienePermisos('Pagina_Delete')) {
					new Mensaje('No tienes los permisos necesarios', 'PAGINA_Controller.php');
				} else {

					new Pagina_Edit($valores, 'PAGINA_Controller.php');
				}
			} else {

				$pagina = get_data_form();

				$respuesta = $pagina->update_pagina($_REQUEST['PAGINA_ID']);
				new Mensaje($respuesta, 'PAGINA_Controller.php');

			}
			break;
		case $strings['Consultar']: //Consulta de páginas
			if (!isset($_REQUEST['PAGINA_NOM'])) {
				new Pagina_Show();
			} else {
				$pagina = get_data_form();
				$datos = $pagina->select_pagina();
				if (!tienePermisos('Pagina_Delete')) {
					new Mensaje('No tienes los permisos necesarios', 'PAGINA_Controller.php');
				} else {

					new Pagina_default($datos, 'PAGINA_Controller.php');
				}
			}
			break;

		default:
			//La vista por defecto lista todas las páginas
			if (!isset($_REQUEST['PAGINA_NOM'])) {
				$pagina = new Pagina('', '');
			} else {
				$pagina = get_data_form();
			}
			$datos = $pagina->ConsultarTodo();
			if (!tienePermisos('Pagina_Default')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
			} else {
				new Pagina_Default($datos, '../Views/DEFAULT_Vista.php');

			}

	}

?>
