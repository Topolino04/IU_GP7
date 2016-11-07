<?php

class Pagina_Delete
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
				include '../Functions/PAGINADefForm.php';
				include '../Functions/LibraryFunctions.php';
				$lista = array('PAGINA_ID','PAGINA_LINK','PAGINA_NOM');

?>
			</h2>
		</p>
		<p>
			<h1>
				Borrar <?php echo $strings['Pagina'];?><br>
			</h1>
			<h3>
				<?php echo $strings['(Los campos "Link de la pagina" y "Nombre de la pagina" NO son necesarios)'];?> 
				<br><br>
				<form action='PAGINA_Controller.php' method='post'>
<?php
					createForm($lista,$DefForm,$strings,'',false,false);
?>
				<input type='submit' name='accion' value='Borrar'>
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