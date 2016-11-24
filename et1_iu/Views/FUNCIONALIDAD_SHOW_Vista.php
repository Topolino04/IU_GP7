

<?php

class FUNCIONALIDAD_Consultar{
//VISTA PARA CONSULTAR FUNCIONALIDADES

	function __construct(){
		$this->render();
	}

	function render(){
		?>

		<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
			<p>

				<?php
				include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';;

				$lista = array('FUNCIONALIDAD_NOM');

				?>
				<h1><span class="form-title">
					<?php echo $strings['Consultar Funcionalidad']; ?><br>
				</h1>


			</p>
			<p>
			<h3>

				<form action='FUNCIONALIDAD_Controller.php' method='post'>
					<ul class="form-style-1">
					<?php

					include '../Functions/FUNCIONAddDefForm.php';



					createForm($lista,$form,$strings,$values='',false,false);
					?>

					<input type='submit' name='accion' value=<?php echo $strings['Consultar']; ?>><br>

				</form>
				<?php
				echo '<a class="form-link" href=\'FUNCIONALIDAD_Controller.php\'>' . $strings['Volver'] . '</a>';
				?>

			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
