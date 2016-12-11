<?php

include '../Models/CATEGORIA_Model.php';
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
	
	if(isset($_REQUEST['CATEGORIA_ID'])){
		$CATEGORIA_ID = $_REQUEST['CATEGORIA_ID'];
	}else{
		$CATEGORIA_ID=null;
	}
	if(isset($_REQUEST['CATEGORIA_NOMBRE'])){
		$CATEGORIA_NOMBRE = $_REQUEST['CATEGORIA_NOMBRE'];
	}else{
		$CATEGORIA_NOMBRE=null;
	}

	
	$accion = $_REQUEST['accion'];

	$categoria = new categoria($CATEGORIA_ID,$CATEGORIA_NOMBRE);

	return $categoria;
}


if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	
	Switch ($_REQUEST['accion']) {
		case $strings['Insertar']: //Inserción de categoria
			if (!isset($_REQUEST['CATEGORIA_NOMBRE'])) {
				if (!tienePermisos('Categoria_Add')) {
					new Mensaje('No tienes los permisos necesarios', 'CATEGORIA_Controller.php');
				} else {
					new Categoria_Add();
				}
			} else {

				$categoria = get_data_form();
				$respuesta = $categoria->insert_categoria();
				new Mensaje($respuesta, 'CATEGORIA_Controller.php');

			}
			break;
		case $strings['Borrar']: //Borrado de categoria
			if (!isset($_REQUEST['CATEGORIA_ID'])) {
				$categoria = new categoria('', $_REQUEST['CATEGORIA_NOMBRE']);
				$valores = $categoria->RellenaDatos();
				if (!tienePermisos('Categoria_Delete')) {
					new Mensaje('No tienes los permisos necesarios', 'CATEGORIA_Controller.php');
				} else {
					new Categoria_Delete($valores,'CATEGORIA_Controller.php');
				}
			} else {
				$categoria = get_data_form();
				$respuesta = $categoria->delete_categoria();
				new Mensaje($respuesta, 'CATEGORIA_Controller.php');
			}
			break;
		case $strings['Modificar']: //Modificación de categoria

			if (!isset($_REQUEST['CATEGORIA_ID'])) {

				$categoria = new categoria('', $_REQUEST['CATEGORIA_NOMBRE']);
				$valores = $categoria->RellenaDatos();
				
				if (!tienePermisos('CATEGORIA_Edit')) {
					new Mensaje('No tienes los permisos necesarios', 'CATEGORIA_Controller.php');
				} else {

					new Categoria_Edit($valores, 'CATEGORIA_Controller.php');
				}
			} else {

				$categoria = get_data_form();

				$respuesta = $categoria->update_categoria($_REQUEST['CATEGORIA_ID']);
				new Mensaje($respuesta, 'CATEGORIA_Controller.php');

			}
			break;
		case $strings['Consultar']: //Consulta de categoria
			if (!isset($_REQUEST['CATEGORIA_NOMBRE'])) {
				new Categoria_Show();
			} else {
				$categoria = get_data_form();
				$datos = $categoria->select_categoria();
				if (!tienePermisos('CATEGORIA_Show')) {
					new Mensaje('No tienes los permisos necesarios', 'CATEGORIA_Controller.php');
				} else {

					new Categoria_Default($datos, 'CATEGORIA_Controller.php');
				}
			}
			break;
		
		default:
			//La vista por defecto lista todas las categorias
			if (!isset($_REQUEST['CATEGORIA_NOMBRE'])) {
				$categoria = new categoria('', '');
			} else {
				$categoria = get_data_form();
			}
			$datos = $categoria->ConsultarTodo();
			if (!tienePermisos('Actividad_Default')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
			} else {
				new Categoria_Default($datos, '../Views/DEFAULT_Vista.php');

			}

	}

?>
