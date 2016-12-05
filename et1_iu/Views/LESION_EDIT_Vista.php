<?php

class LESION_Modificar {

//Vista para modificar las lesiones de un Usuarios (Empleado o Cliente)

    private $valores;
    private $volver;
    private $EMP_USER;
    private $CLIENTE_ID;

    function __construct($valores, $volver, $EMP_USER, $CLIENTE_ID) {
        $this->valores = $valores;
        $this->volver = $volver;
        $this->EMP_USER = $EMP_USER;
        $this->CLIENTE_ID = $CLIENTE_ID;
        $this->render();
    }

    function render() {
        ?>
        <head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
            <script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA'] ?>_validate.js"></script></head>
        <div>
            <p>
            <h2>
                <?php
                include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
                include '../Functions/LESIONDefForm.php';

                $lista = array('LESION_ID', 'LESION_NOM', 'LESION_DESC', 'LESION_ESTADO');
                ?>
            </h2>
        </p>
        <p>
        <h1><span class="form-title">
                <?php echo $strings['Modificar lesion'] ?><br>
                </h1>
                <h3>

                    <form  id="form" name="form" action='LESION_Controller.php' method='post' >
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
                            createForm($lista, $form, $strings, $this->valores, array('LESION_NOM'=>false, 'LESION_DESC'=>false), array('LESION_ID'=>true));
                            ?>

                            </select><br>


                            <input type='submit' name='accion' value=<?php echo $strings['Modificar'] ?>>
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
                    ?>
