<?php

class Modulo{
    
    private static $contador = 0; // atributo compartido por todas las instancias
    public $id;
    public $nombre;
    public $curso;

    public function __construct($nombre, $curso)
    {
        if (!isset($_SESSION['contador_tareas'])) {
            $_SESSION['contador_tareas'] = 0;
        }

        // Incrementa y asigna
        $_SESSION['contador_tareas']++;
        $this->id = $_SESSION['contador_tareas'];

        $this->nombre = $nombre;
        $this->curso = $curso;
    }

    public static function reiniciarContador(): void {
        self::$contador = 0;
    }
}

?>