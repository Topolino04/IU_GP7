<?php

//Vista como resultado de filtrar los registros de consulta sobre las lesiones de un usuario
class REGISTRO_Select {

    private $datos;
    private $volver;
    private $EMP_USER;
    private $CLIENTE_ID;

    function __construct($array, $volver, $EMP_USER, $CLIENTE_ID) {
        $this->datos = $array;
        $this->volver = $volver;
        $this->EMP_USER = $EMP_USER;
        $this->CLIENTE_ID = $CLIENTE_ID;
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
                                if($this->CLIENTE_ID == ''){
                                echo '<a href=\'' . $this->volver . $this->EMP_USER . "'>" . $strings['Volver'] . " </a>"; 
                                }else {
                                echo '<a href=\'' . $this->volver . $this->CLIENTE_ID . "'>" . $strings['Volver'] . " </a>";     
                                }
                            ?>
                   

                            
                        </div>
                    </nav>


                    <?php
                    $lista = array('REGISTRO_CONSULTA_LESION_ID', 'REGISTRO_CONSULTA_LESION_FECHAHORA', 'USUARIO');
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

                                echo "<tr>";
                            }
                            ?> 

                        </table>
                    </div>
        <?php
    }

}
