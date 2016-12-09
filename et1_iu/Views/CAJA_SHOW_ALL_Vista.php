<?php

class Caja_default{
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
			<h1>
			<span class="form-title">
			<?php 
				include '../Locates/StringsCF_'.$_SESSION['IDIOMA'].'.php';
				echo	$stringsCF['Listar Cajas'] 
			?><br>
			</h1>
				<h2>
					
					<div>
						<?php

						$lista = array('CAJA_FECHA','CAJA_INGRESOS');


						?>
						<head>
							<link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
							<link rel="stylesheet" type="text/css" href="../Styles/print.css" media="print" />
						</head>
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



		<?php
	} //fin metodo render

}

