<?php

    class Personaje {
        public $nombre;
        public $puntosVida = 100;
        public $puntosAtaque;

        public function __construct($nombre, $puntosAtaque) {
            $this->nombre = $nombre;
            $this->puntosAtaque = $puntosAtaque;
        }

        public function atacar($personajeEnemigo) {
            echo "El personaje " . $this->nombre . " ataca a " . $personajeEnemigo->nombre . "<br>";
            $personajeEnemigo->perderVida($this->puntosAtaque);
        }

        public function curarse() {
            echo "El personaje " . $this->nombre . " se esta curando..<br>";
            if ($this->puntosVida >= 100) {
                return;
            }

            $vidaFaltante = $this->puntosVida - 100;
            if ($vidaFaltante < 20) {
                $this->puntosVida = 100;
                return;
            }

            $this->puntosVida += 20;
        }

        public function perderVida($dañoAtaque) {
            if ($dañoAtaque >= $this->puntosVida) {
                echo "Personaje muerto";
                $this->puntosVida = 0;
                return;
            }

            $this->puntosVida -= $dañoAtaque;
        }

        public function obtenerDatos() {
            echo "El personaje " . $this->nombre . " con daño de ataque " . $this->puntosAtaque . " tiene como salud: " . $this->puntosVida . "<br>";
        }

    }

?>