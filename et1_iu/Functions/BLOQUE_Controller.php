<?php


include '../Models/BLOQUE_Model.php';

include '../Views/MENSAJE_Vista.php';
include '../Views/BLOQUE_ADD_Vista.php';
include '../Views/BLOQUE_DELETE_Vista.php';
include '../Views/BLOQUE_EDIT_Vista.php';
include '../Views/BLOQUE_SHOW_Vista.php';
include '../Views/BLOQUE_SHOW_ALL_Vista.php';
include '../Views/BLOQUE_SHOW_ACTEV_Vista.php';
include '../Views/CLASE_Vista.php';

if (!IsAuthenticated()){
	header('Location:../index.php');
}
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
//Genera los includes según las páginas a las que tiene acceso

function get_data_form(){
//Recoge la información procedente del formulario
	$titulos=array('BLOQUE_FECHA', 'BLOQUE_HORAI', 'BLOQUE_HORAF',  'BLOQUE_LUGAR','BLOQUE_ACT1','BLOQUE_ACT2','BLOQUE_ACT3','BLOQUE_EV1','BLOQUE_EV2','BLOQUE_EV3');

	foreach($titulos as $titulo){
		if (!isset($_REQUEST[$titulo])){
			$_REQUEST[$titulo]='';
		}
	}

	$BLOQUE_FECHA=$_REQUEST['BLOQUE_FECHA'];
	$BLOQUE_HORAI=$_REQUEST['BLOQUE_HORAI'];
	$BLOQUE_HORAF=$_REQUEST['BLOQUE_HORAF'];
	$BLOQUE_LUGAR=ConsultarIDLugar($_REQUEST['BLOQUE_LUGAR']);
	$BLOQUE_ACT1=ConsultarIDActividad($_REQUEST['BLOQUE_ACT1']);
	$BLOQUE_ACT2=ConsultarIDActividad($_REQUEST['BLOQUE_ACT2']);
	$BLOQUE_ACT3=ConsultarIDActividad($_REQUEST['BLOQUE_ACT3']);
	$BLOQUE_EV1=ConsultarIDEvento($_REQUEST['BLOQUE_EV1']);
	$BLOQUE_EV2=ConsultarIDEvento($_REQUEST['BLOQUE_EV2']);
	$BLOQUE_EV3=ConsultarIDEvento($_REQUEST['BLOQUE_EV3']);
	


	$accion = $_REQUEST['accion'];

	$bloque = new BLOQUE_MODEL( $BLOQUE_FECHA, $BLOQUE_HORAI, $BLOQUE_HORAF,  $BLOQUE_LUGAR,$BLOQUE_ACT1,$BLOQUE_ACT2,$BLOQUE_ACT3,$BLOQUE_EV1,$BLOQUE_EV2,$BLOQUE_EV3);

	return $bloque;
}


if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	Switch ($_REQUEST['accion']) {
		case $strings['Insertar']: //Inserción de roles
			if (!isset($_REQUEST['BLOQUE_FECHA'])) {
				if (!tienePermisos('BLOQUE_Insertar')) {
					new Mensaje('No tienes los permisos necesarios', 'BLOQUE_Controller.php');
				} else {
					new BLOQUE_Insertar();
				}
			} else {

					$bloque = get_data_form();
					$respuesta = $bloque->Insertar();
					new Mensaje($respuesta, 'BLOQUE_Controller.php');

			}

			break;

		case $strings['Borrar']: //Borrado de roles

			if (!isset($_REQUEST['BLOQUE_FECHA'])) {
				$rol = new BLOQUE_MODEL('','','','','','','','','','');
				$valores = $rol->RellenaDatos($_REQUEST['BLOQUE_ID']);
				if (!tienePermisos('BLOQUE_Borrar')) {
					new Mensaje('No tienes los permisos necesarios', 'BLOQUE_Controller.php');
				} else {

							new BLOQUE_Borrar($valores, 'BLOQUE_Controller.php');

				}
			} else {



				$rol = get_data_form();
				$respuesta = $rol->Borrar($_REQUEST['BLOQUE_ID']);
				new Mensaje($respuesta, 'BLOQUE_Controller.php');
			}
			break;

		case $strings['Modificar']: //Modificación de roles

			if (!isset($_REQUEST['BLOQUE_FECHA'])) {

				$bloque = new BLOQUE_MODEL('','','','','','','','','','');
				$valores = $bloque->RellenaDatos($_REQUEST['BLOQUE_ID']);
				if (!tienePermisos('BLOQUE_Modificar')) {
					new Mensaje('No tienes los permisos necesarios', 'BLOQUE_Controller.php');
				} else {


					new BLOQUE_Modificar($valores, 'EMPLEADOS_Controller.php');
				}
			} else {

					$bloque = get_data_form();

					$respuesta = $bloque->Modificar($_REQUEST['BLOQUE_ID']);
					new Mensaje($respuesta, 'BLOQUE_Controller.php');

			}
			break;
		case $strings['Consultar']://Consulta de roles
			if (!isset($_REQUEST['BLOQUE_FECHA'])) {
				if (!tienePermisos('BLOQUE_Consultar')) {
					new Mensaje('No tienes los permisos necesarios', 'BLOQUE_Controller.php');
				} else {

					new BLOQUE_Consultar();
				}
			} else {

				$bloque=new BLOQUE_MODEL($_REQUEST ['BLOQUE_FECHA'],'','','','','','','','','');
				$datos = $bloque->Consultar();
				new BLOQUE_Show($datos, 'BLOQUE_Controller.php');
			}


			break;
		case $strings['ActEv']: //Nos muestra las páginas que tiene asociadas una funcionalidad
			$bloque=new BLOQUE_MODEL('','', '', '','','','','','','');
			$valores=$bloque->ConsultarActEv($_REQUEST['BLOQUE_ID']);
			if(!tienePermisos('BLOQUE_Show_ActEv')){
				new Mensaje('No tienes los permisos necesarios','BLOQUE_Controller.php');
			}
			else {
				new BLOQUE_Show_ActEv($valores, 'BLOQUE_Controller.php');
			}
			break;
		case 'clase':
		    if(isset ($_REQUEST['actividad'])) {
                $infoAct = infoActividad($_REQUEST['actividad']);

                new CLASE($infoAct['CLASE_NOMBRE'], $infoAct['CLASE_PROFESORES'], $infoAct['CLASE_ALUMNOS'], '../Views/DEFAULT_Vista.php');
            }
            else{
                $infoAct = infoEvento($_REQUEST['evento']);

                new CLASE($infoAct['CLASE_NOMBRE'], $infoAct['CLASE_PROFESORES'], $infoAct['CLASE_ALUMNOS'], '../Views/DEFAULT_Vista.php');
            }
			break;
		default:
			//La vista por defecto lista las funcionalidades
			if (!isset($_REQUEST['BLOQUE_FECHA'])) {
				$bloque = new BLOQUE_MODEL('', '','', '','','','','','','');
			} else {
				$bloque = get_data_form();

			}
			$datos = $bloque->ConsultarTodo();
			if (!tienePermisos('BLOQUE_Show')) {
				new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php');
			} else {

				new BLOQUE_Show($datos, '../Views/DEFAULT_Vista.php');
			}
	}


?>
