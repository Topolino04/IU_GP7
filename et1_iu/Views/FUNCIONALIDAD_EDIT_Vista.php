<?php

class FUNCIONALIDAD_Modificar{
//VISTA PARA MODIFICAR FUNCIONALIDADES
    private $valores;

	function __construct($valores){
	    $this->valores=$valores;
		$this->render();
	}

	function render(){
		?>
		<head>
			<link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
			<script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA']?>_validate.js"></script></head>
		<div>
			<p>
			<h2>
				<?php
				include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
				include '../Functions/FUNCIONShowDefForm.php';
				//include '../Functions/LibraryFunctions.php';

				$list = array('FUNCIONALIDAD_ID','FUNCIONALIDAD_NOM');
				$lista=AñadirPaginasTitulos($list);




				?>
			</h2>
			</p>
			<p>
			<h1><span class="form-title">
				<?php echo $strings['Modificar Funcionalidad']?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='FUNCIONALIDAD_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php

					createForm4($lista,$DefForm2,$strings,$this->valores,false,array('FUNCIONALIDAD_ID'=>true,'FUNCIONALIDAD_NOM'=>true));

					?>
					<input type='submit' name='accion' onclick="return valida_envia3()" value=<?php echo $strings['Modificar'] ?>>
				</form>
				<?php
				echo '<a class="form-link" href=\'FUNCIONALIDAD_Controller.php\'>' . $strings['Volver'] . " </a>";
				?>
			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
