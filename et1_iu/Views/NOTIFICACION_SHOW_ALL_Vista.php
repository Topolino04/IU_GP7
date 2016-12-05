<?php

//VISTA INICIAL DE LA GESTION DE PAGOS
class NOTIFICACION_Default {

    private $volver;

    //private $ACTIVIDAD_ID;

    function __construct($volver) {
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        ?>

        <div>
            <p>
            <h2>
                <?php
                include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
                ?>
                <head>
                    <link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
                    <link rel="stylesheet" type="text/css" href="../Styles/print.css" media="print" />
                </head>
                <div id="wrapper">

                    <nav>

                        <div class="menu">


                            <ul>
                                <li><a href="../Functions/Desconectar.php"><?php echo $strings['Cerrar Sesión']; ?></a></li>
                                <li><?php echo $strings['Usuario'] . ": " . $_SESSION['login']; ?></li>

                            </ul>

        <?php echo '<a href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>"; ?>

                        </div>
                    </nav>

                    <div >
                        <form action="../Controllers/NOTIFICACION_Controller.php" method='post'>
                            <br>
                            <p>
                               <!-- <input type='submit' name='accion' value=<?php// echo $strings['Clientes'] ?>> -->
                              <a href='NOTIFICACION_Controller.php?accion=<?php echo $strings['Clientes']; ?>'><?php echo $strings['Notificacion sobre Clientes'] ?></a>
                            </p>
                            <br>
                            <p>Notificacion sobre Actividades
                            <p> <select name='actividad'>
                             <option selected value="0"> Elige una opción </option>
                                    <?php
                                    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");

                                    if ($mysqli->connect_errno) {
                                        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                                    }
                                    $query = $mysqli->query("SELECT * from ACTIVIDAD");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores['ACTIVIDAD_ID'] . '">' . $valores['ACTIVIDAD_NOMBRE'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </p>
                              <input type='submit' name='accion' value=<?php echo $strings['Actividad'] ?>>
                            </p>
                            <br>
                            <p>Notificacion sobre Eventos
                                <select name='evento'>
                             <option selected value="0"> Elige una opción </option>
                                    <?php
                                    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");

                                    if ($mysqli->connect_errno) {
                                        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                                    }
                                    $query = $mysqli->query("SELECT * from EVENTO");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores['EVENTO_ID'] . '">' . $valores['EVENTO_NOMBRE'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <a href='NOTIFICACION_Controller.php?<?php echo '&accion=' . $strings['Evento']; ?>'><?php echo $strings['Evento'] ?></a>
                            </p>

                        </form>

                    </div>
                </div>
                <h3>
                    <p>
                </h3>
                </p>

        </div>

        <?php
    }

}
