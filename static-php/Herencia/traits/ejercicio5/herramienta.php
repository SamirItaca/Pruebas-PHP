<?php

    trait Debug {
        public function mostrarInfoPublica() {

        }
    }

    trait Oculto {
        use Debug {
            mostrarInfoPublica as protected;
        }
    }

    class Herramienta {
        use Oculto;

        public function probarMetodo() {
            $this->mostrarInfoPublica();
        }
    }

    $h = new Herramienta();

    // Esto funciona:
    $h->probarMetodo();

    // Esto produce un error:
    // $h->mostrarInfoPublica();

?>