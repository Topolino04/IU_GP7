<?php

class Caja_Add
{
	//VISTA PARA AÑADIR INGRESOS

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
				include '../Functions/CAJADefForm.php';

				$lista = array('CAJA_INGRESOS');

?>
			</h2>
		</p>
		<p>
			<h1>
			<span class="form-title">
			<?php echo	$stringsCF['Añadir Ingresos Extra'] ?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='CAJA_Controller.php' method='post'>
					<ul class="form-style-1">
					<?php
					createForm($lista,$DefForm,$stringsCF,'',true,false);
?>
				<input type='submit' name='accion' value=<?php echo $stringsCF['Insertar'] ?>>
				</form>
				<br>
<?php
				echo '<a class="form-link" href=\'CAJA_Controller.php\'>' . $stringsCF['Volver'] . " </a>";
?>
			</h3>
		</p>

	</div>

<?php
} //fin metodo render

}