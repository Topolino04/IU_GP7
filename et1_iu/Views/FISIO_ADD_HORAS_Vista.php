<?php

class Fisio_Add_Horas
{
    var $fisio;
    function __construct($fisio){
        $this->fisio=$fisio;
        $this->render();
    }


    function render(){

        ?>
        <head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
            <script type="text/javascript" src="../js/<?php  echo $_SESSION['IDIOMA']?>_validate.js"></script></head>
        <div>
        <p>
        <h2>
        <?php
        include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
        include '../Functions/FISIODefForm.php';

        $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
        if ($mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        $sql = "SELECT DISTINCT BLOQUE_HORAI, BLOQUE_HORAF from HORAS_POSIBLES WHERE BLOQUE_FECHA='".($this->fisio->FISIO_FECHA)."' AND BLOQUE_HORARIO='".ConsultarIDHorario($this->fisio->FISIO_HORARIO)."'";
        echo $sql;
        $result = $mysqli->query($sql);
        if($result->num_rows===0){
            new Mensaje('No hay bloques definidos para ese día en ese horario','../Controllers/FISIO_Controller.php');
        }
        else {

            $str = array();
            while ($tipo = $result->fetch_array()) {
                array_push($str, $tipo['BLOQUE_HORAI'] . "-" . $tipo['BLOQUE_HORAF']);
            }

            ?>
            </h2>
            </p>
            <p>
            <h1>
			<span class="form-title">
			<?php echo $strings['Insertar Fisio'] ?><br>
            </h1>
            <h3>

                <form id="form" name="form" action='FISIO_Controller.php?' method='post'>
                    <ul class="form-style-1">

                        <?= $strings['FISIO_NOMBRE'] ?> <input type="text" name="FISIO_NOMBRE"    value='<?= $this->fisio->FISIO_NOMBRE ?>' readonly><br><br>
                        <?= $strings['LUGARES']     ?>   <input type="text" name="FISIO_LUGAR"     value='<?= $this->fisio->FISIO_LUGAR  ?>' readonly><br><br>
                        <?= $strings['FISIO_HORARIO'] ?><input type="text" name="FISIO_HORARIO"   value=<?= $this->fisio->FISIO_HORARIO ?>  readonly><br><br>
                        <?= $strings['FECHA'] ?>         <input type="text" name="FISIO_FECHA"     value=<?= $this->fisio->FISIO_FECHA   ?>  readonly><br><br>
                        <?= $strings['FISIO_BLOQUE'] ?> <select            name="FISIO_BLOQUE">
                            <?php for ($i = 0; $i < count($str); $i++) {
                                echo $str[$i]."<option  value='" . $str[$i] . "'> {$str[$i]} </option>";
                            } ?>
                        </select> <br><br>
                        <?= $strings['FISIO_DESCRIPCION'] ?> <input type="text" name="FISIO_DESCRIPCION"><br><br>
                        <?= $strings['ORGANIZADOR'] ?> <select name="FISIO_ORGANIZADOR">
                            <?php $monitores=getMonitores2();
                            for ($i = 0; $i < count($monitores); $i++) {
                                echo $str[$i]."<option  value='" . $monitores[$i] . "'> {$monitores[$i]} </option>";
                            }
                            ?>
                        </select><br>
                        <input type='submit' name='accion' onclick="return valida_envia4()"
                               value=<?php echo $strings['Insertar'] ?>>
                </form>
                <br>
                <?php
                echo '<a class="form-link" href=\'FISIO_Controller.php\'>' . $strings['Volver'] . " </a>";
                ?>
            </h3>
            </p>

            </div>

            <?php
        }
    } //fin metodo render

}