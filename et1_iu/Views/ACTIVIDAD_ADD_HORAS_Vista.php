<?php

class Actividad_Add_Horas
{
		var $actividad;
	function __construct($actividad){
$this->actividad=$actividad;
		$this->render();
	}


function render(){

?>
	<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
		<script type="text/javascript" src="../js/<?php  echo $_SESSION['IDIOMA']?>_validate.js"></script></head>
	<div>
		<p>
			<h2>
<?php
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';


				include '../Functions/ACTIVIDADDefForm.php';

	$semana=array($strings['Domingo'],$strings['Lunes'],$strings['Martes'],$strings['Miercoles'],$strings['Jueves'],$strings['Viernes'], $strings['Sabado']);
;
	$mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


if ($mysqli->connect_errno) {
	echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$sql = "SELECT DISTINCT BLOQUE_HORAI, BLOQUE_HORAF from HORAS_POSIBLES WHERE BLOQUE_DIA='".array_search($this->actividad->ACTIVIDAD_DIA,$semana)."' AND BLOQUE_HORARIO='".ConsultarIDHorario($this->actividad->ACTIVIDAD_HORARIO)."'";

$result = $mysqli->query($sql);
if($result->num_rows===0){
	new Mensaje('No hay bloques definidos para ese día en ese horario','../Controllers/ACTIVIDAD_Controller.php');
}
else {

	$str = array();
	while ($tipo = $result->fetch_array()) {
		array_push($str, $tipo['BLOQUE_HORAI'] . "-" . $tipo['BLOQUE_HORAF']);
	}


	?>
	</h2>
	</p>
	<p>
	<h1>
			<span class="form-title">
			<?php echo $strings['Insertar Actividad'] ?><br>
	</h1>
	<h3>

		<form id="form" name="form" action='ACTIVIDAD_Controller.php?' method='post'>
			<ul class="form-style-1">

				<?php echo $strings['ACTIVIDAD_NOMBRE'] ?><br> <input type="text" name="ACTIVIDAD_NOMBRE"  value=<?php echo $this->actividad->ACTIVIDAD_NOMBRE ?> readonly><br>
                <li> Nombre Categoria </li>
				<select readonly name = "CATEGORIA_ID">
					<?php
					listarCategorias();
					?> 
					</select> <br>
 
               
                <li> Lugar </li>
				<select name = "LUGAR_ID">
					<?php
					listarLugares();
					?> 
					</select> <br>


                <?php echo $strings['ACTIVIDAD_HORARIO'] ?> <br><input type="text" name="ACTIVIDAD_HORARIO"
                                                                   value=<?php echo $this->actividad->ACTIVIDAD_HORARIO ?> readonly><br>
                <?php echo $strings['ACTIVIDAD_DIA'] ?><br> <input type="text" name="ACTIVIDAD_DIA"
                                                               value=<?php echo $this->actividad->ACTIVIDAD_DIA ?> readonly><br>
				<?php echo $strings['ACTIVIDAD_LUGAR'] ?> <br><input type="text" name="ACTIVIDAD_LUGAR"
															   value=<?php echo $this->actividad->ACTIVIDAD_LUGAR ?> readonly><br>
                    <u><h2 style="color:white;"><?php echo $strings['ACTIVIDAD_BLOQUE'] ?></h2></u>
                        <?php for ($i = 0; $i < count($str); $i++) {
                            echo $str[$i]."<input type='checkbox' name='ACTIVIDAD_BLOQUE[]' value='" . $str[$i] . "'><br>";
                        } ?><br>
				<?php echo $strings['ACTIVIDAD_PRECIO'] ?> <br><input type="text" name="ACTIVIDAD_PRECIO"
																  ><br>
				<?php echo $strings['ACTIVIDAD_DESCRIPCION'] ?> <br><input type="text" name="ACTIVIDAD_DESCRIPCION"
																	   ><br>

				<p style="color:white;"><?php echo $strings['PROFESORES'] ?></p>
				<?php $monitores=getMonitores2();
                for ($i = 0; $i < count($monitores); $i++) {
					echo $monitores[$i] ?><input type="checkbox"
																			 name="ACTIVIDAD_PROFESORES[]"
																			 value='<?php echo $monitores[$i] ?>'

																			   >
				<?php }
				?>


				<?php }
				?>

				<br>
				<input type='submit' name='accion' onclick="return valida_envia4()" value=<?php echo $strings['Continuar'] ?>>
				</form>
				<?php
				echo '<a class="form-link" href=\'ACTIVIDAD_Controller.php\'>' . $strings['Volver'] . " </a>";
				?>
				<br>

			</h3>
		</p>

	</div>

	<?php
}
} //fin metodo render

