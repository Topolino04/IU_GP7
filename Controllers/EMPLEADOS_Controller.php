<?php

include '../Models/EMPLEADOS_Model.php';
include '../Views/EMPLEADOS_Show_Vista.php';
include '../Views/EMPLEADOS_ShowConsulta_Vista.php';
include '../Views/EMPLEADOS_Consultar_Vista.php';
include '../Views/EMPLEADOS_Insertar_Vista.php';
include '../Views/EMPLEADOS_Modificar_Vista.php';
include '../Views/EMPLEADOS_Borrar_Vista.php';
include '../Views/Mensaje_Vista.php';
include '../Views/Login_Vista.php';
include '../Functions/LibraryFunctions.php';

if (!IsAuthenticated()){
	header('Location:../index.php');
}

function get_data_form(){


	$EMP_USER=$_REQUEST['EMP_USER'];
	$EMP_PASSWORD=$_REQUEST['EMP_PASSWORD'];
	$EMP_CUENTA=$_REQUEST['EMP_CUENTA'];
	$EMP_TIPO=$_REQUEST['EMP_TIPO'];
	$EMP_ESTADO=$_REQUEST['EMP_ESTADO'];
	$EMP_DNI = $_REQUEST['EMP_DNI'];
	$EMP_EMAIL = $_REQUEST['EMP_EMAIL'];
	$EMP_FECH_NAC = $_REQUEST['EMP_FECH_NAC'];
	$EMP_DIRECCION = $_REQUEST['EMP_DIRECCION'];
	$EMP_NOMBRE = $_REQUEST['EMP_NOMBRE'];
	$EMP_APELLIDO = $_REQUEST['EMP_APELLIDO'];
	$EMP_TELEFONO = $_REQUEST['EMP_TELEFONO'];
	$EMP_COMENTARIOS = $_REQUEST['EMP_COMENTARIOS'];


	if (isset($_FILES['EMP_FOTO']['name']) && ($_FILES['EMP_FOTO']['name']!=='')) {

		$EMP_FOTO = '../Documents/Empleados/' . $_REQUEST['EMP_DNI'] . '/Foto/' . $_FILES['EMP_FOTO']['name'];

	}
	else {

		$EMP_FOTO='';

	}
	if (isset($_FILES['EMP_NOMINA']['name']) && ($_FILES['EMP_NOMINA']['name']!=='')) {


		$EMP_NOMINA = '../Documents/Empleados/' . $_REQUEST['EMP_DNI'] . '/Nomina/' . $_FILES['EMP_NOMINA']['name'];
	}
	else {


		$EMP_NOMINA='';
	}
	$accion = $_REQUEST['accion'];

	$usuario = new EMPLEADOS_Modelo($EMP_USER, $EMP_PASSWORD, $EMP_FECH_NAC, $EMP_EMAIL, $EMP_NOMBRE, $EMP_APELLIDO, $EMP_DNI, $EMP_TELEFONO, $EMP_CUENTA, $EMP_DIRECCION, $EMP_COMENTARIOS, $EMP_TIPO, $EMP_ESTADO,$EMP_FOTO,$EMP_NOMINA);

	return $usuario;
}

if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	
	Switch ($_REQUEST['accion']){
		case 'Insertar':
			if (!isset($_REQUEST['EMP_USER'])){
				new EMPLEADOS_Insertar();
			}
			else{


				$usuario = get_data_form();

				$carpetaFoto='../Documents/Empleados/'.$_REQUEST['EMP_DNI'].'/Foto/';
				$carpetaNomina='../Documents/Empleados/'.$_REQUEST['EMP_DNI'].'/Nomina/';

				if($_FILES['EMP_FOTO']['name']!=='') {
					if (!file_exists($carpetaFoto)) {
						mkdir($carpetaFoto, 0777, true);
					}

					move_uploaded_file($_FILES['EMP_FOTO']['tmp_name'], $carpetaFoto . $_FILES['EMP_FOTO']['name']);
				}
				if($_FILES['EMP_NOMINA']['name']!=='') {
					if (!file_exists($carpetaNomina)) {
						mkdir($carpetaNomina, 0777, true);
					}


					move_uploaded_file($_FILES['EMP_NOMINA']['tmp_name'], $carpetaNomina . $_FILES['EMP_NOMINA']['name']);

				}
				$respuesta = $usuario->Insertar();
				new Mensaje($respuesta, 'EMPLEADOS_Controller.php');
			}
			break;
		case 'Borrar':
			if (!isset($_REQUEST['EMP_NOMBRE'])){
				$usuario = new EMPLEADOS_Modelo($_REQUEST['EMP_USER'], '', '', '', '', '', '', '', '','','', '', '', '', '');
				$valores = $usuario->RellenaDatos($_REQUEST['EMP_USER']);
				new EMPLEADOS_Borrar($valores,'EMPLEADOS_Controller.php');
			}
			else{
				$_REQUEST['EMP_PASSWORD']='';

				$_REQUEST['EMP_ESTADO']='';
				$usuario = get_data_form();
				$respuesta = $usuario->Borrar();
				new Mensaje($respuesta, 'EMPLEADOS_Controller.php');
			}
			break;
		case 'Modificar':


			if (!isset($_REQUEST['EMP_DNI'])){

				$usuario = new EMPLEADOS_Modelo($_REQUEST['EMP_USER'], '', '', '', '', '', '', '', '','','', '', '', '', '');
				$valores = $usuario->RellenaDatos($_REQUEST['EMP_USER']);
				new EMPLEADOS_Modificar($valores,'EMPLEADOS_Controller.php');
			}
			else{
				$usuario = get_data_form();
				$carpetaFoto='../Documents/Empleados/'.$_REQUEST['EMP_DNI'].'/Foto/';
				$carpetaNomina='../Documents/Empleados/'.$_REQUEST['EMP_DNI'].'/Nomina/';


				if($_FILES['EMP_FOTO']['name']!=='') {
					if (!file_exists($carpetaFoto)) {
						mkdir($carpetaFoto, 0777, true);
					}

					move_uploaded_file($_FILES['EMP_FOTO']['tmp_name'], $carpetaFoto . $_FILES['EMP_FOTO']['name']);
				}
				if($_FILES['EMP_NOMINA']['name']!=='') {
					if (!file_exists($carpetaNomina)) {
						mkdir($carpetaNomina, 0777, true);
					}


					move_uploaded_file($_FILES['EMP_NOMINA']['tmp_name'], $carpetaNomina . $_FILES['EMP_NOMINA']['name']);

				}
				$respuesta = $usuario->Modificar();
				new Mensaje($respuesta, 'EMPLEADOS_Controller.php');
			}
			break;
		case 'Consultar':
			if (!isset($_REQUEST['EMP_USER'])){

				new EMPLEADOS_Consultar();
			}
			else{


			$_REQUEST['EMP_CUENTA']='';
				$_REQUEST['EMP_TIPO']='';
			$_REQUEST['EMP_ESTADO']='';

		$_REQUEST['EMP_EMAIL']='';
				$_REQUEST['EMP_FECH_NAC']='';
				$_REQUEST['EMP_DIRECCION']='';


			$_REQUEST['EMP_TELEFONO']='';
				$_REQUEST['EMP_PASSWORD']='';
		$_REQUEST['EMP_COMENTARIOS']='';
			;
				$_REQUEST['EMP_FOTO']='';
				$_REQUEST['EMP_NOMINA']='';

				$usuario = get_data_form();
				$datos = $usuario->Consultar();

				new EMPLEADOS_ShowConsulta($datos, 'EMPLEADOS_Controller.php');
			}
			break;

		default:

			if (!isset($_REQUEST['EMP_USER'])){
				$usuario = new EMPLEADOS_Modelo('','', '', '', '', '', '', '', '','','', '', '', '', '');
			}
			else{
				$usuario = get_data_form();
			}
				$datos = $usuario->ConsultarTodo();


				new EMPLEADOS_Show($datos, 'EMPLEADOS_Controller.php');
						
	}



?>
