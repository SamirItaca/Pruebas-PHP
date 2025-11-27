<?php

    class Dado {
        public $min = 1;
        public $max = 6;

        public function __construct() { }

        public function tirar() {
            return rand($this->min, $this->max);
        } 
    }

?>