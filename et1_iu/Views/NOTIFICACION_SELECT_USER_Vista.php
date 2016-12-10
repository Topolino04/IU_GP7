<?php

class NOTIFICACION_USER_Select {

    //VISTA PARA LISTAR LOS USUARUIS DESTINATARIOS.

    private $datos;
    private $volver;
    private $usuario;   //Para diferenciar entre Clientes y Empleados

    function __construct($array, $volver, $usuario) {
        $this->datos = $array;
        $this->volver = $volver;
        $this->usuario = $usuario;
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
                if ($this->usuario == 'EMP') {
                    $lista = array('SELECT', 'EMP_USER', 'EMP_NOMBRE', 'EMP_APELLIDO', 'EMP_EMAIL');
                } else {
                    $lista = array('SELECT', 'CLIENTE_ID', 'CLIENTE_NOMBRE', 'CLIENTE_APELLIDOS', 'CLIENTE_CORREO');
                }
                ?>
                <head>
                    <link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
                    <link rel="stylesheet" type="text/css" href="../Styles/print.css" media="print" />

                    <script type="text/javascript">
                        function marcar(source)
                        {
                            checkboxes = document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
                            for (i = 0; i < checkboxes.length; i++) //recoremos todos los controles
                            {
                                if (checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
                                {
                                    checkboxes[i].checked = source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
                                }
                            }
                        }
                    </script>
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
                                echo $strings[$titulo];
                                echo "</th>";
                            }
                            ?>
                        <input type="checkbox" onclick="marcar(this);" /> Marcar/Desmarcar Todo
                        </tr>
                        <?php
                        for ($j = 0; $j < count($this->datos); $j++) {
                            echo "<tr>";
                            // var_dump($this->datos);
                            echo "<td>";
                            if ($this->usuario == 'EMP') {
                                ?><form id="form1" method="post">
                                    <input type="checkbox" name="email[]" value="<?php echo $this->datos [$j]['EMP_EMAIL']; ?>"/> <br/><?php
                                    //echo $this->datos [$j]['EMP_EMAIL'];
                                    echo "</td>";
                                } else {
                                    ?><form method="post">
                                        <input type="checkbox" name="email[]" value="<?php echo $this->datos [$j]['CLIENTE_CORREO']; ?>"/> <br/><?php
                                        //echo $this->datos [$j]['CLIENTE_CORREO'];
                                        echo "</td>";
                                    }
                                    foreach ($this->datos [$j] as $clave => $valor) {
                                        for ($i = 0; $i < count($lista); $i++) {
                                            if ($clave === $lista[$i]) {

                                                echo "<td>";
                                                echo $valor;
                                                echo "</td>";
                                            }
                                        }
                                    }

                                    echo "<tr>";
                                }
                                ?>

                                </table>

                                <h3>

                                    <form action="../Controllers/NOTIFICACION_Controller.php" method='post'>
                                        <?php if ($this->usuario == 'EMP') { ?>
                                            <input type='submit' onclick="return validar()" name='accion' value=<?php echo $strings['Empleados'] ?>> 
                                        <?php } else { ?>
                                            <input type='submit'  name='accion' value=<?php echo $strings['Clientes'] ?>> 
                                        <?php }
                                        ?>

                                    </form>

                                </h3>
                                </div> <!--fin de div de muestra de datos -->



                                </div>

                                <?php
                            }

                            //fin metodo render
                        }
                        