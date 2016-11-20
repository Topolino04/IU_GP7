<?php

class EMPLEADOS_Consultar{
	//VISTA QUE MUESTRA  EMPLEADOS CONSULTADOS


function __construct(){	
	$this->render();
}

function render(){
?>
<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
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
	
	<form action='EMPLEADO_Controller.php' method='post'>
<?php
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
include '../Functions/EMPLEADOShowAllDefForm.php';
include '../Functions/EMPLEADOShowDefForm.php';?>
		<span class="form-title">
			<?php echo $strings['Consultar Empleado']?><br>
		<ul class="form-style-1"><?php



		createForm($lista,$DefForm2,$strings,$values='',false,false);
?>
	<input type='submit' name='accion' value='<?php echo $strings['Consultar'] ?>'><br>
	
	</form>
<?php
        	echo '<a class="form-link" href=\'EMPLEADO_Controller.php\'>' . $strings['Volver'] . '</a>';
?>

	</h3>
	</p>

	</div>

<?php
} //fin metodo render

}
?>
