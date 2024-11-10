<?php
class Pie {
    private $mensaje;

    public function __construct($message) {
        $this->mensaje = $message;
    }

    public function graficar() {
        $estilo = 'text-align: center';
        echo '<h4 style="'.$estilo.'">'.$this->mensaje.'</h4>';
    }
}
?>