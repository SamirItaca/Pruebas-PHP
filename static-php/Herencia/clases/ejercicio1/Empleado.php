<?php

    abstract class Empleado {
        public string $nombre;
        public float $sueldoBase;
        public int $antiguedad;

        public function __contruct(string $nombre, float $sueldoBase, int $antiguedad) {
            $this->nombre = $nombre;
            $this->sueldoBase = $sueldoBase;
            $this->antiguedad = $antiguedad;
        }

        abstract public function calcularSueldoNeto();

        public function obtenerNombre() {
            return $this->nombre;
        }

        public function obtenerAntiguedad() {
            return $this->antiguedad;
        }

        public function aplicarBonoAntiguedad() {
            return $this->sueldoBase * 0.01 * $this->antiguedad;
        }
    }

?>