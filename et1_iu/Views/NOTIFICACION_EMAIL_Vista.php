<?php

//VISTA PARA INSERTAR PAGOS
class NOTIFICACION_EMAIL {

    private $datos;
    private $volver;

    function __construct($datos, $volver) {
        $this->datos = $datos;
        $this->volver = $volver;
        $this->render();
    }

    function render() {
        ?>
        <head>	<script type="text/javascript" src="../js/<?php echo $_SESSION['IDIOMA'] ?>_validate.js"></script>
            <link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
        <div>
            <p>
            <h2>
                <?php
                include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
                include '../Functions/NOTIFICACIONDefForm.php';


                $lista = array('NOTIFICACION_REMITENTE', 'NOTIFICACION_PASSWORD', 'NOTIFICACION_NOMBRE_REMITENTE', 'NOTIFICACION_ASUNTO', 'NOTIFICACION_CUERPO');
                ?>
            </h2>
        </p>
        <p>
        <h1>
            <span class="form-title">
                <?php echo $strings['Redactar Email'] ?><br>
                </h1>
                <h3>

                    <form id="form" name="form"  action='NOTIFICACION_Controller.php' method='post' >
                        <ul class="form-style-1">
                            <?php
                            $dest = implode(",", $this->datos);
                           // echo $dest;
                            ?>
                          <input type='hidden' name='NOTIFICACION_DESTINATARIOS' value="<?php echo $dest ?>" >
                            <?php
                           
                            createForm($lista, $form, $strings, '', true, false);
                            ?>
                          <p>
                         <br><b>Mensaje </b>
                            <textarea rows="30" cols="70" name="NOTIFICACION_CUERPO"></textarea>
                            
                            <input type='submit' name='accion' value=<?php echo $strings['Enviar'] ?>>
                            </form>
                            <?php
                            echo '<a  class="form-link" href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>";
                            ?>

                            </h3>
                            </p>

                            </div>

                            <?php
                        }

                    }
                    