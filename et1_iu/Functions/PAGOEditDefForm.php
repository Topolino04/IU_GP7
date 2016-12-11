<?php

//Definición del formulario que muestra la informacion completa de cada pago.
//Formulario para la modificacion de pagos

$form = array(
    0 => array(
        'type' => 'text',
        'name' => 'PAGO_ID',
        'value' => '',
        'size' => 5,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    1 => array(
        'type' => 'text',
        'name' => 'PAGO_IMPORTE',
        'value' => '',
        'size' => 10,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    2 => array(
        'type' => 'text',
        'name' => 'PAGO_CONCEPTO',
        'value' => '',
        'size' => 75,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    3 => array(
        'type' => 'text',
        'name' => 'CLIENTE_DNI', //CLIENTE_ID FUNCIONA----- !!! -----
        'value' => '',
        'size' => 10,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
);
//$DefForm = añadirFunciones($form);//MODIFICAR
?>
