<?php

    trait Timestamp {
        public function crearFecha() {

        }

        public function actualizarFecha() {
            
        }
    }

    class Documento {
        use Timestamp;
    }

    $documento = new Documento();
    $documento->crearFecha(); 
    $documento->actualizarFecha(); 

?>