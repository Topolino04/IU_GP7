<?php

//Funciones para la creación automática de formulario a partir de array

function createForm2($listFields, $fieldsDef, $strings, $values, $required, $noedit, $rol) {

    foreach ($listFields as $field) { //miro todos los campos que me piden en su orden
        for ($i = 0; $i < count($fieldsDef); $i++) { //recorro todos los campos de la definición de formulario para encontrarlo
            //echo $field . ':' . $fieldsDef[$i]['required'] . '<br>';
            if ($field == $fieldsDef[$i]['name'] || $field == $fieldsDef[$i]['value']) { //si es el que busco
                switch ($fieldsDef[$i]['type']) {
                    case 'text':
                        if (isset($fieldsDef[$i]['texto'])) {
                            $str = "\t" . $strings[$fieldsDef[$i]['texto']];
                        } else {
                            $str = "\t" . $strings[$fieldsDef[$i]['name']];
                        }
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {

                            if (!isset($required[$field])) {

                                $str .= 'required';
                            } else {
                                $str .= '';
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ><br>\n";
                        echo $str;
                        break;
                    case 'date':
                        $str = "\t" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " min = '" . $fieldsDef[$i]['min'] . "'";
                        $str .= " max = '" . $fieldsDef[$i]['max'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . ($values[$fieldsDef[$i]['name']]) . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {

                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ><br>\n";
                        echo $str;
                        break;
                    case 'email':
                        $str = "\t" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ><br>\n";
                        echo $str;
                        break;
                    case 'search':
                        break;
                    case 'url': //las url muestran enlace en otra pestaña
                        $str = "\t" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <a target='_blank' href='" . $values[$fieldsDef[$i]['name']] . "'>Ver</a>";
                        $str .= " <br>\n";
                        echo $str;
                        break;
                    case 'tel':
                        break;
                    case 'password':
                        $str = "\t" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ><br>\n";
                        echo $str;
                        break;
                    case 'number':
                        $str = "\t" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " min = '" . $fieldsDef[$i]['min'] . "'";
                        $str .= " max = '" . $fieldsDef[$i]['max'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ><br>\n";
                        echo $str;
                        break;
                    case 'checkbox':



                        $str = "\t" . $fieldsDef[$i]['value'];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";

                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }


                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }

                        $rolActual = consultarRol($_SESSION['login']);

                        $func = consultarFuncionalidadesRol($rolActual);



                        if ($rol === $rolActual && in_array($field, $func)) { //No se permite quitar funcionalidades a su propio rol
                            $str .= ' checked ';
                            $str .= ' onclick="javascript: return false;" ';
                        }


                        $str .= " ><br>\n";
                        echo $str;
                        break;
                    case 'radio':
                        break;
                    case 'file':
                        $str = "\t" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";

                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ><br>\n";
                        echo $str;
                        break;
                        ;
                    case 'select':
                        $str = "\t" . $strings[$fieldsDef[$i]['name']] . ": <select name='" . $fieldsDef[$i]['name'] . "'";
                        if ($noedit || $noedit[$field]) {
                            $str .= ' readonly ';
                        }
                        if ($fieldsDef[$i]['multiple'] == 'true') {
                            $str = $str . " multiple ";
                        }
                        $str = $str . " >";
                        foreach ($fieldsDef[$i]['options'] as $value) {
                            $str1 = "<option value = '" . $value . "'";
                            if (isset($values[$fieldsDef[$i]['name']])) {
                                if ($values[$fieldsDef[$i]['name']] == $value) {
                                    $str1 .= " selected ";
                                }
                            }
                            $str1 .= ">" . $value . "</option>";
                            $str = $str . $str1;
                        }
                        $str = $str . "</select><br>\n";
                        echo $str;
                        break;
                    case 'textarea':
                        break;
                    default:
                } //search, url, tel, email, password, date pickers, number, checkbox, radio y file
            }
        }
    }
}

function createForm3($listFields, $fieldsDef, $strings, $values, $required, $noedit, $pags) {

    foreach ($listFields as $field) { //miro todos los campos que me piden en su orden
        for ($i = 0; $i < count($fieldsDef); $i++) { //recorro todos los campos de la definición de formulario para encontrarlo
            //echo $field . ':' . $fieldsDef[$i]['required'] . '<br>';
            if ($field == $fieldsDef[$i]['name'] || $field == $fieldsDef[$i]['value']) { //si es el que busco
                switch ($fieldsDef[$i]['type']) {
                    case 'text':
                        if (isset($fieldsDef[$i]['texto'])) {
                            $str = "<li>" . $strings[$fieldsDef[$i]['texto']];
                        } else {
                            $str = "<li>" . $strings[$fieldsDef[$i]['name']];
                        }
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " id = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {

                            if (isset($required[$field])) {

                                $str .= 'required';
                            } else {
                                $str .= '';
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>";
                        echo $str;
                        break;
                    case 'date':
                        $str = "<li>" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " min = '" . $fieldsDef[$i]['min'] . "'";
                        $str .= " max = '" . $fieldsDef[$i]['max'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . ($values[$fieldsDef[$i]['name']]) . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {

                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= "required" . " ><br>";
                        echo $str;
                        break;
                    case 'email':
                        $str = "<li>" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= "required" . " ></li>";
                        echo $str;
                        break;
                    case 'search':
                        break;
                    case 'url':
                        $str = "<li>" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <a target='_blank' href='" . $values[$fieldsDef[$i]['name']] . "'>Ver</a>";
                        $str .= " </li>";
                        echo $str;
                        break;
                    case 'tel':
                        break;
                    case 'password':
                        $str = "<li>" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>\n";
                        echo $str;
                        break;
                    case 'number':
                        $str = "<li>" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " min = '" . $fieldsDef[$i]['min'] . "'";
                        $str .= " max = '" . $fieldsDef[$i]['max'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>\n";
                        echo $str;
                        break;
                    case 'checkbox':


                        $str = "<li>" . $fieldsDef[$i]['value'];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";

                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }


                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }


                        if (in_array($field, $pags)) {
                            $str .= ' checked ';
                        }
                        $str .= " ></li>";
                        echo $str;
                        break;
                    case 'radio':
                        break;
                    case 'file':
                        $str = "<li>" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";

                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>";
                        echo $str;
                        break;
                        ;
                    case 'select':
                        $str = "\t" . $strings[$fieldsDef[$i]['name']] . ": <select name='" . $fieldsDef[$i]['name'] . "'";
                        if ($noedit || $noedit[$field]) {
                            $str .= ' readonly ';
                        }
                        if ($fieldsDef[$i]['multiple'] == 'true') {
                            $str = $str . " multiple ";
                        }
                        $str = $str . " >";
                        foreach ($fieldsDef[$i]['options'] as $value) {
                            $str1 = "<option value = '" . $value . "'";
                            if (isset($values[$fieldsDef[$i]['name']])) {
                                if ($values[$fieldsDef[$i]['name']] == $value) {
                                    $str1 .= " selected ";
                                }
                            }
                            $str1 .= ">" . $value . "</option>";
                            $str = $str . $str1;
                        }
                        $str = $str . "</select></li>";
                        echo $str;
                        break;
                    case 'textarea':
                        break;
                    default:
                }
            }
        }
    }
}

function createForm($listFields, $fieldsDef, $strings, $values, $required, $noedit) {

    foreach ($listFields as $field) { //miro todos los campos que me piden en su orden
        for ($i = 0; $i < count($fieldsDef); $i++) { //recorro todos los campos de la definición de formulario para encontrarlo
            //echo $field . ':' . $fieldsDef[$i]['required'] . '<br>';
            if ($field == $fieldsDef[$i]['name'] || $field == $fieldsDef[$i]['value']) { //si es el que busco
                switch ($fieldsDef[$i]['type']) {
                    case 'text':
                        if (isset($fieldsDef[$i]['texto'])) {
                            $str = "<li>" . $strings[$fieldsDef[$i]['texto']];
                        } else {
                            $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>";
                        }
                        $str .= "<input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " id = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {

                            if (!isset($required[$field])) {

                                $str .= 'required';
                            } else {
                                $str .= '';
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>";
                        echo $str;
                        break;
                    case 'date':
                        $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>";
                        $str .= "<input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " min = '" . $fieldsDef[$i]['min'] . "'";
                        $str .= " max = '" . $fieldsDef[$i]['max'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . ($values[$fieldsDef[$i]['name']]) . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {

                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= "required" . " ></li>";
                        echo $str;
                        break;
                    case 'email':
                        $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>";
                        $str .= "<input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= "required" . " ></li>";
                        echo $str;
                        break;
                    case 'search':
                        break;
                    case 'url':

                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>";
                            $str .= "<a target='_blank' href='" . $values[$fieldsDef[$i]['name']] . "'>Ver</a>";
                            $str .= " <br>\n";
                            echo $str;
                        }
                        break;
                    case 'tel':
                        break;
                    case 'password':
                        $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>";
                        $str .= "<input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= "required" . " ></li>";
                        echo $str;
                        break;
                    case 'number':
                        $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>";
                        $str .= "<input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " min = '" . $fieldsDef[$i]['min'] . "'";
                        $str .= " max = '" . $fieldsDef[$i]['max'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>";
                        echo $str;
                        break;
                    case 'checkbox':

                        if (isset($strings[$fieldsDef[$i]['value']])) {
                            $str = "<li><label>" . $strings[$fieldsDef[$i]['value']] . "</label>";
                        } else {
                            $str = "<li><label>" . $fieldsDef[$i]['value'] . "</label>";
                        }
                        $str .= "<input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";

                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }


                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>";
                        echo $str;
                        break;
                    case 'radio':
                        break;
                    case 'file':
                        $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>";
                        $str .= "<input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";

                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>";
                        echo $str;
                        break;
                        ;
                    case 'select':
                        $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>" . "<select name='" . $fieldsDef[$i]['name'] . "'";
                        if ($noedit || $noedit[$field]) {
                            $str .= ' readonly ';
                        }
                        if ($fieldsDef[$i]['multiple'] == 'true') {
                            $str = $str . " multiple ";
                        }
                        $str = $str . " >";
                        foreach ($fieldsDef[$i]['options'] as $value) {
                            $str1 = "<option value = '" . $value . "'";
                            if (isset($values[$fieldsDef[$i]['name']])) {
                                if ($values[$fieldsDef[$i]['name']] == $value) {
                                    $str1 .= " selected ";
                                }
                            }
                            $str1 .= ">" . $value . "</option>";
                            $str = $str . $str1;
                        }
                        $str = $str . "</select></li>";
                        echo $str;
                        break;
                    case 'textarea':
                        break;
                    default:
                }
            }
        }
    }
}

function IsAuthenticated() {

    session_start();
    if (!isset($_SESSION['login'])) {

        return false;
    } else {

        return true;
    }
}

//Elimina la carpeta que se le pasa como argumento
function eliminarDir($carpeta) {
    foreach (glob($carpeta . "/*") as $archivos_carpeta) {


        if (is_dir($archivos_carpeta)) {
            eliminarDir($archivos_carpeta);
        } else {
            unlink($archivos_carpeta);
        }
    }

    rmdir($carpeta);
}

//Completa la lista de titulos con las funcionalidades disponibles
function AñadirFuncionesTitulos($array) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");




    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = 'SELECT FUNCIONALIDAD_NOM from FUNCIONALIDAD';
    $result = $mysqli->query($sql);

    while ($tipo = $result->fetch_array()) {
        array_push($array, $tipo['FUNCIONALIDAD_NOM']);
    }

    return $array;
}

//Añade al array de definición de formulario las entradas correspondientes a las funcionalidades añadidas
function AñadirFunciones($array) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");




    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = 'SELECT FUNCIONALIDAD_NOM from FUNCIONALIDAD';


    $result = $mysqli->query($sql);


    while ($tipo = $result->fetch_array()) {
        $array[count($array)] = array(
            'type' => 'checkbox',
            'name' => 'rol_funcionalidades[]',
            'value' => $tipo['FUNCIONALIDAD_NOM'],
            'size' => 20,
            'required' => true,
            'pattern' => '',
            'validation' => '',
            'readonly' => false);
    }

    return $array;
}

//Devuelve el ID de rol a partir del nombre
function ConsultarIDRol($ROL_NOM) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT ROL_ID FROM ROL WHERE ROL_NOM='" . $ROL_NOM . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['ROL_ID'];
}

//Devuelve el nombre de rol a partir del id de rol
function ConsultarNOMRol($ROL_ID) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT ROL_NOM FROM ROL WHERE ROL_ID='" . $ROL_ID . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['ROL_NOM'];
}

//Devuelve el id de una funcionalidad a partir del nombre
function ConsultarIDFuncionalidad($FUNCIONALIDAD_NOM) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT FUNCIONALIDAD_ID FROM FUNCIONALIDAD WHERE FUNCIONALIDAD_NOM='" . $FUNCIONALIDAD_NOM . "'";
    $result = $mysqli->query($sql)->fetch_array();

    return $result['FUNCIONALIDAD_ID'];
}

//Devuelve el nombre de una funcionalidad a partir de su id
function ConsultarNOMFuncionalidad($FUNCIONALIDAD_ID) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT FUNCIONALIDAD_NOM FROM FUNCIONALIDAD WHERE FUNCIONALIDAD_ID='" . $FUNCIONALIDAD_ID . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['FUNCIONALIDAD_NOM'];
}

//Devuelve el id de una página a partir de su nombre
function ConsultarIDPagina($PAGINA_NOM) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT PAGINA_ID FROM PAGINA WHERE PAGINA_NOM='" . $PAGINA_NOM . "'";
    $result = $mysqli->query($sql)->fetch_array();

    return $result['PAGINA_ID'];
}

//Devuelve el nombre de una pagina a partir de su id
function ConsultarNOMPagina($PAGINA_ID) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT PAGINA_NOM FROM PAGINA WHERE PAGINA_ID='" . $PAGINA_ID . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['PAGINA_NOM'];
}

//Añade al array los nombre de las paginas disponibles
function AñadirPaginasTitulos($array) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");




    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = 'SELECT PAGINA_NOM from PAGINA';
    $result = $mysqli->query($sql);

    while ($tipo = $result->fetch_array()) {
        array_push($array, $tipo['PAGINA_NOM']);
    }


    return $array;
}

//Añade al formulario de definicion las entradas correspondientes a las paginas disponibles
function AñadirPaginas($array) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");




    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = 'SELECT PAGINA_NOM from PAGINA';


    $result = $mysqli->query($sql);


    while ($tipo = $result->fetch_array()) {
        $array[count($array)] = array(
            'type' => 'checkbox',
            'name' => 'funcionalidad_paginas[]',
            'value' => $tipo['PAGINA_NOM'],
            'size' => 20,
            'required' => true,
            'pattern' => '',
            'validation' => '',
            'readonly' => false);
    }

    return $array;
}

//Genera un link para la página a partir de un nombre
function GenerarLinkPagina($PAGINA_NOM) {
    $link = str_replace(" ", "_", $PAGINA_NOM);

    $s = '../Views/';
    $s .= $link;
    $s .= '_Vista.php';
    return $s;
}

//Genera el link de un controlador a partir del nombre de la funcionalidad
function GenerarLinkControlador($CON_NOM) {
    $link = str_replace(" ", "_", $CON_NOM);

    $s = '../Controllers/';
    $s .= $link;
    $s .= '_Controller.php';
    return $s;
}

//Añade los roles al desplegable de tipos
function AñadirTipos($array) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = 'SELECT ROL_NOM from ROL';
    $result = $mysqli->query($sql);



    $str = array();
    while ($tipo = $result->fetch_array()) {
        array_push($str, $tipo['ROL_NOM']);
    }


    $añadido = array(
        'type' => 'select',
        'name' => 'EMP_TIPO',
        'multiple' => 'false',
        'value' => '',
        'options' => $str,
        'required' => 'true',
        'readonly' => false
    );


    $array[count($array)] = $añadido;
    return $array;
}

//crea un archivo en la direccion especificada
function crearArchivo($direccion) {
    $fp = fopen($direccion, "w+");
    $string = "<h1>En construcción</h1><br><a href='../Views/DEFAULT_Vista.php'>Back</a>";

    fputs($fp, $string);
    fclose($fp);
}

//Modifica el nombre de un archivo
function cambiarNombreArchivo($antiguo, $nuevo) {
    rename($antiguo, $nuevo);
}

//Borra el archivo en la direccion especificada
function borrarArchivo($direccion) {
    unlink($direccion);
}

//añade a la pagina default los enlaces correspondientes a las funcionalidades
function añadirFuncionalidades($NOM) {
    include '../Locates/Strings_' . $NOM['IDIOMA'] . '.php';
    include '../Locates/StringsCF_' . $NOM['IDIOMA'] . '.php';
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $rol = "SELECT EMP_TIPO FROM EMPLEADOS WHERE EMP_USER='" . $NOM['login'] . "'";
    $sql = "SELECT FUNCIONALIDAD_ID, ROL_ID FROM ROL_FUNCIONALIDAD WHERE ROL_ID=(" . $rol . ")";

    if (!($resultado = $mysqli->query($sql))) {
        echo 'Error en la consulta sobre la base de datos';
    } else {
        while ($fila = $resultado->fetch_array()) {

            $funcionalidad = ConsultarNOMFuncionalidad($fila['FUNCIONALIDAD_ID']);

            switch ($funcionalidad) {
                case "GESTION EMPLEADOS":
                    ?><a style="font-size:20px;" href='../Controllers/EMPLEADO_Controller.php'><?php echo $strings['Gestión de Empleados'] ?></a><br><br>  <?php
                    break;
                case "GESTION ROLES":
                    ?><a style="font-size:20px;" href='../Controllers/ROL_Controller.php'><?php echo $strings['Gestión de Roles'] ?></a><br><br> <?php
                    break;
                case "GESTION FUNCIONALIDADES":
                    ?> <a  style="font-size:20px;"href='../Controllers/FUNCIONALIDAD_Controller.php'><?php echo $strings['Gestión de Funcionalidades'] ?></a><br><br> <?php
                    break;
                case "GESTION PAGINAS":
                    ?><a style="font-size:20px;" href='../Controllers/PAGINA_Controller.php'><?php echo $strings['Gestión de Páginas'] ?></a><br><br> <?php
                    break;
                case "CONSULTA EMPLEADOS":
                    ?><a style="font-size:20px;" href='../Controllers/EMPLEADO_Controller.php'><?php echo $strings['Consulta de Empleados'] ?></a><br><br> <?php
                    break;
                case "GESTION PAGOS":
                    ?><a style="font-size:20px;" href='../Controllers/PAGO_Controller.php'><?php echo $strings['Gestión de Pagos'] ?></a><br><br> <?php
                    break;

                case "GESTION ACTIVIDADES":
                    ?><a style="font-size:20px;" href='../Controllers/ACTIVIDAD_Controller.php'><?php echo $strings['Gestión de Actividades'] ?></a><br><br> <?php
                    break;
                case "HACER CAJA":
                    ?><a style="font-size:20px;" href='../Controllers/CAJA_Controller.php'><?php echo $stringsCF['Hacer Caja'] ?></a><br><br> <?php
                    break;
               case "GESTION LESIONES":
                    break;
                case "GESTION HORARIO":
                    ?><a style="font-size:20px;" href='../Controllers/BLOQUE_Controller.php'><?php echo $strings['Gestion de Horario'] ?></a><br><br><?php
                    break;
                case "GESTION CLIENTES":
                    ?><a style="font-size:20px;" href='../Controllers/CLIENTE_Controller.php'><?php echo $strings['Gestion de Clientes'] ?></a><br><br><?php
                    break;
                 case "ENVIAR NOTIFICACION":
                    ?><a style="font-size:20px;" href='../Controllers/NOTIFICACION_Controller.php'><?php echo $strings['Enviar Notificacion'] ?></a><br><br> <?php
                    break;
		case "HACER CAJA":
                    ?><a style="font-size:20px;" href='../Controllers/CAJA_Controller.php'><?php echo $stringsCF['Hacer Caja'] ?></a><br><br> <?php
                    break;
		case "GESTION FACTURAS":
                    ?><a style="font-size:20px;" href='../Controllers/FACTURA_Controller.php'><?php echo $stringsCF['Gestion de Facturas'] ?></a><br><br> <?php
                    break;
                default:
                    $link = str_replace(" ", "_", ConsultarNOMFuncionalidad($fila['FUNCIONALIDAD_ID'])) . "_Controller.php";
                    echo "<a style='font-size:20px;'href='../Controllers/" . $link . "'>" . ConsultarNOMFuncionalidad($fila['FUNCIONALIDAD_ID']) . " </a><br><br>";
                    break;
            }
        }
    }
}

//Genera los includes correspondientes a las paginas a las que se tiene acceso
function generarIncludes() {

    $toret = array();
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT DISTINCT PAGINA.PAGINA_LINK FROM EMPLEADOS_PAGINA, PAGINA  WHERE PAGINA.PAGINA_ID=EMPLEADOS_PAGINA.PAGINA_ID AND EMPLEADOS_PAGINA.EMP_USER='" . $_SESSION['login'] . "'";


    if (!($resultado = $mysqli->query($sql))) {
        echo 'Error en la consulta sobre la base de datos';
    } else {
        while ($tupla = $resultado->fetch_array()) {

            array_push($toret, $tupla['PAGINA_LINK']);
        }
    }
    return $toret;
}

//Revisa si tiene permiso al comprobar si se ha incluido la clase a la que se quiere acceder
function tienePermisos($string) {
    return class_exists($string);
}

//Devuelve el rol de un usuario
function consultarRol($EMP_USER) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT EMP_TIPO FROM EMPLEADOS WHERE EMP_USER='" . $EMP_USER . "'";

    $result = $mysqli->query($sql)->fetch_array();
    return $result['EMP_TIPO'];
}

//Devuelve las funcionalidades asignadas a un rol
function consultarFuncionalidadesRol($rol) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");

    $toret = array();
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT FUNCIONALIDAD_NOM FROM FUNCIONALIDAD, ROL_FUNCIONALIDAD WHERE FUNCIONALIDAD.FUNCIONALIDAD_ID=ROL_FUNCIONALIDAD.FUNCIONALIDAD_ID AND ROL_FUNCIONALIDAD.ROL_ID=" . $rol;

    $result = $mysqli->query($sql);
    while ($tupla = $result->fetch_array()) {
        array_push($toret, $tupla['FUNCIONALIDAD_NOM']);
    }
    return $toret;
}

//Consulta las paginas asignadas a un usuario
function consultarPaginasEmp($user) {

    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
    $sql = "select PAGINA_ID from EMPLEADOS_PAGINA WHERE EMP_USER='" . $user . "'";

    if (!($resultado = $mysqli->query($sql))) {
        return 'Error en la consulta sobre la base de datos';
    } else {


        $toret = array();
        $i = 0;

        while ($fila = $resultado->fetch_array()) {


            $toret[$i] = ConsultarNOMPagina($fila['PAGINA_ID']);
            $i++;
        }


        return $toret;
    }
}

function createForm4($listFields, $fieldsDef, $strings, $values, $required, $noedit) {

    foreach ($listFields as $field) { //miro todos los campos que me piden en su orden
        for ($i = 0; $i < count($fieldsDef); $i++) { //recorro todos los campos de la definición de formulario para encontrarlo
            //echo $field . ':' . $fieldsDef[$i]['required'] . '<br>';
            if ($field == $fieldsDef[$i]['name'] || $field == $fieldsDef[$i]['value']) { //si es el que busco
                switch ($fieldsDef[$i]['type']) {
                    case 'text':
                        if (isset($fieldsDef[$i]['texto'])) {
                            $str = "<li>" . $strings[$fieldsDef[$i]['texto']];
                        } else {
                            $str = "\t" . $strings[$fieldsDef[$i]['name']];
                        }
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " id = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {

                            if (isset($required[$field])) {

                                $str .= 'required';
                            } else {
                                $str .= '';
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>";
                        echo $str;
                        break;
                    case 'date':
                        $str = "<li>" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " min = '" . $fieldsDef[$i]['min'] . "'";
                        $str .= " max = '" . $fieldsDef[$i]['max'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . ($values[$fieldsDef[$i]['name']]) . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {

                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= "required" . " ></li>";
                        echo $str;
                        break;
                    case 'email':
                        $str = "<li>" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= "required" . " ></li>";
                        echo $str;
                        break;
                    case 'search':
                        break;
                    case 'url':
                        $str = "<li>" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <a target='_blank' href='" . $values[$fieldsDef[$i]['name']] . "'>Ver</a>";
                        $str .= " </li>";
                        echo $str;
                        break;
                    case 'tel':
                        break;
                    case 'password':
                        $str = "<li>" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>";
                        echo $str;
                        break;
                    case 'number':
                        $str = "<li>" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " min = '" . $fieldsDef[$i]['min'] . "'";
                        $str .= " max = '" . $fieldsDef[$i]['max'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>";
                        echo $str;
                        break;
                    case 'checkbox':


                        $str = "<li>" . $fieldsDef[$i]['value'];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";

                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }


                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ><br>\n";
                        echo $str;
                        break;
                    case 'radio':
                        break;
                    case 'file':
                        $str = "<li>" . $strings[$fieldsDef[$i]['name']];
                        $str .= " : <input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";

                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>";
                        echo $str;
                        break;
                        ;
                    case 'select':
                        $str = "<li>" . $strings[$fieldsDef[$i]['name']] . ": <select name='" . $fieldsDef[$i]['name'] . "'";
                        if ($noedit || $noedit[$field]) {
                            $str .= ' readonly ';
                        }
                        if ($fieldsDef[$i]['multiple'] == 'true') {
                            $str = $str . " multiple ";
                        }
                        $str = $str . " >";
                        foreach ($fieldsDef[$i]['options'] as $value) {
                            $str1 = "<option value = '" . $value . "'";
                            if (isset($values[$fieldsDef[$i]['name']])) {
                                if ($values[$fieldsDef[$i]['name']] == $value) {
                                    $str1 .= " selected ";
                                }
                            }
                            $str1 .= ">" . $value . "</option>";
                            $str = $str . $str1;
                        }
                        $str = $str . "</select></li>";
                        echo $str;
                        break;
                    case 'textarea':
                        break;
                    default:
                }
            }
        }
    }
}

//Consulta la tabla Clientes y obtiene el ID de un cliente a partir de su DNI
function consultarIDCliente($CLIENTE_DNI) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT CLIENTE_ID FROM CLIENTE WHERE CLIENTE_DNI='" . $CLIENTE_DNI . "'";
    if (!$busqueda = $mysqli->query($sql)) {
        return FALSE;
    } else {
        $resultado = $busqueda->fetch_array();
        return $resultado['CLIENTE_ID'];
    }
}

function consultarDNICliente($CLIENTE_ID) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT CLIENTE_DNI FROM CLIENTE WHERE CLIENTE_ID='" . $CLIENTE_ID . "'";
    if (!$busqueda = $mysqli->query($sql)) {
        return FALSE;
    } else {
        $resultado = $busqueda->fetch_array();
        return $resultado['CLIENTE_DNI'];
    }
}

function consultarIDClientePAGO($PAGO_ID) { //REVISAR FUNCIONAMIENTO
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT * FROM PAGO WHERE PAGO_ID='" . $PAGO_ID . "'";
    if (!$busqueda = $mysqli->query($sql)) {
        return FALSE;
    } else {
        $resultado = $busqueda->fetch_array();
        return $resultado['CLIENTE_ID'];
    }
}

function generarRecibo($PAGO_ID, $PAGO_FECHA, $EMPLEADO, $CLIENTE_ID, $PAGO_CONCEPTO, $PAGO_IMPORTE) {
    $template = file_get_contents('../Recibos/recibo_template.txt');
    $template = str_replace('[PAGO_ID]', $PAGO_ID, $template);
    $template = str_replace('[PAGO_FECHA]', $PAGO_FECHA, $template);
    $template = str_replace(['[EMPLEADO]'], $EMPLEADO, $template);
    $template = str_replace('[CLIENTE_ID]', $CLIENTE_ID, $template);
    $template = str_replace('[PAGO_CONCEPTO]', $PAGO_CONCEPTO, $template);
    $template = str_replace('[PAGO_IMPORTE]', $PAGO_IMPORTE, $template);
    $template = str_replace('[PAGO_DESCUENTO]', 100 * (1 - CalcularDescuentoCliente($CLIENTE_ID)), $template);
    $template = str_replace('[PAGO_IMPORTE_TOTAL]', round($PAGO_IMPORTE * CalcularDescuentoCliente($CLIENTE_ID), 2), $template);
    $recibo_ID = '../Recibos/Recibo_' . $PAGO_ID . '.txt';
    file_put_contents($recibo_ID, $template);
}

function CalcularDescuentoCliente($CLIENTE_ID) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT SUM(DESCUENTO.DESCUENTO_VALOR) AS TOTAL
			FROM CLIENTE_TIENE_DESCUENTO, DESCUENTO
			WHERE CLIENTE_TIENE_DESCUENTO.DESCUENTO_ID = DESCUENTO.DESCUENTO_ID
			AND  CLIENTE_TIENE_DESCUENTO.CLIENTE_ID = {$CLIENTE_ID}";
    $result = $mysqli->query($sql);
    $resultado = $result->fetch_array();
    $res = 1 - (((float) $resultado["TOTAL"]) / 100);
    if ($res < 0) {
        return 0;
    } else {
        return $res;
    }
}

function consultarEstadoPago($PAGO_ID) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT * FROM PAGO WHERE PAGO_ID='" . $PAGO_ID . "'";
    if (!$busqueda = $mysqli->query($sql)) {
        return FALSE; //No se va a producir
    } else {
        $resultado = $busqueda->fetch_array();
        if ($resultado['PAGO_ESTADO'] === 'PAGADO') {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

function consultarNomActividad($ACTIVIDAD_ID) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT ACTIVIDAD_NOMBRE FROM ACTIVIDAD WHERE ACTIVIDAD_ID='" . $ACTIVIDAD_ID . "'";
    if (!$busqueda = $mysqli->query($sql)) {
        return FALSE;
    } else {
        $resultado = $busqueda->fetch_array();
        return $resultado['ACTIVIDAD_NOMBRE'];
    }
}
function consultarNomLesion($LESION_ID) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT LESION_NOM FROM LESION WHERE LESION_ID='" . $LESION_ID . "'";
    if (!$busqueda = $mysqli->query($sql)) {
        return false;
    } else {
        $resultado = $busqueda->fetch_array();
        return $resultado['LESION_NOM'];
    }
}
function consultarNomLugar($LUGAR_ID) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT LUGAR_NOMBRE FROM LUGAR WHERE LUGAR_ID='" . $LUGAR_ID . "'";
    if (!$busqueda = $mysqli->query($sql)) {
        return false;
    } else {
        $resultado = $busqueda->fetch_array();
        return $resultado['LUGAR_NOMBRE'];
    }
}
function AñadirLugares($array) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = 'SELECT LUGAR_NOMBRE from LUGAR';
    $result = $mysqli->query($sql);



    $str = array();
    while ($tipo = $result->fetch_array()) {
        array_push($str, $tipo['LUGAR_NOMBRE']);
    }


    $añadido = array(
        'type' => 'select',
        'name' => 'BLOQUE_LUGAR',
        'multiple' => 'false',
        'value' => '',
        'options' => $str,
        'required' => 'true',
        'readonly' => false
    );


    $array[count($array)] = $añadido;
    return $array;
}
function ConsultarIDLugar($LUGAR_NOMBRE) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT LUGAR_ID FROM LUGAR WHERE LUGAR_NOMBRE='" . $LUGAR_NOMBRE . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['LUGAR_ID'];
}

function generarCalendario(){
    include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
    $rango=diasSemana(strtotime(date('Y-m-d')));
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql1 = "SELECT BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI ,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3 FROM HORARIO WHERE BLOQUE_DIA='1'".$rango;

    $sql2 = "SELECT BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI ,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3  FROM HORARIO WHERE BLOQUE_DIA='2'".$rango;
    $sql3 = "SELECT  BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI ,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3  FROM HORARIO WHERE BLOQUE_DIA='3'".$rango;
    $sql4 = "SELECT BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI ,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3  FROM HORARIO WHERE BLOQUE_DIA='4'".$rango;
    $sql5 = "SELECT BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3  FROM HORARIO WHERE BLOQUE_DIA='5'".$rango;
    $sql6 = "SELECT BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3  FROM HORARIO WHERE BLOQUE_DIA='6'".$rango;
    //$result = $mysqli->query($sql)->fetch_array(); ?>

    <h2 align="center"><a href="../Views/DEFAULT1_Vista.php"><img  height="30px" src="../images/previous.jpg"  /></a> <?php echo diasSemana2(strtotime(date('Y-m-d'))) ?> <a href="../Views/DEFAULT2_Vista.php"><img height="30px" src="../images/next.jpg"  /></a> </h2>

    <table class="horario" style="font-size: 12px" border = 1>
        <tr>
            <th colspan="2"></th>
            <th class="azul borde_especial" ><?php  echo $strings['Lunes'] ?></th>
            <th colspan="2"></th>
            <th class="azul borde_especial"><?php  echo$strings['Martes'] ?></th>
            <th colspan="2"></th>
            <th class="azul borde_especial"><?php  echo$strings['Miercoles'] ?></th>
            <th colspan="2"></th>
            <th class="azul borde_especial"><?php  echo$strings['Jueves'] ?></th>
            <th colspan="2"></th>
            <th class="azul borde_especial"><?php  echo$strings['Viernes'] ?></th>
            <th colspan="2"></th>
            <th class="azul borde_especial"><?php  echo$strings['Sabado'] ?></th>
        </tr> <?php


        $result1=$mysqli->query($sql1);
        $result2=$mysqli->query($sql2);
        $result3=$mysqli->query($sql3);
        $result4=$mysqli->query($sql4);
        $result5=$mysqli->query($sql5);
        $result6=$mysqli->query($sql6);


        $a=0;
        while($lunes= $result1->fetch_array()){
            $calendario['lunes'][$a]=$lunes;
            $a++;
        }
        $b=0;
        while($martes= $result2->fetch_array()){
            $calendario['martes'][$b]=$martes;
            $b++;
        }
        $c=0;
        while($miercoles= $result3->fetch_array()){
            $calendario['miercoles'][$c]=$miercoles;
            $c++;
        }
        $d=0;
        while($jueves= $result4->fetch_array()){
            $calendario['jueves'][$d]=$jueves;
            $d++;
        }
        $e=0;
        while($viernes= $result5->fetch_array()){
            $calendario['viernes'][$e]=$viernes;
            $e++;
        }
        $f=0;
        while($sabado= $result6->fetch_array()){
            $calendario['sabado'][$f]=$sabado;
            $f++;
        }
        $mayor=0;
        foreach($calendario as $dia){
            if(count($dia)>$mayor){
                $mayor=count($dia);
            }
        }

        for($i=0;$i<$mayor;$i++){

            ?>      <tr>
                <th class="lila" ><?php  if(! isset($calendario['lunes'][$i])) echo ''; else echo $calendario['lunes'][$i]['BLOQUE_HORAI']."-".$calendario['lunes'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['lunes'][$i])) echo ''; else  echo consultarNomLugar($calendario['lunes'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['lunes'][$i])) echo ''; else echo generarLinksCalendario($calendario['lunes'][$i])?></td>
                <th class="lila"><?php  if(! isset($calendario['martes'][$i])) echo ''; else echo $calendario['martes'][$i]['BLOQUE_HORAI']."-".$calendario['martes'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['martes'][$i])) echo ''; else  echo consultarNomLugar($calendario['martes'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['martes'][$i])) echo ''; else  echo generarLinksCalendario($calendario['martes'][$i])?></td>
                <th class="lila"><?php  if(! isset($calendario['miercoles'][$i])) echo ''; else echo $calendario['miercoles'][$i]['BLOQUE_HORAI']."-".$calendario['miercoles'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['miercoles'][$i])) echo ''; else  echo consultarNomLugar($calendario['miercoles'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['miercoles'][$i])) echo ''; else  echo generarLinksCalendario($calendario['miercoles'][$i])?></td>
                <th class="lila"><?php  if(! isset($calendario['jueves'][$i])) echo ''; else echo $calendario['jueves'][$i]['BLOQUE_HORAI']."-".$calendario['jueves'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['jueves'][$i])) echo ''; else  echo consultarNomLugar($calendario['jueves'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['jueves'][$i])) echo ''; else  echo generarLinksCalendario($calendario['jueves'][$i])?></td>
                <th class="lila"><?php  if(! isset($calendario['viernes'][$i])) echo ''; else echo $calendario['viernes'][$i]['BLOQUE_HORAI']."-".$calendario['viernes'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['viernes'][$i])) echo ''; else  echo consultarNomLugar($calendario['viernes'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['viernes'][$i])) echo ''; else  echo generarLinksCalendario($calendario['viernes'][$i])?></td>
                <th class="lila"><?php  if(! isset($calendario['sabado'][$i])) echo ''; else echo $calendario['sabado'][$i]['BLOQUE_HORAI']."-".$calendario['sabado'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['sabado'][$i])) echo ''; else  echo consultarNomLugar($calendario['sabado'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['sabado'][$i])) echo ''; else  echo generarLinksCalendario($calendario['sabado'][$i])?></td>
            </tr>
            <?php
        } ?>
    </table> <?php

}
function generarCalendarioAnt(){
    include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
    $fecha = date('Y-m-d');
    $nuevafecha = strtotime ( '-7 day' , strtotime ( $fecha ) ) ;
    $rango=diasSemana( $nuevafecha);
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql1 = "SELECT BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI ,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3 FROM HORARIO WHERE BLOQUE_DIA='1'".$rango;

    $sql2 = "SELECT BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI ,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3  FROM HORARIO WHERE BLOQUE_DIA='2'".$rango;
    $sql3 = "SELECT  BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI ,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3  FROM HORARIO WHERE BLOQUE_DIA='3'".$rango;
    $sql4 = "SELECT BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI ,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3  FROM HORARIO WHERE BLOQUE_DIA='4'".$rango;
    $sql5 = "SELECT BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3  FROM HORARIO WHERE BLOQUE_DIA='5'".$rango;
    $sql6 = "SELECT BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3  FROM HORARIO WHERE BLOQUE_DIA='6'".$rango;
    //$result = $mysqli->query($sql)->fetch_array(); ?>

    <h2 align="center"><?php echo diasSemana2( $nuevafecha) ?> <a href="../Views/DEFAULT_Vista.php"><img height="30px" src="../images/next.jpg"  /></a> </h2>

    <table class="horario" style="font-size: 12px" border = 1>
        <tr>
            <th colspan="2"></th>
            <th class="azul borde_especial" ><?php  echo $strings['Lunes'] ?></th>
            <th colspan="2"></th>
            <th class="azul borde_especial"><?php  echo$strings['Martes'] ?></th>
            <th colspan="2"></th>
            <th class="azul borde_especial"><?php  echo$strings['Miercoles'] ?></th>
            <th colspan="2"></th>
            <th class="azul borde_especial"><?php  echo$strings['Jueves'] ?></th>
            <th colspan="2"></th>
            <th class="azul borde_especial"><?php  echo$strings['Viernes'] ?></th>
            <th colspan="2"></th>
            <th class="azul borde_especial"><?php  echo$strings['Sabado'] ?></th>
        </tr> <?php


        $result1=$mysqli->query($sql1);
        $result2=$mysqli->query($sql2);
        $result3=$mysqli->query($sql3);
        $result4=$mysqli->query($sql4);
        $result5=$mysqli->query($sql5);
        $result6=$mysqli->query($sql6);


        $a=0;
        while($lunes= $result1->fetch_array()){
            $calendario['lunes'][$a]=$lunes;
            $a++;
        }
        $b=0;
        while($martes= $result2->fetch_array()){
            $calendario['martes'][$b]=$martes;
            $b++;
        }
        $c=0;
        while($miercoles= $result3->fetch_array()){
            $calendario['miercoles'][$c]=$miercoles;
            $c++;
        }
        $d=0;
        while($jueves= $result4->fetch_array()){
            $calendario['jueves'][$d]=$jueves;
            $d++;
        }
        $e=0;
        while($viernes= $result5->fetch_array()){
            $calendario['viernes'][$e]=$viernes;
            $e++;
        }
        $f=0;
        while($sabado= $result6->fetch_array()){
            $calendario['sabado'][$f]=$sabado;
            $f++;
        }
        $mayor=0;
        foreach($calendario as $dia){
            if(count($dia)>$mayor){
                $mayor=count($dia);
            }
        }

        for($i=0;$i<$mayor;$i++){

            ?>      <tr>
                <th class="lila" ><?php  if(! isset($calendario['lunes'][$i])) echo ''; else echo $calendario['lunes'][$i]['BLOQUE_HORAI']."-".$calendario['lunes'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['lunes'][$i])) echo ''; else  echo consultarNomLugar($calendario['lunes'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['lunes'][$i])) echo ''; else echo generarLinksCalendario($calendario['lunes'][$i])?></td>
                <th class="lila"><?php  if(! isset($calendario['martes'][$i])) echo ''; else echo $calendario['martes'][$i]['BLOQUE_HORAI']."-".$calendario['martes'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['martes'][$i])) echo ''; else  echo consultarNomLugar($calendario['martes'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['martes'][$i])) echo ''; else  echo generarLinksCalendario($calendario['martes'][$i])?></td>
                <th class="lila"><?php  if(! isset($calendario['miercoles'][$i])) echo ''; else echo $calendario['miercoles'][$i]['BLOQUE_HORAI']."-".$calendario['miercoles'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['miercoles'][$i])) echo ''; else  echo consultarNomLugar($calendario['miercoles'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['miercoles'][$i])) echo ''; else  echo generarLinksCalendario($calendario['miercoles'][$i])?></td>
                <th class="lila"><?php  if(! isset($calendario['jueves'][$i])) echo ''; else echo $calendario['jueves'][$i]['BLOQUE_HORAI']."-".$calendario['jueves'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['jueves'][$i])) echo ''; else  echo consultarNomLugar($calendario['jueves'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['jueves'][$i])) echo ''; else  echo generarLinksCalendario($calendario['jueves'][$i])?></td>
                <th class="lila"><?php  if(! isset($calendario['viernes'][$i])) echo ''; else echo $calendario['viernes'][$i]['BLOQUE_HORAI']."-".$calendario['viernes'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['viernes'][$i])) echo ''; else  echo consultarNomLugar($calendario['viernes'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['viernes'][$i])) echo ''; else  echo generarLinksCalendario($calendario['viernes'][$i])?></td>
                <th class="lila"><?php  if(! isset($calendario['sabado'][$i])) echo ''; else echo $calendario['sabado'][$i]['BLOQUE_HORAI']."-".$calendario['sabado'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['sabado'][$i])) echo ''; else  echo consultarNomLugar($calendario['sabado'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['sabado'][$i])) echo ''; else  echo generarLinksCalendario($calendario['sabado'][$i])?></td>
            </tr>
            <?php
        } ?>
    </table> <?php

}
function generarCalendarioSig(){
    include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
    $fecha = date('Y-m-d');
    $nuevafecha = strtotime ( '+7 day' , strtotime ( $fecha ) ) ;
    $rango=diasSemana( $nuevafecha);
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql1 = "SELECT BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI ,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3 FROM HORARIO WHERE BLOQUE_DIA='1'".$rango;

    $sql2 = "SELECT BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI ,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3  FROM HORARIO WHERE BLOQUE_DIA='2'".$rango;
    $sql3 = "SELECT  BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI ,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3  FROM HORARIO WHERE BLOQUE_DIA='3'".$rango;
    $sql4 = "SELECT BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI ,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3  FROM HORARIO WHERE BLOQUE_DIA='4'".$rango;
    $sql5 = "SELECT BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3  FROM HORARIO WHERE BLOQUE_DIA='5'".$rango;
    $sql6 = "SELECT BLOQUE_ID, TIME_FORMAT(BLOQUE_HORAI,'%H:%i') AS BLOQUE_HORAI,  TIME_FORMAT(BLOQUE_HORAF,'%H:%i') AS BLOQUE_HORAF, BLOQUE_LUGAR, BLOQUE_ACT1, BLOQUE_ACT2, BLOQUE_ACT3, BLOQUE_EV1, BLOQUE_EV2, BLOQUE_EV3  FROM HORARIO WHERE BLOQUE_DIA='6'".$rango;
    //$result = $mysqli->query($sql)->fetch_array(); ?>

    <h2  align="center"> <a href="../Views/DEFAULT_Vista.php"><img height="30px" src="../images/previous.jpg"  /></a><?php echo diasSemana2( $nuevafecha) ?> </h2>

    <table class="horario" style="font-size: 12px" border = 1>
        <tr>
            <th colspan="2"></th>
            <th class="azul borde_especial" ><?php  echo $strings['Lunes'] ?></th>
            <th colspan="2"></th>
            <th class="azul borde_especial"><?php  echo$strings['Martes'] ?></th>
            <th colspan="2"></th>
            <th class="azul borde_especial"><?php  echo$strings['Miercoles'] ?></th>
            <th colspan="2"></th>
            <th class="azul borde_especial"><?php  echo$strings['Jueves'] ?></th>
            <th colspan="2"></th>
            <th class="azul borde_especial"><?php  echo$strings['Viernes'] ?></th>
            <th colspan="2"></th>
            <th class="azul borde_especial"><?php  echo$strings['Sabado'] ?></th>
        </tr> <?php


        $result1=$mysqli->query($sql1);
        $result2=$mysqli->query($sql2);
        $result3=$mysqli->query($sql3);
        $result4=$mysqli->query($sql4);
        $result5=$mysqli->query($sql5);
        $result6=$mysqli->query($sql6);


        $a=0;
        while($lunes= $result1->fetch_array()){
            $calendario['lunes'][$a]=$lunes;
            $a++;
        }
        $b=0;
        while($martes= $result2->fetch_array()){
            $calendario['martes'][$b]=$martes;
            $b++;
        }
        $c=0;
        while($miercoles= $result3->fetch_array()){
            $calendario['miercoles'][$c]=$miercoles;
            $c++;
        }
        $d=0;
        while($jueves= $result4->fetch_array()){
            $calendario['jueves'][$d]=$jueves;
            $d++;
        }
        $e=0;
        while($viernes= $result5->fetch_array()){
            $calendario['viernes'][$e]=$viernes;
            $e++;
        }
        $f=0;
        while($sabado= $result6->fetch_array()){
            $calendario['sabado'][$f]=$sabado;
            $f++;
        }
        $mayor=0;
        foreach($calendario as $dia){
            if(count($dia)>$mayor){
                $mayor=count($dia);
            }
        }

        for($i=0;$i<$mayor;$i++){

            ?>      <tr>
                <th class="lila" ><?php  if(! isset($calendario['lunes'][$i])) echo ''; else echo $calendario['lunes'][$i]['BLOQUE_HORAI']."-".$calendario['lunes'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['lunes'][$i])) echo ''; else  echo consultarNomLugar($calendario['lunes'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['lunes'][$i])) echo ''; else echo generarLinksCalendario($calendario['lunes'][$i])?></td>
                <th class="lila"><?php  if(! isset($calendario['martes'][$i])) echo ''; else echo $calendario['martes'][$i]['BLOQUE_HORAI']."-".$calendario['martes'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['martes'][$i])) echo ''; else  echo consultarNomLugar($calendario['martes'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['martes'][$i])) echo ''; else  echo generarLinksCalendario($calendario['martes'][$i])?></td>
                <th class="lila"><?php  if(! isset($calendario['miercoles'][$i])) echo ''; else echo $calendario['miercoles'][$i]['BLOQUE_HORAI']."-".$calendario['miercoles'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['miercoles'][$i])) echo ''; else  echo consultarNomLugar($calendario['miercoles'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['miercoles'][$i])) echo ''; else  echo generarLinksCalendario($calendario['miercoles'][$i])?></td>
                <th class="lila"><?php  if(! isset($calendario['jueves'][$i])) echo ''; else echo $calendario['jueves'][$i]['BLOQUE_HORAI']."-".$calendario['jueves'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['jueves'][$i])) echo ''; else  echo consultarNomLugar($calendario['jueves'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['jueves'][$i])) echo ''; else  echo generarLinksCalendario($calendario['jueves'][$i])?></td>
                <th class="lila"><?php  if(! isset($calendario['viernes'][$i])) echo ''; else echo $calendario['viernes'][$i]['BLOQUE_HORAI']."-".$calendario['viernes'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['viernes'][$i])) echo ''; else  echo consultarNomLugar($calendario['viernes'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['viernes'][$i])) echo ''; else  echo generarLinksCalendario($calendario['viernes'][$i])?></td>
                <th class="lila"><?php  if(! isset($calendario['sabado'][$i])) echo ''; else echo $calendario['sabado'][$i]['BLOQUE_HORAI']."-".$calendario['sabado'][$i]['BLOQUE_HORAF']?></th>
                <td><?php  if(! isset($calendario['sabado'][$i])) echo ''; else  echo consultarNomLugar($calendario['sabado'][$i]['BLOQUE_LUGAR'])?></td>
                <td><?php if(! isset($calendario['sabado'][$i])) echo ''; else  echo generarLinksCalendario($calendario['sabado'][$i])?></td>
            </tr>
            <?php
        } ?>
    </table> <?php

}
function diasSemana($date){
    $day=date('d',$date);
    $month=date('m',$date);
    $year=date('Y',$date);
# Obtenemos el día de la semana de la fecha dada
    $diaSemana=date("w",mktime(0,0,0,$month,$day,$year));

# el 0 equivale al domingo...
    if($diaSemana==0)
        $diaSemana=7;

# A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
    $primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));

# A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo
    $ultimoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(7-$diaSemana),$year));

    return " AND BLOQUE_FECHA BETWEEN '".$primerDia."' AND '".$ultimoDia."' ORDER BY BLOQUE_HORAI";
}
function diasSemana2($date){
    $day=date('d',$date);
    $month=date('m',$date);
    $year=date('Y',$date);
# Obtenemos el día de la semana de la fecha dada
    $diaSemana=date("w",mktime(0,0,0,$month,$day,$year));

# el 0 equivale al domingo...
    if($diaSemana==0)
        $diaSemana=7;

# A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
    $primerDia=date("d/m/Y",mktime(0,0,0,$month,$day-$diaSemana+1,$year));

# A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo
    $ultimoDia=date("d/m/Y",mktime(0,0,0,$month,$day+(7-$diaSemana),$year));

    return $primerDia." - ".$ultimoDia;
}
function generarLinksCalendario($bloque){

    $toret='';
    foreach($bloque as $clave=>$valor) {
        if ($valor !== '0' && $clave!==0 ) {
            switch ($clave){
                case 'BLOQUE_ACT1':
                    $toret .= "<a  href='../Controllers/BLOQUE_Controller.php?actividad=" .$bloque['BLOQUE_ACT1'] . "&accion=clase'>" . consultarNomActividad($bloque['BLOQUE_ACT1']) . "</a></br>";
                    break;
                case 'BLOQUE_ACT2':
                    $toret .= "<a  href='../Controllers/BLOQUE_Controller.php?actividad=" . $bloque['BLOQUE_ACT2'] . "&accion=clase'>" . consultarNomActividad($bloque['BLOQUE_ACT2']) . "</a></br>";
                    break;
                case 'BLOQUE_ACT3':
                    $toret .= "<a  href='../Controllers/BLOQUE_Controller.php?actividad=" . $bloque['BLOQUE_ACT3'] . "&accion=clase'>" . consultarNomActividad($bloque['BLOQUE_ACT3']) . "</a></br>";
                    break;
                case 'BLOQUE_EV1':
                    $toret .= "<a  href='../Controllers/BLOQUE_Controller.php?evento=" . $bloque['BLOQUE_EV1'] . "&accion=clase'>" . consultarNomEvento($bloque['BLOQUE_EV1']) . "</a></br>";
                    break;
                case 'BLOQUE_EV2':
                    $toret .= "<a  href='../Controllers/BLOQUE_Controller.php?evento=" . $bloque['BLOQUE_EV2'] . "&accion=clase'>" . consultarNomEvento($bloque['BLOQUE_EV2']) . "</a></br>";
                    break;
                case 'BLOQUE_EV3':
                    $toret .= "<a  href='../Controllers/BLOQUE_Controller.php?evento=" . $bloque['BLOQUE_EV3'] . "&accion=clase'>" . consultarNomEvento($bloque['BLOQUE_EV3']) . "</a></br>";
                    break;
            }

        }
    }
    return $toret;
}
function consultarNomEmp($EMP_USER){
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT EMP_NOMBRE from EMPLEADOS WHERE EMP_USER='".$EMP_USER."'";
    $result = $mysqli->query($sql);

    $nombre=$result->fetch_array()['EMP_NOMBRE'];
    return $nombre;

}
function consultarNomCli($CLIENTE_ID){
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT CLIENTE_NOMBRE from CLIENTE WHERE CLIENTE_ID='".$CLIENTE_ID."'";

    $result = $mysqli->query($sql);

    $nombre=$result->fetch_array()['CLIENTE_NOMBRE'];
    return $nombre;

}
function infoActividad($ACTIVIDAD_ID){
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT ACTIVIDAD_NOMBRE from ACTIVIDAD WHERE ACTIVIDAD_ID='".$ACTIVIDAD_ID."'";
    $result = $mysqli->query($sql);

    $nombre=$result->fetch_array()['ACTIVIDAD_NOMBRE'];
    $sql = "SELECT EMP_USER from EMPLEADOS_IMPARTE_ACTIVIDAD WHERE ACTIVIDAD_ID='".$ACTIVIDAD_ID."'";

    $result = $mysqli->query($sql);
    $profesores=array();
    while($profesor=$result->fetch_array()){
        array_push($profesores, consultarNomEmp($profesor['EMP_USER']));
    }
    $sql = "SELECT CLIENTE_ID from CLIENTE_INSCRIPCION_ACTIVIDAD WHERE ACTIVIDAD_ID='".$ACTIVIDAD_ID."'";
    $result = $mysqli->query($sql);
    $alumnos=array();
    while($alumno=$result->fetch_array()){
        array_push($alumnos, consultarNomCli($alumno['CLIENTE_ID']));
    }
    $toret=array ('CLASE_NOMBRE'=>$nombre,'CLASE_PROFESORES'=>$profesores,'CLASE_ALUMNOS'=>$alumnos);
    return $toret;
}
function infoEvento($EVENTO_ID){
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT EVENTO_NOMBRE from EVENTO WHERE EVENTO_ID='".$EVENTO_ID."'";

    $result = $mysqli->query($sql);

    $nombre=$result->fetch_array()['EVENTO_NOMBRE'];
    $sql = "SELECT EVENTO_ORGANIZADOR from EVENTO WHERE EVENTO_ID='".$EVENTO_ID."'";

    $result = $mysqli->query($sql);
    $profesores=array();
    while($profesor=$result->fetch_array()){
        array_push($profesores, $profesor['EVENTO_ORGANIZADOR']);
    }
    $sql = "SELECT CLIENTE_ID from CLIENTE_PARTICIPA_EVENTO WHERE EVENTO_ID='".$EVENTO_ID."'";
    $result = $mysqli->query($sql);
    $alumnos=array();
    while($alumno=$result->fetch_array()){
        array_push($alumnos, consultarNomCli($alumno['CLIENTE_ID']));
    }
    $toret=array ('CLASE_NOMBRE'=>$nombre,'CLASE_PROFESORES'=>$profesores,'CLASE_ALUMNOS'=>$alumnos);
    return $toret;
}

function AñadirActividades($array) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = 'SELECT ACTIVIDAD_NOMBRE from ACTIVIDAD';
    $result = $mysqli->query($sql);



    $str = array('');
    while ($tipo = $result->fetch_array()) {
        array_push($str, $tipo['ACTIVIDAD_NOMBRE']);
    }


    $añadido = array(
        'type' => 'select',
        'name' => 'BLOQUE_ACT1',
        'multiple' => 'false',
        'value' => '',
        'options' => $str,
        'required' => 'true',
        'readonly' => false
    );


    $array[count($array)] = $añadido;
    $añadido = array(
        'type' => 'select',
        'name' => 'BLOQUE_ACT2',
        'multiple' => 'false',
        'value' => '',
        'options' => $str,
        'required' => 'true',
        'readonly' => false
    );
    $array[count($array)] = $añadido;
    $añadido = array(
        'type' => 'select',
        'name' => 'BLOQUE_ACT3',
        'multiple' => 'false',
        'value' => '',
        'options' => $str,
        'required' => 'true',
        'readonly' => false
    );
    $array[count($array)] = $añadido;
    return $array;
}
function AñadirEventos($array) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = 'SELECT EVENTO_NOMBRE from EVENTO';
    $result = $mysqli->query($sql);



    $str = array('');
    while ($tipo = $result->fetch_array()) {
        array_push($str, $tipo['EVENTO_NOMBRE']);
    }


    $añadido = array(
        'type' => 'select',
        'name' => 'BLOQUE_EV1',
        'multiple' => 'false',
        'value' => '',
        'options' => $str,
        'required' => 'true',
        'readonly' => false
    );


    $array[count($array)] = $añadido;
    $añadido = array(
        'type' => 'select',
        'name' => 'BLOQUE_EV2',
        'multiple' => 'false',
        'value' => '',
        'options' => $str,
        'required' => 'true',
        'readonly' => false
    );
    $array[count($array)] = $añadido;
    $añadido = array(
        'type' => 'select',
        'name' => 'BLOQUE_EV3',
        'multiple' => 'false',
        'value' => '',
        'options' => $str,
        'required' => 'true',
        'readonly' => false
    );
    $array[count($array)] = $añadido;
    return $array;
}
function consultarNomEvento($EVENTO_ID) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT EVENTO_NOMBRE FROM EVENTO WHERE EVENTO_ID='" . $EVENTO_ID . "'";
    if (!$busqueda = $mysqli->query($sql)) {
        return FALSE;
    } else {
        $resultado = $busqueda->fetch_array();
        return $resultado['EVENTO_NOMBRE'];
    }
}
function ConsultarIDEvento($EVENTO_NOMBRE) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT EVENTO_ID FROM EVENTO WHERE EVENTO_NOMBRE='" . $EVENTO_NOMBRE . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['EVENTO_ID'];
}
function ConsultarIDActividad($ACTIVIDAD_NOMBRE) {
    $mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");


    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT ACTIVIDAD_ID FROM ACTIVIDAD WHERE ACTIVIDAD_NOMBRE='" . $ACTIVIDAD_NOMBRE . "'";
    $result = $mysqli->query($sql)->fetch_array();
    return $result['ACTIVIDAD_ID'];
}


function createFormI($listFields, $fieldsDef, $strings, $values, $required, $noedit) {

    foreach ($listFields as $field) { //miro todos los campos que me piden en su orden
        for ($i = 0; $i < count($fieldsDef); $i++) { //recorro todos los campos de la definición de formulario para encontrarlo
            //echo $field . ':' . $fieldsDef[$i]['required'] . '<br>';
            if ($field == $fieldsDef[$i]['name'] || $field == $fieldsDef[$i]['value']) { //si es el que busco
                switch ($fieldsDef[$i]['type']) {
                    case 'text':
                        if (isset($fieldsDef[$i]['texto'])) {
                            $str = "<li>" . $strings[$fieldsDef[$i]['texto']];
                        } else {
                            $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>";
                        }
                        $str .= "<input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " id = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {

                            if (!isset($required[$field])) {

                                $str .= 'required';
                            } else {
                                $str .= '';
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>";
                        echo $str;
                        break;
                    case 'date':
                        $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>";
                        $str .= "<input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " min = '" . $fieldsDef[$i]['min'] . "'";
                        $str .= " max = '" . $fieldsDef[$i]['max'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . ($values[$fieldsDef[$i]['name']]) . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= '';
                            } else {
                                $str .= ' required ';
                            }
                        } else {

                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                       $str .= " ></li>";
                        echo $str;
                        break;
                    case 'email':
                        $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>";
                        $str .= "<input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= "required" . " ></li>";
                        echo $str;
                        break;
                    case 'search':
                        break;
                    case 'url':

                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>";
                            $str .= "<a target='_blank' href='" . $values[$fieldsDef[$i]['name']] . "'>Ver</a>";
                            $str .= " <br>\n";
                            echo $str;
                        }
                        break;
                    case 'tel':
                        break;
                    case 'password':
                        $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>";
                        $str .= "<input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= "required" . " ></li>";
                        echo $str;
                        break;
                    case 'number':
                        $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>";
                        $str .= "<input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " min = '" . $fieldsDef[$i]['min'] . "'";
                        $str .= " max = '" . $fieldsDef[$i]['max'] . "'";
                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>";
                        echo $str;
                        break;
                    case 'checkbox':

                        if (isset($strings[$fieldsDef[$i]['value']])) {
                            $str = "<li><label>" . $strings[$fieldsDef[$i]['value']] . "</label>";
                        } else {
                            $str = "<li><label>" . $fieldsDef[$i]['value'] . "</label>";
                        }
                        $str .= "<input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";
                        $str .= " size = '" . $fieldsDef[$i]['size'] . "'";

                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }


                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>";
                        echo $str;
                        break;
                    case 'radio':
                        break;
                    case 'file':
                        $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>";
                        $str .= "<input type = '" . $fieldsDef[$i]['type'] . "'";
                        $str .= " name = '" . $fieldsDef[$i]['name'] . "'";

                        if (isset($values[$fieldsDef[$i]['name']])) {
                            $str .= " value = '" . $values[$fieldsDef[$i]['name']] . "'";
                        } else {
                            $str .= " value = '" . $fieldsDef[$i]['value'] . "'";
                        }
                        if ($fieldsDef[$i]['pattern'] <> '') {
                            $str .= " pattern = '" . $fieldsDef[$i]['pattern'] . "'";
                        }
                        if ($fieldsDef[$i]['validation'] <> '') {
                            $str .= " " . $fieldsDef[$i]['validation'];
                        }

                        if (is_bool($required)) {
                            if (!$required) {
                                $str .= ' ';
                            } else {
                                $str .= ' required ';
                            }
                        } else {
                            if (isset($required[$field])) {
                                if (!$required[$field]) {
                                    $str .= ' ';
                                } else {
                                    $str -= ' required ';
                                }
                            }
                        }

                        if (is_bool($noedit)) {
                            if ($noedit) {
                                $str .= ' readonly ';
                            }
                        } else {
                            if (isset($noedit[$field])) {
                                if ($noedit[$field]) {
                                    $str .= ' readonly ';
                                }
                            }
                        }
                        $str .= " ></li>";
                        echo $str;
                        break;
                        ;
                    case 'select':
                        $str = "<li><label>" . $strings[$fieldsDef[$i]['name']] . "</label>" . "<select name='" . $fieldsDef[$i]['name'] . "'";
                        if ($noedit || $noedit[$field]) {
                            $str .= ' readonly ';
                        }
                        if ($fieldsDef[$i]['multiple'] == 'true') {
                            $str = $str . " multiple ";
                        }
                        $str = $str . " >";
                        foreach ($fieldsDef[$i]['options'] as $value) {
                            $str1 = "<option value = '" . $value . "'";
                            if (isset($values[$fieldsDef[$i]['name']])) {
                                if ($values[$fieldsDef[$i]['name']] == $value) {
                                    $str1 .= " selected ";
                                }
                            }
                            $str1 .= ">" . $value . "</option>";
                            $str = $str . $str1;
                        }
                        $str = $str . "</select></li>";
                        echo $str;
                        break;
                    case 'textarea':
                        break;
                    default:
                }
            }
        }
    }
}

function existeCliente($CLIENTE_NIF, $CLIENTE_NOMBRE, $CLIENTE_APELLIDOS)
	{
		//Función para comprobar si un nif ya existe, para evitar que haya dos personas con nombres y/o apellidos diferentes y el mismo nif
		$mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
		if ($mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$sql = "SELECT CLIENTE_NOMBRE,CLIENTE_APELLIDOS FROM CLIENTE WHERE CLIENTE_DNI = '".$CLIENTE_NIF."'";
		$resultado=$mysqli->query($sql);
		if ($resultado->num_rows==0){
			return false;
		}
		else{
			$resultado=$resultado->fetch_array();
		    if ($resultado['CLIENTE_NOMBRE'] == $CLIENTE_NOMBRE AND $resultado['CLIENTE_APELLIDOS'] == $CLIENTE_APELLIDOS){
				return false;	
            }
            else {
				return true;
            }
		}

	}
function consultarID($CLIENTE_NIF, $CLIENTE_NOMBRE, $CLIENTE_APELLIDOS)
	{
		//Función para consultar el id de un cliente, si al crear una nueva factura el cliente no existe, lo introduce en la base de datos,
		//si ya existe simplemente crea la factura

		$mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
		if ($mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$sql = "SELECT CLIENTE_ID FROM CLIENTE WHERE CLIENTE_DNI = '".$CLIENTE_NIF."'";
        $resultado=$mysqli->query($sql);


		    if ($resultado->num_rows==0){
				$unidad = 1;
				$sql = "SELECT COALESCE(MAX(CLIENTE_ID),0) AS MAXIMO FROM CLIENTE";
				$resultado = $mysqli->query($sql);
				$result = $resultado->fetch_array();
				$max = $result['MAXIMO'];
				$result=$max+$unidad;
		        $sql = "INSERT INTO CLIENTE (CLIENTE_ID, CLIENTE_DNI, CLIENTE_NOMBRE, CLIENTE_APELLIDOS) VALUES (".$result.", '".$CLIENTE_NIF."', '".$CLIENTE_NOMBRE."', '".$CLIENTE_APELLIDOS."')";
				$resultado=$mysqli->query($sql);
				return $result;
					
            }
            else {
				$result =  $resultado->fetch_array();
				$result = $result['CLIENTE_ID'];
				return $result;
            }

	}
	
function sePuedeModificar($FACTURA_ID)
	{
		//Función para verificar si una factura se puede modificar
		$mysqli = new mysqli("localhost", "iu2016", "iu2016", "IU2016");
		if ($mysqli->connect_errno) {
			echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$sql = "SELECT FACTURA_ESTADO FROM FACTURA WHERE FACTURA_ID = ".$FACTURA_ID." AND FACTURA_ESTADO = 'COBRADA'";
		$resultado=$mysqli->query($sql);
		if ($resultado->num_rows==0){
			return true;
		}
		else{
			return false;
		}

	}


?>
