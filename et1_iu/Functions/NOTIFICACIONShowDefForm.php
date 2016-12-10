<?php

//Definición del formulario para insertar y consultar lesiones
$form = array(
    0 => array(
        'type' => 'text',
        'name' => 'NOTIFICACION_REMITENTE',
        'value' => '',
        'size' => 35,
        'required' => true,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),

    1 => array(
        'type' => 'date',
        'name' => 'NOTIFICACION_FECHAHORA1',
        'value' => '',
        'min' => '1900-01-01',
        'max' => '2018-01-01',
        'required' => false,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    2 => array(
        'type' => 'date',
        'name' => 'NOTIFICACION_FECHAHORA2',
        'value' => '',
        'min' => '1900-01-01',
        'max' => '2018-01-01',
        'required' => false,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    ),
    3 => array(
        'type' => 'text',
        'name' => 'NOTIFICACION_DESTINATARIO',
        'value' => '',
        'size' => 35,
        'required' => false,
        'pattern' => '',
        'validation' => '',
        'readonly' => false
    )
    
);
