<?php



class Lugar_Edit{
//VISTA PARA MODIFICAR LUGAR
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
				include '../Functions/LUGARDefForm.php';
				//include '../Functions/LibraryFunctions.php';

				$lista = array('LUGAR_ID','LUGAR_NOMBRE');





				?>
			</h2>
			</p>
			<p>
			<h1>
				<span class="form-title">
				<center><?php echo $strings['Modificar Lugar']?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='LUGAR_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php

					createForm($lista,$DefForm,$strings,$this->valores,array('LUGAR_NOMBRE'=>false),array('LUGAR_ID'=>false));

					?>
					<input type='submit' name='accion' onclick="return valida_envia4()" value=<?php echo $strings['Modificar'] ?>>
				</form>
				<?php
				echo '<a class="form-link" href=\'LUGAR_Controller.php\'>' . $strings['Volver'] . " </a>";
				?>
			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
