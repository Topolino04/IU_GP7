<?php

class FUNCIONALIDAD_Insertar{
//VISTA PARA INSERTAR FUNCIONALIDADES

    function __construct(){
        $this->render();
    }

    function render(){
        ?>
        <head>
            <link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
            <script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA']?>_validate.js"></script></head>
        <div>
            <p>
            <h2>
                <?php
                include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
                include '../Functions/FUNCIONAddDefForm.php';
                //include '../Functions/LibraryFunctions.php';

                $list = array('FUNCIONALIDAD_NOM');
                $lista=AñadirPaginasTitulos($list);



                ?>
            </h2>
            </p>
            <p>
            <h1><span class="form-title">
                <?php echo $strings['Insertar Funcionalidad']?><br>
            </h1>
            <h3>

                <form  id="form" name="form" action='FUNCIONALIDAD_Controller.php' method='get' >

                    <ul class="form-style-1">
                    <?php


                    createForm($lista,$DefForm,$strings,'',true,false);

                    ?>
                    <input type='submit' name='accion' onclick="return valida_envia3()" value=<?php echo $strings['Insertar'] ?>>
                </form>
                <?php
                echo '<a class="form-link" href=\'FUNCIONALIDAD_Controller.php\'>' . $strings['Volver'] . " </a>";
                ?>
            </h3>
            </p>

        </div>

        <?php
    } //fin metodo render

}