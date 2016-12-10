<?php

class CLIENTE_ShowConsulta{
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
		<meta charset="UTF-8">
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
				<a href='./CLIENTE_Controller.php?accion=<?php echo $strings['Consultar']?>'><?php echo $strings['Consultar']?></a>
				<a href='./CLIENTE_Controller.php?accion=<?php echo $strings['Insertar']?>'><?php echo $strings['Insertar']?></a>
				<a href='./CLIENTE_Controller.php?accion=<?php echo $strings['InsertarExterno']?>'><?php echo $strings['Insertar_Externo']?></a>


			</div>
		</nav><!-- end of top nav --><!-- div de muestra de datos.... titulos y datos -->
<?php

	$lista = array('CLIENTE_DNI','CLIENTE_NOMBRE', 'CLIENTE_APELLIDOS', 'CLIENTE_FECH_NAC',  'CLIENTE_TELEFONO1','CLIENTE_TELEFONO2','CLIENTE_TELEFONO3',  'CLIENTE_CORREO', 'CLIENTE_PROFESION',  'CLIENTE_DIRECCION', 'CLIENTE_COMENTARIOS','CLIENTE_ESTADO', 'CLIENTE_TIPO', 'CLIENTE_DOM','CLIENTE_LOPD');


?>

	<br><br>

	<table id="btable" class="responstable" border = 1>
	<tr>
<?php

	foreach($lista as $titulo){
		if($titulo==='CLIENTE_CORREO') {

			echo "<th  id='long' colspan='2'>";
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
		if($clave==='CLIENTE_CORREO') {

		?><td  id='long' colspan="2"><?php
			}
			else {
				echo "<td>";
			}
			if( ($clave==='CLIENTE_DOM' ||$clave==='CLIENTE_LOPD') ){
				if(is_file($valor)) {
					echo "<a target='_blank' href='" . $valor . "'>".$strings['Ver']."</a>";
				}
				else {
					echo '';
				}
			}
			else{
				if(($clave==='CLIENTE_TELEFONO1'||$clave==='CLIENTE_TELEFONO2'||$clave==='CLIENTE_TELEFONO3'||$clave==='CLIENTE_FECH_NAC') && ($valor==='0'||$valor==='0000-00-00')){
					echo '';
				}
				else {
					if($clave==='CLIENTE_TIPO'){
						if($valor==='1'){
							echo 'S';
						}
						else {
							echo 'E';
						}
					}
					else{
						echo utf8_encode($valor);
					}
				}

				echo "</td>";
			}
			}
			?>

			<?php
			}
			}
?>

		<td>
			<a href='CLIENTE_Controller.php?CLIENTE_DNI=<?php echo $this->datos[$j]['CLIENTE_DNI'] . '&accion='.$strings['Modificar']; ?>'><?php echo $strings['Modificar'] ?></a>
		</td>
		<td>


				<a href='CLIENTE_Controller.php?CLIENTE_DNI=<?php echo $this->datos[$j]['CLIENTE_DNI'] . '&accion='.$strings['Borrar']; ?>'><?php echo $strings['Borrar'] ?></a>

		</td>
		<td>


			<a href='CLIENTE_Controller.php?CLIENTE_DNI=<?php echo $this->datos[$j]['CLIENTE_DNI'] . '&accion='.$strings['Actividades']; ?>'><?php echo $strings['Actividades'] ?></a>

		</td>
		<td>


			<a href='CLIENTE_Controller.php?CLIENTE_DNI=<?php echo $this->datos[$j]['CLIENTE_DNI'] . '&accion='.$strings['Lesiones']; ?>'><?php echo $strings['Lesiones'] ?></a>

		</td>


		<tr>
			<?php


}
?>

	</table>
	<p style="font-size: 10px;color:white"><?php echo $strings['Nota']?></p>

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
