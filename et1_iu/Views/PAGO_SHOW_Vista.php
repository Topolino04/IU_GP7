

<?php

//VISTA PARA CONSULTAR ROLES || USA PAGODEFFORM

class PAGO_Consultar{
	function __construct(){
		$this->render();
	}

	function render(){
		?>

		<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
			<p>
			<h2>
				<?php

				include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
				
             $lista = array('CLIENTE_DNI', 'PAGO_CONCEPTO', 'PAGO_METODO','PAGO_IMPORTE', 'PAGO_ESTADO');
				?>
			<span class="form-title">
				<?php echo $strings['Consultar Pago']?><br>
			</h2>
			</p>
			<p>
			<h3>

				<form action='PAGO_Controller.php' method='post'>
					<ul class="form-style-1">
					<?php

					include '../Functions/PAGODefForm.php';


					createForm($lista,$form,$strings,$values='',false,false); //$form está en PAGODefForm.php //false, false
					?>
                                                <br><b>Método de Pago </b>
                        <select name="PAGO_METODO" size="1" >
                            <option disabled selected value></option>
                            <option value=" - n/d - "> - n/d - </option>

                            <option value="Contado">Contado</option>
                            <option value="Tarjeta de Credito/Debito">Tarjeta de Credito/Debito</option>
                            <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                            <option value="Ingreso en Cuenta">Ingreso en Cuenta</option>
                             <option value="Domiciliacion Bancaria">Domiciliacion Bancaria</option>
                        </select><br>
                                            <br><b>Estado </b>
                        <select name="PAGO_ESTADO" size="1">
                            <option disabled selected value></option>
                            <option value="PENDIENTE">PENDIENTE</option>
                            <option value="PAGADO">PAGADO</option>
                        </select><br>
				
					<input type='submit' name='accion' value=<?php echo $strings['Consultar'] ?>>

				</form>
				<?php
				echo '<a  class="form-link" href=\'PAGO_Controller.php\'>' . $strings['Volver'] . '</a>';
				?>

			</h3>
			</p>

		</div>

		<?php
	}

}
?>
