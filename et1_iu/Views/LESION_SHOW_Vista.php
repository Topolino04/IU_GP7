

<?php

//Vista para Filtrar el conjunto de las lesiones

class LESION_Consultar {

    var $volver;
    var $EMP_USER;
    var $CLIENTE_ID;

    function __construct($volver, $EMP_USER, $CLIENTE_ID) {
        $this->volver = $volver;
        $this->EMP_USER = $EMP_USER;
        $this->CLIENTE_ID = $CLIENTE_ID;
        $this->render();
    }

    function render() {
        ?>

        <head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
        <p>
        <h2>
            <?php
            include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
            include '../Functions/LESIONShowDefForm.php';
            
            $lista = array('LESION_ID', 'LESION_NOM', 'LESION_ESTADO');
            ?>
            <span class="form-title">
                <?php echo $strings['Consultar Lesion'] ?><br>
                </h2>
                </p>
                <p>
                <h3>
                    <form action='LESION_Controller.php' method='post'>
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
                            
                            createForm($lista, $form, $strings, $values = '', false, false);
                            ?>
                
                            <input type='submit' name='accion' value=<?php echo $strings['Consultar'] ?>>

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
