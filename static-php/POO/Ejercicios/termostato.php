<?php

    class Termostato {
        private $temperatura;

        public function __construct($temperaturaInicial) {
            $this->temperatura = $temperaturaInicial;
        }

        public function calentar() {
            if ($this->temperatura >= 40) {
                return;
            }

            $this->temperatura += 1;
        }

        public function enfriar() {
            if ($this->temperatura <= 0) {
                return;
            }

            $this->temperatura -= 1;
        }

        public function obtenerTemperatura() {
            return $this->temperatura;
        }
    }

?>