<?php

    class Dado {
        public $min = 1;
        public $max = 6;

        public function __construct() { }

        public function tirar() {
            $resultado = rand($this->min, $this->max);
            echo "El resultado de la tirado de dado es: " . $resultado . "<br>";
            return rand($this->min, $this->max);
        } 
    }

?>