<?php

class ROL_Borrar{
	//VISTA PARA BORRAR ROLES

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
				include '../Functions/RolShowDefForm.php';


				$list = array('ROL_ID','ROL_NOM');
				$lista=AñadirFuncionesTitulos($list);




				?>
			</h2>
			</p>
			<p>
			<h1><span class="form-title">
				<?php echo $strings['Borrar Rol']?><br>
			</h1>
			<h3>

				<form action='ROL_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php

					createForm($lista,$form2,$strings,$this->valores,false,true);

					?>
					<input type='submit' name='accion' value=<?php echo $strings['Borrar'] ?>>
				</form>
				<?php
				echo '<a class="form-link" href=\'ROL_Controller.php\'>' . $strings['Volver'] . " </a>";
				?>
			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
