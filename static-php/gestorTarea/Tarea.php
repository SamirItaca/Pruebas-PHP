<?php

    class Tarea {

        public $id;
        public $nombre;
        public $descripcion;
        public $prioridad;

        public function __construct($nombre, $descripcion, $prioridad) {
            $this -> nombre = $nombre;
            $this -> descripcion = $descripcion;
            $this -> prioridad = $prioridad;
        }
    }

?>