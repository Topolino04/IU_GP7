<?php

include '../Models/PAGINA_Model.php';
include '../Views/PAGINA_SHOW_Vista.php';
include '../Views/PAGINA_DEFAULT_Vista.php';
include '../Views/PAGINA_ADD_Vista.php';
include '../Views/PAGINA_EDIT_Vista.php';
include '../Views/PAGINA_DELETE_Vista.php';
include '../Views/PAGINA_MENU_Vista.php';
include '../Locates/Strings_Español.php';  
//include '../Locates/Strings_Galego.php';

function get_data_form(){

	$PAGINA_ID= $_REQUEST['PAGINA_ID'];
	$PAGINA_LINK = $_REQUEST['PAGINA_LINK'];
	$PAGINA_NOM = $_REQUEST['PAGINA_NOM'];
	$accion = $_REQUEST['accion'];

	$pagina = new Pagina($PAGINA_ID, $PAGINA_LINK, $PAGINA_NOM);

	return $pagina;
}

if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	
	Switch ($_REQUEST['accion']){
		case 'Insertar':
			if (!isset($_REQUEST['PAGINA_ID'])){
				new Pagina_Add();
			}
			else{
				$pagina = get_data_form();
				$respuesta = $pagina->insert_pagina();
				//new Mensaje($respuesta, 'PAGINA_Controller.php');
				echo $respuesta;
				echo '<br><br><a href=\'PAGINA_Controller.php\'>' . $strings['Volver'] . " </a>";
			}
			break;
		case 'Borrar':
			if (!isset($_REQUEST['PAGINA_ID'])){
				//$pagina = new Pagina('','','');
				//$valores = $pagina->RellenaDatos();
				//new Pagina_Delete($valores,'PAGINA_Controller.php');
				new Pagina_Delete();
				
			}
			else{
				$pagina = get_data_form();
				$respuesta = $pagina->delete_pagina();
				//new Mensaje($respuesta, 'PAGINA_Controller.php');
				echo $respuesta;
				echo '<br><br><a href=\'PAGINA_Controller.php\'>' . $strings['Volver'] . " </a>";
			}
			break;
		case 'Modificar':		
			if (!isset($_REQUEST['PAGINA_ID'])){
				//$pagina = new Pagina('','','');
				//$valores = $pagina->RellenaDatos();
				//new Pagina_Edit($valores,'PAGINA_Controller.php');
				  new Pagina_Edit();
			}
			else{
				$pagina = get_data_form();
				$respuesta = $pagina->update_pagina();
				//new Mensaje($respuesta, 'PAGINA_Controller.php');
				echo $respuesta;
				echo '<br><br><a href=\'PAGINA_Controller.php\'>' . $strings['Volver'] . " </a>";
			}
			break;
		case 'Consultar':
			if (!isset($_REQUEST['PAGINA_ID'])){
				new Pagina_Show();
			}
			else{
				$pagina = get_data_form();
				$datos = $pagina->select_pagina();
				new Pagina_Menu($datos, 'PAGINA_Controller.php');
			}
			break;
		case 'Listar':
				$pagina = new Pagina('','', '');
				$datos = $pagina->listar_pagina();
				new Pagina_Default($datos, 'PAGINA_Controller.php');

			break;
		
		default:
			if (!isset($_REQUEST['PAGINA_ID'])){
				$pagina = new Pagina('','','');
			}
			else{
				$pagina = get_data_form();
			}
				$datos = $pagina->select_pagina();
				new Pagina_Menu($datos, 'PAGINA_Controller.php');
						
	}



?>
