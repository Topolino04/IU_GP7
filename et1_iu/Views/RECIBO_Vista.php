<?php
class ReciboVista {

    private $recibo;
    
    public function __construct($recibo) {
        $this->recibo=$recibo;
        $this->render();
    }
    
    function render() {
        include '../Locates/Strings_' . $_SESSION['IDIOMA'] . '.php';
        echo '<html>';
      echo "<object data='".$this->recibo."' width='700' height='500'></object><br><br><br><br><br>";
        //echo '<a  class="form-link" href=\'PAGO_Controller.php\'>' . $strings['Volver'] . '</a>'; BOTON VOLVER
        echo '</html>';
    }
    
    //AÑADIR BOTON VOLVER

}
?>