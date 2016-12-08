<?php

include '../Models/LESION_Model.php';
include '../Models/REGISTRO_Model.php';
include '../Views/MENSAJE_Vista.php';
include '../Views/MENSAJE_LESION_Vista.php';

if (!IsAuthenticated()) {
    header('Location:../index.php');
}
include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
//Genera los includes según las páginas a las que tiene acceso
$pags = generarIncludes();

for ($z = 0; $z < count($pags); $z++) {
    include $pags[$z];
}

function get_data_form() {
//Recoge la información procedente del formulario

    $LESION_NOM = $_REQUEST['LESION_NOM'];
    $LESION_ESTADO = $_REQUEST['LESION_ESTADO'];

    //Realizamos las comprobaciones pertinentes para saber si nos encontramos en la Gestion de Empleados o en la Gestion de Lesiones
    if (isset($_REQUEST['LESION_ID'])) {
        $LESION_ID = $_REQUEST['LESION_ID'];
        if (isset($_REQUEST['EMP_USER'])) {
            $EMP_USER = $_REQUEST['EMP_USER'];
            if (isset($_REQUEST['LESION_DESC'])) {
                $LESION_DESC = $_REQUEST['LESION_DESC'];
                $lesion = new LESION_MODEL($LESION_ID, $LESION_NOM, $LESION_DESC, $LESION_ESTADO, $EMP_USER, '');
            } else {
                $lesion = new LESION_MODEL($LESION_ID, $LESION_NOM, '', $LESION_ESTADO, $EMP_USER, '');
            }
        } else {
            $CLIENTE_ID = $_REQUEST['CLIENTE_ID'];
            if (isset($_REQUEST['LESION_DESC'])) {
                $LESION_DESC = $_REQUEST['LESION_DESC'];
                $lesion = new LESION_MODEL($LESION_ID, $LESION_NOM, $LESION_DESC, $LESION_ESTADO, '', $CLIENTE_ID);
            } else {
                $lesion = new LESION_MODEL($LESION_ID, $LESION_NOM, '', $LESION_ESTADO, '', $CLIENTE_ID);
            }
        }
    } else {
        if (isset($_REQUEST['EMP_USER'])) {
            $EMP_USER = $_REQUEST['EMP_USER'];
            if (isset($_REQUEST['LESION_DESC'])) {
                $LESION_DESC = $_REQUEST['LESION_DESC'];
                $lesion = new LESION_MODEL('', $LESION_NOM, $LESION_DESC, $LESION_ESTADO, $EMP_USER, '');
            } else {
                $lesion = new LESION_MODEL('', $LESION_NOM, '', $LESION_ESTADO, $EMP_USER, '');
            }
        } else {
            $CLIENTE_ID = $_REQUEST['CLIENTE_ID'];
            if (isset($_REQUEST['LESION_DESC'])) {
                $LESION_DESC = $_REQUEST['LESION_DESC'];
                $lesion = new LESION_MODEL('', $LESION_NOM, $LESION_DESC, $LESION_ESTADO, '', $CLIENTE_ID);
            } else {
                $lesion = new LESION_MODEL('', $LESION_NOM, '', $LESION_ESTADO, '', $CLIENTE_ID);
            }
        }
    }

    return $lesion;
}

function get_data_form1() {

    if (isset($_REQUEST['EMP_USER'])) {
        $REGISTRO_CONSULTA_LESION_ID = $_REQUEST['REGISTRO_CONSULTA_LESION_ID'];
        echo $REGISTRO_CONSULTA_LESION_ID;
        $REGISTRO_CONSULTA_LESION_FECHAHORA1 = $_REQUEST['REGISTRO_CONSULTA_LESION_FECHAHORA1'];
        echo $REGISTRO_CONSULTA_LESION_FECHAHORA1,
        $REGISTRO_CONSULTA_LESION_FECHAHORA2 = $_REQUEST['REGISTRO_CONSULTA_LESION_FECHAHORA2'];
        // echo $REGISTRO_CONSULTA_LESION_FECHAHORA2;
        $USUARIO = $_REQUEST['USUARIO'];
        // echo $USUARIO;
        $EMP_USER = $_REQUEST['EMP_USER'];
        //echo $EMP_USER;

        $registro = new REGISTRO_MODEL($REGISTRO_CONSULTA_LESION_ID, $REGISTRO_CONSULTA_LESION_FECHAHORA1, $REGISTRO_CONSULTA_LESION_FECHAHORA2, $USUARIO, '', $EMP_USER);
    } else {
        $REGISTRO_CONSULTA_LESION_ID = $_REQUEST['REGISTRO_CONSULTA_LESION_ID'];
        $REGISTRO_CONSULTA_LESION_FECHAHORA1 = $_REQUEST['REGISTRO_CONSULTA_LESION_FECHAHORA1'];
        $REGISTRO_CONSULTA_LESION_FECHAHORA2 = $_REQUEST['REGISTRO_CONSULTA_LESION_FECHAHORA2'];
        $USUARIO = $_REQUEST['USUARIO'];
        $CLIENTE_ID = $_REQUEST['CLIENTE_ID'];

        $registro = new REGISTRO_MODEL($REGISTRO_CONSULTA_LESION_ID, $REGISTRO_CONSULTA_LESION_FECHAHORA1, $REGISTRO_CONSULTA_LESION_FECHAHORA2, $USUARIO, $CLIENTE_ID, '');
    }

    return $registro;
}

if (!isset($_REQUEST['accion'])) {
    $_REQUEST['accion'] = '';
}
Switch ($_REQUEST['accion']) {


    case $strings['Insertar']: //Insertar una nueva lesion
        if (!isset($_REQUEST['LESION_NOM'])) {
            if (isset($_REQUEST['EMP_USER'])) {
                if (!tienePermisos('LESION_Insertar')) {
                    new MENSAJE_LESION($respuesta, 'LESION_Controller.php?EMP_USER=', $_REQUEST['EMP_USER'], '');
                } else {
                    new LESION_Insertar('LESION_Controller.php?EMP_USER=', $_REQUEST['EMP_USER'], '');
                }
            } else {
                if (!tienePermisos('LESION_Insertar')) {
                    new MENSAJE_LESION($respuesta, 'LESION_Controller.php?CLIENTE_ID=', '', $_REQUEST['CLIENTE_ID']);
                } else {
                    new LESION_Insertar('LESION_Controller.php?CLIENTE_ID=', '', $_REQUEST['CLIENTE_ID']);
                }
            }
        } else {
            $lesion = get_data_form();
            $respuesta = $lesion->Insertar();
            if (isset($_REQUEST['EMP_USER'])) {
                new MENSAJE_LESION($respuesta, 'LESION_Controller.php?EMP_USER=', $_REQUEST['EMP_USER'], '');
            } else {
                new MENSAJE_LESION($respuesta, 'LESION_Controller.php?CLIENTE_ID=', '', $_REQUEST['CLIENTE_ID']);
            }
        }
        break;


    case $strings['Borrar']: //Borrar una lesion
        if (!isset($_REQUEST['LESION_NOM'])) {
            if (isset($_REQUEST['EMP_USER'])) {
                $lesion = new LESION_MODEL($_REQUEST['LESION_ID'], '', '', '', $_REQUEST['EMP_USER'], '');
                $valores = $lesion->RellenaDatos();
                if (!tienePermisos('LESION_Borrar')) {
                    new Mensaje_LESION($respuesta, 'LESION_Controller.php?EMP_USER=', $_REQUEST['EMP_USER'], '');
                } else
                    new LESION_Borrar($valores, 'LESION_Controller.php?EMP_USER=', $_REQUEST['EMP_USER'], '');
            } else {
                $lesion = new LESION_MODEL($_REQUEST['LESION_ID'], '', '', '', '', $_REQUEST['CLIENTE_ID']);
                $valores = $lesion->RellenaDatos();
                if (!tienePermisos('LESION_Borrar')) {
                    new Mensaje_LESION($respuesta, 'LESION_Controller.php?CLIENTE_ID=', '', $_REQUEST['CLIENTE_ID']);
                } else
                    new LESION_Borrar($valores, 'LESION_Controller.php?CLIENTE_ID=', '', $_REQUEST['CLIENTE_ID']);
            }
        } else {
            $lesion = get_data_form();
            $respuesta = $lesion->Borrar();

            if (isset($_REQUEST['EMP_USER'])) {
                new Mensaje_LESION($respuesta, 'LESION_Controller.php?EMP_USER=', $_REQUEST['EMP_USER'], '');
            } else
                new Mensaje_LESION($respuesta, 'LESION_Controller.php?CLIENTE_ID=', '', $_REQUEST['CLIENTE_ID']);
        }
        break;





    case $strings['Modificar']: //Modificar una lesion

        if (!isset($_REQUEST['LESION_NOM'])) {
            if (isset($_REQUEST['EMP_USER'])) {
                $lesion = new LESION_MODEL($_REQUEST['LESION_ID'], '', '', '', $_REQUEST['EMP_USER'], '');
                $valores = $lesion->RellenaDatos();
                if (!tienePermisos('LESION_Modificar')) {
                    new Mensaje_LESION($respuesta, 'LESION_Controller.php?EMP_USER=', $_REQUEST['EMP_USER'], '');
                } else {
                    new LESION_Modificar($valores, 'LESION_Controller.php?EMP_USER=', $_REQUEST['EMP_USER'], '');
                }
            } else {
                $lesion = new LESION_MODEL($_REQUEST['LESION_ID'], '', '', '', '', $_REQUEST['CLIENTE_ID']);
                $valores = $lesion->RellenaDatos();
                if (!tienePermisos('LESION_Modificar')) {
                    new Mensaje_LESION($respuesta, 'LESION_Controller.php?CLIENTE_ID=', '', $_REQUEST['CLIENTE_ID']);
                } else
                    new LESION_Modificar($valores, 'LESION_Controller.php?CLIENTE_ID=', '', $_REQUEST['CLIENTE_ID']);
            }
        } else {
            $lesion = get_data_form();
            $respuesta = $lesion->Modificar();
            if (isset($_REQUEST['EMP_USER'])) {
                new Mensaje_LESION($respuesta, 'LESION_Controller.php?EMP_USER=', $_REQUEST['EMP_USER'], '');
            } else
                new Mensaje_LESION($respuesta, 'LESION_Controller.php?CLIENTE_ID=', '', $_REQUEST['CLIENTE_ID']);
        }


        break;


    case $strings['Consultar']:  //Consulta de lesiones -> Se utiliza para filtrar el SHOW_ALL de Lesiones de un Usuario
        if (!isset($_REQUEST['LESION_NOM'])) {
            if (!tienePermisos('LESION_Consultar')) {
                new Mensaje('No tienes los permisos necesarios', 'EMPLEADOS_Controller.php');
            } else {
                if (isset($_REQUEST['EMP_USER'])) {
                    new LESION_Consultar('LESION_Controller.php?EMP_USER=', $_REQUEST['EMP_USER'], '');
                } else {
                    new LESION_Consultar('LESION_Controller.php?CLIENTE_ID=', '', $_REQUEST['CLIENTE_ID']);
                }
            }
        } else {
            $lesion = get_data_form();
            $datos = $lesion->Consultar();
            if (isset($_REQUEST['EMP_USER'])) {
                new LESION_Select($datos, '../Controllers/LESION_Controller.php?EMP_USER=', $_REQUEST['EMP_USER'], '');
            } else
                new LESION_Select($datos, '../Controllers/LESION_Controller.php?CLIENTE_ID=', '', $_REQUEST['CLIENTE_ID']);
        }
        break;

    case $strings['Filtrar']:  //Consulta de lesiones -> Se utiliza para filtrar el SHOW_ALL de Lesiones de un Usuario
        if (!isset($_REQUEST['REGISTRO_CONSULTA_LESION_ID'])) {
            if (isset($_REQUEST['EMP_USER'])) {
                new REGISTRO_Consultar('LESION_Controller.php?accion=Registro&EMP_USER=', $_REQUEST['EMP_USER'], '');
            } else {
                new REGISTRO_Consultar('LESION_Controller.php?CLIENTE_ID=', '', $_REQUEST['CLIENTE_ID']);
            }
        } else {
            $registro = get_data_form1();
            $datos = $registro->Consultar();
            if (isset($_REQUEST['EMP_USER'])) {
                new REGISTRO_Select($datos, '../Controllers/LESION_Controller.php?EMP_USER=', $_REQUEST['EMP_USER'], '');
            } else
                new LESION_Select($datos, '../Controllers/LESION_Controller.php?CLIENTE_ID=', '', $_REQUEST['CLIENTE_ID']);
        }
        break;



    case $strings['Registro']:  //Consulta de lesiones -> Se utiliza para filtrar el SHOW_ALL de Lesiones de un Usuario
        if (isset($_REQUEST['EMP_USER'])) {
            $lesion = new LESION_MODEL('', '', '', '', $_REQUEST['EMP_USER'], '');
            $datos = $lesion->ConsultarRegistro();
            if (!tienePermisos('LESION_Registro')) {
                new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php', $_REQUEST['EMP_USER'], '');
            } else {
                new LESION_Registro($datos, '../Controllers/LESION_Controller.php?EMP_USER=', $_REQUEST['EMP_USER'], '');
            }
        } else {
            $lesion = new LESION_MODEL('', '', '', '', '', $_REQUEST['CLIENTE_ID']);
            $datos = $lesion->ConsultarRegistro();
            if (!tienePermisos('LESION_Registro')) {
                new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php', '', $_REQUEST['CLIENTE_ID']);
            } else {
                new LESION_Registro($datos, '../Controllers/LESION_Controller.php?CLIENTE_ID=', '', $_REQUEST['CLIENTE_ID']);
            }
        }
        break;



    default:  //La vista por defecto lista las lesiones del usuario seleccionado (Empleado o Cliente)
        if (isset($_REQUEST['EMP_USER'])) {
            $lesion = new LESION_MODEL('', '', '', '', $_REQUEST['EMP_USER'], '');
            $datos = $lesion->ConsultarTodo();
            if (!tienePermisos('LESION_Show')) {
                new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php', $_REQUEST['EMP_USER'], '');
            } else {
                new LESION_Show($datos, '../Controllers/EMPLEADO_Controller.php', $_REQUEST['EMP_USER'], '');
            }
        } else {
            $lesion = new LESION_MODEL('', '', '', '', '', $_REQUEST['CLIENTE_ID']);
            $datos = $lesion->ConsultarTodo();
            if (!tienePermisos('LESION_Show')) {
                new Mensaje('No tienes los permisos necesarios', '../Views/DEFAULT_Vista.php', '', $_REQUEST['CLIENTE_ID']);
            } else {
                new LESION_Show($datos, '../Controllers/CLIENTE_Controller.php', '', $_REQUEST['CLIENTE_ID']);
            }
        }
}
?>
