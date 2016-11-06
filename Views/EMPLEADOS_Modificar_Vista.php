<?php

class EMPLEADOS_Modificar{

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
	//include '../Functions/LibraryFunctions.php';
	
	$lista = array('EMP_USER', 'EMP_PASSWORD',  'EMP_NOMBRE', 'EMP_APELLIDO', 'EMP_DNI','EMP_FECH_NAC', 'EMP_EMAIL', 'EMP_TELEFONO', 'EMP_CUENTA', 'EMP_DIRECCION', 'EMP_COMENTARIOS', 'EMP_TIPO', 'EMP_ESTADO','EMP_FOTO','EMP_NOMINA');

?>
<html>
	<head>
		<meta charset="UTF-8">
	</head> 
<body>
	<h1><?php echo $strings['Modificar Empleado']?></h1>
<div>
<p>
<h2>
<form action = 'EMPLEADOS_Controller.php' method = 'post' enctype="multipart/form-data"><br>
<?php
createForm($lista,$DefForm,$strings,$this->valores,array('EMP_COMENTARIOS'=>false,'EMP_FOTO'=>false,'EMP_NOMINA'=>false),array('EMP_USER'=>true,'EMP_DNI'=>true));
?>
<input type = 'submit' name = 'accion' value = 'Modificar' >
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
