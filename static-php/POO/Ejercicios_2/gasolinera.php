<?php

    class Gasolinera {
        public $litrosDisponibles;

        public function __construct($litrosDisponibles) {
            $this->litrosDisponibles = $litrosDisponibles;
        }

        public function surtir($coche, $cantindad) {
            if ($cantindad > $this->litrosDisponibles) {
                echo "No hay litros disponibles para surtir <br>";
                return;
            }

            $this->litrosDisponibles -= $cantindad;
            echo "Se va a surtir " . $cantindad . " litros. Queda disponible: " . $this->litrosDisponibles . "<br>";

            $coche->repostar($cantindad);
        }
    }

?>
