<?php

class Factura_Show_Linea_Factura{
	//VISTA PARA LISTAR FACTURAS

	private $factura;
	private $lineas;

	function __construct($factura, $lineas){
		$this->factura = $factura;
		$this->lineas = $lineas;
		$this->render();
	}

	function render(){
		?>
	<html>
						<?php
						include '../Locates/StringsCF_'.$_SESSION['IDIOMA'].'.php';
						$lista = array('FACTURA_ID','FACTURA_FECHA','CLIENTE_NOMBRE','CLIENTE_APELLIDOS', 'CLIENTE_NIF');
						$lista1 = array('LINEA_FACTURA_CONCEPTO','LINEA_FACTURA_UNIDADES', 'LINEA_FACTURA_PRECIOUD');


						?>
						<head>
							<title> &nbsp </title>
							<link rel="stylesheet" href="../Styles/factura.css" type="text/css" media="screen" />
							<link rel="stylesheet" type="text/css" href="../Styles/factura.css" media="print" />
						</head>
						<body>
						<fieldset style="width:700px; height:100%;">
						
							<div id="header">
								<div id="foto">
									<img src="../images/logo_moovett1.png">
								</div>
								
								<div id="direccion">
										Moovett<br>
										CIF:<br>
										<?php echo $stringsCF['Calle'];?> Avilés de Taramancos, 2, 32003 <br>
										Ourense <br>
										España <br>
								</div>
								
								<div id = "tipofactura">
									<h3><?php echo $stringsCF['Factura'];?>
										<table border="0">
											<tr>
												<td><?php echo $stringsCF['FACTURA_ID'];?></td> <td colspan"2" border="1"> <?php echo $this->factura[0]['FACTURA_ID'];?></td> <td></td>
											</tr>
											<tr>
												<td><?php echo $stringsCF['FACTURA_FECHA'];?><td colspan"2" border="1"><?php echo $this->factura[0]['FACTURA_FECHA'];?></td> <td></td>
											</tr>
										</table>
								</div>
							</div>
							<div id="container">
								<fieldset style="width:660px; border-radius:4%;">
									<div id="datoscliente">
										<table style="min-width:660px; border:0px; paddng:1px; margin:3px">
											<tr>
												<td colspan="4"> <h3 align="center"> <?php echo $stringsCF['Datos Cliente'];?> </h3></td>
											</tr> 
											<tr>
												<td> <?php echo $stringsCF['Cliente'];?>:</td> <td class="recuadro"><?php echo $this->factura[0]['CLIENTE_NOMBRE']." ".$this->factura[0]['CLIENTE_APELLIDOS'];?></td> <td><?php echo $stringsCF['CLIENTE_NIF'];?></td><td class="recuadro"><?php echo $this->factura[0]['CLIENTE_NIF'];?></td>
											</tr>
										</table>
									</div>
								</fieldset>
								<fieldset style="width:660px; border-radius:4%;">
									<div id="lineasfactura">
										<table style="min-width:660px; border: 1px; margin:3px" border="1">
											<tr>
												<td colspan="4"> <h3 align="center"> <?php echo $stringsCF['Lineas de Factura'];?></h3> </td>
											</tr>
											<tr>
												<td><?php echo $stringsCF['LINEA_FACTURA_CONCEPTO'];?> </td><td align="center"><?php echo $stringsCF['LINEA_FACTURA_UNIDADES'];?></td> <td><?php echo $stringsCF['LINEA_FACTURA_PRECIOUD'];?></td> <td><?php echo $stringsCF['Subtotal'];?></td>
											</tr>
											<?php
											$subtotal = 0;
											$total = 0;
											$unidades = 0;
											$precio = 0;
											$iva=21;
											for ($j=0;$j<count($this->lineas);$j++){
												echo "<tr>";
												foreach ($this->lineas [$j] as $clave => $valor) {
													for ($i = 0; $i < count($lista1); $i++) {
														if ($clave === $lista1[$i]) {
															echo "<td>";
															echo $valor;
															echo "</td>";
														}	
													}
													if ($clave === 'LINEA_FACTURA_PRECIOUD') {
															$precio = $valor;
													}
													if ($clave === 'LINEA_FACTURA_UNIDADES') {
															$unidades = $valor;
													}
												}
												echo "<td>";
												$subtotal = $precio * $unidades;
												echo $subtotal; 
												echo "</td>";
												$total = $total + $subtotal;
												$subtotal = 0;
												$unidades = 0;
												$precio = 0;
												echo '</tr>';
											}
											$neto = $total + ($total*($iva/100))
											?>
										</table>
										<table style="border: 1px; margin:6px" border="1">
											<br>
											<br>
											<tr>
												<td><?php echo $stringsCF['Total Bruto'];?></td><td><?php echo $total;?></td>
											</tr>
											<tr>
												<td><?php echo $stringsCF['IVA'];?></td><td><?php echo $iva;?></td>
											</tr>
											<tr>
												<td><?php echo $stringsCF['TOTAL'];?></td><td><?php echo $neto;?></td>
											</tr>
										<table>
									</div>
								</fieldset>
							</div>
							<!--<div id="footer">
								<div id="pagos">
									<input type="checkbox" id="contado" value="si">
									<label for "contado"><?// echo $stringsCF['Pago al contado'];?></label><br>
						            <input type="checkbox" id="domiciliado" value="si">
									<label for "domiciliado"><? //echo $stringsCF['Pago domiciliado'];?></label><br>
									<input type="checkbox" id="tarjeta" value="si">
									<label for "tarjeta"><? //echo $stringsCF['Pago con tarjeta'];?></label><br>
								</div>
								<div id="entidad">
									<table>
										<tr>
											<td colspan="3"><b><? //echo $stringsCF['Forma de pago y Datos bancarios'];?></b></td>
										</tr>
										<tr> 
											<td> &nbsp </td><td><? //echo $stringsCF['Entidad'];?><input type="text" size=20></td>
										</tr>
										<tr> 
											<td> &nbsp </td><td><? //echo $stringsCF['Nº de cuenta'];?><input type="text" id="cuenta" size=20></td>
										</tr>
									</table>
								</div>
							</div>-->
						</fieldset>
					</body>
				<html>							
				
<?php
	} //fin metodo render

}

