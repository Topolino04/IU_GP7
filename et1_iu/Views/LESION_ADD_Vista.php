<?php

//VISTA PARA INSERTAR PAGOS
class LESION_Insertar {

    private $volver;
    private $EMP_USER;
    private $CLIENTE_ID;

    function __construct($volver,$EMP_USER, $CLIENTE_ID) {
        $this->volver = $volver;
        $this->EMP_USER = $EMP_USER;
        $this->CLIENTE_ID = $CLIENTE_ID;
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
                include '../Functions/LESIONDefForm.php';


                $lista = array('LESION_NOM', 'LESION_DESC', 'LESION_ESTADO');
                ?>
            </h2>
        </p>
        <p>
        <h1>
            <span class="form-title">
                <?php echo $strings['Insertar Lesion'] ?><br>
                </h1>
                <h3>

                    <form id="form" name="form"  action='LESION_Controller.php' method='post' >
                        <ul class="form-style-1">
                            <?php
                            if ($this->CLIENTE_ID == '') {
                                ?>
                                <input type='hidden' name='EMP_USER' value="<?php echo $this->EMP_USER ?>" readonly>
                                <?php
                            } else {
                                ?> 
                                <input type='hidden' name='CLIENTE_ID' value="<?php echo $this->CLIENTE_ID ?>" readonly>
                                <?php
                            }
                            createForm($lista, $form, $strings, '', array('LESION_DESC'=>false), false);

//----- Añadir Select de estado -----
                            ?>

                            <input type='submit' onclick="return valida_envia_LESION()" name='accion' value=<?php echo $strings['Insertar'] ?>>
                            </form>
                            <?php
                            if ($this->CLIENTE_ID == '') {
                                echo '<a  class="form-link" href=\'' . $this->volver . $this->EMP_USER . "'>" . $strings['Volver'] . " </a>";
                            } else {
                                echo '<a  class="form-link" href=\'' . $this->volver . $this->CLIENTE_ID . "'>" . $strings['Volver'] . " </a>";
                            }
                            ?>

                            </h3>
                            </p>

                            </div>

                            <?php
                        }

                    }
                    