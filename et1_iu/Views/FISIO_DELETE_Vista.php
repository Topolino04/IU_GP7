<?php

class Fisio_delete{
    //VISTA PARA BORRAR PAGINAS

    private $valores;

    function __construct($valores){
        $this->valores=$valores;
        $this->render();
    }

    function render(){
        ?>

        <head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
        <p>
        <h2>
            <?php
            include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
            include '../Functions/FISIODefForm.php';


            $lista = array('FISIO_ID','FISIO_NOMBRE','FISIO_DESCRIPCION');


            ?>
        </h2>
        </p>
        <p>
        <h1>
			<span class="form-title">
				<?php echo $strings['Borrar Fisio']?><br>
        </h1>
        <h3>

            <form action='FISIO_Controller.php' method='post' >
                <ul class="form-style-1">
                    <?php

                    createForm($lista,$DefForm,$strings,$this->valores,false,true);

                    ?>
                    <input type='submit' name='accion' value=<?php echo $strings['Borrar'] ?>>
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
<?php
/**
 * Created by PhpStorm.
 * User: Ismael
 * Date: 11/12/2016
 * Time: 16:27
 */