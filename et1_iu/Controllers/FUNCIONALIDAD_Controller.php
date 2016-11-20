<?php


include '../Models/FUNCIONALIDAD_Model.php';
include '../Views/MENSAJE_Vista.php';

if (!IsAuthenticated()){
	header('Location:../index.php');
}
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
//Generamos los includes correspondientes a las páginas a las que se tiene acceso
$pags=generarIncludes();
for ($z=0;$z<count($pags);$z++){
	include $pags[$z];
}

function get_data_form(){

//recogemos la información del formulario
	$FUNCIONALIDAD_NOM = $_REQUEST['FUNCIONALIDAD_NOM'];

		$funcionalidad_paginas=$_REQUEST['funcionalidad_paginas'];


	$accion = $_REQUEST['accion'];

	$funcionalidad = new FUNCIONALIDAD_MODEL( $FUNCIONALIDAD_NOM,$funcionalidad_paginas);

	return $funcionalidad;
}


if (!isset($_REQUEST['accion'])){
	$_REQUEST['accion'] = '';
}
	Switch ($_REQUEST['accion']){
		case $strings['Insertar']: //Inserción de funcionalidades
			if(!isset($_REQUEST['FUNCIONALIDAD_NOM'])){

				if(!tienePermisos('FUNCIONALIDAD_Insertar')){
					new Mensaje('No tienes los permisos necesarios','FUNCIONALIDAD_Controller.php');
				}
				else {
					new FUNCIONALIDAD_Insertar();
				}
			}
			else {
				if(!isset($_REQUEST['funcionalidad_paginas'])){ //Si no se ha seleccionado ninguna funcionalidad muestra un aviso
					new Mensaje('No pagina','FUNCIONALIDAD_Controller.php?accion='.$strings['Insertar']."'");
				}
else {
	$funcionalidad = get_data_form();
	$respuesta = $funcionalidad->Insertar();
	new Mensaje($respuesta, 'FUNCIONALIDAD_Controller.php');
}
			}

			break;

		case $strings['Borrar']: //Borrado de funcionalidades
			if (!isset($_REQUEST['FUNCIONALIDAD_ID'])){
				$funcionalidad = new FUNCIONALIDAD_MODEL($_REQUEST['FUNCIONALIDAD_NOM'], '');
				$valores = $funcionalidad->RellenaDatos();
				if(!tienePermisos('FUNCIONALIDAD_Borrar')){
					new Mensaje('No tienes los permisos necesarios','FUNCIONALIDAD_Controller.php');
				}
				else {
					new FUNCIONALIDAD_Borrar($valores, 'FUNCIONALIDAD_Controller.php');
				}
			}
			else{
				$_REQUEST['funcionalidad_paginas']=array('');


				$funcionalidad = get_data_form();
				$respuesta = $funcionalidad->Borrar();
				new Mensaje($respuesta, 'FUNCIONALIDAD_Controller.php');
			}
			break;

		case $strings['Modificar']: //Modificación de funcionalidades

            if (!isset($_REQUEST['FUNCIONALIDAD_ID'])){

                $funcionalidad=new FUNCIONALIDAD_MODEL($_REQUEST['FUNCIONALIDAD_NOM'],'');

				$valores=$funcionalidad->RellenaDatos();
				if(!tienePermisos('FUNCIONALIDAD_Modificar')){
					new Mensaje('No tienes los permisos necesarios','FUNCIONALIDAD_Controller.php');
				}
				else {


					new FUNCIONALIDAD_Modificar($valores, 'FUNCIONALIDAD_Controller.php');
				}
            }
            else {
				if (!isset($_REQUEST['funcionalidad_paginas'])) { //Si no se selecciona ninguna página muestra mensaje de error
					new Mensaje('No pagina', 'FUNCIONALIDAD_Controller.php');
				} else {
					$funcionalidad = get_data_form();

					$respuesta = $funcionalidad->Modificar($_REQUEST['FUNCIONALIDAD_ID'], $funcionalidad->funcionalidad_paginas);
					new Mensaje($respuesta, 'FUNCIONALIDAD_Controller.php');
				}
			}
			break;
		case $strings['Consultar']: //Consulta de funcionalidades
			if (!isset($_REQUEST['FUNCIONALIDAD_NOM'])){
				if(!tienePermisos('FUNCIONALIDAD_Consultar')){
					new Mensaje('No tienes los permisos necesarios','FUNCIONALIDAD_Controller.php');
				}
				else {

					new FUNCIONALIDAD_Consultar();
				}
			}
			else {
				$_REQUEST['funcionalidad_paginas']=array('');
				$funcionalidad = get_data_form();
				$datos = $funcionalidad->Consultar();
				new FUNCIONALIDAD_Show($datos, 'FUNCIONALIDAD_Controller.php');
			}


			break;
		case $strings['Paginas']: //Nos muestra las páginas que tiene asociadas una funcionalidad
			$funcionalidad=new FUNCIONALIDAD_MODEL($_REQUEST['FUNCIONALIDAD_NOM'],'');
			$valores=$funcionalidad->ConsultarPaginas();
if(!tienePermisos('FUNCIONALIDAD_Show_Pagina')){
	new Mensaje('No tienes los permisos necesarios','FUNCIONALIDAD_Controller.php');
}
else {
	new FUNCIONALIDAD_Show_Pagina($valores, 'FUNCIONALIDAD_Controller.php');
}
			break;
		default:
			//La vista por defecto muestra una lista de las funcionalidades
			if (!isset($_REQUEST['FUNCIONALIDAD_NOM'])){
				$funcionalidad = new FUNCIONALIDAD_MODEL('', '');
			}
			else {
				$rol=get_data_form();

			}
			$datos = $funcionalidad->ConsultarTodo();

			if(!tienePermisos('FUNCIONALIDAD_Show')){
				new Mensaje('No tienes los permisos necesarios','../Views/DEFAULT_Vista.php');
			}
			else {
				new FUNCIONALIDAD_Show($datos, '../Views/DEFAULT_Vista.php');
			}
	}



?>
