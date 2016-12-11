<?php

class Actividad_delete{
	//VISTA PARA BORRAR ACTIVIDAD

	private $valores;

	function __construct($valores){
		$this->valores=$valores;
		$this->render();
	}

	function render(){
		?>

		<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
			<p>
			<h2>
				<?php
				include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
				include '../Functions/ACTIVIDADDefForm.php';


				$lista = array('ACTIVIDAD_ID','ACTIVIDAD_NOMBRE','ACTIVIDAD_PRECIO','ACTIVIDAD_DESCRIPCION','CATEGORIA_ID');


				?>
			</h2>
			</p>
			<p>
			<h1>
			<span class="form-title">
				<?php echo $strings['Borrar Actividad']?><br>
			</h1>
			<h3>

				<form action='ACTIVIDAD_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php

					createForm($lista,$DefForm,$strings,$this->valores,false,true);

					?>
					<input type='submit' name='accion' value=<?php echo $strings['Borrar'] ?>>
				</form>
				<?php
				echo '<a class="form-link" href=\'ACTIVIDAD_Controller.php\'>' . $strings['Volver'] . " </a>";
				?>
			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
