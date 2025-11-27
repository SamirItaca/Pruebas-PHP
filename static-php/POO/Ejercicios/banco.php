<?php

    class Banco {
        public $titular;
        public $tipo;
        private $saldo;
        
        public function __construct($titular, $tipo, $saldoInicial) {
            $this->titular = $titular;
            $this->tipo = $tipo;
            $this->saldo = $saldoInicial;
        }

        public function ingresar($cantidad) {
            if ($cantidad > 0) {
                $this->saldo += $cantidad;
            }
        }

        public function retirar($cantidad) {
            if ($cantidad > 0 && $cantidad <= $this->saldo) {
                $this->saldo -= $cantidad;
            } else {
                echo "Fondos insuficientes para retirar $cantidad.\n";
            }
        }

        public function mostrarSaldo() {
            return $this->saldo;
        }
    }

?>