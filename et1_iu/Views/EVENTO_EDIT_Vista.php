<?php



class Evento_Edit{
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
                include '../Functions/EVENTODefForm.php';
                //include '../Functions/LibraryFunctions.php';

                $lista = array('EVENTO_ID','EVENTO_NOMBRE','EVENTO_DESCRIPCION');





                ?>
            </h2>
            </p>
            <p>
            <h1>
				<span class="form-title">
				<?php echo $strings['Modificar Evento']?><br>
            </h1>
            <h3>

                <form  id="form" name="form" action='EVENTO_Controller.php' method='post' >
                    <ul class="form-style-1">
                        <?php

                        createForm($lista,$DefForm,$strings,$this->valores,array('EVENTO_NOMBRE'=>false),array('EVENTO_ID'=>true,'EVENTO_PRECIO'=>false,'EVENTO_DESCRIPCION'=>false,'CATEGORIA_ID'=>false,'ACTIVO'=>false));

                        ?>
                        <input type='submit' name='accion' onclick="return valida_envia4()" value=<?php echo $strings['Modificar'] ?>>
                </form>
                <?php
                echo '<a class="form-link" href=\'EVENTO_Controller.php\'>' . $strings['Volver'] . " </a>";
                ?>
            </h3>
            </p>

        </div>

        <?php
    } //fin metodo render

}
?>
