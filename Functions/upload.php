<?php
$carpeta = '../Documents/Empleados/'.$_REQUEST['EMP_USER'];
if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
}

move_uploaded_file($_FILES['EMP_FOTO']['tmp_name'],$carpeta.$_FILES['EMP_FOTO']['name']);
move_uploaded_file($_FILES['EMP_NOMINA']['tmp_name'],$carpeta.$_FILES['EMP_NOMINA']['name']);
header('Location:../Controllers/EMPLEADOS_Controller.php?accion=Insertar');
?>