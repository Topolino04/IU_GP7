<?php

class Eventodos_delete{
	//VISTA PARA BORRAR EVENTOS

	private $valores;

	function __construct($eventos,$clientes,$valores){
		$this->eventos=$eventos;
		$this->clientes=$clientes;
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
				include '../Functions/EVENTODOSDefForm.php';

				//$list = array('IDENTIFICADOR');
				$lista = array('IDENTIFICADOR'/*,'PAGO_IMPORTE','PAGO_ESTADO'*/);

				?>
			</h2>
			</p>
			<p>
			<h1>
			<span class="form-title">
				<center><?php echo $strings['Borrar Persona de Evento']?><br>
			</h1>
			<h3>

				<form action='EVENTO_Controllerdos.php' method='post' >
					<ul class="form-style-1">
					
					<?php

					//createForm($list,$DefForm,$strings,$this->valores,false,true);

					?>
					
					<?php echo"NOMBRE DEL EVENTO";?><br>
				<select name = "EVENTO_NOMBRE">
				<?php 
					foreach($this->eventos as $evento){
						echo "<option value = '".$evento['EVENTO_NOMBRE']."'> ".$evento['EVENTO_NOMBRE']."</option>";
					}
				?>
				</select>
				<br>
				<?php echo"DNI DEL CLIENTE";?><br>
				<select name = "CLIENTE_DNI">
				<?php 
					foreach($this->clientes as $cliente){
						echo "<option value = '".$cliente['CLIENTE_DNI']."'> ".$cliente['CLIENTE_DNI']."</option>";
					}
				?>
				</select>
				
					<?php

					createForm($lista,$DefForm,$strings,$this->valores,false,true);

					?>
					<input type='submit' name='accion' value=<?php echo $strings['Borrar'] ?>>
				</form>
				<?php
				echo '<a class="form-link" href=\'EVENTO_Controllerdos.php\'>' . $strings['Volver'] . " </a>";
				?>
			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
