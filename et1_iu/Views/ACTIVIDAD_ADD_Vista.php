<?php

class Actividad_Add
{
	//VISTA PARA INSERTAR ACTIVIDAD

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
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
				include '../Functions/ACTIVIDAD2DefForm.php';

				$lista = array('ACTIVIDAD_NOMBRE','CATEGORIA_NOMBRE','ACTIVIDAD_HORARIO','ACTIVIDAD_DIA');


?>
			</h2>
		</p>
		<p>
			<h1>
			<span class="form-title">
			<?php echo	$strings['Insertar Actividad'] ?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='ACTIVIDAD_Controller.php?' method='post'>
					<ul class="form-style-1">
					<?php
					createForm($lista,$DefForm,$strings,'',true,false);
?>
				
					<li> Lugar </li>
				<select name = "ACTIVIDAD_LUGAR">
					<?php
					listarLugares();
					?>
					</select> <br>
				<input type='submit' name='accion' onclick="return valida_envia4()" value=<?php echo $strings['Continuar'] ?>>
				</form>
				<?php
				echo '<a class="form-link" href=\'ACTIVIDAD_Controller.php\'>' . $strings['Volver'] . " </a>";
				?>
				<br>

			</h3>
		</p>

	</div>

<?php
} //fin metodo render

}
