<?php

class FISIO_Show_Invitados {

//VISTA PARA LISTAR TODOS LOS EMPLEADOS
    private $datos;
    private $volver;

    function __construct($array, $volver) {
        $this->datos = $array;
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        ?>



        <?php
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';

        //include '../Models/USUARIOS_array.php';
        //include '../Classes/gen_form_class.php';
        ?> <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
            <link rel="stylesheet" type="text/css" href="../Styles/print.css" media="print" />
        </head>
        <form id="wrapper1" action="FISIO_Controller.php?FISIO_ID=<?= $_GET['FISIO_ID']?>&amp;accion=<?= $strings['Guardar']?>" method="post">
            <nav>
                <div class="menu">
                    <ul>
                        <li><a href="../Functions/Desconectar.php"><?php echo $strings['Cerrar Sesión']; ?></a></li>
                        <li><?php echo $strings['Usuario'] . ": " . $_SESSION['login']; ?></li>

                    </ul>

                    <?php echo '<a href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>"; ?></li>
                </div>
            </nav>
            <?php
            //$gen_datos = new gen_form($arrayDefForm);
            $lista = array('CLIENTE_DNI', 'CLIENTE_NOMBRE', 'CLIENTE_APELLIDOS','CLIENTE_DIRECCION', 'CLIENTE_CORREO', 'CLIENTE_FECH_NAC', 'CLIENTE_TELEFONO1', 'CLIENTE_TELEFONO2', 'CLIENTE_TELEFONO3',  'CLIENTE_COMENTARIOS');
            ?>


            <br><br>

            <table id="btable" class="responstable" border = 1>
                <tr>
                    <?php
                    foreach ($lista as $titulo) {
                        if ($titulo === 'CLIENTE_CORREO') {

                            echo "<th  colspan='2'>";
                        } else {
                            echo "<th>";
                        }
                        echo $strings[$titulo];
                        ?>
                        </th>
                        <?php
                    }
                    ?>
                    <th> <?= $strings['Invitado']?></th>
                </tr>
                <?php
                for ($j = 0; $j < count($this->datos); $j++) {
                    if ($this->datos[$j]['CLIENTE_ESTADO'] !== 'Inactivo') {
                        echo "<tr>";
                        foreach ($this->datos [$j] as $clave => $valor) {
                            for ($i = 0; $i < count($lista); $i++) {
                                if ($clave === $lista[$i]) {
                                    if ($clave === 'CLIENTE_CORREO') {
                                        ?><td  id='long' colspan="2"><?php
                                    } else {
                                        echo "<td>";
                                    }
                                    if (($clave === 'CLIENTE_DOM' || $clave === 'CLIENTE_LOPD')) {
                                        if (is_file($valor)) {
                                            echo "<a target='_blank' href='" . $valor . "'>" . $strings['Ver'] . "</a>";
                                        } else {
                                            echo '';
                                        }
                                    } else {
                                        if (($clave === 'CLIENTE_TELEFONO1' || $clave === 'CLIENTE_TELEFONO2' || $clave === 'CLIENTE_TELEFONO3' || $clave === 'CLIENTE_FECH_NAC') && ($valor === '0' || $valor === '0000-00-00')) {
                                            echo '';
                                        } else {
                                            if ($clave === 'CLIENTE_TIPO') {
                                                if ($valor === '1') {
                                                    echo 'S';
                                                } else {
                                                    echo 'E';
                                                }
                                            } else {
                                                echo utf8_encode($valor);
                                            }
                                        }

                                        echo "</td>";
                                    }
                                }
                            }
                        }
                        ?>
                        <td>
                            <input type="checkbox" name = "invitados[]" value = "<?= $this->datos[$j]["CLIENTE_ID"]?>" <?php if($valor) echo "checked" ?> >
                        </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <input type='submit' onclick="" name='accion'  value= <?= $strings['Guardar']?>>
            <p style="font-size: 10px;color:white"><?php echo $strings['Nota'] ?></p>
        </form> <!-- fin de div de muestra de datos -->
        <h3>
            <p>
                <?php ?>
        </h3>
        </p>

        </div>

        <?php
    }

//fin metodo render
}

