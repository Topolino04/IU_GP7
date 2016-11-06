<?php

class Pagina_Menu{

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
<h1>
	Gestión de Páginas<br>
</h1>
<h2>
<?php

	include '../Locates/Strings_Español.php';

?>
	<div> <!-- Menú de muestra de opciones y datos de consulta --> 
<?php
	$lista = array('PAGINA_ID','PAGINA_LINK','PAGINA_NOM');

?>
	<--------->  	<a href='./PAGINA_Controller.php?accion=Consultar'>Consultar Página</a>
	<br>
	<--------->		<a href='./PAGINA_Controller.php?accion=Listar'>Listar Páginas</a>
	<br>
	<--------->		<a href='./PAGINA_Controller.php?accion=Insertar'>Insertar Página</a>
	<br>
	<--------->		<a href='./PAGINA_Controller.php?accion=Borrar'>Borrar Página</a>
	<br>
	<--------->		<a href='./PAGINA_Controller.php?accion=Modificar'>Modificar Página</a>
	<br><br>
	<table border = 1>
	<tr>
<?php
	foreach($lista as $titulo){
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
		for($i=0;$i<count($lista);$i++){
?>
		<td>
<?php
			echo $datos[$lista[$i]];
?>
		</td>
<?php
	}
?>

<?php
	}
?>
	</table>	
	
	

</div> <!-- Fin de menu -->
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
