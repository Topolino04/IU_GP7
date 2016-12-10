<?php

class PAGO_Borrar {

//VISTA PARA BORRAR PAGOS

    private $valores;

    function __construct($valores) {
        $this->valores = $valores;
        $this->render();
    }

    function render() {
        ?>

        <head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
        <p>
        <h2>
            <?php
            include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
            include '../Functions/PAGOShowDefForm.php';

            // $lista = array('CLIENTE_DNI', 'PAGO_CONCEPTO', 'PAGO_IMPORTE');
            $lista = array('PAGO_ID', 'CLIENTE_ID', 'PAGO_FECHA', 'PAGO_CONCEPTO', 'PAGO_METODO', 'PAGO_IMPORTE', 'PAGO_ESTADO');
            ?>
        </h2>
        </p>
        <p>
        <h1><span class="form-title">
                <?php echo $strings['Borrar Pago'] ?><br>
                </h1>
                <h3>

                    <form action='PAGO_Controller.php' method='post' >
                        <ul class="form-style-1">
                            <?php
                            createForm($lista, $form, $strings, $this->valores, false, true); //$form2
                            ?>

                            <br><b>Método de Pago </b>
                            <?php
                            switch ($this->valores['PAGO_METODO']) {
                                case 'Contado':
                                    ?>
                                    <input type="text" name="PAGO_METODO" value="Contado" readonly><br>
                                    <?php
                                    break;
                                case 'Tarjeta de Credito/Debito':
                                    ?>
                                    <input type="text" name="PAGO_METODO" value="Tarjeta de Credito/Debito" readonly><br>
                                    <?php
                                    break;
                                case 'Transferencia Bancaria':
                                    ?>
                                    <input type="text" name="PAGO_METODO" value="Transferencia Bancaria" readonly><br>
                                    <?php
                                    break;
                                case 'Ingreso en Cuenta':
                                    ?>
                                    <input type="text" name="PAGO_METODO" value="Ingreso en Cuenta" readonly><br>
                                    <?php
                                    break;
                                case 'Domiciliacion Bancaria':
                                    ?>
                                      <input type="text" name="PAGO_METODO" value="Domiciliacion Bancaria" readonly><br>
                                    <?php
                                    break;
                            }
                            ?>

                            <br><b>Estado </b>


                            <?php
                            if ($this->valores['PAGO_ESTADO'] == 'PENDIENTE') {
                                ?><input type="text" name="PAGO_ESTADO" value="PENDIENTE" readonly><br>
                                <?php
                            } else {
                                ?><input type="text" name="PAGO_ESTADO" value="PAGADO" readonly><br>
                                <?php
                                //readonly
                            }
                            ?>


                            <input type='submit' name='accion' value=<?php echo $strings['Borrar'] ?>>
                            </form>
        <?php
        echo '<a class="form-link" href=\'PAGO_Controller.php\'>' . $strings['Volver'] . " </a>";
        ?>
                            </h3>
                            </p>

                            </div>

                            <?php
                        }

//fin metodo render
                    }
                    ?>
