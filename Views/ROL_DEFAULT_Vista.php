<?php

class ROL_default{


function __construct(){	
	$this->render();
}

function render(){
?>

<div>
<p>
<h2>
<?php
include '../Locates/Strings_SPANISH.php';
include '../Models/ROL_ARRAY.php';
include '../Classes/ROL_gen_form_class.php';
$vistaDefault = new gen_form($arrayDefForm);
$vistaDefault->crear_formulario();

?>
</h2>
</p>
<p>
<h3>
<?php
echo '<a href=\'ROL_Controller.php\'>' . $strings['Volver'] . " </a>";
?>
</h3>
</p>

</div>

<?php
} //fin metodo render

}
