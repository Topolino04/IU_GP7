<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "DROP DATABASE IU_DATABASE";
$conn->query($sql);
$sql = "CREATE DATABASE IU_DATABASE";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
    ejecutarSQL("DataBase.sql",$conn);
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
function ejecutarSQL($_rutaArchivo, $_conexionDB){
    $queries = explode(';', file_get_contents($_rutaArchivo));
    foreach($queries as $query){
        if($query != ''){
            $_conexionDB->query($query); // Asumo un objeto conexión que ejecuta consultas
        }
    }
}

?>
