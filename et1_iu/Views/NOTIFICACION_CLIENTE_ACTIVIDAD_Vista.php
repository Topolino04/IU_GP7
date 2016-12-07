<?php

class NOTIFICACION_CLIENTE_ACTIVIDAD_Show {

    //VISTA PARA LISTAR LOS CLIENTES DESTINATARIOS

    private $datos;
    private $volver;

    function __construct($array, $volver) {
        $this->datos = $array;
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        ?>

        <head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
        <p>
        <h2>
            <?php
            include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
            ?>
            <div>
                <?php
                $lista = array('SELECT', 'CLIENTE_ID', 'CLIENTE_NOMBRE', 'CLIENTE_APELLIDOS', 'CLIENTE_CORREO');
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

                            <?php echo '<a href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>"; ?></li>		
                        </div>
                    </nav>
                    <table id='btable' border = 1>
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
                            echo "<tr>";
                            echo "<td>";
                            ?><form method="post">
                                <input type="checkbox" name="email[]" checked="checked" readonly="readonly" onclick="javascript: return false;" value="<?php echo $this->datos [$j]['CLIENTE_CORREO']; ?> "/> <br/><?php
                                echo $this->datos [$j]['CLIENTE_CORREO'];
                                echo "</td>";
                                foreach ($this->datos [$j] as $clave => $valor) {
                                    for ($i = 0; $i < count($lista); $i++) {
                                        if ($clave === $lista[$i]) {

                                            echo "<td>";
                                            echo $valor;
                                            echo "</td>";
                                        }
                                    }
                                }
                            }
                            ?>

                    </table>
                    <h3>

                        <form action="../Controllers/NOTIFICACION_Controller.php" method='post'>

                            <input type='submit' name='accion' value=<?php echo $strings['Actividad'] ?>>
                        </form>

                    </h3>
                </div> <!-- fin de div de muestra de datos -->



            </div>

            <?php
        }

        //fin metodo render
    }
    