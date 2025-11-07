<?php


// Incluimos la definición de la clase Tarea para poder crear objetos de ese tipo
require_once 'Tarea.php';

class GestorTareas {

    // El fichero en el que vamos a guardar las tareas    
    private $fichero = 'tareas.csv';

    /**
     * Guarda la lista de tareas en el fichero CSV.
     * Cada línea será: nombre;descripcion
     */
    
    public function guardarTareas($listaTareas) {
        $cadena = "";
         foreach ($listaTareas as $tarea) {
            //construimos la cadena para guardar en el fichero
            $cadena .= $tarea-> id . ";" . $tarea-> prioridad . ";" . $tarea-> nombre . ";" . $tarea->descripcion . "\n";
        } 
        file_put_contents($this->fichero,$cadena);   
    }

    /**
     * Carga las tareas desde el fichero CSV.
     */

    public function cargarTareas() {
        // Si el fichero no existe, no devolvemos nada y salimos de la funión
        if (!file_exists($this->fichero)) {
            return []; 
        }

        // Leemos el fichero completo
        $contenidoCompleto = file_get_contents($this->fichero);
        
        // Si el fichero esta vacio , no devolvemos nada y salimos de la función
        if (empty($contenidoCompleto)) {
            return [];
        }

        // Separamos el contenido en líneas individuales, separando con "\n"
        $lineas = explode("\n", $contenidoCompleto);
        
        $listaTareas = [];

        // Procesamos cada línea
        foreach ($lineas as $linea) {
            
            // Saltamos líneas vacías que puedan haberse colado (ej. al final del fichero)
            if (trim($linea) === '') {
                continue;
            }

            // 3. Separamos la línea por el primer punto y coma (;)
            // Usamos el límite '2' en explode. Esto es clave.
            // Significa que si la descripción contiene un ';', no se romperá.
            // $partes[0] será el id.
            // $partes[1] será el nombre (la descripción).
            // $partes[2] será *todo el resto* (la descripción).
            // $partes[3] será la prioridad.
            $partes = explode(";", $linea, 4);

            // Comprobamos que la línea tenía el formato esperado
            if (count($partes) === 4) {
                $id = $partes[0];
                $nombre = $partes[1];
                $descripcion = $partes[2];
                $prioridad = $partes[3];
                
                // Creamos el objeto Tarea y lo añadimos a la lista
                $listaTareas[] = new Tarea($nombre, $descripcion, $prioridad);
            }
        }

        return $listaTareas;
    }

    public function ordenarTarea($isOrdenMayorMenor, $listaTareas) {
        if ($isOrdenMayorMenor) {
            // De mayor a menor (alta -> baja)
            usort($listaTareas, function($a, $b) {
                return $b->prioridad["Valor"] <=> $a->prioridad["Valor"];
            });
        } else {
            // De menor a mayor (baja -> alta)
            usort($listaTareas, function($a, $b) {
                return $a->prioridad["Valor"] <=> $b->prioridad["Valor"];
            });
        }

        return $listaTareas; 
    }
}
?>