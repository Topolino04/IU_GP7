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
	include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
//Recoge la información procedente del formulario
	$titulos=array('BLOQUE_HORARIO','BLOQUE_FECHA', 'BLOQUE_DIA', 'BLOQUE_HORAI', 'BLOQUE_HORAF');
	$semana=array($strings['Domingo'],$strings['Lunes'],$strings['Martes'],$strings['Miercoles'],$strings['Jueves'],$strings['Viernes'], $strings['Sabado']);

	foreach($titulos as $titulo){
		if (!isset($_REQUEST[$titulo])){
			$_REQUEST[$titulo]='';
		}
	}
	$BLOQUE_HORARIO=ConsultarIDHorario($_REQUEST['BLOQUE_HORARIO']);
	$BLOQUE_FECHA=$_REQUEST['BLOQUE_FECHA'];
	$BLOQUE_DIA=array_search($_REQUEST['BLOQUE_DIA'],$semana);
	$BLOQUE_HORAI=$_REQUEST['BLOQUE_HORAI'];
	$BLOQUE_HORAF=$_REQUEST['BLOQUE_HORAF'];

	


	$accion = $_REQUEST['accion'];

	$bloque = new BLOQUE_MODEL($BLOQUE_HORARIO, $BLOQUE_FECHA,$BLOQUE_DIA, $BLOQUE_HORAI, $BLOQUE_HORAF);

	return $bloque;
}


if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	Switch ($_REQUEST['accion']) {
		case $strings['Insertar']: //Inserción de horas
			if (!isset($_REQUEST['BLOQUE_DIA'])) {
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

		case $strings['Borrar']: //Borrado de horas

			if (!isset($_REQUEST['BLOQUE_HORAI'])) {
				$bloque = new BLOQUE_MODEL('','','','','');
				$valores = $bloque->RellenaDatos($_REQUEST['BLOQUE_ID']);
				if (!tienePermisos('BLOQUE_Borrar')) {
					new Mensaje('No tienes los permisos necesarios', 'BLOQUE_Controller.php');
				} else {

							new BLOQUE_Borrar($valores, 'BLOQUE_Controller.php');

				}
			} else {



				$bloque = get_data_form();
				$respuesta = $bloque->Borrar($_REQUEST['BLOQUE_ID']);
				new Mensaje($respuesta, 'BLOQUE_Controller.php');
			}
			break;

		case $strings['Modificar']: //Modificación de horas

			if (!isset($_REQUEST['BLOQUE_HORAI'])) {

				$bloque = new BLOQUE_MODEL('','','','','');
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
		case $strings['Consultar']://Consulta de horas
			if (!isset($_REQUEST['BLOQUE_FECHA'])) {
				if (!tienePermisos('BLOQUE_Consultar')) {
					new Mensaje('No tienes los permisos necesarios', 'BLOQUE_Controller.php');
				} else {

					new BLOQUE_Consultar();
				}
			} else {

				$bloque=new BLOQUE_MODEL($_REQUEST ['BLOQUE_HORARIO'],$_REQUEST ['BLOQUE_FECHA'],'','','');
				$datos = $bloque->Consultar();
				new BLOQUE_Show($datos, 'BLOQUE_Controller.php');
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
			//La vista por defecto lista las horas
			if (!isset($_REQUEST['BLOQUE_FECHA'])) {
				$bloque = new BLOQUE_MODEL('', '','', '','');
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
