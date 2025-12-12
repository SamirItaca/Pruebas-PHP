<?php

    interface IClimatizable {
        public function encenderClimatizador(): void;
    } 

    abstract class Vehiculo {
        protected $matricula;

        public function __construct($matricula) {
            $this->matricula = $matricula;
        }

        abstract public function calcularCostoAlquiler(int $dias): float;

        public function mostrarInfo(): void {
            echo "Matricula: " . $this->matricula . "<br>";
        }
    }

    class Coche extends Vehiculo implements IClimatizable{

        private $base = 50;

        public function __construct($matricula) {
            parent::__construct($matricula);
        }
        
        public function calcularCostoAlquiler(int $dias): float {
            return $this->base * $dias;
        }

        public function encenderClimatizador(): void {
            echo "Clima encendidio <br>";
        }
    }

    class Camioneta extends Vehiculo {

        private $base = 80;

        public function __construct($matricula) {
            parent::__construct($matricula);
        }
        
        public function calcularCostoAlquiler(int $dias): float {
            return 100 + ($this->base * $dias);
        }
    }

    $coche = new Coche("TSD2131");
    $coche->mostrarInfo();
    echo "El costo del alquilar el coche para 3 dias es de: " . $coche->calcularCostoAlquiler(3) . "<hr>";

    $camioneta = new Camioneta("KCH5466");
    $camioneta->mostrarInfo();
    echo "El costo del alquilar el camioneta para 5 dias es de: " . $coche->calcularCostoAlquiler(5) . " ademas se suma 100 por el uso del cargo.<hr>";


?>