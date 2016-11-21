<?php
	include '../Models/EMPLEADO_Model.php';
	if (isset($_REQUEST['accion'])){

		if ($_REQUEST['accion'] == 'Login'){

			$usuario = new EMPLEADOS_Modelo($_REQUEST['EMP_USER'], $_REQUEST['EMP_PASSWORD'], '', '', '', '', '', '', '', '', '', '', '', '','');
			$respuesta = $usuario->Login(); //Comprueba que se pueda loguear
			if ($respuesta == 'true'){

				session_start();
				$_SESSION['IDIOMA']=$_REQUEST['IDIOMA']; //Establece el idioma de la sesión

				$_SESSION['login'] = $usuario->EMP_USER;//Establece el login de la sesión


				header('Location:../index.php');
			}
			else{
				include '../Views/MENSAJE_Vista.php';
				$_SESSION['IDIOMA']=$_REQUEST['IDIOMA'];
        			new Mensaje($respuesta, '../index.php');
			}
		}
	

	}

?>
