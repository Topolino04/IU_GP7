<?php
class Linea_Factura_Edit{
//VISTA PARA MODIFICAR LINEA DE FACTURA
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

				$lista = array('LINEA_FACTURA_ID','LINEA_FACTURA_CONCEPTO', 'LINEA_FACTURA_UNIDADES', 'LINEA_FACTURA_PRECIOUD');


				?>
			</h2>
			</p>
			<p>
			<h1>
				<span class="form-title">
				<?php echo $stringsCF['Modificar']?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='LINEA_FACTURA_Controller.php' method='post' >
					<ul class="form-style-1">
					 <?php echo $stringsCF['LINEA_FACTURA_ID'];?><br>
					 <?php echo '<input type = "number" name="LINEA_FACTURA_ID"  value="'.$this->valores['LINEA_FACTURA_ID'].'" min="1" max="9999999999" readonly required>';?><br>
					 <?php echo $stringsCF['LINEA_FACTURA_CONCEPTO'];?><br>
					 <?php echo '<input type = "text" name="LINEA_FACTURA_CONCEPTO" value='.$this->valores['LINEA_FACTURA_CONCEPTO'].' size="50" maxlength="100" required>'?><br>
					 <?php echo $stringsCF['LINEA_FACTURA_UNIDADES'];?><br>
					 <?php echo '<input type = "number" name="LINEA_FACTURA_UNIDADES" value='.$this->valores['LINEA_FACTURA_UNIDADES'].' min="1" max="9999999999" required>'?><br>
					 <?php echo $stringsCF['LINEA_FACTURA_PRECIOUD'];?><br>
					 <?php echo '<input type = "number" name="LINEA_FACTURA_PRECIOUD" value='.$this->valores['LINEA_FACTURA_PRECIOUD'].' min="0" max="9999999999.99" step="any" required>'?><br>
					 

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
