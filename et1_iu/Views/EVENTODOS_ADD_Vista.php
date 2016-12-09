<?php

class Eventodos_Add
{
	//VISTA PARA INSERTAR EVENTOS

	function __construct($eventos,$clientes){	
		$this->eventos = $eventos;
		$this->clientes = $clientes;
		$this->render();
	}

function render(){
?>
	<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
		<script type="text/javascript" src="../js/<?php  echo $_SESSION['IDIOMA']?>_validate.js"></script></head>
	<div>
		<p>
			<h2>
<?php
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
				include '../Functions/EVENTODOSDefForm.php';

				
				$lista = array('PAGO_IMPORTE','PAGO_ESTADO');
				
?>				
				
			</h2>
		</p>
		<p>
			<h1>
			<span class="form-title">
			<center><?php echo	$strings['Insertar Persona a Evento'] ?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='EVENTO_Controllerdos.php' method='post'>
					<ul class="form-style-1">
				<?php echo"NOMBRE DEL EVENTO";?><br>
				<select name = "EVENTO_NOMBRE">/////////////////
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
					createForm($lista,$DefForm,$strings,'',true,false);
?>				
				
				<input type='submit' name='accion' onclick="return valida_envia4()" value=<?php echo $strings['Insertar'] ?>>
				</form>
				<br>
<?php
				echo '<a class="form-link" href=\'EVENTO_Controllerdos.php\'>' . $strings['Volver'] . " </a>";
?>
			</h3>
		</p>

	</div>

<?php
} //fin metodo render

}