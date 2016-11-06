<?php
include './Functions/LibraryFunctions.php';
if (IsAuthenticated()){

	header('Location:./Controllers/EMPLEADOS_Controller.php');
}
else{
	include './Views/Login_Vista.php';
	$login = new Login();
}
?>
