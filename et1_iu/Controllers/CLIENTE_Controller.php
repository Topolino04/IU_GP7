<?php

include '../Models/CLIENTE_Model.php';
include '../Views/CLIENTE_SHOW_ALL_Vista.php';
include '../Views/CLIENTE_SHOW_Vista.php';
include '../Views/CLIENTE_SHOW_ACTIVIDADES_Vista.php';
include '../Views/CLIENTE_SHOW_LESIONES_Vista.php';
include '../Views/CLIENTE_SHOW_CONSULT_Vista.php';
include '../Views/CLIENTE_ADD_Vista.php';
include '../Views/CLIENTE_ADD_EXTERNO_Vista.php';
include '../Views/CLIENTE_EDIT_Vista.php';
include '../Views/CLIENTE_DELETE_Vista.php';
include '../Views/MENSAJE_Vista.php';
include '../Functions/LibraryFunctions.php';

if (!IsAuthenticated()){
	header('Location:../index.php');
}

include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
//Crea cliente a partir de los datos del formulario
function get_data_form(){
$titulos=array('CLIENTE_DNI','CLIENTE_NOMBRE','CLIENTE_NOMBRE','CLIENTE_APELLIDOS','CLIENTE_FECH_NAC','CLIENTE_TELEFONO1','CLIENTE_TELEFONO2','CLIENTE_TELEFONO3','CLIENTE_CORREO','CLIENTE_PROFESION','CLIENTE_DIRECCION','CLIENTE_DIRECCION','CLIENTE_DIRECCION','CLIENTE_COMENTARIOS','CLIENTE_ESTADO','CLIENTE_TIPO');
	foreach($titulos as $titulo){
		if (!isset($_REQUEST[$titulo])){
			$_REQUEST[$titulo]='';
		}
	}
	$CLIENTE_DNI = $_REQUEST['CLIENTE_DNI'];
	$CLIENTE_NOMBRE = $_REQUEST['CLIENTE_NOMBRE'];
	$CLIENTE_APELLIDOS = $_REQUEST['CLIENTE_APELLIDOS'];
	$CLIENTE_FECH_NAC = $_REQUEST['CLIENTE_FECH_NAC'];
	$CLIENTE_TELEFONO1 = $_REQUEST['CLIENTE_TELEFONO1'];
	$CLIENTE_TELEFONO2 = $_REQUEST['CLIENTE_TELEFONO2'];
	$CLIENTE_TELEFONO3 = $_REQUEST['CLIENTE_TELEFONO3'];
	$CLIENTE_CORREO = $_REQUEST['CLIENTE_CORREO'];
	$CLIENTE_PROFESION = $_REQUEST['CLIENTE_PROFESION'];
	$CLIENTE_DIRECCION = $_REQUEST['CLIENTE_DIRECCION'];
	$CLIENTE_COMENTARIOS = $_REQUEST['CLIENTE_COMENTARIOS'];
	$CLIENTE_ESTADO = $_REQUEST['CLIENTE_ESTADO'];//actio o inactivo
	$CLIENTE_TIPO = $_REQUEST['CLIENTE_TIPO'];//externo o socio
	//Si no se ha introducido un nuevo archivo se deja el que había
	if (isset($_FILES['CLIENTE_DOM']['name']) && ($_FILES['CLIENTE_DOM']['name']!=='')) {
//ruta de la carpeta que albergará los documentos
		$CLIENTE_DOM = '../Documents/Clientes/' . $_REQUEST['CLIENTE_DNI'] . '/Domiciliacion/' . $_FILES['CLIENTE_DOM']['name'];

	}
	else {

		$CLIENTE_DOM='';

	}
	if (isset($_FILES['CLIENTE_LOPD']['name']) && ($_FILES['CLIENTE_LOPD']['name']!=='')) {


		$CLIENTE_LOPD = '../Documents/Clientes/' . $_REQUEST['CLIENTE_DNI'] . '/LOPD/' . $_FILES['CLIENTE_LOPD']['name'];
	}
	else {


		$CLIENTE_LOPD='';
	}
	$accion = $_REQUEST['accion'];

	$cliente = new CLIENTE_Modelo( $CLIENTE_DNI,$CLIENTE_NOMBRE, $CLIENTE_APELLIDOS, $CLIENTE_FECH_NAC,  $CLIENTE_TELEFONO1,$CLIENTE_TELEFONO2,$CLIENTE_TELEFONO3,  $CLIENTE_CORREO, $CLIENTE_PROFESION,  $CLIENTE_DIRECCION, $CLIENTE_COMENTARIOS, $CLIENTE_ESTADO, $CLIENTE_TIPO,$CLIENTE_DOM,$CLIENTE_LOPD);

	return $cliente;
}

if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	
	Switch ($_REQUEST['accion']){
		case $strings['Insertar']:
			if (!isset($_REQUEST['CLIENTE_DNI'])){ //Si aún no se ha establecido el usuario
				if(!tienePermisos('CLIENTE_Insertar')){//Siempre que no tenga los permisos mostrará un mensaje de aviso
					new Mensaje('No tienes los permisos necesarios','CLIENTE_Controller.php');
				}
				else {//Muestra el formulario para insertar
					new CLIENTE_Insertar();
				}
			}
			else{

				$_REQUEST['CLIENTE_TIPO']='1';
				$_REQUEST['CLIENTE_ESTADO']='Activo'; //Siempre que se inserta estará activo en un principio
				$cliente = get_data_form();
				//Creamos las carpetas para guardar los archivos
				$carpetaDom='../Documents/Clientes/'.$_REQUEST['CLIENTE_DNI'].'/Domiciliacion/';
				$carpetaLOPD='../Documents/Clientes/'.$_REQUEST['CLIENTE_DNI'].'/LOPD/';

				if($_FILES['CLIENTE_DOM']['name']!=='') {
					if (!file_exists($carpetaDom)) {
						mkdir($carpetaDom, 0777, true);
					}

					move_uploaded_file($_FILES['CLIENTE_DOM']['tmp_name'], $carpetaDom . $_FILES['CLIENTE_DOM']['name']);
				}
				if($_FILES['CLIENTE_LOPD']['name']!=='') {
					if (!file_exists($carpetaLOPD)) {
						mkdir($carpetaLOPD, 0777, true);
					}

					move_uploaded_file($_FILES['CLIENTE_LOPD']['tmp_name'], $carpetaLOPD . $_FILES['CLIENTE_LOPD']['name']);
				} //Insertamos el usuario
				$respuesta = $cliente->Insertar();
				new Mensaje($respuesta, 'CLIENTE_Controller.php');
			}
			break;
		case $strings['InsertarExterno']:
			if (!isset($_REQUEST['CLIENTE_DNI'])){ //Si aún no se ha establecido el usuario
				if(!tienePermisos('CLIENTE_Insertar_Externo')){//Siempre que no tenga los permisos mostrará un mensaje de aviso
					new Mensaje('No tienes los permisos necesarios','CLIENTE_Controller.php');
				}
				else {//Muestra el formulario para insertar
					new CLIENTE_Insertar_Externo();
				}
			}
			else{
				$_REQUEST['CLIENTE_FECH_NAC'] = '';
				$_REQUEST['CLIENTE_TELEFONO2']= '';
				$_REQUEST['CLIENTE_TELEFONO3']= '';
				$_REQUEST['CLIENTE_PROFESION']= '';
				$_REQUEST['CLIENTE_COMENTARIOS'] ='';
				$_REQUEST['CLIENTE_TIPO'] ='0';
				$_REQUEST['CLIENTE_ESTADO']='Activo'; //Siempre que se inserta estará activo en un principio
				$cliente = get_data_form();

				$respuesta = $cliente->Insertar();
				new Mensaje($respuesta, 'CLIENTE_Controller.php');
			}
			break;
		case $strings['Borrar']:
			if (!isset($_REQUEST['CLIENTE_NOMBRE'])){
				//Crea un usuario solo con el user para rellenar posteriormente sus datos y mostrarlos en el formulario
					$cliente = new CLIENTE_Modelo($_REQUEST['CLIENTE_DNI'],'', '', '','','','','','','','','','','','');
				$valores = $cliente->RellenaDatos($_REQUEST['CLIENTE_DNI']);
				if(!tienePermisos('CLIENTE_Borrar')){
					new Mensaje('No tienes los permisos necesarios','CLIENTE_Controller.php');
				}
				else {
					//muestra el formulario de borrado
					new CLIENTE_Borrar($valores, 'CLIENTE_Controller.php');
				}
			}
			else{ //Estos campos no se muestran en el formulario de borrado por lo que se ponen vacíos


				$_REQUEST['CLIENTE_ESTADO']='';

				$cliente = get_data_form();
				$respuesta = $cliente->Borrar();
				new Mensaje($respuesta, 'CLIENTE_Controller.php');
			}
			break;
		case $strings['Modificar']:

			if (!isset($_REQUEST['CLIENTE_NOMBRE'])){
				//Crea un usuario solo con el user para posteriormente rellenar el formulario con sus datos
				$cliente = new CLIENTE_Modelo($_REQUEST['CLIENTE_DNI'],'', '', '','','','','','','','','','','','');
				$valores = $cliente->RellenaDatos($_REQUEST['CLIENTE_DNI']);
				if(!tienePermisos('CLIENTE_Modificar')){
					new Mensaje('No tienes los permisos necesarios','CLIENTE_Controller.php');
				}
				else {
					//Muestra el formulario de modificación
					new CLIENTE_Modificar($valores, 'CLIENTE_Controller.php');
				}
			}
			else{


				$cliente = get_data_form();
				$carpetaDom='../Documents/Clientes/'.$_REQUEST['CLIENTE_DNI'].'/Domiciliacion/';
				$carpetaLOPD='../Documents/Clientes/'.$_REQUEST['CLIENTE_DNI'].'/LOPD/';
				if($_REQUEST['CLIENTE_PROFESION']!=='') {
					//Se realizan las modificaciones también en las carpetas de documentos
					if ($_FILES['CLIENTE_DOM']['name'] !== '') {
						if (!file_exists($carpetaDom)) {
							mkdir($carpetaDom, 0777, true);
						}

						move_uploaded_file($_FILES['CLIENTE_DOM']['tmp_name'], $carpetaDom . $_FILES['CLIENTE_DOM']['name']);
					}
					if ($_FILES['CLIENTE_LOPD']['name'] !== '') {
						if (!file_exists($carpetaLOPD)) {
							mkdir($carpetaLOPD, 0777, true);
						}


						move_uploaded_file($_FILES['CLIENTE_LOPD']['tmp_name'], $carpetaLOPD . $_FILES['CLIENTE_LOPD']['name']);

					}
				}
				$respuesta = $cliente->Modificar();
				new Mensaje($respuesta, 'CLIENTE_Controller.php');
			}


			break;
		case $strings['Consultar']:
			if (!isset($_REQUEST['CLIENTE_DNI'])){
				if(!tienePermisos('CLIENTE_Consultar')){
					new Mensaje('No tienes los permisos necesarios','CLIENTE_Controller.php');
				}
				else { //Se muestra el formulario de consulta
					new CLIENTE_Consultar();
				}
			}
			else{

//Establecemos a cadena vacía la información que no se obtiene del formulario
				$_REQUEST['CLIENTE_FECH_NAC']='';
				$_REQUEST['CLIENTE_TELEFONO1']='';
				$_REQUEST['CLIENTE_TELEFONO2']='';
				$_REQUEST['CLIENTE_TELEFONO3']='';
				$_REQUEST['CLIENTE_CORREO']='';
				$_REQUEST['CLIENTE_PROFESION']='';
				$_REQUEST['CLIENTE_DIRECCION']='';
				$_REQUEST['CLIENTE_COMENTARIOS']='';
				$_REQUEST['CLIENTE_ESTADO']='';
				$_REQUEST['CLIENTE_LOPD']='';
				$_REQUEST['CLIENTE_DOM']='';

				$cliente = get_data_form();
				$datos = $cliente->Consultar();


				new CLIENTE_ShowConsulta($datos, 'CLIENTE_Controller.php');
			}
			break;
		case $strings['Actividades']: //Nos muestra las páginas que tiene asociadas una funcionalidad
			$cliente=new CLIENTE_Modelo($_REQUEST['CLIENTE_DNI'],'', '', '','','','','','','','','','','','');
			$valores=$cliente->ConsultarActividades();
			if(!tienePermisos('CLIENTE_Show_Actividades')){
				new Mensaje('No tienes los permisos necesarios','CLIENTE_Controller.php');
			}
			else {
				new CLIENTE_Show_Actividades($valores, 'CLIENTE_Controller.php');
			}
				break;
		case $strings['Lesiones']: //Nos muestra las páginas que tiene asociadas una funcionalidad
			$cliente=new CLIENTE_Modelo($_REQUEST['CLIENTE_DNI'],'', '', '','','','','','','','','','','','');
			$valores=$cliente->ConsultarLesiones();
			if(!tienePermisos('CLIENTE_Show_Lesiones')){
				new Mensaje('No tienes los permisos necesarios','CLIENTE_Controller.php');
			}
			else {
				new CLIENTE_Show_Lesiones($valores, 'CLIENTE_Controller.php');
			}
			break;
		default:
//Por defecto se realiza el show all

			if (!isset($_REQUEST['CLIENTE_DNI'])){
				$cliente = new CLIENTE_Modelo('','', '', '', '', '', '', '', '','','', '', '', '','');
			}
			else{
				$cliente = get_data_form();
			}
			$datos = $cliente->ConsultarTodo();


			if(!tienePermisos('CLIENTE_Show')){
				new Mensaje('No tienes los permisos necesarios','../Views/DEFAULT_Vista.php');
			}
			else {

				new CLIENTE_Show($datos, '../Views/DEFAULT_Vista.php');
			}

	}



?>
