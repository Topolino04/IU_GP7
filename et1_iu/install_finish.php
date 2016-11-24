<?php
$mysqli = new mysqli("localhost", $_POST["usuario"], $_POST["password"]);
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
    $sql = '';
    $fichero = file('IU2016.sql');
    foreach ($fichero as $linea) {
        if (substr($linea, 0, 2) === '--' || $linea === '') {
            continue;
        } else {
            $sql .= $linea;
            if (substr(trim($linea), -1, 1) == ';') {
                $mysqli->query($sql) or die($mysqli->error);
                $sql = '';
            }
        }
    }
    $mysqli->close();
    ?>
    <p></br></br>----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----</p>
    <p>----- ----- ----- ----- ----- ----- ----- INSTALACIÓN EXITOSA ----- ----- ----- ----- ----- ----- ----- </p>
    <p>----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----</p>
    <?php
}
?>