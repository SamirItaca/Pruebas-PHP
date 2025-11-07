<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de tareas</title>
    <link rel="stylesheet" href="gestor.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<?php

    class GestorTarea {
        
        private $fichero = "tareas.txt";

        public function __construct($fichero) {
            $this -> fichero = $fichero;
        }

        function guardarTareaEnFichero($listaDeTareas) {

            $texto = "";

            if(isset($listaDeTareas)){
                
                if (count($listaDeTareas)) {

                    foreach ($listaDeTareas as $tarea) {
                        $texto .= "Nombre de la tarea: " . $tarea->nombre . ", descripción: " . $tarea->descripcion . PHP_EOL;
                    }

                }
            }

            $fichero = fopen($this -> fichero, "a") or die("No se pudo abrir el fichero");

            fwrite($fichero, $texto);
            fclose($fichero);
        }

        function verTareaFichero() {
            // Verificar que el archivo existe
            if (!file_exists($this -> fichero)) {
                echo "<pre style='padding:10px; background:#f8f8f8; border:1px solid #ccc;'>No existe el archivo de tareas.</pre>";
                return;
            }

            // Leer el contenido del archivo
            $contenido = file_get_contents($this -> fichero);

            // Escapar caracteres HTML para seguridad
            $contenido = htmlspecialchars($contenido);

            // Mostrar dentro de <pre>
            echo "<pre style='padding:10px; background:#f8f8f8; border:1px solid #ccc; max-height:400px; overflow:auto;'>{$contenido}</pre>";
        }
    }

    require_once "Tarea.php";

    session_start();

    $SESSION_KEY = 'listaTareasEnCola';

    if (!isset($_SESSION[$SESSION_KEY])) {
        $_SESSION[$SESSION_KEY] = [];
    }

    function crearTareaEnCola($nombre, $descripcion): Tarea {
        $tarea = new Tarea($nombre, $descripcion);

        if (isset($tarea)) {
            return $tarea;
        }

        return null;
    }

    function eliminarTodasLasTareaEnCola() {    
        global $SESSION_KEY;

        // Vaciar la lista de tareas en sesión
        $_SESSION[$SESSION_KEY] = [];
    }

    function eliminarUnaTarea($id, $nombreFichero) {
        global $SESSION_KEY;

        // Verificamos que el índice exista antes de eliminar
        if (isset($_SESSION[$SESSION_KEY][$id])) {
            unset($_SESSION[$SESSION_KEY][$id]);

            // Reindexamos el array para evitar huecos
            $_SESSION[$SESSION_KEY] = array_values($_SESSION[$SESSION_KEY]);

            // Actualizar fichero con el array actualizado
            $nuevoContenidoFichero = "";
            foreach ($_SESSION[$SESSION_KEY] as $tarea) {
                $nuevoContenidoFichero .= "Nombre de la tarea: " . $tarea->nombre . ", descripción: " . $tarea->descripcion . PHP_EOL;
            }

            $fichero = fopen($nombreFichero, "w") or die("No se pudo abrir el fichero");
            fwrite($fichero, $nuevoContenidoFichero);
            fclose($fichero);
        }
    }

    function guardarTareaEnFichero($nombreFichero) {
        global $SESSION_KEY;

        $texto = "";

        if(isset($_SESSION[$SESSION_KEY])){
            
            if (count($_SESSION[$SESSION_KEY])) {

                foreach ($_SESSION[$SESSION_KEY] as $tarea) {
                    $texto .= "Nombre de la tarea: " . $tarea->nombre . ", descripción: " . $tarea->descripcion . PHP_EOL;
                }

            }
        }

        $fichero = fopen($nombreFichero, "a") or die("No se pudo abrir el fichero");

        fwrite($fichero, $texto);
        fclose($fichero);

        // Vaciar la lista de tareas en sesión
        //$_SESSION[$SESSION_KEY] = [];
    }

    function verTareaFichero($nombreFichero) {
        // Verificar que el archivo existe
        if (!file_exists($nombreFichero)) {
            echo "<pre style='padding:10px; background:#f8f8f8; border:1px solid #ccc;'>No existe el archivo de tareas.</pre>";
            return;
        }

        // Leer el contenido del archivo
        $contenido = file_get_contents($nombreFichero);

        // Escapar caracteres HTML para seguridad
        $contenido = htmlspecialchars($contenido);

        // Mostrar dentro de <pre>
        echo "<pre style='padding:10px; background:#f8f8f8; border:1px solid #ccc; max-height:400px; overflow:auto;'>{$contenido}</pre>";
    }

    function eliminarTareaDelFichero($nombreFichero) {
        global $SESSION_KEY;

        $fichero = fopen($nombreFichero, "w") or die("No se pudo abrir el fichero");

        fwrite($fichero, "");
        fclose($fichero);

        // Vaciar la lista de tareas en sesión
        $_SESSION[$SESSION_KEY] = [];
    }

    function verListaDeTareas() {
        global $SESSION_KEY;
        
        if(isset($_SESSION[$SESSION_KEY])){

            if (count($_SESSION[$SESSION_KEY]) > 0) {
                echo '<div class="accordion" id="accordionExample">';

                $index = 0; // para crear IDs únicos en cada tarea

                foreach ($_SESSION[$SESSION_KEY] as $tarea) {
                    $collapseId = "collapse" . $index;
                    $headingId = "heading" . $index;

                    echo '
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="' . $headingId . '">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">
                                ' . htmlspecialchars($tarea->nombre) . '
                            </button>
                        </h2>
                        <div id="' . $collapseId . '" class="accordion-collapse collapse" aria-labelledby="' . $headingId . '" data-bs-parent="#accordionExample">
                            <div class="accordion-body form-delete-tarea">
                                <div>
                                    <strong>Descripción:</strong> ' . nl2br(htmlspecialchars($tarea->descripcion)) . '
                                </div>

                                <form action="GestorDeTarea.php" method="post" style="display:inline;">
                                    <input type="hidden" name="idTareaBorrar" value="'. $index .'">
                                    <button type="submit" class="btn-close" aria-label="Close"></button>
                                </form>
                            </div>
                        </div>

                    </div>';

                    $index++;
                }

            } else {
                echo "<p> No existen tareas aun </p>";
            }

        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Crear tarea en cola
        if (isset($_POST['crearTareaBtn'])) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";

            $tareaCreada = crearTareaEnCola($nombre, $descripcion);

            if (isset($tareaCreada)) {
                $_SESSION[$SESSION_KEY][] = $tareaCreada;
            }
        }

        // Borrar tareas en cola
        if (isset($_POST['borrarTodasTareasBtn'])) {
            eliminarTodasLasTareaEnCola();
        }

        // Borrar una sola tarea
        if (isset($_POST['idTareaBorrar']) && is_numeric($_POST['idTareaBorrar'])) {
            $id = intval($_POST['idTareaBorrar']);

            eliminarUnaTarea($id, "tareas.txt");
        }

        // Guardar tarea en fichero
        if (isset($_POST['guardarEnFicheroBtn'])) {
            guardarTareaEnFichero("tareas.txt");
        }

        // Eliminar tarea del fichero
        if (isset($_POST['eliminarTareaFicheroBtn'])) {
            eliminarTareaDelFichero("tareas.txt");
        }

    }

?>

<body style="padding: 16px;">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <!-- Contenido gestor de tarea -->
    <div class="contenido">

        <!-- Formulario crear tarea -->
        <div class="card" style="padding: 8px;">
            <form action="GestorDeTarea.php" method="post">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la tarea</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej. Ir al Mercadona">
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary" name="crearTareaBtn">Crear tarea</button>
                <button type="submit" class="btn btn-danger" name="borrarTodasTareasBtn">Eliminar todas las tareas en cola</button>
                <button type="submit" class="btn btn-success" name="guardarEnFicheroBtn">Guardar tareas en el fichero</button>
                <button type="submit" class="btn btn-danger" name="eliminarTareaFicheroBtn">Eliminar tareas del fichero</button>
                <button type="submit" class="btn btn-secondary" name="verTareaFicheroBtn">Ver tareas en el fichero</button>
            </form>
        </div>

        <!-- Lista de tareas en cola -->
        <div class="card" style="padding: 8px;">
            <h2>Lista de tareas en cola</h2>

            <!-- Imprimir tareas en cola (session) -->
            <?php verListaDeTareas() ?>
        </div>
    </div>

    <!-- Contenido datos del fichero -->
    <div class="card contenido">
        <h2>Contenido del fichero</h2>
        
        <!-- Imprimir tareas dentro del fichero -->
        <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Ver tareas en el fichero
                if (isset($_POST['verTareaFicheroBtn'])) {
                    verTareaFichero("tareas.txt");
                }
            }
        ?>
    </div>
  
</body>

</html>