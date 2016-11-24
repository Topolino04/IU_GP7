<?php
mysqli_connect("localhost", $_POST["usuario"], $_POST["password"]) or die ("Usuario o contraseña no son root en la base de datos");

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}





$mysqli = new mysqli("localhost", $_POST["usuario"], $_POST["password"]);


if ($mysqli->connect_errno) {
   // echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
    $sql = '';
    $fichero = file(“/IU2016.sql”);
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


    echo "Instalación realizada correctamente."; //Añadir .css
}
?>


<?php
//$mysqli = new mysqli("localhost", "root", "iu");
//if ($mysqli->connect_errno) {
//    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
//} else {
//    $sql = '';
//    $fichero = file('IU2016.sql');
//    foreach ($fichero as $linea) {
//        if (substr($linea, 0, 2) === '--' || $linea === '') {
//            continue;
//        } else {
//            $sql .= $linea;
//            if (substr(trim($linea), -1, 1) == ';') {
//                $mysqli->query($sql) or die($mysqli->error);
//                $sql = '';
//            }
//        }
//    }
//    $mysqli->close();
//
//
//    echo "Instalación realizada correctamente."; //Añadir .css
//}
//?>