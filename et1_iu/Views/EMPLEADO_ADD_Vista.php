<?php

class EMPLEADOS_Insertar{


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
				include '../Functions/EMPLEADOShowAllDefForm.php';
				$lista = array('EMP_USER','EMP_PASSWORD', 'EMP_NOMBRE', 'EMP_APELLIDO', 'EMP_DNI', 'EMP_FECH_NAC', 'EMP_EMAIL','EMP_TELEFONO', 'EMP_CUENTA', 'EMP_DIRECCION', 'EMP_COMENTARIOS', 'EMP_TIPO', 'EMP_FOTO','EMP_NOMINA');

?>
			

				<form  id="form" name="form" action='EMPLEADO_Controller.php' method='post'   enctype="multipart/form-data">
					<span class="form-title">
			<?php echo $strings['Insertar Empleado']?><br>
			</span>
					<ul class="form-style-1">
<?php
					
					createForm($lista,$DefForm,$strings,'',array('EMP_COMENTARIOS'=>false,'EMP_FOTO'=>false,'EMP_NOMINA'=>false),false);

?>
					<input type='submit' onclick="return valida_envia()" name='accion'  value=<?php echo $strings['Insertar'] ?>
					<ul>
				</form>
<?php
				echo '<a class="form-link" href=\'EMPLEADO_Controller.php\'>' . $strings['Volver'] . " </a>";
?>


	</div>

<?php
} //fin metodo render

}

