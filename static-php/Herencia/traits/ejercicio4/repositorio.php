<?php

    trait ConexionBD {
        abstract public function obtenerCredenciales(); 

        public function conectar() {
            return $this->obtenerCredenciales();
        }
    }

    class Repositorio {
        use ConexionBD;

        public function obtenerCredenciales() {
            return "pass";
        }
    }

    $r = new Repositorio();
    $r->conectar();

?>