<?php

//Vista DEFAULT de Notificaciones, muestra todas las Notificaciones que sea han hecho

class NOTIFICACION_Select {

    private $datos;
    private $volver;
    private $return;

    function __construct($array, $volver, $return) {
        $this->datos = $array;
        $this->volver = $volver;
        $this->return = $return;
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

                            <?php
    
                            if ($this->return == '') {
                                echo '<a href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>";
                            } else {
                                echo '<a href=\'' . $this->volver . $this->return . "'>" . $strings['Volver'] . " </a>";
                            }
                                
                            if ($this->return == '') { ?>
                                <a href='NOTIFICACION_Controller.php?accion=<?php echo $strings['Consultar']; ?>'><?php echo $strings['Consultar'] ?></a>
                            <?php } ?>

                            </div>
                        </nav>


                        <?php
                        $lista = array('NOTIFICACION_REMITENTE', 'NOTIFICACION_FECHAHORA', 'NOTIFICACION_DESTINATARIO', 'EMP_USER');
                        ?>

                        <div >
                            <table  id="btable"  class="responstable" border = 1>
                                <tr>
                                    <?php
                                    foreach ($lista as $titulo) {

                                        echo "<th>";
                                        ?>
                                        <?php
                                        echo $strings[$titulo];
                                        ?>
                                        </th>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                                for ($j = 0; $j < count($this->datos); $j++) {
                                    echo "<tr>";

                                    foreach ($this->datos [$j] as $clave => $valor) {
                                        for ($i = 0; $i < count($lista); $i++) {
                                            if ($clave === $lista[$i]) {

                                                echo "<td>";
                                                echo $valor;
                                                echo "</td>";
                                            }
                                        }
                                    }
                                    ?>
                                    <?php
                                    echo "<tr>";
                                }
                                ?> 

                            </table>
                        </div>
                        <?php
                    }
                }
                