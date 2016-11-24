<?php

?>
<html>

<head>
    <?php
    $GLOBALS['host']="localhost";
    $GLOBALS['user']="root";
    $GLOBALS['password']="root";
    $GLOBALS['db']="scotchbox";
//VISTA PRINCIPAL

  
    include '../Functions/InterfaceFunctions.php';
    include '../Functions/LibraryFunctions.php';
    if (!IsAuthenticated()){
        header('Location:../index.php');
    }
    include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';
    ?>
    <meta charset="utf-8" />
    <title><?php echo $strings['Menu Principal'];?></title>
    <link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../Styles/responstable.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../Styles/print.css" media="print" />
</head>
<body>
<div id="wrapper">

    <nav><!-- #Aqui la barra para cerrar sesión y más cosas si se quieren -->

        <div class="menu">

            <ul>
                <li><a href="../Functions/Desconectar.php"><?php echo  $strings['Cerrar Sesión']; ?></a></li>
                <li><?php echo $strings['Usuario'].": ". $_SESSION['login']; ?></li>
            </ul>



        </div>
    </nav><!-- end of top nav -->

    <header><!-- header -->
        <div id="plandesign"></div>
        <a href="../index.php"><img style="margin:auto; margin-left: 40px;" height="120px" src="../images/logo_moovett1.png"  /></a>

    </header><!-- end of header -->

    <section id="main"><!-- #main content and sidebar area -->
        <section id="content"><!-- #content -->

            <article>
                <h2><a href="../index.php"><?php echo $strings['Calendario'];?></a></h2><!--AQUI EL TITULO DE LA GESTION/ESCENARIO-->
                <p><!--CALENDARIO-->
                    <style type="text/css">

                        .horario {width:90%; border-collapse: collapse; border:3px solid grey;}
                        .tabla_colores {width:50%; border-collapse: collapse; border:3px solid grey;}
                        .colores {width:25%}
                        tr {width:100%; border-collapse: collapse; border:1px solid grey}
                        td,th {width:12,86%;border-collapse: collapse; border:1px solid grey; color:black; text-align:center;}
                        th {font-size:15px; text-transform:uppercase; color: #F11FC2;}
                        .borde {border:solid 3px grey;}
                        .borde_especial {border: #FF0077 3px dotted;}
                        .sin_borde {border:1px solid transparent;}
                        .sin_borde_dcha { border-right:1px solid transparent;}
                        .dcha {font-size: 12px;}
                        .amarillo {background-color:#ffff99;}
                        .verde {background-color:#ccffcc;}
                        .lila {background-color:#cc99ff}
                        .azul {background-color:#99ccff}
                        .rosa_mn {background-color:#F9B1DE}
                        .rojo {background-color: #F75451}
                        .rosa {background-color: #ffccff}
                        .fucsia {background-color: #FF0077}
                        .azul_osc {background-color: #3366cc}
                    </style>
                <table class="horario">
                    <tr>
                        <th colspan="2"></th>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miércoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>Sábado</th>
                    </tr>
                    <tr>
                        <th class="rosa">10 - 11</th>
                        <td>Sala 1</td>
                        <td class="rosa_mn">Bodyjump<br/><span class="dcha">Oscar</span></td>
                        <td class="rosa_mn">Zumba<br/><span class="dcha">Uxía</span></td>
                        <td class="rosa_mn">Entren. Funcional<br/><span class="dcha">Juan</span></td>
                        <td class="rosa_mn">Zumba/Latinos<br/><span class="dcha">Uxía/Juan</span></td>
                        <td class="rosa_mn">Matt Pilates<br/><span class="dcha">Uxía</span></td>
                        <td class="rojo" rowspan="5">10:00 - 12:00<br/>Krav Maga<br/><span class="dcha">David</span></td>
                    </tr>
                    <tr class="borde">
                        <td colspan="2" class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                    </tr>
                    <tr>
                        <th class="rosa" rowspan="3">11 - 12</th>
                        <td>Sala 1</td>
                        <td class="rosa_mn">Entren. Funcional<br/><span class="dcha">Juan</span></td>
                        <td class="rosa_mn">Bodyjump<br/><span class="dcha">Oscar</span></td>
                        <td class="rosa_mn">Zumba<br/><span class="dcha">Elva</span></td>
                        <td class="rosa_mn">Matt Pilates<br/><span class="dcha">Uxía</span></td>
                        <td class="rosa_mn">Zumba/Latinos<br/><span class="dcha">Uxía/Juan</span></td>
                    </tr>
                    <tr>
                        <td>Sala 2</td>
                        <td class="lila">P. Reformer<br/><span class="dcha">Uxía</span></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sala 3</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="borde">
                        <td colspan="2" class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                    </tr>
                    <tr>
                        <th class="rosa" colspan="2">12:30 - 13:10</th>
                        <td></td>
                        <td class="lila">Gold Yoga<br/><span class="dcha">Deanne</span></td>
                        <td></td>
                        <td class="lila">Gold Pilates<br/><span class="dcha">Uxía</span></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="borde">
                        <td colspan="2" class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                    </tr>
                    <tr>
                        <th class="rosa" rowspan="3">16 - 17</th>
                        <td>Sala 1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sala 2</td>
                        <td class="lila">Matt Pilates<br/><span class="dcha">Uxía</span></td>
                        <td></td>
                        <td class="lila">P. Reformer<br/><span class="dcha">Uxía</span></td>
                        <td class="borde_especial lila">Matt Pilates<br/><span class="dcha">Uxía</span></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sala 3</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="azul">Moder Hip Adult<br/><span class="dcha">Lucas</span></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="borde">
                        <td colspan="2" class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                    </tr>
                    <tr>
                        <th class="rosa" rowspan="3">17 - 18</th>
                        <td>Sala 1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sala 2</td>
                        <td class="borde_especial lila">P. Reformer<br/><span class="dcha">Uxía</span></td>
                        <td></td>
                        <td class="borde_especial lila">P. Reformer<br/><span class="dcha">Uxía</span></td>
                        <td class="lila">P.Reformer<br/><span class="dcha">Uxía</span></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sala 3</td>
                        <td></td>
                        <td></td>
                        <td class="verde">Zumba<br/><span class="dcha">Elva</span></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="borde">
                        <td colspan="2" class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                    </tr>
                    <tr>
                        <th class="rosa" rowspan="3">18 - 19</th>
                        <td>Sala 1</td>
                        <td class="borde_especial lila">Yoga Embaraz.<br/><span class="dcha">Deanne</span></td>
                        <td></td>
                        <td class="verde">Zumba<br/><span class="dcha">Elva</span></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sala 2</td>
                        <td class="lila">Matt Pilates<br/><span class="dcha">Uxía</span></td>
                        <td class="borde_especial amarillo">Yoga Kids Inglés<br/><span class="dcha">Deanne</span></td>
                        <td class="borde_especial lila">Yoga Embaraz.<br/><span class="dcha">Deanne</span></td>
                        <td class="borde_especial amarillo">Yoga Kids Inglés<br/><span class="dcha">Deanne</span></td>
                        <td class="borde_especial verde">Zumba<br/><span class="dcha">Elva</span></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sala 3</td>
                        <td></td>
                        <td class="borde_especial amarillo">Baila con mamá<br/><span class="dcha">Uxía</span></td>
                        <td class="amarillo">Zumba Kids<br/><span class="dcha">Uxía</span></td>
                        <td class="lila">Matt Pilates<br/><span class="dcha">Uxía</span></td>
                        <td class="rojo">Krav Maga<br/><span class="dcha">David</span></td>
                        <td></td>
                    </tr>
                    <tr class="borde">
                        <td colspan="2" class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                    </tr>
                    <tr>
                        <th class="rosa" rowspan="3">19 - 20</th>
                        <td>Sala 1</td>
                        <td class="amarillo borde_especial">Bodyjump Kids<br/><span class="dcha">Oscar</span></td>
                        <td class="amarillo borde_especial">Bodyjump Kids<br/><span class="dcha">Oscar</span></td>
                        <td class="verde">Bundafit<br/><span class="dcha">Elva</span></td>
                        <td class="verde">Bodyjump<br/><span class="dcha">Oscar</span></td>
                        <td class="azul">R. Latinos Inic 2<br/><span class="dcha">Juan</span></td>
                        <td class="azul">R. Latinos Inic 1<br/><span class="dcha">Juan</span></td>
                    </tr>
                    <tr>
                        <td>Sala 2</td>
                        <td class="verde borde_especial">Bundafit<br/><span class="dcha">Elva</span></td>
                        <td class="borde_especial verde">Zumba<br/><span class="dcha">Elva</span></td>
                        <td class="lila">P. Reformer<br/><span class="dcha">Uxía</span></td>
                        <td class="amarillo">Ballet<br/><span class="dcha">Olga</span></td>
                        <td class="verde borde_especial">Zumba<br/><span class="dcha">Mónica</span></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sala 3</td>
                        <td class="verde borde_especial">Zumba<br/><span class="dcha">Uxía</span></td>
                        <td class="lila">Matt Pilates<br/><span class="dcha">Uxía</span></td>
                        <td class="amarillo">Hip-Hop<br/><span class="dcha">Lucas</span></td>
                        <td class="lila">Matt Pilates<br/><span class="dcha">Uxía</span></td>
                        <td class="rojo">Krav Maga<br/><span class="dcha">David</span></td>
                        <td></td>
                    </tr>
                    <tr class="borde">
                        <td colspan="2" class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                    </tr>
                    <tr>
                        <th class="rosa" rowspan="3">20 - 21</th>
                        <td>Sala 1</td>
                        <td class="azul borde_especial">Salsa Línea Inic 1<br/><span class="dcha">Juan</span></td>
                        <td class="azul">Salsa Línea Medio 1<br/><span class="dcha">Juan</span></td>
                        <td class="azul">Bachata Inic 2<br/><span class="dcha">Juan</span></td>
                        <td class="azul borde_especial">R. Latinos Inic 1<br/><span class="dcha">Juan</span></td>
                        <td class="azul borde_especial">R. Latinos Inic 1<br/><span class="dcha">Juan</span></td>
                        <td class="azul borde_especial">Salsa Línea Inic 1<br/><span class="dcha">Juan</span></td>
                    </tr>
                    <tr>
                        <td>Sala 2</td>
                        <td class="azul">Baile de Salón<br/><span class="dcha">Olga</span></td>
                        <td class="verde borde_especial">Zumba<br/><span class="dcha">Elva</span></td>
                        <td class="lila">P. Reformer<br/><span class="dcha">Uxía</span></td>
                        <td class="azul">Sevillanas<br/><span class="dcha">Olga</span></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sala 3</td>
                        <td class="verde borde_especial">Zumba<br/><span class="dcha">Uxía</span></td>
                        <td class="lila">Matt Pilates<br/><span class="dcha">Uxía</span></td>
                        <td class="verde">Bundafit<br/><span class="dcha">Elva</span></td>
                        <td class="lila">Matt Pilates<br/><span class="dcha">Uxía</span></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="borde">
                        <td colspan="2" class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                    </tr>
                    <tr>
                        <th class="rosa" rowspan="3">21 - 22</th>
                        <td>Sala 1</td>
                        <td class="verde">Bodyjump<br/><span class="dcha">Oscar</span></td>
                        <td class="azul">R. Latinos Inic 2<br/><span class="dcha">Juan</span></td>
                        <td class="azul">Salsa Línea Medio 3<br/><span class="dcha">Juan</span></td>
                        <td class="azul borde_especial">Kizomba Inic. 1<br/><span class="dcha">Juan</span></td>
                        <td class="azul borde_especial">Salsa Línea Medio 1<br/><span class="dcha">Juan</span></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sala 2</td>
                        <td class="lila">P. Reformer<br/><span class="dcha">Uxía</span></td>
                        <td class="verde">TRX<br/><span class="dcha">Oscar</span></td>
                        <td class="lila">P. Reformer<br/><span class="dcha">Uxía</span></td>
                        <td class="lila">P. Reformer<br/><span class="dcha">Uxía</span></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sala 3</td>
                        <td class="azul">R. Latinos Inic. 2<br/><span class="dcha">Juan</span></td>
                        <td class="verde">Zumba<br/><span class="dcha">Uxía</span></td>
                        <td class="verde borde_especial">Bodyjump<br/><span class="dcha">Oscar</span></td>
                        <td></td>
                        <td class="azul borde_especial">D. Oriental Inic.<br/><span class="dcha">Iria</span></td>
                        <td></td>
                    </tr>
                    <tr class="borde">
                        <td colspan="2" class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                    </tr>
                    <tr>
                        <th class="rosa">22 - 23</th>
                        <td>Sala 1</td>
                        <td class="fucsia">Ensayo Moovett<br/><span class="dcha">Juan</span></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="fucsia">Ensayo Moovett<br/><span class="dcha">Juan</span></td>
                        <td></td>
                    </tr>
                    <tr class="borde">
                        <td colspan="2" class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                    </tr>
                    <tr>
                        <th class="rosa">23 - 03</th>
                        <td>Café-Bar</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="fucsia">Fiesta Latina<br/><span class="dcha"></span></td>
                        <td></td>
                    </tr>
                    <tr class="borde">
                        <td colspan="2" class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde"></td>
                    </tr>
                </table>


                <br/><br/><br/>

                <table style="margin:auto;" class="tabla_colores">
                    <tr>
                        <td class="amarillo" width="10%"></td>
                        <td colspan="2" class="colores">Niños y adolescentes</td>
                        <td class="lila" width="10%"></td>
                        <td colspan="2" class="colores">Pilates y Yoga</td>
                        <td class="fucsia" width="10%"></td>
                        <td colspan="2" class="colores">Especial Moovett</td>
                    </tr>
                    <tr>
                        <td class="verde" width="10%"></td>
                        <td colspan="2" class="colores">Fitness y cardio</td>
                        <td class="azul" width="10%"></td>
                        <td colspan="2" class="colores">Danza y baile</td>
                        <td class="borde_especial"></td>
                        <td colspan="2" class="colores">Grupos Nuevos</td>
                    </tr>
                    <tr>
                        <td class="rosa_mn" width="10%"></td>
                        <td colspan="2" class="colores">Mañanas Moovett</td>
                        <td class="rojo" width="10%"></td>
                        <td colspan="2" class="colores">Krav Maga</td>
                        <td class="sin_borde"></td>
                        <td class="sin_borde" colspan="2"></td>
                    </tr>
                </table>
                </p>
            </article>



        </section><!-- end of #content -->

        <aside id="sidebar"><!-- sidebar --><!--AQUI VAN A LAS GESTIONES-->
           <?php AñadirFuncionalidades($_SESSION); ?>
        </aside><!-- end of sidebar -->

    </section><!-- end of #main content and sidebar-->

    <footer>

        <section  id="footer-area">
            <h2 style="margin-left:20px" ><?php echo  $strings['Asistencia Monitores'];?></h2>
            <section id="footer-outer-block">

<?php
$empleados =getMonitores();

for($u=0;$u<count($empleados);$u++){

?>
                <aside class="footer-segment">

                    <ul>

                        <h4><?php $v=$u+1; echo $v.")"; ?></h4>
                        <?php
                        echo '<li><a href="#">'.$empleados[$u].'</a></li>';
                        ?>
                    </ul>
                </aside><!-- end of #first footer segment -->

               <?php } ?>
            </section><!-- end of footer-outer-block -->

        </section><!-- end of footer-area -->
    </footer>

</div><!-- #wrapper -->
</body>
</html>

