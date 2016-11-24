<?php

//Instalador de la Base de datos IU2016 para phpmyadmin.
$mysqli = new mysqli("localhost", "root", "iu");
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

    //Modificación de los permisos para poder gestionar carpetas en el servidor.
    exec('chmod -R 777 /var/www/http/et1_iu');
//    $cmd = ['adduser www-data www-data', 'chown -R www-data:www-data /var/www', 'chmod -R 777 /var/www/http/et1_iu'];
//    exec($cmd[0], $salida);
//    foreach ($salida as $line) {
//        echo "$line<br>";
//    }
//    exec($cmd[1], $salida);
//    foreach ($salida as $line) {
//        echo "$line<br>";
//    }
//    exec($cmd[2], $salida);
//    foreach ($salida as $line) {
//        echo "$line<br>";
//    }
    echo "Instalación realizada correctamente."; //Añadir .css
}
?>