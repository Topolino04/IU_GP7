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
                <p>
                    <style type="text/css">

                        .horario {width:0%; border-collapse: collapse; border:3px solid grey;}
                        .tabla_colores {width:50%; border-collapse: collapse; border:3px solid grey;}
                        .colores {width:25%}
                        tr {width:80%; border-collapse: collapse; border:1px solid grey}
                        td,th {width:12,86%;border-collapse: collapse; border:1px solid grey; color:black; text-align:center;}
                        th {font-size:12px; text-transform:uppercase; color: darkblue;}
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


                    <?php  echo generarCalendario();?>
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

