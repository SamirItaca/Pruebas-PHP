<?php

class Mensaje {
    public $texto;
    public $tipo;
    public $claseCss;

    public function __construct($texto, $tipo) {
        $this->texto = $texto;
        $this->claseCss = $this->obtenerClaseCssPorTipo($tipo);
    }

    private function obtenerClaseCssPorTipo($tipo) {
        switch ($tipo) {
            case 'correcto': return "alert-success";
            case 'error': return "alert-danger";
            case 'advertencia': return "alert-warning";
            case 'informacion': return "alert-primary";
            default: return "alert-secondary"; // valor por defecto
        }
    }
}

?>