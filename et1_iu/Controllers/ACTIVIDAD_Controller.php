<?php

include '../Models/ACTIVIDAD_Model.php';
include '../Locates/Strings_Castellano.php';
include '../Functions/LibraryFunctions.php';
include '../Views/MENSAJE_Vista.php';
if (!IsAuthenticated()){
	header('Location:../index.php');
}
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';

//Genera los includes según las actividades a las que tiene acceso
$actividades=generarIncludes();
for ($z=0;$z<count($actividades);$z++){
	include $actividades[$z];
}

function get_data_form(){

//Recoge la información del formulario
	
	if(isset($_REQUEST['ACTIVIDAD_ID'])){
		$ACTIVIDAD_ID = $_REQUEST['ACTIVIDAD_ID'];
	}else{
		$ACTIVIDAD_ID=null;
	}
	if(isset($_REQUEST['ACTIVIDAD_NOMBRE'])){
	$ACTIVIDAD_NOMBRE = $_REQUEST['ACTIVIDAD_NOMBRE'];
	}else{
		$ACTIVIDAD_NOMBRE=null;
	}
	if(isset($_REQUEST['ACTIVIDAD_PRECIO'])){
		$ACTIVIDAD_PRECIO = $_REQUEST['ACTIVIDAD_PRECIO'];
	}else{
		$ACTIVIDAD_PRECIO=null;
	}
	if(isset($_REQUEST['ACTIVIDAD_DESCRIPCION'])){
	$ACTIVIDAD_DESCRIPCION = $_REQUEST ['ACTIVIDAD_DESCRIPCION'];
	}else{
		$ACTIVIDAD_DESCRIPCION=null;
	}
	if(isset($_REQUEST['CATEGORIA_ID'])){
	$CATEGORIA_ID = $_REQUEST ['CATEGORIA_ID'];
	}else{
		$CATEGORIA_ID=null;
	}
	if(isset($_REQUEST['ACTIVO'])){
	$ACTIVO = $_REQUEST ['ACTIVO'];
	}else{
		$ACTIVO=null;
	}
	$accion = $_REQUEST['accion'];

	$actividad = new actividad('',$ACTIVIDAD_NOMBRE,$ACTIVIDAD_PRECIO,$ACTIVIDAD_DESCRIPCION,$CATEGORIA_ID,$ACTIVO);

	return $actividad;
}

if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	
	Switch ($_REQUEST['accion']) {
		case $strings['Insertar']: //Inserción de actividades
			if (!isset($_REQUEST['ACTIVIDAD_NOMBRE'])) {
				if (!tienePermisos('Actividad_Add')) {
					new Mensaje('No tienes los permisos necesarios', 'ACTIVIDAD_Controller.php');
				} else {
					new Actividad_Add();
				}
			} else {

				$actividad = get_data_form();
				$respuesta = $actividad->insert_actividad();
				new Mensaje($respuesta, 'ACTIVIDAD_Controller.php');

			}
			break;
		case $strings['Borrar']: //Borrado de actividades
			if (!isset($_REQUEST['ACTIVIDAD_ID'])) {
				$actividad = new actividad('', $_REQUEST['ACTIVIDAD_NOMBRE'], '','','','');
				$valores = $actividad->RellenaDatos();
				if (!tienePermisos('Actividad_Delete')) {
					new Mensaje('No tienes los permisos necesarios', 'ACTIVIDAD_Controller.php');
				} else {
					new Actividad_Delete($valores, 'ACTIVIDAD_Controller.php');
				}
			} else {


				$actividad = get_data_form();
				$respuesta = $actividad->delete_actividad();
				new Mensaje($respuesta, 'ACTIVIDAD_Controller.php');
			}
			break;
		case $strings['Modificar']: //Modificación de actividades

			if (!isset($_REQUEST['ACTIVIDAD_ID'])) {

				$actividad = new actividad('', $_REQUEST['ACTIVIDAD_NOMBRE'], '', '','','');
				$valores = $actividad->RellenaDatos();

				if (!tienePermisos('ACTIVIDAD_Edit')) {
					new Mensaje('No tienes los permisos necesarios', 'ACTIVIDAD_Controller.php');
				} else {

					new Actividad_Edit($valores, 'ACTIVIDAD_Controller.php');
				}
			} else {

				$actividad = get_data_form();

				$respuesta = $actividad->update_actividad($_REQUEST['ACTIVIDAD_ID']);
				new Mensaje($respuesta, 'ACTIVIDAD_Controller.php');

			}
			break;
		case $strings['Consultar']: //Consulta de actividades
			if (!isset($_REQUEST['ACTIVIDAD_NOMBRE'])) {
				new Actividad_Show();
			} else {
				$actividad = get_data_form();
				$datos = $actividad->select_actividad();
				if (!tienePermisos('ACTIVIDAD_Show')) {
					new Mensaje('No tienes los permisos necesarios', 'ACTIVIDAD_Controller.php');
				} else {

					new Actividad_default($datos, 'ACTIVIDAD_Controller.php');
				}
			}
			break;
		case $strings['CONSULTAR BORRADO']: //Consulta de actividades ocultas
			if (!isset($_REQUEST['ACTIVIDAD_NOMBRE'])) {
				$actividad = new actividad('', '', '','','','');
			} else {
				$actividad = get_data_form();
			}
			
			$datos = $actividad->ConsultarBorradas();
			
			if (!tienePermisos('Actividad_default_borradas')) {
				new Mensaje('No tienes los permisos necesarios', 'ACTIVIDAD_Controller.php');
			} else {
				//var_dump($datos);
				new Actividad_default_borradas($datos, 'ACTIVIDAD_Controller.php');
			}
			break;
		default:
			//La vista por defecto lista todas las actividades
			if (!isset($_REQUEST['ACTIVIDAD_NOMBRE'])) {
				$actividad = new actividad('', '', '','','','');
			} else {
				$actividad = get_data_form();
			}
			$datos = $actividad->ConsultarTodo();
			if (!tienePermisos('Actividad_Default')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
			} else {
				new Actividad_default($datos, '../Views/DEFAULT_Vista.php');

			}

	}

?>
