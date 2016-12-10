<?php



class Actividad_Edit{
//VISTA PARA MODIFICAR PAGINAS
	private $valores;

	function __construct($valores){
		$this->valores=$valores;
		$this->render();
	}

	function render(){
		?>
		<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
			<script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA']?>_validate.js"></script></head>
		<div>
			<p>
			<h2>
				<?php
				include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
				include '../Functions/ACTIVIDADDefForm.php';
				//include '../Functions/LibraryFunctions.php';

				$lista = array('ACTIVIDAD_ID','ACTIVIDAD_NOMBRE','ACTIVIDAD_PRECIO','ACTIVIDAD_DESCRIPCION','ACTIVO');





				?>
				
			</h2>
			</p>
			<p>
			<h1>
				<span class="form-title">
				<?php echo $strings['Modificar Actividad']?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='ACTIVIDAD_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php

					createForm($lista,$DefForm,$strings,$this->valores,array('ACTIVIDAD_NOMBRE'=>false),array('ACTIVIDAD_ID'=>true,'ACTIVIDAD_PRECIO'=>false,'ACTIVIDAD_DESCRIPCION'=>false,'CATEGORIA_ID'=>false,'ACTIVO'=>false));

					?>
					<li> Categoria </li>
					<select name = "CATEGORIA_ID">
					<?php
					listarCategorias();
					?>
				
					</select> <br>
					<input type='submit' name='accion' onclick="return valida_envia4()" value=<?php echo $strings['Modificar'] ?>>
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
