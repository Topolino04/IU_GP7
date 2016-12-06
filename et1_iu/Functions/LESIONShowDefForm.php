<?php

//Definición del formulario para insertar y consultar lesiones
$form = array(

      0 => array(
        'type' => 'text',
        'name' => 'LESION_ID',
        'value' => '',
        'size' => 10,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
       1 => array(
        'type' => 'text',
        'name' => 'LESION_NOM',
        'value' => '',
        'size' => 35,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    2 => array(
        'type' => 'text',
        'name' => 'LESION_DESC',
        'value' => '',
        'size' => 75,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    3 => array(
		'type' => 'select',
		'name' => 'LESION_ESTADO',
		'multiple' => 'false',
		'value' => '',
		'options' => array(' ', 'Superada','Pendiente','Cronica'),
		'required' => 'true',
		'readonly' => true
	)
    
    );
//$DefForm = añadirFunciones($form); //MODIFICAR ?


//     0 => array(
//        'type' => 'text',
//        'name' => 'PAGO_ID',
//        'value' => '',
//        'size' => 50,
//        'required' => true,
//        'pattern' => '',
//        'validation' => '',
//        'readonly' => false
//    ),
//    3 => array(
//        'type' => 'date',
//        'name' => 'PAGO_FECHA',
//        'value' => '2000-01-01',
//        'min' => '1900-01-01',
//        'max' => '3000-01-01',
//        'required' => true,
//        'pattern' => '',
//        'validation' => '',
//        'readonly' => false
//    ),
  
    

?>