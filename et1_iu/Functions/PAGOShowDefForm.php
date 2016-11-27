<?php
//Definición del formulario que muestra la informacion completa de cada pago.
//Formulario para la consulta de pagos
$form = array(
    0 => array(
        'type' => 'text',
        'name' => 'PAGO_ID',
        'value' => '',
        'size' => 50,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    1 => array(
        'type' => 'text',
        'name' => 'PAGO_IMPORTE',
        'value' => '',
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    2 => array(
        'type' => 'text',
        'name' => 'PAGO_CONCEPTO',
        'value' => '',
        'size' => 155,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    3 => array(
        'type' => 'date',
        'name' => 'PAGO_FECHA',
        'value' => '2000-01-01',
        'min' => '1900-01-01',
        'max' => '3000-01-01',
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    4 => array(
        'type' => 'text',
        'name' => 'PAGO_CLIENTE',
        'value' => '',
        'size' => 50,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    
);
//$DefForm = añadirFunciones($form);//MODIFICAR
?>
