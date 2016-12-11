<?php

class Evento_Add_Horas
{
    var $evento;
    function __construct($evento){
        $this->evento=$evento;
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


        include '../Functions/EVENTODefForm.php';

        $semana=array($strings['Domingo'],$strings['Lunes'],$strings['Martes'],$strings['Miercoles'],$strings['Jueves'],$strings['Viernes'], $strings['Sabado']);
    ;
        $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


        if ($mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        $sql = "SELECT DISTINCT BLOQUE_HORAI, BLOQUE_HORAF from HORAS_POSIBLES WHERE BLOQUE_DIA='".array_search($this->evento->EVENTO_DIA,$semana)."' AND BLOQUE_HORARIO='".ConsultarIDHorario($this->evento->EVENTO_HORARIO)."'";

        $result = $mysqli->query($sql);
        if($result->num_rows===0){
            new Mensaje('No hay bloques definidos para ese día en ese horario','../Controllers/EVENTO_Controller.php');
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
			<?php echo $strings['Insertar Evento'] ?><br>
            </h1>
            <h3>

                <form id="form" name="form" action='EVENTO_Controller.php?' method='post'>
                    <ul class="form-style-1">

                        <?= $strings['EVENTO_NOMBRE'] ?> <input type="text" name="EVENTO_NOMBRE"    value='<?= $this->evento->EVENTO_NOMBRE ?>' readonly><br><br>
                        <?= $strings['LUGARES']     ?>   <input type="text" name="EVENTO_LUGAR"     value='<?= $this->evento->EVENTO_LUGAR  ?>' readonly><br><br>
                        <?= $strings['EVENTO_HORARIO'] ?><input type="text" name="EVENTO_HORARIO"   value=<?= $this->evento->EVENTO_HORARIO ?> readonly><br><br>
                        <?= $strings['EVENTO_DIA'] ?>    <input type="text" name="EVENTO_DIA"       value=<?= $this->evento->EVENTO_DIA ?> readonly><br><br>
                        <?= $strings['EVENTO_BLOQUE'] ?> <select name="EVENTO_BLOQUE">
                            <?php for ($i = 0; $i < count($str); $i++) {
                                echo $str[$i]."<option  value='" . $str[$i] . "'> {$str[$i]} </option>";
                            } ?>
                        </select> <br><br>
                        <?= $strings['EVENTO_DESCRIPCION'] ?> <input type="text" name="EVENTO_DESCRIPCION"><br><br>
                        <?= $strings['ORGANIZADOR'] ?> <select name="EVENTO_ORGANIZADOR">
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
                echo '<a class="form-link" href=\'EVENTO_Controller.php\'>' . $strings['Volver'] . " </a>";
                ?>
            </h3>
            </p>

            </div>

            <?php
        }
    } //fin metodo render

}