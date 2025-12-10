<?php

    trait Timestamp {
        public function crearFecha() {
            echo "Crear fecha <br>";
        }

        public function actualizarFecha() {
            echo "Actualizar fecha <br>";
        }
    }

    class Documento {
        use Timestamp;
    }

    $documento = new Documento();
    $documento->crearFecha(); 
    $documento->actualizarFecha(); 

?>