<?php



class Fisio_Edit{
//VISTA PARA MODIFICAR PAGINAS
    private $valores;

    function __construct($valores){
        $this->valores=$valores;
        $this->render();
    }

    function render(){
        ?>
        <head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
            <script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA']?>_validate.js"></script></head>
        <div>
            <p>
            <h2>
                <?php
                include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
                include '../Functions/FISIODefForm.php';
                //include '../Functions/LibraryFunctions.php';

                $lista = array('FISIO_ID','FISIO_NOMBRE','FISIO_DESCRIPCION');





                ?>
            </h2>
            </p>
            <p>
            <h1>
				<span class="form-title">
				<?php echo $strings['Modificar Fisio']?><br>
            </h1>
            <h3>

                <form  id="form" name="form" action='FISIO_Controller.php' method='post' >
                    <ul class="form-style-1">
                        <?php

                        createForm($lista,$DefForm,$strings,$this->valores,array('FISIO_NOMBRE'=>false),array('FISIO_ID'=>true,'FISIO_PRECIO'=>false,'FISIO_DESCRIPCION'=>false,'CATEGORIA_ID'=>false,'ACTIVO'=>false));

                        ?>
                        <input type='submit' name='accion' onclick="return valida_envia4()" value=<?php echo $strings['Modificar'] ?>>
                </form>
                <?php
                echo '<a class="form-link" href=\'FISIO_Controller.php\'>' . $strings['Volver'] . " </a>";
                ?>
            </h3>
            </p>

        </div>

        <?php
    } //fin metodo render

}
?>
