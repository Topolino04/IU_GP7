<?php

class PAGO_Modificar{
    
//VISTA PARA MODIFICAR PAGOS
   
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
				include '../Functions/PAGOEditDefForm.php';
				//include '../Functions/LibraryFunctions.php';

				 $lista = array('PAGO_ID', 'PAGO_CONCEPTO', 'PAGO_IMPORTE', 'CLIENTE_DNI');





				?>
			</h2>
			</p>
			<p>
			<h1><span class="form-title">
				<?php echo $strings['Modificar Pago']?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='PAGO_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php

					//createForm2($lista,$DefForm,$strings,$this->valores,array('ROL_NOM'=>true),array('ROL_ID'=>true),$this->valores['ROL_ID']); //DefForm2
					createForm($lista,$form,$strings,$this->valores,array('PAGO_CONCEPTO'=>false, 'PAGO_IMPORTE'=>false, 'CLIENTE_DNI'=>false), array('PAGO_ID'=>true));
					?>
					<input type='submit' name='accion' onclick="return valida_envia_PAGO()" value=<?php echo $strings['Modificar'] ?>>
				</form>
				<?php
				echo '<a  class="form-link" href=\'PAGO_Controller.php\'>' . $strings['Volver'] . " </a>";
				?>
			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
