<?php

class CLASE{

	private $CLASE_NOMBRE;
	private $CLASE_PROFESORES;
	private $CLASE_ALUMNOS;
	private $volver;


	function __construct($CLASE_NOMBRE,$CLASE_PROFESORES, $CLASE_ALUMNOS,$volver){
		$this->CLASE_NOMBRE=$CLASE_NOMBRE;
		$this->CLASE_PROFESORES=$CLASE_PROFESORES;
		$this->CLASE_ALUMNOS=$CLASE_ALUMNOS;
		$this->volver=$volver;
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
					<head>
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


							</div>
						</nav>
						<?php




						?>


						<?php // echo $strings['EMP_USER'] . ' : ' . $_SESSION['login']; ?>

						<div >
							<table  id="btable"  class="responstable" border = 1>
								<tr>
									<th><?php echo utf8_encode($this->CLASE_NOMBRE);?></th>

								</tr>
								<tr>
									<th><?php echo $strings['profesores'];?></th>

								</tr>
								<?php
								for($i=0;$i<count($this->CLASE_PROFESORES);$i++){
									?>
									<tr>
										<td><?php echo utf8_encode($this->CLASE_PROFESORES[$i]);?></td>
									</tr>
									<?php
								}
								?>



							</table>
							<h4 style="color:white"><?php echo $strings['alumnos'] ?></h4>
							<!--<form  style="color:white" action="ASISTENCIA_Controller.php" method="get">-->
							<form  style="color:white" action="../Views/DEFAULT_Vista.php" method="get">
								<?php
								for($i=0;$i<count($this->CLASE_ALUMNOS);$i++){
									?>
									<input type="checkbox" name="alumnos" value="Bike"><?php echo utf8_encode($this->CLASE_ALUMNOS[$i]);?><br>
								<?php } ?>
								<input type="submit" value="Submit">
							</form>

						</div>
					</div>
					<h3>
			<p>
				<?php
				echo '<a  class="form-link" href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>";
				?>
				</h3>
			</p>

		</div>

		<?php
	} //fin metodo render

}
?>
