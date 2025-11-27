<?php

    class Tarea {

        private $lista = [];

        public function __construct() { }

        public function agregarTarea($texto) {
            $this->lista[] = $texto;
        }

        public function mostrarTareas() {
            $listaTareasHTML = "";
            $listaTareasHTML .= "<ul>";
            if (!empty($this->lista)) {
                $listaTareasHTML .= '<li>' . implode('</li><li>', array_map('htmlspecialchars', $this->lista)) . '</li>';
            }
            $listaTareasHTML .= "<ul>";

            echo $listaTareasHTML;
        }
    }

?>