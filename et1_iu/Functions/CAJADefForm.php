<?php
//Formulario para añadir ingresos a la caja
$DefForm = array(
	0 => array(
	'type' => 'number',
	'name' => 'CAJA_INGRESOS',
	'value' => '',
	'min' => 0,
	'max' => 9999999999.99,
	'size' => 10,
	'required' => true,
	'pattern' => '([0-9]{1,10})([.]{0,1})([0-9]{0,2})',
	'validation' => 'step="any"',
	'readonly' => false
	)
	
)



?>
