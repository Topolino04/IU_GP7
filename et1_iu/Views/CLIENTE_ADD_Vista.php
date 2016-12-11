<?php

class CLIENTE_Insertar{


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
			$lista = array('CLIENTE_DNI','CLIENTE_NOMBRE', 'CLIENTE_APELLIDOS', 'CLIENTE_FECH_NAC',  'CLIENTE_TELEFONO1','CLIENTE_TELEFONO2','CLIENTE_TELEFONO3',  'CLIENTE_CORREO', 'CLIENTE_PROFESION',  'CLIENTE_DIRECCION', 'CLIENTE_COMENTARIOS',  'CLIENTE_DOM','CLIENTE_LOPD');

			?>


			<form  id="form" name="form" action='CLIENTE_Controller.php' method='post'   enctype="multipart/form-data">
					<span class="form-title">
			<?php echo $strings['Insertar Cliente']?><br>
			</span>
				<ul class="form-style-1">
					<?php

					createForm($lista,$DefForm,$strings,'',array('CLIENTE_TELEFONO2'=>false,'CLIENTE_TELEFONO3'=>false,'CLIENTE_COMENTARIOS'=>false,'CLIENTE_DOM'=>false,'CLIENTE_LOPD'=>false),false);

					?>
					<input type='submit' onclick="return valida_envia_CLIENTE()" name='accion'  value=<?php echo $strings['Insertar'] ?>
					<ul>
			</form>
			<?php
			echo '<a class="form-link" href=\'CLIENTE_Controller.php\'>' . $strings['Volver'] . " </a>";
			?>


		</div>

		<?php
	} //fin metodo render

}

