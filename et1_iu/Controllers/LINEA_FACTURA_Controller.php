<?php

include '../Models/LINEA_FACTURA_Model.php';
include '../Functions/LibraryFunctions.php';
include '../Views/MENSAJECF_Vista.php';
include '../Views/LINEA_FACTURA_ADD_Vista.php';
include '../Views/LINEA_FACTURA_EDIT_Vista.php';
include '../Views/LINEA_FACTURA_SHOW_ALL_Vista.php';
if (!IsAuthenticated()){
	header('Location:../index.php');
}
include '../Locates/StringsCF_'.$_SESSION['IDIOMA'].'.php';

//Genera los includes según las páginas a las que tiene acceso


function get_data_form(){
	
	//Recoge la información del formulario
	$LINEA_FACTURA_ID = 1;
	$LINEA_FACTURA_CONCEPTO = $_REQUEST['LINEA_FACTURA_CONCEPTO'];
	$LINEA_FACTURA_UNIDADES = $_REQUEST['LINEA_FACTURA_UNIDADES'];
	$LINEA_FACTURA_PRECIOUD = $_REQUEST['LINEA_FACTURA_PRECIOUD'];
	$FACTURA_ID = $_REQUEST['FACTURA_ID'];
	
	$linea_factura = new Linea_Factura($LINEA_FACTURA_ID, $LINEA_FACTURA_CONCEPTO, $LINEA_FACTURA_UNIDADES, $LINEA_FACTURA_PRECIOUD, $FACTURA_ID);

	return $linea_factura;
}

function get_data_form2(){
	
	//Recoge la información del formulario
	$LINEA_FACTURA_ID = $_REQUEST['LINEA_FACTURA_ID'];
	$LINEA_FACTURA_CONCEPTO = $_REQUEST['LINEA_FACTURA_CONCEPTO'];
	$LINEA_FACTURA_UNIDADES = $_REQUEST['LINEA_FACTURA_UNIDADES'];
	$LINEA_FACTURA_PRECIOUD = $_REQUEST['LINEA_FACTURA_PRECIOUD'];
	$FACTURA_ID = '';
	
	$linea_factura = new Linea_Factura($LINEA_FACTURA_ID, $LINEA_FACTURA_CONCEPTO, $LINEA_FACTURA_UNIDADES, $LINEA_FACTURA_PRECIOUD, $FACTURA_ID);

	return $linea_factura;
}

if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	
	Switch ($_REQUEST['accion']) {
		case $stringsCF['Añadir']: 
			//Inserción de lineas de facturas
			if (!tienePermisos('Linea_Factura_Add')) {
					new Mensaje('No tienes los permisos necesarios', 'FACTURA_Controller.php');
			} else {
				if (sePuedeModificar($_REQUEST['FACTURA_ID'])==true){
					if (!isset($_REQUEST['LINEA_FACTURA_UNIDADES'])) {
						new Linea_Factura_Add($_REQUEST['FACTURA_ID']);
					} else {
						$linea_factura = get_data_form();
						$respuesta = $linea_factura->Insertar();
						new Mensaje($respuesta, 'FACTURA_Controller.php');
					}
				}
				else {
					new Mensaje ('No se puede modificar', 'FACTURA_Controller.php');
				}
			}
			
			break;
			
		case $stringsCF['Borrar']: 
				//Borrado de  lineas factura
				if (!tienePermisos('Linea_Factura_Default')) {
					new Mensaje('No tienes los permisos necesarios', 'FACTURA_Controller.php');
				}
				else{
					$linea_factura = new Linea_Factura($_REQUEST['LINEA_FACTURA_ID'],'','','','');
					$FACTURA_ID = $linea_factura->idFactura();
					$FACTURA_ID = $FACTURA_ID['FACTURA_ID'];
					if (sePuedeModificar($FACTURA_ID)==true){
						$respuesta = $linea_factura->Borrar();
						new Mensaje($respuesta, 'FACTURA_Controller.php');	
					}
					else {
						new Mensaje ('No se puede modificar2', 'FACTURA_Controller.php');
					}
					
				}
			break;
			
		case $stringsCF['Modificar']: 
			//Modificación de lineas de facturas
			if (!tienePermisos('Linea_Factura_Edit')) {
					new Mensaje('No tienes los permisos necesarios', 'FACTURA_Controller.php');
				}
			else{
				if (!isset($_REQUEST['LINEA_FACTURA_UNIDADES'])) {
					$linea_factura = new Linea_Factura($_REQUEST['LINEA_FACTURA_ID'],'','','','');
					$valores = $linea_factura->RellenaDatos();
					$FACTURA_ID = $linea_factura->idFactura();
					$FACTURA_ID = $FACTURA_ID['FACTURA_ID'];
					if (sePuedeModificar($FACTURA_ID)==true){
						new Linea_Factura_Edit($valores, 'LINEA_FACTURA_Controller.php');
					}
					else{
						new Mensaje('No se puede modificar','FACTURA_Controller.php');
					}
				
				} else {
					$linea_factura = get_data_form2();
					$respuesta = $linea_factura->Modificar();
					new Mensaje($respuesta, 'FACTURA_Controller.php');
				}
			}
			break;
			
		default:
			//La vista por defecto lista todas las lineas de facturas
			if (!tienePermisos('Linea_Factura_Default')) {
					new Mensaje('No tienes los permisos necesarios', 'FACTURA_Controller.php');
			}
			else{
				$linea_factura = new Linea_Factura('','','','',$_REQUEST['FACTURA_ID']);
				$datos = $linea_factura->ConsultarTodo();
				new Linea_Factura_Default($datos, '../Controllers/FACTURA_Controller.php');
			}

	}

?>
