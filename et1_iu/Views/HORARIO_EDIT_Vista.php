<?php

class HORARIO_Modificar{
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
				include '../Functions/HORARIODefForm.php';
				//include '../Functions/LibraryFunctions.php';

				$lista = array('HORARIO_ID','HORARIO_NOMBRE','HORARIO_FECHAI','HORARIO_FECHAF');






				?>
			</h2>
			</p>
			<p>
			<h1><span class="form-title">
				<?php echo $strings['Modificar Horario']?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='HORARIO_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php

					createForm($lista,$DefForm,$strings,$this->valores,true,array('HORARIO_ID'=>true));

					?>
					<input type='submit' name='accion' onclick="return valida_envia2()" value=<?php echo $strings['Modificar'] ?>>
				</form>
				<?php
				echo '<a  class="form-link" href=\'HORARIO_Controller.php\'>' . $strings['Volver'] . " </a>";
				?>
			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
