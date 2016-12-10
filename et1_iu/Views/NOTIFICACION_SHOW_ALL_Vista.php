<?php

//VISTA INICIAL DE LA GESTION DE NOTIFICACIONES
class NOTIFICACION_Default {

    private $volver;

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
                             <a href='NOTIFICACION_Controller.php?accion=<?php echo $strings['Registro']; ?>'><?php echo $strings['Registro'] ?></a>

                        </div>
                    </nav>

                    <div >
                        <form action="../Controllers/NOTIFICACION_Controller.php" method='post'>
                            <br>
                            <p>
                                <a href='NOTIFICACION_Controller.php?accion=<?php echo $strings['Empleados']; ?>'><?php echo $strings['Notificacion sobre Empleados'] ?></a>
                            </p>
                            <br>
                            <p>
                                <a href='NOTIFICACION_Controller.php?accion=<?php echo $strings['Clientes']; ?>'><?php echo $strings['Notificacion sobre Clientes'] ?></a>
                            </p>
                            <br>
                            <p>
                                <a href='NOTIFICACION_Controller.php?accion=<?php echo $strings['Actividad']; ?>'><?php echo $strings['Notificacion sobre Actividades'] ?></a>
                            </p>
                            <br>
                                <a href='NOTIFICACION_Controller.php?accion=<?php echo $strings['Eventos']; ?>'><?php echo $strings['Notificacion sobre Eventos'] ?></a>
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
