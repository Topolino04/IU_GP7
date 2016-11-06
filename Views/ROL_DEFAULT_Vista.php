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
echo "</br>" ;

?>
</h2>
</p>
<p>
<h3>
</h3>
</p>

</div>

<?php
} //fin metodo render

}
