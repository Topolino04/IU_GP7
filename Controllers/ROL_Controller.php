<?php

include '../Models/ROL_ARRAY.php';
include '../Models/ROL_Model.php';
include '../Views/ROL_DEFAULT_Vista.php';
include '../Views/ROL_SELECT_Vista.php';
include '../Views/ROL_UPDATE_Vista.php';
include '../Views/ROL_DELETE_Vista.php';
include '../Views/Mensaje_Vista.php';



function get_data_form(){

	$rol_id = $_REQUEST['rol_id'];
	$rol_descripcion = $_REQUEST['rol_descripcion'];
	$accion = $_REQUEST['accion'];

	$rol = new ROL_MODEL($rol_id, $rol_descripcion);

	return $rol;
}

if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
elseif ($_REQUEST['accion'] == 'Insertar' || $_REQUEST['accion'] == 'Consultar' || $_REQUEST['accion'] == 'Modificar'){
		$rol = get_data_form();
	}
	
	Switch ($_REQUEST['accion']){
		case 'Insertar':
			$respuesta = $rol->Insertar();
			new Mensaje($respuesta, 'ROL_Controller.php');
			break;
		case 'Delete':
			$rol = new ROL_Model($_REQUEST['rol_id'], '', '', '', '', '', '', '', '');
			$valores = $rol->RellenaDatos($_REQUEST['rol_id']);
			new ROL_Delete($valores,'ROL_Controller.php');
			break;
		case 'Borrar':
			$rol = new ROL_Model($_REQUEST['rol_id'], '', '', '', '', '', '', '', '');
			$respuesta = $rol->Borrar();
			new Mensaje($respuesta, 'ROL_Controller.php');
			break;
		case 'Update':
			$rol = new ROL_Model($_REQUEST['rol_id'], '', '', '', '', '', '', '', '');
			$valores = $rol->RellenaDatos($_REQUEST['rol_id']);
			new ROL_Update($valores,'ROL_Controller.php');
			break;
		case 'Modificar':		
			$respuesta = $rol->Modificar();
			new Mensaje($respuesta, 'ROL_Controller.php');
			break;
		case 'Consultar':
			$datos = $rol->Consultar();
			new ROL_Select($datos, 'ROL_Controller.php');
			break;
		default:
			new ROL_default();
			
	}



?>
