<?php

class BLOQUE_Show_ActEv{
//VISTA PARA MOSTAR PÁGINAS QUE TIENEN ASOCIADAS LAS FUNCIONALIDADES
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


                        <table  id="btable" border = 1>
                            <tr>
                                <?php



                                    echo "<th>";

                                    ?>


                                <?php
                                    echo $strings['ACTIVIDADES'];
                                    ?>
                                    </th>
                                    <?php

                                ?>
                            </tr>
                            <?php

if(isset($this->datos['ACTIVIDADES'])) {
    for ($j = 0; $j < count($this->datos['ACTIVIDADES']); $j++) {


        echo "<tr>";

        ?>

        <?php

        echo "<td>";


        echo $this->datos['ACTIVIDADES'][$j];

        echo "</td>";

        ?>

        <?php


        ?>


        <?php

        echo "<tr>";

    }
    ?>
    <tr>
        <?php


        echo "<th>";

        ?>


        <?php
        echo $strings['EVENTOS'];
        ?>
        </th>
        <?php

        ?>
    </tr>
    <?php
}
if(isset($this->datos['EVENTOS'])) {

    for ($j = 0; $j < count($this->datos['EVENTOS']); $j++) {


        echo "<tr>";

        ?>

        <?php

        echo "<td>";


        echo $this->datos['EVENTOS'][$j];

        echo "</td>";

        ?>

        <?php


        ?>


        <?php

        echo "<tr>";

    }
}
                            ?>


                        </table>

                    </div>
                    <h3>
            <p>
                <?php

                ?>
                </h3>
            </p>

        </div>

        <?php
    } //fin metodo render

}
