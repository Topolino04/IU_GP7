<?php

class EMPLEADOS_Borrar{

private $valores;
private $volver;
//VISTA PARA EL BORRADO DE EMPLEADOS
function __construct($valores,$volver){
	$this->valores = $valores;
	$this->volver = $volver;
	$this->render();
}

function render(){

	include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
	include '../Functions/EMPLEADOShowAllDefForm.php';
	include '../Functions/EMPLEADODeleteDefForm.php';
	//include '../Functions/LibraryFunctions.php';

	$lista = array('EMP_USER', 'EMP_NOMBRE', 'EMP_APELLIDO', 'EMP_DNI','EMP_FECH_NAC', 'EMP_EMAIL','EMP_TELEFONO', 'EMP_CUENTA', 'EMP_DIRECCION', 'EMP_COMENTARIOS', 'EMP_TIPO');
	if ($this->valores['EMP_FOTO']!==''){
		array_push($lista,'EMP_FOTO');
	}
	if ($this->valores['EMP_NOMINA']!==''){
		array_push($lista,'EMP_NOMINA');
	}
?>
<html>
	<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
		<meta charset="UTF-8">
	</head> 

		<div>



			<form action = 'EMPLEADO_Controller.php' method = 'get'><br>
				<span class="form-title">
			<?php echo $strings['Borrar Empleado']?><br>
				<ul class="form-style-1">
				<?php

	createForm($lista,$DefForm3,$strings,$this->valores,true,true);
?>
				<input type = 'submit' name = 'accion' value =<?php echo $strings['Borrar'] ?> ></form> <a class="form-link" href='<?php echo $this->volver; ?> '><?php echo $strings['Volver']; ?> </a>
			</p>

		</div>

</html>
<?php
} // fin del metodo render
} // fin de la clase
?>
