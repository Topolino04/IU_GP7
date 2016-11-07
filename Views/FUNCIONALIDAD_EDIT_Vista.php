<?php

class Funcionalidad_Edit
{

	function __construct(){	
		$this->render();
	}

function render(){
?>

	<div>
		<p>
			<h2>
<?php
				include '../Locates/Strings_Español.php';
				//include '../Locates/Strings_Galego.php';
				include '../Functions/FUNCIONALIDADDefForm.php';
				include '../Functions/LibraryFunctions.php';
				$lista = array('FUNCIONALIDAD_ID','FUNCIONALIDAD_NOM');

?>
			</h2>
		</p>
		<p>
			<h1>
				Modificar <?php echo $strings['Funcionalidad'];?><br>
			</h1>
			<h3>
				<form action='FUNCIONALIDAD_Controller.php' method='post'>
<?php
					createForm($lista,$DefForm,$strings,'',true,false);
?>
				<input type='submit' name='accion' value='Modificar'>
				</form>
				<br>
<?php
				echo '<a href=\'FUNCIONALIDAD_Controller.php\'>' . $strings['Volver'] . " </a>";
?>
			</h3>
		</p>

	</div>

<?php
} //fin metodo render

}