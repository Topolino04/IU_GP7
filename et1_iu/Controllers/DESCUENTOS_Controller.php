<?php

include '../Models/DESCUENTO_Model.php';
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
//Recoge la información procedente del formulario

	$DESCUENTO_ID = $_REQUEST['DESCUENTO_ID'];
	$DESCUENTO_VALOR=$_REQUEST['DESCUENTO_VALOR'];
	$DESCUENTO_DESCRIPCION=$_REQUEST['DESCUENTO_DESCRIPCION'];
	$accion = $_REQUEST['accion'];
	$descuento = new DESCUENTO_MODEL($DESCUENTO_ID,$DESCUENTO_VALOR,$DESCUENTO_DESCRIPCION);

	return $descuento;
}


if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	Switch ($_REQUEST['accion']) {
		case $strings['Insertar']: //Inserción de roles
			if (!isset($_REQUEST['DESCUENTO_VALOR'])) {
				if (!tienePermisos('DESCUENTO_Insertar')) {
					new Mensaje('No tienes los permisos necesarios', 'DESCUENTOS_Controller.php');
				} else {
					new DESCUENTO_Insertar();
				}
			} else {
				$descuento = get_data_form();
				$respuesta = $descuento->Insertar();
				new Mensaje($respuesta, 'DESCUENTOS_Controller.php');
			}
			break;
		case $strings['Borrar']: //Borrado de roles
			if (!isset($_REQUEST['DESCUENTO_VALOR'])) {
				$descuento = new DESCUENTO_MODEL($_REQUEST['DESCUENTO_ID'], '','');
				$valores = $descuento->RellenaDatos();
				if (!tienePermisos('DESCUENTO_Borrar')) {
					new Mensaje('No tienes los permisos necesarios', 'DESCUENTOS_Controller.php');
				} else {
					new DESCUENTO_Borrar($valores, 'DESCUENTOS_Controller.php');
				}
			} else {
				$descuento = get_data_form();
				$respuesta = $descuento->Borrar();
				new Mensaje($respuesta, 'DESCUENTOS_Controller.php');
			}
			break;
		case $strings['Modificar']: //Modificación de roles

			if (!isset($_REQUEST['DESCUENTO_VALOR'])) {
				$descuento = new DESCUENTO_MODEL($_REQUEST['DESCUENTO_ID'], '','');
				$valores = $descuento->RellenaDatos();
				if (!tienePermisos('DESCUENTO_Modificar')) {
					new Mensaje('No tienes los permisos necesarios', 'DESCUENTOS_Controller.php');
				} else {
					new DESCUENTO_Modificar($valores, 'DESCUENTOS_Controller.php');
				}
			} else {

				$descuento = get_data_form();
				$respuesta = $descuento->Modificar();
				new Mensaje($respuesta, 'DESCUENTOS_Controller.php');
			}
			break;
		case $strings['Descuentos']:
			$descuento = new DESCUENTO_MODEL('', '','');
			$datos = $descuento->ConsultarDescuentosDeCliente($_GET["CLIENTE_ID"]);
			if (!tienePermisos('DESCUENTO_Show_Por_Cliente')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
			} else {
				new DESCUENTO_Show_Por_Cliente($datos, './CLIENTE_Controller.php');
			}
			break;

			case $strings['Guardar']:
				$descuento = new DESCUENTO_MODEL('', '','');
				$respuesta = $descuento->AsignarDescuentos($_GET["CLIENTE_ID"],$_POST['descuentos']);
				new Mensaje($respuesta, './CLIENTE_Controller.php');
				break;
		default:
			//La vista por defecto lista los descuentos
			$descuento = new DESCUENTO_MODEL('', '','');
			$datos = $descuento->ConsultarTodo();
			if (!tienePermisos('DESCUENTO_Show')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
			} else {
				new DESCUENTO_Show($datos, '../Views/DEFAULT_Vista.php');
			}
	}


?>
