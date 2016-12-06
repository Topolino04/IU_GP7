<?php

class Mensaje_LESION {

//VISTA PARA MOSTRAR AVISOS Y MENSAJES PARA LESIONES, RECIBIENDO COMO PARAMETRO EMP_USER O CLIENTE_ID
    private $string;
    private $volver;
    private $EMP_USER;
    private $CLIENTE_ID;

    function __construct($string, $volver, $EMP_USER, $CLIENTE_ID) {
        $this->string = $string;
        $this->volver = $volver;
        $this->EMP_USER = $EMP_USER;
        $this->CLIENTE_ID = $CLIENTE_ID;
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
                    if ($this->CLIENTE_ID == '') {
                        echo '<a  class="form-link" href=\'' . $this->volver . $this->EMP_USER . "'>" . $strings['Volver'] . " </a>";
                    } else {
                        echo '<a  class="form-link" href=\'' . $this->volver . $this->CLIENTE_ID . "'>" . $strings['Volver'] . " </a>";
                    }
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
