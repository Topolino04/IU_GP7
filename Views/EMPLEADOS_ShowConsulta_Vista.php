<?php

class EMPLEADOS_ShowConsulta{

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

include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
	//include '../Models/USUARIOS_array.php';
	//include '../Classes/gen_form_class.php';

?>
	<div> <!-- div de muestra de datos.... titulos y datos --> 
<?php
	//$gen_datos = new gen_form($arrayDefForm);
	$lista = array('EMP_USER', 'EMP_NOMBRE', 'EMP_APELLIDO', 'EMP_DNI','EMP_FECH_NAC', 'EMP_EMAIL', 'EMP_TELEFONO', 'EMP_CUENTA', 'EMP_DIRECCION', 'EMP_COMENTARIOS', 'EMP_TIPO','EMP_FOTO','EMP_NOMINA','EMP_ESTADO');
//MIRAR QUE HABÍA EN LA LINEA 38, 39

?>
	<a href='./EMPLEADOS_Controller.php?accion=Consultar'>Consultar</a>
	<--------->
	<a href='./EMPLEADOS_Controller.php?accion=Insertar'>Insertar</a>
	<--------->
		<?php echo $strings['EMP_USER'] . ' : ' . $_SESSION['login']; ?>
		<--------->
		<a href='../Functions/Desconectar.php'><?php echo $strings['Cerrar Sesión']; ?></a>

	<br><br>
	<table border = 1>
	<tr>
<?php

	foreach($lista as $titulo){
		if($titulo==='EMP_DIRECCION') {

			echo "<th colspan='2'>";
		}
		else {
			echo "<th>";
		}
		?>
<?php
		echo $strings[$titulo];
?>
		</th>
<?php
	}
?>
	</tr>
<?php

for ($j=0;$j<count($this->datos);$j++){



echo "<tr>";
foreach ($this->datos [$j] as $clave => $valor) {
	for ($i = 0; $i < count($lista); $i++) {
		?>

		<?php

		if ($clave === $lista[$i]) {
			if($clave==='EMP_DIRECCION') {

				echo "<td colspan='2'>";
			}
			else {
				echo "<td>";
			}
			if( ($clave==='EMP_FOTO' ||$clave==='EMP_NOMINA') ){
				if(is_file($valor)) {
					echo "<a target='_blank' href='" . $valor . "'>Ver</a>";
				}
			}
			else{

				echo $valor;
			}
			echo "</td>";
		}
		?>

		<?php
	}
}

?>

		<td>
			<a href='EMPLEADOS_Controller.php?EMP_USER=<?php echo $this->datos[$j]['EMP_USER'] . '&accion=Modificar'; ?>'>Modificar</a>
		</td>
		<td><a href='EMPLEADOS_Controller.php?EMP_USER=<?php echo $this->datos[$j]['EMP_USER'] . '&accion=Borrar'; ?>'>Borrar</a>
		</td>
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
