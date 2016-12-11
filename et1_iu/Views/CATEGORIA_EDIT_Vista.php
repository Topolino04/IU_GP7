<?php



class Categoria_Edit{
//VISTA PARA MODIFICAR CATEGORIAS
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
				include '../Functions/CATEGORIADefForm.php';
				//include '../Functions/LibraryFunctions.php';

				$lista = array('CATEGORIA_ID','CATEGORIA_NOMBRE');





				?>
				
			</h2>
			</p>
			<p>
			<h1>
				<span class="form-title">
				<?php echo $strings['Modificar Categoria']?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='CATEGORIA_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php

					createForm($lista,$DefForm,$strings,$this->valores,array('CATEGORIA_NOMBRE'=>false),array('CATEGORIA_ID'=>true));

					?>
					<input type='submit' name='accion' onclick="return valida_envia4()" value=<?php echo $strings['Modificar'] ?>>
				</form>
				<?php
				echo '<a class="form-link" href=\'CATEGORIA_Controller.php\'>' . $strings['Volver'] . " </a>";
				?>
			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
