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
				include '../Functions/BLOQUEDefForm.php';
				//include '../Functions/LibraryFunctions.php';

				$lista = array('BLOQUE_ID','BLOQUE_FECHA', 'BLOQUE_HORAI', 'BLOQUE_HORAF',  'BLOQUE_LUGAR','BLOQUE_ACT1','BLOQUE_ACT2','BLOQUE_ACT3','BLOQUE_EV1','BLOQUE_EV2','BLOQUE_EV3');






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

					createForm($lista,$DefForm,$strings,$this->valores,true,array('BLOQUE_ID'=>true));?></br>
					<a target="_blank" href='BLOQUE_Controller.php?BLOQUE_ID=<?php echo $_REQUEST['BLOQUE_ID'] . '&accion='.$strings['ActEv']; ?>'><?php echo $strings['ActEv'] ?></a></br>


					<input type='submit' name='accion' onclick="return valida_envia_BLOQUE()" value=<?php echo $strings['Modificar'] ?>>
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
