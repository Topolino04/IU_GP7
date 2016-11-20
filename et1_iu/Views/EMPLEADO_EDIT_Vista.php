<?php

class EMPLEADOS_Modificar{

private $valores;
private $volver;
//VISTA PARA LA MODIFICACIÓN DE EMPLEADOS
function __construct($valores,$volver){
	$this->valores = $valores;
	$this->volver = $volver;
	$this->render();
}

function render(){

	include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
	include '../Functions/EMPLEADOShowAllDefForm.php';
	//include '../Functions/LibraryFunctions.php';
	
	$lista = array('EMP_USER', 'EMP_PASSWORD',  'EMP_NOMBRE', 'EMP_APELLIDO', 'EMP_DNI','EMP_FECH_NAC', 'EMP_EMAIL', 'EMP_TELEFONO', 'EMP_CUENTA', 'EMP_DIRECCION', 'EMP_COMENTARIOS', 'EMP_ESTADO','EMP_FOTO','EMP_NOMINA');

?>
<html>
	<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
		<script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA']?>_validate.js"></script>
		<meta charset="UTF-8">
	</head> 
<body>
<span class="form-title">
	<?php echo $strings['Modificar Empleado']?>
<div>
<p>
<h2>
<form id="form" name="form"  action = 'EMPLEADO_Controller.php'  method = 'post' enctype="multipart/form-data"><br>
	<ul class="form-style-1">
	<?php

createForm($lista,$DefForm,$strings,$this->valores,array('EMP_COMENTARIOS'=>false,'EMP_FOTO'=>false,'EMP_NOMINA'=>false),array('EMP_USER'=>true,'EMP_DNI'=>true));
?>

<input type = 'submit' name = 'accion' value = '<?php echo $strings['Modificar'] ?>'  onclick="return valida_envia()" >
</form>


<a class="form-link" href='<?php echo $this->volver; ?> '><?php echo $strings['Volver']; ?> </a>
</p>

</div>
</body>
</html>
<?php
} // fin del metodo render
} // fin de la clase
?>
