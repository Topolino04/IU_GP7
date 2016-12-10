<?php



class Factura_Edit{
//VISTA PARA MODIFICAR FACTURAS
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
				include '../Locates/StringsCF_'.$_SESSION['IDIOMA'].'.php';
				include '../Functions/FACTURADefForm.php';

				$lista = array('FACTURA_ID','CLIENTE_NIF', 'CLIENTE_NOMBRE', 'CLIENTE_APELLIDOS','FACTURA_ESTADO');





				?>
			</h2>
			</p>
			<p>
			<h1>
				<span class="form-title">
				<?php echo $stringsCF['Modificar Factura']?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='FACTURA_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php

					
					createForm($lista,$DefForm,$stringsCF,$this->valores,array('CLIENTE_NIF'=>true, 'CLIENTE_NOMBRE'=>true,'CLIENTE_APELLIDOS'=>true),array('FACTURA_ID'=>true));
					
					?>
					<br><b>Estado </b><br>
                        <select name="FACTURA_ESTADO" size="1" required="required">
                            <option value="PENDIENTE">PENDIENTE</option>
                            <option value="COBRADA">COBRADA</option>
                        </select><br>
					<input type='submit' name='accion' value=<?php echo $stringsCF['Modificar'] ?>>
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
