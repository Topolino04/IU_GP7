<?php

class DESCUENTO_Show_Por_Cliente{
	//VISTA PARA LISTAR DESCUENTOS

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

								<a href='./DESCUENTOS_Controller.php?accion=<?php echo $strings['Insertar']?>'><?php echo $strings['Insertar']?></a>
							</div>
						</nav>
						<?php
						$lista = array('DESCUENTO_ID','DESCUENTO_VALOR','DESCUENTO_DESCRIPCION');
						?>
						<form action="DESCUENTOS_Controller.php?CLIENTE_ID=<?= $_GET['CLIENTE_ID']?>&amp;accion=Descuentos" method="post">
						<table  id="btable"  class="responstable" border = 1>
							<tr>
								<?php
								foreach($lista as $titulo){
									echo "<th>{$strings[$titulo]}</th>";
								}
								echo "<th> {$strings['Aplicado']} </th>"
								?>
							</tr>
							<?php
							for ($j=0;$j<count($this->datos);$j++){
								echo "<tr>";
								foreach ($this->datos [$j] as $clave => $valor) {
                                	for ($i = 0; $i < count($lista); $i++) {
                                    	if ($clave === $lista[$i]) {
                                    		echo "<td>{$valor}</td>";
                                    	}
                                	}
                            	}
								?> <td> <input name= 'descuentos[]'  type='checkbox' value = '<?=$this->datos[$j]["DESCUENTO_ID"]?>'<?php
								if($valor) echo "checked";
								?> ></td> <?php
								?> </tr> <?php
							}?>
						</table>
						<input type='submit' onclick="" name='accion'  value= <?= $strings['Guardar']?>>
						<a class="form-link" href=<?=$this->volver  ?>> <?=$strings['Volver']?></a>
					</form>
					</div>
			</p>
		</div>
		<?php
	} //fin metodo render
}
