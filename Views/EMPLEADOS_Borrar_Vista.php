<?php

class EMPLEADOS_Borrar{

private $valores;
private $volver;

function __construct($valores,$volver){
	$this->valores = $valores;
	$this->volver = $volver;
	$this->render();
}

function render(){

	include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
	include '../Functions/EmpleadosDefForm.php';
	include '../Functions/EMPLEADOSBorrarDefForm.php';
	//include '../Functions/LibraryFunctions.php';

	$lista = array('EMP_USER', 'EMP_NOMBRE', 'EMP_APELLIDO', 'EMP_DNI','EMP_FECH_NAC', 'EMP_EMAIL','EMP_TELEFONO', 'EMP_CUENTA', 'EMP_DIRECCION', 'EMP_COMENTARIOS', 'EMP_TIPO', 'EMP_FOTO','EMP_NOMINA');

?>
<html>
	<head>
		<meta charset="UTF-8">
	</head> 
	<body>
		<div>
		<p>
		<h2>
			<form action = 'EMPLEADOS_Controller.php' method = 'get'><br>
<?php

	createForm($lista,$DefForm3,$strings,$this->valores,true,true);
?>
				<input type = 'submit' name = 'accion' value = 'Borrar' >
			</form>
		</h2>
		</p>
		<p>
		<h3>
			<a href='<?php echo $this->volver; ?> '><?php echo $strings['Volver']; ?> </a></h3>
		</p>

		</div>
	</body>
</html>
<?php
} // fin del metodo render
} // fin de la clase
?>
