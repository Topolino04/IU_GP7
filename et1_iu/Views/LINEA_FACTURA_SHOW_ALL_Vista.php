<?php

class Linea_Factura_Default{
	//VISTA PARA LISTAR LINEAS FACTURA

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

						$lista = array('LINEA_FACTURA_CONCEPTO', 'LINEA_FACTURA_UNIDADES','LINEA_FACTURA_PRECIOUD');


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

								<td>
									<a href='LINEA_FACTURA_Controller.php?LINEA_FACTURA_ID=<?php echo $this->datos[$j]['LINEA_FACTURA_ID'] . '&accion='.$stringsCF['Modificar']; ?>'><?php echo $stringsCF['Modificar'] ?></a>
								</td>
								<td>
									<a href='LINEA_FACTURA_Controller.php?LINEA_FACTURA_ID=<?php echo $this->datos[$j]['LINEA_FACTURA_ID'] . '&accion='.$stringsCF['Borrar']; ?>'><?php echo $stringsCF['Borrar'] ?></a>
								</td>
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

		</div>

		<?php
	} //fin metodo render

}

