<?php
class EMPLEADO_Edit_Accion{

    private $datos;
    private $volver;
//VISTA PARA LA MODIFICACIÓN DE LAS ACCIONES DE LOS EMPLEADOS
    function __construct($user,$array, $volver){
        $this->user=$user;
        $this->datos = $array;
        $this->volver = $volver;
        $this->render();
    }

    function render(){

        ?>
<head><link rel="stylesheet" href="../Styles/styles.css" type="text/css" media="screen" /></head>
        <div>
            <p>
                <h2>
                    <?php

                    $list=array('EMP_USER');
                    $lista=AñadirPaginasTitulos($list);
                    include '../Functions/FUNCIONShowDefForm.php';
                    include '../Locates/Strings_'.$_SESSION['IDIOMA'].'.php';

                    ?>
                    <div>
        <span class="form-title">
        <?php echo $strings['Modificar Acciones']?><br>
                        <form  id="form" name="form" action='EMPLEADO_Controller.php' method='post' >
                            <ul class="form-style-1">
                            <?php


                            createForm3($lista,$DefForm2,$strings,array('EMP_USER'=>$this->user),false,array('EMP_USER'=>true), $this->datos);

                            ?>
                            <input type='submit' name='accion'  value=<?php echo $strings['Modificar acciones'] ?>>
                  </form>


                <?php
                echo '<a class="form-link" href=\'' . $this->volver . "'>" . $strings['Volver'] . " </a>";
                ?>




        <?php
    } //fin metodo render

}
