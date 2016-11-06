<?php

class Pagina_Show{


function __construct(){	
	$this->render();
}

function render(){
?>

	<div>
	<p>
	<h1>
		Consultar Páginas<br>
	</h1>
	<h2>
<?php
	include '../Locates/Strings_SPANISH.php';
	include '../Functions/PAGINADefForm.php';
	include '../Functions/LibraryFunctions.php';

	$lista = array('PAGINA_ID','PAGINA_LINK','PAGINA_NOM');

?>
	</h2>
	</p>
	<p>
	<h3>
	(Los campos "Link de la página" y "Nombre de la página" NO son necesarios) 
	<br><br>
	<form action='PAGINA_Controller.php' method='post'>
<?php
		createForm($lista,$DefForm,$strings,$values='',false,false);
?>
	<input type='submit' name='accion' value=' <?php echo $strings['Consultar']; ?> '><br>
	
	</form>
	<br>
<?php
        	echo '<a href=\'PAGINA_Controller.php\'>' . $strings['Volver'] . '</a>';
?>

	</h3>
	</p>

	</div>

<?php
} //fin metodo render

}