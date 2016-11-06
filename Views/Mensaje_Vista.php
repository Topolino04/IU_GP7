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
include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
echo $strings[$this->string];
?>
</h2>
</p>
<p>
<h3>
<?php
echo '<a href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>";
?>
</h3>
</p>

</div>
</body>
</html>
<?php
} //fin metodo render

}
