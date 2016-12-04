<?php

include '../Models/CAJA_Model.php';
include '../Views/MENSAJECF_Vista.php';
if (!IsAuthenticated()){
	header('Location:../index.php');
}
include '../Locates/StringsCF_'.$_SESSION['IDIOMA'].'.php';

//Genera los includes según las páginas a las que tiene acceso
$pags=generarIncludes();
for ($z=0;$z<count($pags);$z++){
	include $pags[$z];
}
function get_data_form(){
	//Establecer la hora actual del sistema
	$time = time();
	$fecha_actual = date("Y-m-d", $time);
	
	//Recoge la información del formulario
	$CAJA_INGRESOS = $_REQUEST['CAJA_INGRESOS'];
	$accion = $_REQUEST['accion'];

	$caja = new Caja(1, $fecha_actual,$CAJA_INGRESOS);

	return $caja;
}

if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	
	Switch ($_REQUEST['accion']) {
		case $stringsCF['Insertar']: 
			//Añadir Ingresos extra
			if (!isset($_REQUEST['CAJA_INGRESOS'])) {
				if (!tienePermisos('Caja_Add')) {
					new Mensaje('No tienes los permisos necesarios', 'CAJA_Controller.php');
				} else {
					new Caja_Add();
				}
			} else {
				$caja = get_data_form();
				$respuesta = $caja->Ingresos();
				$respuesta1 = $caja->Actualizar();
				new Mensaje($respuesta, 'CAJA_Controller.php');
			}
			break;
		case $stringsCF['Listar Cajas']: 
			//Listado de cajas
			if (!tienePermisos('Caja_default')) {
				new Mensaje('No tienes los permisos necesarios', 'CAJA_Controller.php');
			} else {
				$time = time();
				$fecha_actual = date("Y-m-d", $time);
				$caja = new Caja(1, $fecha_actual,0);
				$respuesta = $caja->Actualizar();
				$datos = $caja->ConsultarTodo();
				if ($datos=='Error en la consulta sobre la base de datos'){
					new Mensaje($respuesta, 'CAJA_Controller.php');
				}
				else{
					new Caja_default($datos, 'CAJA_Controller.php');
				}	
			}
			break;
		default:
			//La vista por defecto enseña la caja del dia actual
			$time = time();
			$fecha_actual = date("Y-m-d", $time);
			$caja = new Caja(1,$fecha_actual,0);
			$respuesta = $caja->Insertar();
			$respuesta = $caja->Actualizar();
			$datos = $caja->Consultar();
			if (!tienePermisos('Caja_Show')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
			} else {
				new Caja_Show($datos, '../Views/DEFAULT_Vista.php');

			}

	}

?>
