<?php

class Pagina_Edit
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
				include '../Functions/PAGINADefForm.php';
				include '../Functions/LibraryFunctions.php';
				$lista = array('PAGINA_ID','PAGINA_LINK','PAGINA_NOM');

?>
			</h2>
		</p>
		<p>
			<h1>
				Modificar Página<br>
			</h1>
			<h3>
				<form action='PAGINA_Controller.php' method='post'>
<?php
					createForm($lista,$DefForm,$strings,'',true,false);
?>
				<input type='submit' name='accion' value='Modificar'>
				</form>
				<br>
<?php
				echo '<a href=\'PAGINA_Controller.php\'>' . $strings['Volver'] . " </a>";
?>
			</h3>
		</p>

	</div>

<?php
} //fin metodo render

}