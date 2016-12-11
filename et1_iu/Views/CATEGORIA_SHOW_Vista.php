<?php

class Categoria_Show{
//VISTA PARA MOSTRAR CONSULTA DE CATEGORIAS

function __construct(){	
	$this->render();
}

function render(){
?>

	<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
	<p>


<?php
	include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
	include '../Functions/CATEGORIADefForm.php';


	$lista = array('CATEGORIA_NOMBRE','CATEGORIA_ID');

?>
					<span class="form-title">
			<?php echo	$strings['Insertar Categoria'] ?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='CATEGORIA_Controller.php' method='post'>
					<ul class="form-style-1">
					<?php
					createForm($lista,$DefForm,$strings,'',true,false);
?>
				<input type='submit' name='accion' onclick="return valida_envia4()" value=<?php echo $strings['Insertar'] ?>>
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