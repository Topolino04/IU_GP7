<?php

//Vista para filtrar los registros por alguno de sus campos

class REGISTRO_Consultar {

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
            include '../Functions/REGISTRODefForm.php';

            $lista = array('REGISTRO_CONSULTA_LESION_ID', 'REGISTRO_CONSULTA_LESION_FECHAHORA1', 'REGISTRO_CONSULTA_LESION_FECHAHORA2');
            ?>
            <span class="form-title">
                <?php echo $strings['Consultar Registro'] ?><br>
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

                            createFormI($lista, $form, $strings, '', array('REGISTRO_CONSULTA_LESION_ID'=>false,'REGISTRO_CONSULTA_LESION_FECHAHORA1'=>false,'REGISTRO_CONSULTA_LESION_FECHAHORA2'=>false,), false);
                            ?>
                                
                            <p> <br><b> <?php echo $strings['Usuario'] ?> </b>
                                <br><select name='USUARIO'>
                                    <option selected value="0"> <?php echo $strings['Elige una opcion'] ?> </option>
                                    <?php
                                    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");

                                    if ($mysqli->connect_errno) {
                                        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                                    }
                                    $query = $mysqli->query("SELECT * from EMPLEADOS");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores['EMP_USER'] . '">' . $valores['EMP_USER'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </p>

                            <input type='submit' name='accion' value=<?php echo $strings['Filtrar'] ?>>

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
