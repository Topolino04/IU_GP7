<?php

class DESCUENTO_Modificar{
//VISTA PARA MODIFICAR DESCUENTOS
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
				include '../Functions/DESCUENTODefForm.php';
				//include '../Functions/LibraryFunctions.php';

				$lista = array('DESCUENTO_VALOR','DESCUENTO_DESCRIPCION');
				?>
			</h2>
			</p>
			<p>
			<h1><span class="form-title">
				<?php echo $strings['Modificar Descuento']?><br>
			</h1>
			<h3>

				<form  id="form" name="form" action='Gestion_de_Descuentos_Controller.php' method='post' >
					<ul class="form-style-1">
					<?php
                        createForm($lista,$DefForm,$strings,$this->valores,true,false);
					?>
                    <input type ="hidden" name = "DESCUENTO_ID" value="<?php echo $this->valores['DESCUENTO_ID']?>">
					<input type='submit' name='accion' onclick="return valida_envia2()" value=<?php echo $strings['Modificar'] ?>>
				</form>
				<?php
				echo '<a  class="form-link" href=\'Gestion_de_Descuentos_Controller.php\'>' . $strings['Volver'] . " </a>";
				?>
			</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
