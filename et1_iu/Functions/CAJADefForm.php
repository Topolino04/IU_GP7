<?php
//Formulario para hacer caja
$DefForm = array(
	0 => array(
	'type' => 'number',
	'name' => 'CAJA_INGRESOS',
	'value' => '',
	'min' => 1,
	'max' => 9999999999.99,
	'size' => 10,
	'required' => true,
	'pattern' => '{0-9}{1,10}',
	'validation' => '',
	'readonly' => false
	)
	
)



?>
