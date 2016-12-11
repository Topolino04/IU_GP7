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

                            <br><b><?php echo$strings['PAGO_METODO'] ?></b>
                            <input type="text" name="PAGO_METODO" value='<?php echo $strings [$this->valores['PAGO_METODO']] ?>' readonly><br>
                            <br><b><?php echo $strings['PAGO_ESTADO'] ?></b>
                            <input type="text" name="PAGO_ESTADO" value='<?php echo $strings [$this->valores['PAGO_ESTADO']] ?>' readonly><br>


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
