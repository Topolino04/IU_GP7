<?php

class BLOQUE_Borrar{
	//VISTA PARA BORRAR HORAS POSIBLES

	private $valores;

	function __construct($valores){
		$this->valores=$valores;
		$this->render();
	}

	function render(){
		?>

		<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
			<p>
			<h2>
				<?php
				include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
				include '../Functions/BLOQUEDELETEDefForm.php';


				$lista = array('BLOQUE_ID','BLOQUE_HORARIO','BLOQUE_FECHA','BLOQUE_HORAI','BLOQUE_HORAF');





				?>
			</h2>
			</p>
			<p>
			<h1><span class="form-title">
				<?php echo $strings['Borrar Bloque']?><br>
			</h1>
			<h3>

				<form action='BLOQUE_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php

					createForm($lista,$form2,$strings,$this->valores,false,true); ?></br>


					<input type='submit' name='accion' value=<?php echo $strings['Borrar'] ?>>
						</ul>
				</form>
				<?php
				echo '<a class="form-link" href=\'BLOQUE_Controller.php\'>' . $strings['Volver'] . " </a>";
				?>
			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
