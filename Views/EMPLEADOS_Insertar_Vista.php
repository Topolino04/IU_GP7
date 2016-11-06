<?php

class EMPLEADOS_Insertar{


function __construct(){	
	$this->render();
}

function render(){
?>

	<div>
		<p>
			<h2>
<?php
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
				include '../Functions/EmpleadosDefForm.php';
				$lista = array('EMP_USER','EMP_PASSWORD', 'EMP_NOMBRE', 'EMP_APELLIDO', 'EMP_DNI', 'EMP_FECH_NAC', 'EMP_EMAIL','EMP_TELEFONO', 'EMP_CUENTA', 'EMP_DIRECCION', 'EMP_COMENTARIOS', 'EMP_TIPO', 'EMP_ESTADO','EMP_FOTO','EMP_NOMINA');

?>
			</h2>
		</p>
		<p>
			<h1>
			<?php echo $strings['Insertar Empleado']?><br>
			</h1>
			<h3>

				<form action='EMPLEADOS_Controller.php' method='post' enctype="multipart/form-data">
<?php
					createForm($lista,$DefForm,$strings,'',array('EMP_COMENTARIOS'=>false,'EMP_FOTO'=>false,'EMP_NOMINA'=>false),false);

?>
					<input type='submit' name='accion' value='Insertar'>
				</form>
<?php
				echo '<a href=\'EMPLEADOS_Controller.php\'>' . $strings['Volver'] . " </a>";
?>
			</h3>
		</p>

	</div>

<?php
} //fin metodo render

}
