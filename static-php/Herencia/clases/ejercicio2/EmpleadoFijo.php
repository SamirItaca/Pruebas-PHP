<?php

    require_once '../ejercicio1/Empleado.php';

    class EmpleadoFijo extends Empleado {
        private float $deduccionesImpuestos;

        public function __contruct(string $nombre, float $sueldoBase, int $antiguedad, float $deduccionesImpuestos) {
            parent::__construct($nombre, $sueldoBase, $antiguedad);
            $this->deduccionesImpuestos = $deduccionesImpuestos;
        }
    }

?>