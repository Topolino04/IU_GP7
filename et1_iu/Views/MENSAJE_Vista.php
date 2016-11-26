<?php

class Mensaje {

//VISTA PARA MOSTRAR AVISOS Y MENSAJES
    private $string;
    private $volver;

    function __construct($string, $volver) {
        $this->string = $string;
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        ?>
        <html>
            <head>
                <link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
                <meta charset="UTF-8">
            </head> 
            <body>
                <div>
                    <p>
                    <h2 style="color:white;">


                        <?php
                        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
                        ;

                        echo $strings[$this->string];
                        ?>
                    </h2>
                </p>
                <p>
                <h3>
                    <?php
                    echo '<a  class="form-link" href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>";
                    ?>
                </h3>
            </p>

        </div>
        </body>
        </html>
        <?php
    }

//fin metodo render
}
