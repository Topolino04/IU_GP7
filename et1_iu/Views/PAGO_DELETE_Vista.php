<?php

class PAGO_Borrar{
	
//VISTA PARA BORRAR PAGOS

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
				include '../Functions/PAGOShowDefForm.php';

               // $lista = array('CLIENTE_DNI', 'PAGO_CONCEPTO', 'PAGO_IMPORTE');
 $lista = array('PAGO_ID', 'PAGO_FECHA', 'PAGO_CONCEPTO', 'PAGO_IMPORTE', 'CLIENTE_ID');
				?>
			</h2>
			</p>
			<p>
			<h1><span class="form-title">
				<?php echo $strings['Borrar Pago']?><br>
			</h1>
			<h3>

				<form action='PAGO_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php
                                                                      
					createForm($lista,$form,$strings,$this->valores,false,true); //$form2
					?>
					<input type='submit' name='accion' value=<?php echo $strings['Borrar'] ?>>
				</form>
				<?php
				echo '<a class="form-link" href=\'PAGO_Controller.php\'>' . $strings['Volver'] . " </a>";
				?>
			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
