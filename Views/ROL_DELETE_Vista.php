<?php

class ROL_Delete{

private $valores;
private $volver;

function __construct($valores, $volver){
	$this->valores = $valores;
	$this->volver = $volver;
	$this->render();
}

function render(){

include '../Locates/Strings_SPANISH.php';
?>
<div>
<p>
<h2>
<form action = 'ROL_Controller.php' method = 'post'><br>
	<input type='hidden' name = 'rol_id' value = '<?php echo $this->valores['rol_id']; ?> '>
	<?php echo $strings['rol_id']; ?> : <?php echo $this->valores['rol_id']; ?> <br>
	<?php echo $strings['rol_descripcion']; ?> :  <?php echo $this->valores['rol_descripcion']; ?> <br>>
	<input type = 'submit' name = 'accion' value = 'Borrar' >
</form>
</h2>
</p>
<p>
<h3>
<a href='<?php echo $this->volver; ?>'><?php echo $strings['Volver']; ?> </a></h3>
</p>

</div>

<?php
} // fin del metodo render
} // fin de la clase
?>
