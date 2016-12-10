<?php

//VISTA PARA INSERTAR PAGOS
class PAGO_Insertar {

    function __construct() {
        $this->render();
    }

    function render() {
        ?>
        <head>	<script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA'] ?>_validate.js"></script>
            <link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
        <div>
            <p>
            <h2>
                <?php
                include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
                ;
                include '../Functions/PAGODefForm.php';


                $lista = array('CLIENTE_DNI', 'PAGO_CONCEPTO', 'PAGO_IMPORTE');
                ?>
            </h2>
        </p>
        <p>
        <h1>
            <span class="form-title">
                <?php echo $strings['Insertar Pago'] ?><br>
                </h1>
                <h3>

                    <form id="form" name="form"  action='PAGO_Controller.php' method='post' >
                        <ul class="form-style-1">
                            <?php
                            createForm($lista, $form, $strings, '', true, false);

//----- Añadir Select de estado ----- MULTILENGUAJE!!
                            ?>
                            <br><b>Método de Pago </b>
                            <select name="PAGO_METODO" size="1" required="required">
                                <option value=" - n/d - " selected=" - n/d - "> - n/d - </option>
                                <option value="Contado">Contado</option>
                                <option value="Tarjeta de Credito/Debito">Tarjeta de Credito/Debito</option>
                                <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                <option value="Ingreso en Cuenta">Ingreso en Cuenta</option>
                                <option value="Domiciliacion Bancaria">Domiciliacion Bancaria</option>
                            </select><br>

                            <br><b>Estado </b>
                            <select name="PAGO_ESTADO" size="1" required="required">
                                <option value="PENDIENTE">PENDIENTE</option>
                                <option value="PAGADO">PAGADO</option>
                            </select><br>

                            <input type='submit' name='accion' onclick="return valida_envia_PAGO()" value=<?php echo $strings['Insertar'] ?>>
                            </form>
                            <?php
                            echo '<a  class="form-link" href=\'PAGO_Controller.php\'>' . $strings['Volver'] . " </a>";
                            ?>
                            </h3>
                            </p>

                            </div>

                            <?php
                        }

                    }
                    