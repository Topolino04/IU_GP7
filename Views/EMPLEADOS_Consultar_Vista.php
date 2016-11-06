<?php

class EMPLEADOS_Consultar{


function __construct(){	
	$this->render();
}

function render(){
?>

	<div>
	<p>
	<h2>
<?php


	$lista = array('EMP_USER', 'EMP_NOMBRE', 'EMP_APELLIDO', 'EMP_DNI');

?>
	</h2>
	</p>
	<p>
	<h3>
	
	<form action='EMPLEADOS_Controller.php' method='post'>
<?php
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
include '../Functions/EmpleadosDefForm.php';
include '../Functions/EMPLEADOSConsultarDefForm.php';
//include '../Functions/LibraryFunctions.php';

		createForm($lista,$DefForm2,$strings,$values='',false,false);
?>
	<input type='submit' name='accion' value='Consultar'><br>
	
	</form>
<?php
        	echo '<a href=\'EMPLEADOS_Controller.php\'>' . $strings['Volver'] . '</a>';
?>

	</h3>
	</p>

	</div>

<?php
} //fin metodo render

}
?>
