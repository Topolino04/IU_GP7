<?php

include '../Models/EMPLEADO_Model.php';
include '../Views/EMPLEADO_EDIT_ACCIONES_Vista.php';

include '../Views/MENSAJE_Vista.php';
include '../Views/LOGIN_Vista.php';



if (!IsAuthenticated()){
	header('Location:../index.php');
}

include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
//Realizamos los includes de las páginas a las que tiene acceso
$pags=generarIncludes();

for ($z=0;$z<count($pags);$z++){
	include $pags[$z];
}
//Método que recoge la información del formulario
function get_data_form(){


	$EMP_USER=$_REQUEST['EMP_USER'];
	$EMP_PASSWORD=$_REQUEST['EMP_PASSWORD'];
	$EMP_CUENTA=$_REQUEST['EMP_CUENTA'];
	$EMP_TIPO=ConsultarIDRol($_REQUEST['EMP_TIPO']);

	$EMP_ESTADO=$_REQUEST['EMP_ESTADO'];
	$EMP_DNI = $_REQUEST['EMP_DNI'];
	$EMP_EMAIL = $_REQUEST['EMP_EMAIL'];
	$EMP_FECH_NAC = $_REQUEST['EMP_FECH_NAC'];
	$EMP_DIRECCION = $_REQUEST['EMP_DIRECCION'];
	$EMP_NOMBRE = $_REQUEST['EMP_NOMBRE'];
	$EMP_APELLIDO = $_REQUEST['EMP_APELLIDO'];
	$EMP_TELEFONO = $_REQUEST['EMP_TELEFONO'];
	$EMP_COMENTARIOS = $_REQUEST['EMP_COMENTARIOS'];

//Si no se ha introducido un nuevo archivo se deja el que había
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
//crea el empleado con los datos anteriores
	$usuario = new EMPLEADOS_Modelo($EMP_USER, $EMP_PASSWORD, $EMP_FECH_NAC, $EMP_EMAIL, $EMP_NOMBRE, $EMP_APELLIDO, $EMP_DNI, $EMP_TELEFONO, $EMP_CUENTA, $EMP_DIRECCION, $EMP_COMENTARIOS, $EMP_TIPO, $EMP_ESTADO,$EMP_FOTO,$EMP_NOMINA);

	return $usuario;
}

if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
//Actúa según la acción elegida
	Switch ($_REQUEST['accion']){
		case  $strings['Insertar']:
			if (!isset($_REQUEST['EMP_USER'])){ //Si aún no se ha establecido el usuario
				if(!tienePermisos('EMPLEADOS_Insertar')){//Siempre que no tenga los permisos mostrará un mensaje de aviso
					new Mensaje('No tienes los permisos necesarios','EMPLEADO_Controller.php');
				}
				else {//Muestra el formulario para insertar
					new EMPLEADOS_Insertar();
				}
			}
			else{


				$_REQUEST['EMP_ESTADO']='Activo'; //Siempre que se inserta estará activo en un principio
				$usuario = get_data_form();
				//Creamos las carpetas para guardar los archivos
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

				} //Insertamos el usuario
				$respuesta = $usuario->Insertar();
				new Mensaje($respuesta, 'EMPLEADO_Controller.php');
			}
			break;
		case  $strings['Borrar']:
			if (!isset($_REQUEST['EMP_NOMBRE'])){
				//Crea un usuario solo con el user para rellenar posteriormente sus datos y mostrarlos en el formulario
				$usuario = new EMPLEADOS_Modelo($_REQUEST['EMP_USER'], '', '', '', '', '', '', '', '','','', '', '', '', '');
				$valores = $usuario->RellenaDatos($_REQUEST['EMP_USER']);
				if(!tienePermisos('EMPLEADOS_Borrar')){
					new Mensaje('No tienes los permisos necesarios','EMPLEADO_Controller.php');
				}
				else {
					//muestra el formulario de borrado
					new EMPLEADOS_Borrar($valores, 'EMPLEADO_Controller.php');
				}
			}
			else{ //Estos campos no se muestran en el formulario de borrado por lo que se ponen vacíos
				$_REQUEST['EMP_PASSWORD']='';

				$_REQUEST['EMP_ESTADO']='';
				$_REQUEST['EMP_TIPO']='';
				$usuario = get_data_form();
				$respuesta = $usuario->Borrar();
				new Mensaje($respuesta, 'EMPLEADO_Controller.php');
			}
			break;
		case  $strings['Modificar']:


			if (!isset($_REQUEST['EMP_DNI'])){
				//Crea un usuario solo con el user para posteriormente rellenar el formulario con sus datos
				$usuario = new EMPLEADOS_Modelo($_REQUEST['EMP_USER'], '', '', '', '', '', '', '', '','','', '', '', '', '');
				$valores = $usuario->RellenaDatos($_REQUEST['EMP_USER']);
				if(!tienePermisos('EMPLEADOS_Modificar')){
					new Mensaje('No tienes los permisos necesarios','EMPLEADO_Controller.php');
				}
				else {
					//Muestra el formulario de modificación
					new EMPLEADOS_Modificar($valores, 'EMPLEADO_Controller.php');
				}
			}
			else{
				$_REQUEST['EMP_TIPO']='';

				$usuario = get_data_form();
				$carpetaFoto='../Documents/Empleados/'.$_REQUEST['EMP_DNI'].'/Foto/';
				$carpetaNomina='../Documents/Empleados/'.$_REQUEST['EMP_DNI'].'/Nomina/';

					//Se realizan las modificaciones también en las carpetas de documentos
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
				new Mensaje($respuesta, 'EMPLEADO_Controller.php');
			}
			break;
		case  $strings['Consultar']:
			if (!isset($_REQUEST['EMP_USER'])){
				if(!tienePermisos('EMPLEADOS_Consultar')){
					new Mensaje('No tienes los permisos necesarios','EMPLEADO_Controller.php');
				}
				else { //Se muestra el formulario de consulta
					new EMPLEADOS_Consultar();
				}
			}
			else{

//Establecemos a cadena vacía la información que no se obtiene del formulario
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


				new EMPLEADOS_ShowConsulta($datos, 'EMPLEADO_Controller.php');
			}
			break;
		case $strings['Modificar acciones']:

if (!isset($_REQUEST['funcionalidad_paginas'])) { //Consulta de las páginas asociadas
	$empleado = new EMPLEADOS_Modelo($_REQUEST['EMP_USER'], '', '', '', '', '', '', '', '', '', '', '', '', '', '');

	$valores = $empleado->ConsultarPaginas();


	if (!tienePermisos('EMPLEADO_Edit_Accion')) {
		new Mensaje('No tienes los permisos necesarios', 'EMPLEADO_Controller.php');
	} else {

		new EMPLEADO_Edit_Accion($_REQUEST['EMP_USER'],$valores, 'EMPLEADO_Controller.php');
	}
}
else{
	$empleado = new EMPLEADOS_Modelo($_REQUEST['EMP_USER'], '', '', '', '', '', '', '', '', '', '', '', '', '', '');
 		$empleado->ModificarPaginas($_REQUEST['funcionalidad_paginas']);
	new Mensaje('El empleado se ha modificado con éxito', 'EMPLEADO_Controller.php');
}
			break;

		default:
//Por defecto se realiza el show all

			if (!isset($_REQUEST['EMP_USER'])){
				$usuario = new EMPLEADOS_Modelo('','', '', '', '', '', '', '', '','','', '', '', '', '');
			}
			else{
				$usuario = get_data_form();
			}
				$datos = $usuario->ConsultarTodo();

			if(!tienePermisos('EMPLEADOS_Show')){
				new Mensaje('No tienes los permisos necesarios','../Views/DEFAULT_Vista.php');
			}
			else {
				new EMPLEADOS_Show($datos, '../Views/DEFAULT_Vista.php');
			}
						
	}



?>
