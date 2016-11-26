<?php 


//VISTA PARA INSERTAR PAGOS
class PAGO_Insertar{
    function __construct(){
        $this->render();
    }

    function render(){

        ?>
<head>	<script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA']?>_validate.js"></script>
    <link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
        <div>
            <p>
            <h2>
                <?php
                include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';;
                include '../Functions/PAGODefForm.php';

       
                $lista = array('CLIENTE_DNI', 'PAGO_CONCEPTO', 'PAGO_IMPORTE');
                ?>
            </h2>
            </p>
            <p>
            <h1>
                <span class="form-title">
                <?php echo $strings['Insertar Pago']?><br>
            </h1>
            <h3>

                <form id="form" name="form"  action='PAGO_Controller.php' method='post' >
                    <ul class="form-style-1">
                    <?php

                    createForm($lista,$form,$strings,'',true,false); 
//----- Validacion de campos -----
                    ?>
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