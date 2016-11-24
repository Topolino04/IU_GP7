<?php

class ROL_Insertar{
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
                include '../Functions/ROLDefForm.php';


                $list = array('ROL_NOM');
                $lista=AñadirFuncionesTitulos($list);




                ?>
            </h2>
            </p>
            <p>
            <h1>
                <span class="form-title">
                <?php echo $strings['Insertar Rol']?><br>
            </h1>
            <h3>

                <form id="form" name="form"  action='ROL_Controller.php' method='post' >
                    <ul class="form-style-1">
                    <?php

                    createForm($lista,$DefForm,$strings,'',true,false);

                    ?>
                    <input type='submit' name='accion' onclick="return valida_envia2()" value=<?php echo $strings['Insertar'] ?>>
                </form>
                <?php
                echo '<a  class="form-link" href=\'ROL_Controller.php\'>' . $strings['Volver'] . " </a>";
                ?>
            </h3>
            </p>

        </div>

        <?php
    } //fin metodo render

}