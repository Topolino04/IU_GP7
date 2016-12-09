<?php
$DefForm = array(
	0 => array(
	'type' => 'number',
	'name' => 'LUGAR_ID',
	'value' => '',
	'min' => 1,
	'max' => 9999999999,
	'size' => 10,
	'required' => true,
	'pattern' => '{0-9}{1,10}',
	'validation' => '',
	'readonly' => false
	),
	
	1 => array(
	'type' => 'text',
	'name' => 'LUGAR_NOMBRE',
	'value' => '',
	'size' => 20,
	'required' => true,
	'pattern' => '{a-z}{A-Z}{0-9}{1,20}',
	'validation' => 'maxlength="20"',
	'readonly' => false
)
)



?>
