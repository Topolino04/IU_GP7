<?php

class HORARIO_Insertar{
//VISTA PARA INSERTAR ROLES

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
                include '../Functions/HORARIODefForm.php';


                $lista = array('HORARIO_NOMBRE', 'HORARIO_FECHAI','HORARIO_FECHAF', 'HORARIO_RANGO1I', 'HORARIO_RANGO1F', 'HORARIO_RANGO2I', 'HORARIO_RANGO2F', 'HORARIO_RANGO3I', 'HORARIO_RANGO3F', 'HORARIO_RANGO4I', 'HORARIO_RANGO4F', 'HORARIO_RANGO5I', 'HORARIO_RANGO5F', 'HORARIO_RANGO6I', 'HORARIO_RANGO6F' );





                ?>
            </h2>
            </p>
            <p>
            <h1>
                <span class="form-title">
                <?php echo $strings['Insertar Horario']?><br>
            </h1>
            <h3>

                <form id="form" name="form"  action='HORARIO_Controller.php' method='post' >
                    <ul class="form-style-1">
                    <?php

                    createForm($lista,$DefForm,$strings,'',true,false);

                    ?>
                    <input type='submit' name='accion' value=<?php echo $strings['Insertar'] ?>>
                </form>
                <?php
                echo '<a  class="form-link" href=\'HORARIO_Controller.php\'>' . $strings['Volver'] . " </a>";
                ?>
            </h3>
            </p>

        </div>

        <?php
    } //fin metodo render

}