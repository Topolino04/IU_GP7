<?php

class EMPLEADOS_Show{
//VISTA PARA LISTAR TODOS LOS EMPLEADOS
private $datos; 
private $volver;

function __construct($array, $volver){
	$this->datos = $array;
	$this->volver = $volver;	
	$this->render();
}

function render(){

?>



<?php


include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';

	//include '../Models/USUARIOS_array.php';
	//include '../Classes/gen_form_class.php';

?> <head>
	<link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../Styles/print.css" media="print" />
	</head>
	<div id="wrapper">

		<nav>

			<div class="menu">


				<ul>
					<li><a href="../Functions/Desconectar.php"><?php echo  $strings['Cerrar Sesión']; ?></a></li>
					<li><?php echo $strings['Usuario'].": ". $_SESSION['login']; ?></li>

				</ul>

				<?php echo '<a href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>"; ?></li>
				<a href='./EMPLEADO_Controller.php?accion=<?php echo $strings['Consultar']?>'><?php echo $strings['Consultar']?></a>
				<a href='./EMPLEADO_Controller.php?accion=<?php echo $strings['Insertar']?>'><?php echo $strings['Insertar']?></a>


			</div>
		</nav>
<?php
	//$gen_datos = new gen_form($arrayDefForm);
	$lista = array('EMP_USER','EMP_NOMBRE', 'EMP_APELLIDO', 'EMP_DNI','EMP_FECH_NAC', 'EMP_EMAIL',  'EMP_TELEFONO', 'EMP_CUENTA', 'EMP_DIRECCION', 'EMP_COMENTARIOS', 'EMP_TIPO','EMP_FOTO','EMP_NOMINA');


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


if ($this->datos[$j]['EMP_ESTADO']!=='Inactivo'){
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
if(isset($strings[ConsultarNOMRol($valor)])){
					echo $strings[ConsultarNOMRol($valor)];}
					else{
						echo ConsultarNOMRol($valor);
					}
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

		</tr>
			<?php
			}

}
?>

	</table>
	
	

</div> <!-- fin de div de muestra de datos -->
<h3>
<p>
<?php

?>
</h3>
</p>

</div>

<?php
} //fin metodo render

}
