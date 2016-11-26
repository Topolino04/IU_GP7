<?php

class ROL_Modificar{
//VISTA PARA MODIFICAR ROLES
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
				include '../Functions/RolShowDefForm.php';
				//include '../Functions/LibraryFunctions.php';

				$list = array('ROL_ID','ROL_NOM');

				$lista=AñadirFuncionesTitulos($list);




				?>
			</h2>
			</p>
			<p>
			<h1><span class="form-title">
				<?php echo $strings['Modificar Rol']?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='ROL_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php

					createForm2($lista,$DefForm2,$strings,$this->valores,array('ROL_NOM'=>true),array('ROL_ID'=>true),$this->valores['ROL_ID']);

					?>
					<input type='submit' name='accion' onclick="return valida_envia2()" value=<?php echo $strings['Modificar'] ?>>
				</form>
				<?php
				echo '<a  class="form-link" href=\'ROL_Controller.php\'>' . $strings['Volver'] . " </a>";
				?>
			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
