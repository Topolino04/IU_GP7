

<?php

class HORARIO_Consultar{

//VISTA PARA CONSULTAR ROLES
	function __construct(){
		$this->render();
	}

	function render(){
		?>

		<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
			<p>
			<h2>
				<?php

				include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
				$lista = array('HORARIO_NOMBRE');

				?>
			<span class="form-title">
				<?php echo $strings['Consultar Horario']?><br>
			</h2>
			</p>
			<p>
			<h3>

				<form action='HORARIO_Controller.php' method='post'>
					<ul class="form-style-1">
					<?php

					include '../Functions/HORARIODefForm.php';


					createForm($lista,$DefForm,$strings,$values='',false,false);
					?>
					<input type='submit' name='accion' value=<?php echo $strings['Consultar'] ?>><br>

				</form>
				<?php
				echo '<a  class="form-link" href=\'HORARIO_Controller.php\'>' . $strings['Volver'] . '</a>';
				?>

			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
