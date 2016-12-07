<?php

class CLIENTE_Insertar_Externo{


	function __construct(){
		$this->render();
	}

	function render(){

		?>
		<head>
			<link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
			<script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA']?>_validate.js"></script></head>
		<div>

			<?php //VISTA PARA LA INSERCIÓN DE EMPLEADOS
			include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
			include '../Functions/CLIENTEAddDefForm.php';
			$lista = array('CLIENTE_DNI','CLIENTE_NOMBRE', 'CLIENTE_APELLIDOS',  'CLIENTE_TELEFONO1',  'CLIENTE_CORREO',   'CLIENTE_DIRECCION');

			?>


			<form  id="form" name="form" action='CLIENTE_Controller.php' method='get'   enctype="multipart/form-data">
					<span class="form-title">
			<?php echo $strings['Insertar_Externo']?><br>
			</span>
				<ul class="form-style-1">
					<?php

					createForm($lista,$DefForm,$strings,'',array('CLIENTE_APELLIDOS'=>false,'CLIENTE_TELEFONO1'=>false,'CLIENTE_CORREO'=>false),false);

					?>
					<input type='submit' onclick="return valida_envia_CLIENTE()" name='accion'  value=<?php echo $strings['InsertarExterno'] ?>
					<ul>
			</form>
			<?php
			echo '<a class="form-link" href=\'CLIENTE_Controller.php\'>' . $strings['Volver'] . " </a>";
			?>


		</div>

		<?php
	} //fin metodo render

}

