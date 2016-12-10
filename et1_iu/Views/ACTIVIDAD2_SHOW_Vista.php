<?php

class ACTIVIDAD_Show{
//VISTA PARA MOSTRAR CONSULTA DE ACTIVIDADES

function __construct(){	
	$this->render();
}

function render(){
?>

	<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
	<p>


<?php
	include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
	include '../Functions/ACTIVIDAD2DefForm.php';


	$lista = array('ACTIVIDAD_NOMBRE');

?>
		<h1><span class="form-title">
			<?php echo $strings['Consultar actividad']; ?><br>
		</h1>
	</p>
	<p>
	<h3>

	<br><br>
	<form action='ACTIVIDAD2_Controller.php' method='post'>
		<ul class="form-style-1">
		<?php
		createForm($lista,$DefForm,$strings,$values='',false,false);
?>
	<input type='submit' name='accion' value='<?php echo $strings['Consultar']; ?>'><br>
	
	</form>
	<br>
<?php
        	echo '<a class="form-link" href=\'ACTIVIDAD2_Controller.php\'>' . $strings['Volver'] . '</a>';
?>

	</h3>
	</p>

	</div>

<?php
}

}