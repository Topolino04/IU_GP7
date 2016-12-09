
<?php

//Vista para Filtrar el conjunto de notificaciones por un campo o combinacion de varios campos

class NOTIFICACION_Consultar {

    private $volver;
    private $return;

    function __construct($volver, $return) {
        $this->volver = $volver;
        $this->return = $return;
        $this->render();
    }

    function render() {
        ?>

        <head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
        <p>
        <h2>
            <?php
            include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
            include '../Functions/NOTIFICACIONShowDefForm.php';

            $lista = array('NOTIFICACION_REMITENTE', 'NOTIFICACION_FECHAHORA1', 'NOTIFICACION_FECHAHORA2', 'NOTIFICACION_DESTINATARIO');
            ?>
            <span class="form-title">
                <?php echo $strings['Consultar Notificacion'] ?><br>
                </h2>
                </p>
                <p>
                <h3>
                    <form id="form" name="form" action='NOTIFICACION_Controller.php' method='post'>
                        <ul class="form-style-1">

                            <?php
                            createFormI($lista, $form, $strings, '', array('NOTIFICACION_REMITENTE' => false, 'NOTIFICACION_FECHAHORA1' => false, 'NOTIFICACION_FECHAHORA2' => false, 'NOTIFICACION_DESTINATARIO' => false, 'EMP_USER' => false), false);
                            ?>

                            <p> <br><b> <?php echo $strings['Usuario'] ?> </b>
                                <br><select name='EMP_USER'>
                                    <option selected value=""> <?php echo $strings['Elige una opcion'] ?> </option>
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

                            <input type='submit' onclick= "return valida_fecha()" name='accion' value=<?php echo $strings['Consultar'] ?>>

                            </form>
                            <?php
                            echo '<a  class="form-link" href=\'' . $this->volver . $this->return."'>" . $strings['Volver'] . " </a>";
                            ?>
                            </h3>
                            </p>

                            </div>

                            <?php
                        }

                    }
                    ?>

