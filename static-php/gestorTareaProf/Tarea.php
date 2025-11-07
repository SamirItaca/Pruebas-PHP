<?php

class Tarea{
    
    private static $contador = 0; // atributo compartido por todas las instancias
    public $id;
    public $nombre;
    public $descripcion;
    public $prioridad;

    public function __construct($nombre, $descripcion, $prioridad)
    {
        if (!isset($_SESSION['contador_tareas'])) {
            $_SESSION['contador_tareas'] = 0;
        }

        // Incrementa y asigna
        $_SESSION['contador_tareas']++;
        $this->id = $_SESSION['contador_tareas'];

        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->prioridad = $this-> crearPrioridad($prioridad);
    }

    public static function reiniciarContador(): void {
        self::$contador = 0;
    }

    private function crearPrioridad($prioridad) {
        switch($prioridad) {
            case 'baja':  return ["Valor" => 0, "Prioridad" => $prioridad];
            case 'media': return ["Valor" => 1, "Prioridad" => $prioridad];
            case 'alta':  return ["Valor" => 2, "Prioridad" => $prioridad];
        }
    }
}

?>


