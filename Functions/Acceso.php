<?php
	include '../Models/EMPLEADOS_Model.php';
	if (isset($_REQUEST['accion'])){

		if ($_REQUEST['accion'] == 'Login'){

			$usuario = new EMPLEADOS_Modelo($_REQUEST['EMP_USER'], $_REQUEST['EMP_PASSWORD'], '', '', '', '', '', '', '', '', '', '', '', '','');
			$respuesta = $usuario->Login();
			if ($respuesta == 'true'){

				session_start();
				$_SESSION['IDIOMA']=$_REQUEST['IDIOMA'];
				$_SESSION['login'] = $usuario->EMP_USER;

				header('Location:../index.php');
			}
			else{
				include '../Views/Mensaje_Vista.php';
				$_SESSION['IDIOMA']=$_REQUEST['IDIOMA'];
        			new Mensaje($respuesta, '../index.php');
			}
		}
	
		//if ($_REQUEST['accion'] == 'Registro'){
		//}
	}

?>
