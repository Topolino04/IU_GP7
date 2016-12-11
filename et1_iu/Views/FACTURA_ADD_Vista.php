<?php

class Factura_Add
{
	//VISTA PARA INSERTAR FACTURAS

	function __construct(){	
		$this->render();
	}

function render(){
?>
	<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
		<script type="text/javascript" src="../js/<?php  echo $_SESSION['IDIOMA']?>_validate.js"></script></head>
	<div>
		<p>
			<h2>
<?php
				include '../Locates/StringsCF_'.$_SESSION['IDIOMA'].'.php';
				include '../Functions/FACTURADefForm.php';

				$lista = array('CLIENTE_NIF', 'CLIENTE_NOMBRE', 'CLIENTE_APELLIDOS');

?>
			</h2>
		</p>
		<p>
			<h1>
			<span class="form-title">
			<?php echo "";?>
			<?php echo	$stringsCF['Crear Factura'] ?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='FACTURA_Controller.php' method='post'>
					<ul class="form-style-1">
					<?php
					createForm($lista,$DefForm,$stringsCF,'',true,false);
?>	
				<input type='submit' name='accion' value=<?php echo $stringsCF['Insertar'] ?>>
				</form>
				<br>
<?php
				echo '<a class="form-link" href=\'FACTURA_Controller.php\'>' . $stringsCF['Volver'] . " </a>";
?>
			</h3>
		</p>

	</div>

<?php
} //fin metodo render

}