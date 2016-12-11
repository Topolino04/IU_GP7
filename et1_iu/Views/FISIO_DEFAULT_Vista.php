<?php

class Fisio_default{
    //VISTA PARA LISTAR FISIO

    private $datos;
    private $volver;

    function __construct($array, $volver){
        $this->datos = $array;
        $this->volver = $volver;
        $this->render();
    }

    function render(){
        ?>

        <head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
        <p>
            <h2>
                <?php


                include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';


                ?>
                <div>
                    <?php

                    $lista = array('FISIO_NOMBRE','FISIO_DESCRIPCION');


                    ?>
                    <head>
                        <link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
                        <link rel="stylesheet" type="text/css" href="../Styles/print.css" media="print" />
                    </head>
                    <div id="wrapper">

                        <nav>

                            <div class="menu">


                                <ul>
                                    <li><a href="../Functions/Desconectar.php"><?php echo  $strings['Cerrar Sesión']; ?></a></li>
                                    <li><?php echo $strings['Usuario'].": ". $_SESSION['login']; ?></li>

                                </ul>

                                <?php echo '<a href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>"; ?></li>
                                <a href='./FISIO_Controller.php?accion=<?php echo $strings['Consultar']?>'><?php echo $strings['Consultar']?></a>
                                <a href='./FISIO_Controller.php?accion=<?php echo $strings['Insertar']?>'><?php echo $strings['Insertar']?></a>

                            </div>
                        </nav>
                        <table id="btable" border = 1>
                            <tr>
                                <?php

                                foreach($lista as $titulo){

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


                            for ($j=0;$j<count($this->datos);$j++){
                                echo "<tr>";
                                foreach ($this->datos[$j] as $clave => $valor) {
                                    for ($i = 0; $i < count($lista); $i++) {
                                        if ($clave === $lista[$i]) {
                                            ?>

                                            <?php

                                            echo "<td>";


                                            echo $valor;

                                            echo "</td>";
                                        }
                                    }
                                }
                                ?>

                                <?php


                                ?>
                                <td>
                                    <a href='FISIO_Controller.php?FISIO_ID=<?php echo $this->datos[$j]['FISIO_ID'] . '&accion='.$strings['Invitados']; ?>'> <?php echo $strings['Invitados'] ?></a>
                                </td>
                                <td>
                                    <a href='FISIO_Controller.php?FISIO_NOMBRE=<?php echo $this->datos[$j]['FISIO_NOMBRE'] . '&accion='.$strings['Modificar']; ?>'> <?php echo $strings['Modificar'] ?></a>
                                </td>
                                <td>
                                    <a href='FISIO_Controller.php?FISIO_NOMBRE=<?php echo $this->datos[$j]['FISIO_NOMBRE'] . '&accion='.$strings['Borrar']; ?>'> <?php echo $strings['Borrar'] ?></a>
                                </td>


                                <?php

                                echo "<tr>";

                            }
                            ?>

                        </table>

                    </div>
                    <h3>
        <p>
            <?php
            echo '<a class="form-link" href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>";
            ?>
            </h3>
        </p>

        </div>

        <?php
    } //fin metodo render

}

