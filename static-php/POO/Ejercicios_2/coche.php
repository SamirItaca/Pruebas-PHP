<?php

    class Coche {
        public $litrosDeposito;
        public $capacidadMaxima;

        public function __construct($capacidadMaximaLitros) { 
            $this->litrosDeposito = 0;
            $this->capacidadMaxima = $capacidadMaximaLitros;
        }

        public function repostar($litros) {
            if ($litros > $this->capacidadMaxima) {
                echo "No se puede surtir esta cantidad: excede del maximo <br>";
                return;
            }

            $faltanteLitros = $this->capacidadMaxima - $this->litrosDeposito;
            if ($litros > $faltanteLitros) {
                echo "No se puede surtir mas cantidad de lo foltante <br>";
                return;
            }

            $this->litrosDeposito += $litros;
            if ($this->litrosDeposito === $this->capacidadMaxima) {
                echo "Ha repostado al maximo <br>";
            } else {
                $faltanteLitrosActualizado = $this->capacidadMaxima - $this->litrosDeposito;
                echo "Ha repostado " . $litros . " faltan " . $faltanteLitrosActualizado . " para llegar al maximo <br>";
            }
        }
    }

?>
