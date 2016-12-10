<?php

class Factura_Delete{
	//VISTA PARA BORRAR FACTURAS

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
				include '../Locates/StringsCF_'.$_SESSION['IDIOMA'].'.php';
				include '../Functions/FACTURADefForm.php';


				$lista = array('FACTURA_ID','CLIENTE_ID','FACTURA_FECHA', 'CLIENTE_NIF', 'CLIENTE_NOMBRE', 'CLIENTE_APELLIDOS');





				?>
			</h2>
			</p>
			<p>
			<h1>
			<span class="form-title">
				<?php echo $strings['Eliminar Factura']?><br>
			</h1>
			<h3>

				<form action='FACTURA_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php

					createForm($lista,$DefForm,$stringsCF,$this->valores,false,true);

					?>
					<input type='submit' name='accion' value=<?php echo $stringsCF['Borrar'] ?>>
				</form>
				<?php
				echo '<a class="form-link" href=\'FACTURA_Controller.php\'>' . $stringsCF['Volver'] . " </a>";
				?>
			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
