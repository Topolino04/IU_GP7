<?php

class EMPLEADOS_ShowConsulta{
	//VISTA QUE MUESTRA A LOS EMPLEADOS TRAS UNA CONSULTA INCLUYENDO A LOS INACTIVOS

private $datos; 
private $volver;

function __construct($array, $volver){
	$this->datos = $array;
	$this->volver = $volver;	
	$this->render();
}

function render(){
?>
<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
<div>
<p>
<h2>
<?php

include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
	//include '../Models/USUARIOS_array.php';
	//include '../Classes/gen_form_class.php';

?>
	<head>
		<link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
		<link rel="stylesheet" type="text/css" href="../Styles/print.css" media="print" />
	</head>
	<div id="wrapper">

		<nav><!-- #Aqui la barra para cerrar sesión y más cosas si se quieren -->

			<div class="menu">


				<ul>
					<li><a href="../Functions/Desconectar.php"><?php echo  $strings['Cerrar Sesión']; ?></a></li>
					<li><?php echo $strings['Usuario'].": ". $_SESSION['login']; ?></li>

				</ul>

				<?php echo '<a href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>"; ?></li>
				<a href='./EMPLEADO_Controller.php?accion=<?php echo $strings['Consultar']?>'><?php echo $strings['Consultar']?></a>
				<a href='./EMPLEADO_Controller.php?accion=<?php echo $strings['Insertar']?>'><?php echo $strings['Insertar']?></a>


			</div>
		</nav><!-- end of top nav --><!-- div de muestra de datos.... titulos y datos -->
<?php

	$lista = array('EMP_USER', 'EMP_NOMBRE', 'EMP_APELLIDO', 'EMP_DNI','EMP_FECH_NAC', 'EMP_EMAIL', 'EMP_TELEFONO', 'EMP_CUENTA', 'EMP_DIRECCION', 'EMP_COMENTARIOS', 'EMP_TIPO','EMP_FOTO','EMP_NOMINA','EMP_ESTADO');


?>

	<br><br>

	<table id="btable" class="responstable" border = 1>
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
					echo "<a target='_blank' href='" . $valor . "'>".$strings['Ver']."</a>";
				}
			}
			else
				if($clave==='EMP_TIPO') {

					echo $strings[ConsultarNOMRol($valor)];
				}
				else {
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
			<a href='EMPLEADO_Controller.php?EMP_USER=<?php echo $this->datos[$j]['EMP_USER'] . '&accion='.$strings['Modificar']; ?>'><?php echo $strings['Modificar'] ?></a>
		</td>
		<td>
			<?php if ($this->datos[$j]['EMP_USER']!=='ADMIN'){?>

				<a href='EMPLEADO_Controller.php?EMP_USER=<?php echo $this->datos[$j]['EMP_USER'] . '&accion='.$strings['Borrar']; ?>'><?php echo $strings['Borrar'] ?></a>
			<?php } ?>
		</td>
		<td>
			<a href='EMPLEADO_Controller.php?EMP_USER=<?php echo $this->datos[$j]['EMP_USER'] . '&accion='.$strings['Modificar acciones']; ?>'><?php echo $strings['Modificar acciones']?></a>
		</td>
		<tr>
			<?php


}
?>

	</table>

</div>
<h3>
<p>
<?php
	echo '<a class="form-link" href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>";
?>
</h3>
</p>

</div>

<?php
} //fin metodo render

}
