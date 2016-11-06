<?php

class Mensaje{

private $string; 
private $volver;

function __construct($string, $volver){
	$this->string = $string;
	$this->volver = $volver;	
	$this->render();
}

function render(){
?>
<html>
 <head>
<meta charset="UTF-8">
</head> 
<body>
<div>
<p>
<h2>
<?php
<<<<<<< HEAD
include '../Locates/Strings_SPANISH.php';
=======
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
>>>>>>> master
echo $strings[$this->string];
?>
</h2>
</p>
<p>
<h3>
<?php
<<<<<<< HEAD
echo '<a href=\'' . $this->volver . "\'>" . $strings['Volver'] . " </a>";
=======
echo '<a href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>";
>>>>>>> master
?>
</h3>
</p>

</div>
</body>
</html>
<?php
} //fin metodo render

}
