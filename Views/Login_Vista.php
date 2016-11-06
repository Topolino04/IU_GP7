<?php


class Login {

function __construct(){
	$this->render();
}

function render(){

include './Locates/Strings_Español.php';
include './Functions/EmpleadosDefForm.php';
//include '../Functions/LibraryFunctions.php';
/*
$strings = array(
'usergit' => 'Introduzca el Usuario Git',
'password' => 'Introduzca la Password',
'fechnacuser' => 'Fecha Nacimiento Usuario',
'grupopracticasuser' => 'Grupo de prácticas del Usuario',
'emailuser' => 'Correo electrónico Usuario',
'nombreuser' => 'nombre del usuario git',
'apellidosuser' => 'apellidos del usuario git',
'cursoacademicouser' => 'Curso académico del usuario'
);
*/
$lista = array('EMP_USER', 'EMP_PASSWORD','IDIOMA');

?>

<html>
<head>
</head>
<body>
<h1>Login</h1>
<form action='./Functions/Acceso.php' method='post'>
<?php
createForm($lista,$DefForm,$strings,$values = '',false,false);
?>
<input type='submit' name = 'accion' value='Login'>
</form>
</body>
</html>

<?php
} //fin del metodo render

} // fin de la clase login
?>

