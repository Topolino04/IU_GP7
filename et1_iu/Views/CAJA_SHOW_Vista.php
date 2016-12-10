<?php

class Caja_Show{
	//VISTA POR DEFECTO

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
			<p>
				<h2>
					<?php


					include '../Locates/StringsCF_'.$_SESSION['IDIOMA'].'.php';


					?>
					<div>
						<?php

						$lista = array('CAJA_FECHA','CAJA_INGRESOS');


						?>
						<head>
							<link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
							<link rel="stylesheet" type="text/css" href="../Styles/print.css" media="print" />
						</head>
						<div id="wrapper">

							<nav>

								<div class="menu">


									<ul>
										<li><a href="../Functions/Desconectar.php"><?php echo  $stringsCF['Cerrar Sesión']; ?></a></li>
										<li><?php echo $stringsCF['Usuario'].": ". $_SESSION['login']; ?></li>

									</ul>

									<?php echo '<a href=\'' . $this->volver . "'>" . $stringsCF['Volver'] . " </a>"; ?></li>
									<a href='./CAJA_Controller.php?accion=<?php echo $stringsCF['Insertar']?>'><?php echo $stringsCF['Añadir Ingresos Extra']?></a>
									<a href='./CAJA_Controller.php?accion=<?php echo $stringsCF['Listar Cajas']?>'><?php echo $stringsCF['Listar Cajas']?></a>


								</div>
							</nav>
						<table id="btable" border = 1>
							<tr>
								<?php

								foreach($lista as $titulo){

									echo "<th>";

									?>
									<?php
									echo $stringsCF[$titulo];
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
										if ($clave === $lista[$i]) {
											?>

											<?php

											echo "<td>";


											echo $valor;

											echo "</td>";
										}
									}
								}
								?>

								<?php


								?>

								


								<?php

								echo "<tr>";

							}
							?>

						</table>

					</div>
					<h3>
			<p>
				<?php
				echo '<a class="form-link" href=\'' . $this->volver . "'>" . $stringsCF['Volver'] . " </a>";
				?>
				
				
				</h3>
			</p>
			<p style="align:center; margin:0px 250px;">
			<i style="font-size:14px; color:white;">
					<br>
					<br>
					<br>
					<?php echo $stringsCF['Aviso']; ?>
				</i>
			</p>
		</div>
				</div>
	
			<p><i><? echo $stringsCF['Aviso'];?></i></p>
		

		<?php
	} //fin metodo render

}

