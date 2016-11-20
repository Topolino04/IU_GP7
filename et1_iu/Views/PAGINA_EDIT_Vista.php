<?php



class Pagina_Edit{
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
				include '../Functions/PAGINADefForm.php';
				//include '../Functions/LibraryFunctions.php';

				$lista = array('PAGINA_ID','PAGINA_LINK','PAGINA_NOM');





				?>
			</h2>
			</p>
			<p>
			<h1>
				<span class="form-title">
				<?php echo $strings['Modificar Pagina']?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='PAGINA_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php

					createForm($lista,$DefForm,$strings,$this->valores,array('PAGINA_NOM'=>true),array('PAGINA_ID'=>true,'PAGINA_LINK'=>true));

					?>
					<input type='submit' name='accion' onclick="return valida_envia4()" value=<?php echo $strings['Modificar'] ?>>
				</form>
				<?php
				echo '<a class="form-link" href=\'PAGINA_Controller.php\'>' . $strings['Volver'] . " </a>";
				?>
			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
