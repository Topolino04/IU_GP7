<?php
//Formulario para la gestión de roles
$form = array(
	0 => array(
		'type' => 'time',
		'name' => 'BLOQUE_HORAF',
		'value' => '00:00',
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	1=>array(
		'type' => 'select',
		'name' => 'BLOQUE_DIA',
		'multiple' => 'false',
		'value' => '',
		'options' => array($strings['Lunes'],$strings['Martes'],$strings['Miercoles'],$strings['Jueves'],$strings['Viernes'], $strings['Sabado']),
		'required' => 'true',
		'readonly' => false
	),

	2 => array(
		'type' => 'time',
		'name' => 'BLOQUE_HORAI',
		'value' => '00:00',
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	),
	3=>array(
		'type' => 'text',
		'name' => 'BLOQUE_ID',
		'value' => '',
		'size' => 50,
		'required' => true,
		'pattern' => '',
		'validation' => '',
		'readonly' => false
	)

);
$DefForm=AñadirHorarios($form);


?>
