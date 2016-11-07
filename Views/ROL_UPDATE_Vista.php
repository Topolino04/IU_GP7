<?php

class ROL_Update{

private $valores;
private $volver;

function __construct($valores,$volver){
	$this->valores = $valores;
	$this->volver = $volver;
	$this->render();
}

function render(){

include '../Locates/Strings_SPANISH.php';
//echo $this->volver;

?>
<html>
	<head>
		<meta charset="UTF-8">
	</head> 
<body>
<div>
<p>
<h2>
<form action = 'ROL_Controller.php' method = 'post'><br>
	<input type = 'hidden' name = 'rol_id' <?php echo 'value = \''.$this->valores['rol_id'].'\''; ?> ><br>
	<?php echo $strings['rol_id']; ?> : <?php echo $this->valores['rol_id']; ?> <br>
 	<?php echo $strings['rol_descripcion']; ?> : <input type = 'text' name = 'rol_descripcion'  <?php echo 'value = \''.$this->valores['rol_descripcion'].'\''; ?> ><br>
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
