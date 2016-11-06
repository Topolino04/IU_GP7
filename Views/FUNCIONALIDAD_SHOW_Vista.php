<?php

class Funcionalidad_Show{


function __construct(){	
	$this->render();
}

function render(){
?>

	<div>
	<p>
	<h1>
		Consultar Funcionalidad<br>
	</h1>
	<h2>
<?php
	include '../Locates/Strings_Español.php';
	include '../Functions/FUNCIONALIDADDefForm.php';
	include '../Functions/LibraryFunctions.php';

	$lista = array('FUNCIONALIDAD_ID','FUNCIONALIDAD_NOM');

?>
	</h2>
	</p>
	<p>
	<h3>
	(Los campos "Link de la funcionalidad" y "Nombre de la funcionalidad" NO son necesarios) 
	<br><br>
	<form action='FUNCIONALIDAD_Controller.php' method='post'>
<?php
		createForm($lista,$DefForm,$strings,$values='',false,false);
?>
	<input type='submit' name='accion' value=' <?php echo $strings['Consultar']; ?> '><br>
	
	</form>
	<br>
<?php
        	echo '<a href=\'FUNCIONALIDAD_Controller.php\'>' . $strings['Volver'] . '</a>';
?>

	</h3>
	</p>

	</div>

<?php
} //fin metodo render

}