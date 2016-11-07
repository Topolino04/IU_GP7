<?php

class ROL_Select{

private $datos; 
private $volver;

function __construct($array, $volver){
	$this->datos = $array;
	$this->volver = $volver;	
	$this->render();
}

function render(){
?>

<div>
<p>
<h2>
<?php
	include '../Locates/Strings_SPANISH.php';
	include '../Models/ROL_ARRAY.php';
	include '../Classes/ROL_gen_form_class.php';

?>
<div> <!-- div de muestra de datos.... titulos y datos --> 
<?php
	$gen_datos = new gen_form($arrayDefForm);
	$titulos = $gen_datos->get_Titulos();
?>
	<table border = 1>
	<tr>
<?php
	foreach($titulos as $titulo){
?>
		<th>
<?php
		echo $strings[$titulo];
?>
		</th>
<?php
	}
?>
	</tr>
<?php
	foreach($this->datos as $datos){
?>
	<tr>
<?php
		foreach($datos as $dato){
?>
		<td>
<?php
			echo $dato;
?>
		</td>
<?php
	}
?>
	<td><a href='ROL_Controller.php?rol_id=<?php echo $datos['rol_id'].'&accion=Update'; ?>'>Update</a></td>
	<td><a href='ROL_Controller.php?rol_id=<?php echo $datos['rol_id'].'&accion=Delete'; ?>'>Delete</a></td>
	<tr>
<?php
	}
?>
	</table>

</div> <!-- fin de div de muestra de datos -->
<h3>
<p>
<?php
	echo '<a href=\'' . $this->volver . "\'>" . $strings['Volver'] . " </a>";
?>
</h3>
</p>

</div>

<?php
} //fin metodo render

}
