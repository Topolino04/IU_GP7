<?php

//VISTA PARA INSERTAR PAGOS
class NOTIFICACION_EMAIL {

    private $datos;
    private $volver;
    private $return;

    function __construct($datos, $volver, $return) {
        $this->datos = $datos;
        $this->volver = $volver;
        $this->return = $return;
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
                            $dest = implode(",", $this->datos); //Convierto el array en una cadena de texto
                            ?>
                          <input type='hidden' name='NOTIFICACION_DESTINATARIOS' value="<?php echo $dest ?>" >
                            <?php
                           
                            createForm($lista, $form, $strings, '', array('NOTIFICACION_NOMBRE_REMITENTE'=>false,'NOTIFICACION_ASUNTO'=>false), false);
                            ?>
                          <p>
                         <br><b><?php $strings['Mensaje'] ?> </b>
                            <textarea rows="25" cols="70" name="NOTIFICACION_CUERPO"></textarea>
                            
                            <input type='submit' onclick="return valida_envia_EMAIL()" name='accion' value=<?php echo $strings['Enviar'] ?>>
                             <?php
                            echo '<a  class="form-link" href=\'' . $this->volver . $this->return . "'>" . $strings['Volver'] . " </a>";
                            ?>
                            </form>
                           

                            </h3>
                            </p>

                            </div>

                            <?php
                        }

                    }
                    