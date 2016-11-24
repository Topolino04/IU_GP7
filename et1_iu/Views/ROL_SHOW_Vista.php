

<?php

class ROL_Consultar{

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
				$lista = array('ROL_NOM');

				?>
			<span class="form-title">
				<?php echo $strings['Consultar Rol']?><br>
			</h2>
			</p>
			<p>
			<h3>

				<form action='ROL_Controller.php' method='post'>
					<ul class="form-style-1">
					<?php

					include '../Functions/ROLDefForm.php';


					createForm($lista,$form,$strings,$values='',false,false);
					?>
					<input type='submit' name='accion' value=<?php echo $strings['Consultar'] ?>><br>

				</form>
				<?php
				echo '<a  class="form-link" href=\'ROL_Controller.php\'>' . $strings['Volver'] . '</a>';
				?>

			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
