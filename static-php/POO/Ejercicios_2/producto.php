<?php

    class Producto {
        const IVA = 0.21;

        public $nombre;
        public $precio;

        public function __construct($nombre, $precio) {
            $this->nombre = $nombre;
            $this->precio = $precio;
        }

    }

?>
