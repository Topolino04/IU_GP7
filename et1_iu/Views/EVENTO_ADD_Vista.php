<?php

class Evento_Add
{
	//VISTA PARA INSERTAR EVENTOS

	function __construct($lugares){	
		$this->lugares = $lugares;
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
				include '../Functions/EVENTODefForm.php';
				//include '../Models/LUGAR_Model.php';

				$lista = array('EVENTO_NOMBRE','EVENTO_ORGANIZADOR','EVENTO_DESCRIPCION');

?>
			</h2>
		</p>
		<p>
			<h1>
			<span class="form-title">
			<center><?php echo	$strings['Insertar Evento'] ?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='EVENTO_Controller.php' method='post'>
					<ul class="form-style-1">
					<?php
					createForm($lista,$DefForm,$strings,'',true,false);
?>			<?php echo "nombre lugar";?>
				<select name = "LUGAR_ID">
				<?php 
					foreach($this->lugares as $lugar){
						echo "<option value = '".$lugar['LUGAR_NOMBRE']."'> ".$lugar['LUGAR_NOMBRE']."</option>";
					}
				?>
				</select>
				<input type='submit' name='accion' onclick="return valida_envia4()" value=<?php echo $strings['Insertar'] ?>>
				</form>
				<br>
<?php
				echo '<a class="form-link" href=\'EVENTO_Controller.php\'>' . $strings['Volver'] . " </a>";
?>
			</h3>
		</p>

	</div>

<?php
} //fin metodo render

}