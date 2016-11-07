<?php

include '../Models/FUNCIONALIDAD_Model.php';
include '../Views/FUNCIONALIDAD_SHOW_Vista.php';
include '../Views/FUNCIONALIDAD_DEFAULT_Vista.php';
include '../Views/FUNCIONALIDAD_ADD_Vista.php';
include '../Views/FUNCIONALIDAD_EDIT_Vista.php';
include '../Views/FUNCIONALIDAD_DELETE_Vista.php';
include '../Views/FUNCIONALIDAD_MENU_Vista.php';
include '../Locates/Strings_Español.php';
//include '../Locates/Strings_Galego.php';


function get_data_form(){

	$FUNCIONALIDAD_ID= $_REQUEST['FUNCIONALIDAD_ID'];
	$FUNCIONALIDAD_NOM = $_REQUEST['FUNCIONALIDAD_NOM'];
	$accion = $_REQUEST['accion'];

	$funcionalidad = new Funcionalidad($FUNCIONALIDAD_ID, $FUNCIONALIDAD_NOM);

	return $funcionalidad;
}

if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	
	Switch ($_REQUEST['accion']){
		case 'Insertar':
			if (!isset($_REQUEST['FUNCIONALIDAD_ID'])){
				new Funcionalidad_Add();
			}
			else{
				$funcionalidad = get_data_form();
				$respuesta = $funcionalidad->insert_funcionalidad();
				//new Mensaje($respuesta, 'FUNCIONALIDAD_Controller.php');
				echo $respuesta;
				echo '<br><br><a href=\'FUNCIONALIDAD_Controller.php\'>' . $strings['Volver'] . " </a>";
			}
			break;
		case 'Borrar':
			if (!isset($_REQUEST['FUNCIONALIDAD_ID'])){
				//$funcionalidad = new Funcionalidad('','');
				//$valores = $funcionalidad->RellenaDatos();
				//new Funcionalidad_Delete($valores,'FUNCIONALIDAD_Controller.php');
				new Funcionalidad_Delete();
				
			}
			else{
				$funcionalidad = get_data_form();
				$respuesta = $funcionalidad->delete_funcionalidad();
				//new Mensaje($respuesta, 'FUNCIONALIDAD_Controller.php');
				echo $respuesta;
				echo '<br><br><a href=\'FUNCIONALIDAD_Controller.php\'>' . $strings['Volver'] . " </a>";
			}
			break;
		case 'Modificar':		
			if (!isset($_REQUEST['FUNCIONALIDAD_ID'])){
				//$funcionalidad = new Funcionalidad('','');
				//$valores = $funcionalidad->RellenaDatos();
				//new Funcionalidad_Edit($valores,'FUNCIONALIDAD_Controller.php');
				  new Funcionalidad_Edit();
			}
			else{
				$funcionalidad = get_data_form();
				$respuesta = $funcionalidad->update_funcionalidad();
				//new Mensaje($respuesta, 'FUNCIONALIDAD_Controller.php');
				echo $respuesta;
				echo '<br><br><a href=\'FUNCIONALIDAD_Controller.php\'>' . $strings['Volver'] . " </a>";
			}
			break;
		case 'Consultar':
			if (!isset($_REQUEST['FUNCIONALIDAD_ID'])){
				new Funcionalidad_Show();
			}
			else{
				$funcionalidad = get_data_form();
				$datos = $funcionalidad->select_funcionalidad();
				new Funcionalidad_Menu($datos, 'FUNCIONALIDAD_Controller.php');
			}
			break;
		case 'Listar':
				$funcionalidad = new Funcionalidad('','');
				$datos = $funcionalidad->listar_funcionalidad();
				new Funcionalidad_Default($datos, 'FUNCIONALIDAD_Controller.php');

			break;
		
		default:
			if (!isset($_REQUEST['FUNCIONALIDAD_ID'])){
				$funcionalidad = new Funcionalidad('','');
			}
			else{
				$funcionalidad = get_data_form();
			}
				$datos = $funcionalidad->select_funcionalidad();
				new Funcionalidad_Menu($datos, 'FUNCIONALIDAD_Controller.php');
						
	}



?>
