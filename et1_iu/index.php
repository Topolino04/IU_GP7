<?php
include './Functions/LibraryFunctions.php';

if (IsAuthenticated()){ //Si no está autenticado envía al login y si lo está a la vista por defecto

	header('Location:./Views/DEFAULT_Vista.php');
}
else{
	include './Views/LOGIN_Vista.php';
	$login = new Login();
}
?>
