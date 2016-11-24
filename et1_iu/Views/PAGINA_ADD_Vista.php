<?php

class Pagina_Add
{
	//VISTA PARA INSERTAR PAGINAS

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
				include '../Functions/PAGINADefForm.php';

				$lista = array('PAGINA_NOM');

?>
			</h2>
		</p>
		<p>
			<h1>
			<span class="form-title">
			<?php echo	$strings['Insertar Página'] ?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='PAGINA_Controller.php' method='post'>
					<ul class="form-style-1">
					<?php
					createForm($lista,$DefForm,$strings,'',true,false);
?>
				<input type='submit' name='accion' onclick="return valida_envia4()" value=<?php echo $strings['Insertar'] ?>>
				</form>
				<br>
<?php
				echo '<a class="form-link" href=\'PAGINA_Controller.php\'>' . $strings['Volver'] . " </a>";
?>
			</h3>
		</p>

	</div>

<?php
} //fin metodo render

}