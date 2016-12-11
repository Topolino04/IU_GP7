

<?php

//VISTA PARA CONSULTAR ROLES || USA PAGODEFFORM

class PAGO_Consultar {

    function __construct() {
        $this->render();
    }

    function render() {
        ?>

        <head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
        <p>
        <h2>
            <?php
            include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';

            $lista = array('CLIENTE_DNI', 'PAGO_CONCEPTO', 'PAGO_METODO', 'PAGO_IMPORTE', 'PAGO_ESTADO');
            ?>
            <span class="form-title">
                <?php echo $strings['Consultar Pago'] ?><br>
                </h2>
                </p>
                <p>
                <h3>

                    <form action='PAGO_Controller.php' method='post'>
                        <ul class="form-style-1">
                            <?php
                            include '../Functions/PAGODefForm.php';


                            createForm($lista, $form, $strings, $values = '', false, false); //$form está en PAGODefForm.php //false, false
                            ?>

                            <br><b><?php echo$strings['PAGO_METODO'] ?></b>
                            <select name="PAGO_METODO" size="1" >
                                <option disabled selected value></option>
                                <option value='No seleccionado'><?php echo $strings['No seleccionado'] ?></option>
                                <option value='Efectivo'><?php echo $strings['Efectivo'] ?></option>
                                <option value='Tarjeta Credito/Debito'><?php echo $strings['Tarjeta Credito/Debito'] ?></option>
                                <option value='Domiciliacion Bancaria'><?php echo $strings['Domiciliacion Bancaria'] ?></option>
                            </select><br>

                            <br><b><?php echo $strings['PAGO_ESTADO'] ?></b>
                            <select name="PAGO_ESTADO" size="1" >
                                <option disabled selected value></option>
                                <option value='PENDIENTE'><?php echo $strings['PENDIENTE'] ?></option>
                                <option value='PAGADO'><?php echo $strings['PAGADO'] ?></option>
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
