<?php

class PAGO_Modificar {

//VISTA PARA MODIFICAR PAGOS

    private $valores;

    function __construct($valores) {
        $this->valores = $valores;
        $this->render();
    }

    function render() {
        ?>
        <head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
            <script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA'] ?>_validate.js"></script></head>
        <div>
            <p>
            <h2>
                <?php
                include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
                include '../Functions/PAGOEditDefForm.php';
                //include '../Functions/LibraryFunctions.php';

                $lista = array('PAGO_ID', 'CLIENTE_DNI', 'PAGO_CONCEPTO', 'PAGO_METODO', 'PAGO_IMPORTE', 'PAGO_ESTADO');
                ?>
            </h2>
        </p>
        <p>
        <h1><span class="form-title">
                <?php echo $strings['Modificar Pago'] ?><br>
                </h1>
                <h3>

                    <form  id="form" name="form" action='PAGO_Controller.php' method='post' >
                        <ul class="form-style-1">
                            <?php
                            //createForm2($lista,$DefForm,$strings,$this->valores,array('ROL_NOM'=>true),array('ROL_ID'=>true),$this->valores['ROL_ID']); //DefForm2
                            createForm($lista, $form, $strings, $this->valores, array('PAGO_CONCEPTO' => false, 'PAGO_IMPORTE' => false, 'CLIENTE_DNI' => false), array('PAGO_ID' => true));
                            ?>



                            <br><b>Método de Pago </b>
                            <select name="PAGO_METODO" size="1" required="required">
                                <?php
                                switch ($this->valores['PAGO_METODO']) {
                                    case ' - n/d - ':
                                        ?>
                                        <option value=" - n/d - " selected=" - n/d - "> - n/d - </option>
                                        <option value="Contado">Contado</option>
                                        <option value="Tarjeta de Credito/Debito">Tarjeta de Credito/Debito</option>
                                        <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                        <option value="Ingreso en Cuenta">Ingreso en Cuenta</option>
                                        <option value="Domiciliacion Bancaria">Domiciliacion Bancaria</option>

                                        <?php break;
                                    case 'Contado':
                                        ?>
                                        <option value=" - n/d - " > - n/d - </option>
                                        <option value="Contado" selected="Contado">Contado</option>
                                        <option value="Tarjeta de Credito/Debito">Tarjeta de Credito/Debito</option>
                                        <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                        <option value="Ingreso en Cuenta">Ingreso en Cuenta</option>
                                        <option value="Domiciliacion Bancaria">Domiciliacion Bancaria</option>

                <?php break;
            case 'Tarjeta de Credito/Debito':
                ?>
                                        <option value=" - n/d - " > - n/d - </option>
                                        <option value="Contado">Contado</option>
                                        <option value="Tarjeta de Credito/Debito" selected="Tarjeta de Credito/Debito">Tarjeta de Credito/Debito</option>
                                        <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                        <option value="Ingreso en Cuenta">Ingreso en Cuenta</option>
                                        <option value="Domiciliacion Bancaria">Domiciliacion Bancaria</option>

                <?php break;
            case 'Transferencia Bancaria':
                ?>
                                        <option value=" - n/d - " > - n/d - </option>
                                        <option value="Contado">Contado</option>
                                        <option value="Tarjeta de Credito/Debito">Tarjeta de Credito/Debito</option>
                                        <option value="Transferencia Bancaria" selected="Trasferencia Bancaria">Transferencia Bancaria</option>
                                        <option value="Ingreso en Cuenta">Ingreso en Cuenta</option>
                                        <option value="Domiciliacion Bancaria">Domiciliacion Bancaria</option>

                <?php break;
            case 'Ingreso en Cuenta':
                ?>
                                        <option value=" - n/d - " > - n/d - </option>
                                        <option value="Contado">Contado</option>
                                        <option value="Tarjeta de Credito/Debito">Tarjeta de Credito/Debito</option>
                                        <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                        <option value="Ingreso en Cuenta" selected="Ingreso en Cuenta">Ingreso en Cuenta</option>
                                        <option value="Domiciliacion Bancaria">Domiciliacion Bancaria</option>

                <?php break;
            case 'Domiciliacion Bancaria':
                ?>
                                        <option value="Domiciliacion Bancaria" selected="Domiciliacion Bancaria">Domiciliacion Bancaria</option>
                                        <option value=" - n/d - " > - n/d - </option>
                                        <option value="Contado">Contado</option>
                                        <option value="Tarjeta de Credito/Debito">Tarjeta de Credito/Debito</option>
                                        <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                        <option value="Ingreso en Cuenta" >Ingreso en Cuenta</option>
                                        <?php
                                        break;
                                }
                                ?>
                            </select><br>

                            <br><b>Estado </b>
                            <select name="PAGO_ESTADO" size="1" required="required">
                                <?php
                                if ($this->valores['PAGO_ESTADO'] == 'PENDIENTE') {
                                    ?><option value="PENDIENTE" selected="PENDIENTE">PENDIENTE</option>
                                    <option value="PAGADO">PAGADO</option>
            <?php
        } else {
            ?><option value="PENDIENTE" >PENDIENTE</option>
                                    <option value="PAGADO" selected="PAGADO">PAGADO</option>
            <?php
        }
        ?>

                            </select><br>


                            <input type='submit' name='accion' onclick="return valida_envia_PAGO()" value=<?php echo $strings['Modificar'] ?>>
                            </form>
                            <?php
                            echo '<a  class="form-link" href=\'PAGO_Controller.php\'>' . $strings['Volver'] . " </a>";
                            ?>
                            </h3>
                            </p>

                            </div>

        <?php
    }

//fin metodo render
}
?>
