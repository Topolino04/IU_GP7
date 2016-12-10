<?php

class BLOQUE_Modificar{
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
				include '../Functions/BLOQUEDELETEDefForm.php';
				//include '../Functions/LibraryFunctions.php';

				$lista = array('BLOQUE_ID','BLOQUE_HORARIO','BLOQUE_FECHA', 'BLOQUE_HORAI', 'BLOQUE_HORAF');






				?>
			</h2>
			</p>
			<p>
			<h1><span class="form-title">
				<?php echo $strings['Modificar Bloque']?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='BLOQUE_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php

					createForm($lista,$form2,$strings,$this->valores,true,array('BLOQUE_ID'=>true,'BLOQUE_HORARIO'=>true,'BLOQUE_FECHA'=>true));?></br>



					<input type='submit' name='accion' onclick="return valida_envia_BLOQU()" value=<?php echo $strings['Modificar'] ?>>
				</ul>
				</form>
				<?php
				echo '<a  class="form-link" href=\'BLOQUE_Controller.php\'>' . $strings['Volver'] . " </a>";
				?>
			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
