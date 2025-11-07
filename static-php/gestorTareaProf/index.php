<?php

//Cargamos el gestor de tareas y la clase tarea
require_once 'GestorTareas.php';

//Aunque en el gestor ya esta cargada la clase tarea, la cargamos explicitamente
//require_once hace que si ya está cargada, no se vuelva a cargar
require_once 'Tarea.php';

// Iniciamos la sesion para guardar en memoria
// Las clases deben estar cargadas antes
session_start();


// Instanciamos el gestor de tareas
$gestor = new GestorTareas();

// Una variable para informar al usuario de las acciones que se van realizando
$mensaje_accion = ''; 

// Lógica para manejar los datos enviados por el formulario 
// y recargar la página con los datos enviados
// solamente atenderemos peticiones POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Identificamos qué botón se ha pulsado
    /**
     * El operador ?? es equivalente al operador ternario
     * $accion = isset($_POST['action']) ? $_POST['action'] : null;
     * 
     * asigna a la variable accion el valor del post que tiene
     * o nulo si no tiene ningun valor
     */

    $accion = $_POST['action'] ?? null;
    

    // --- Si queremos añadir una tarea  ---
    if ($accion === 'añadir') {
        
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $prioridad = $_POST['prioridad'] ?? '';

        if (!empty($nombre)) {
            // Creamos un objeto Tarea si tenemos nombre
            $nuevaTarea = new Tarea($nombre, $descripcion, $prioridad);
            
            // Añadimos la tarea a la lista que está EN LA SESIÓN
            $_SESSION['lista_tareas_memoria'][] = $nuevaTarea;

            //Mensaje de confirmación
            // al tener comillas dobles, php interpreta el valor de $nombre
            // usamos las llaves {} para delimitar exactamente donde poner el valor de $nombre
            $mensaje_accion = "Tarea '{$nombre}' añadida a la lista (no guardada).";
        } else {
            //si no podemos añadir la tarea, informamos al usuario
            $mensaje_accion = "El nombre de la tarea no puede estar vacío.";
        }
    }
    
    // --- Si queremos guardar la lista de tareas en memoria al fichero ---
    elseif ($accion === 'guardar') {
        if (isset($_SESSION['lista_tareas_memoria'])) {
            // Usamos el gestor para guardar la lista de la sesion en el fichero
            // como es una instancia de GestorTareas, usamos el -> para llamar al método
            // recuerda que el => es para los pares clave valor, para objetos usamos ->
            $gestor->guardarTareas($_SESSION['lista_tareas_memoria']);

            //mensaje de confirmación
            $mensaje_accion = "¡Tareas guardadas en el fichero correctamente!";
        } else {
            $mensaje_accion = "No hay tareas en memoria para guardar.";
        }
    }

    // --- Si queremos cargar las tareas del fichero a la memoria ---
    elseif ($accion === 'cargar') {
        // Cargamos del fichero y SOBREESCRIBIMOS la lista de la sesión
        //usamos el método de GestorTareas
        $_SESSION['lista_tareas_memoria'] = $gestor->cargarTareas();
        //mensaje de confirmación
        $mensaje_accion = "Tareas cargadas desde el fichero. (Se han descartado los cambios no guardados)";
    }
    
    // --- Si queremos reiniciar la lista que tenemos en memoria (Resetear la sesión) ---
    elseif ($accion === 'reiniciar') {
        // Borramos la lista de la sesión con unset
        unset($_SESSION['lista_tareas_memoria']); 
        //mensaje de confirmación
        $mensaje_accion = "Lista en memoria limpiada.";

        // Reiniciar el contador de ID de la clase Tarea
        $_SESSION['contador_tareas'] = 0;
    }

    elseif ($accion === 'ordenar') {
        $orden = $_POST['orden'] ?? ''; // puede ser "mayorMenor", "menorMayor", o vacío

        if ($orden === 'mayorMenor') {
            $_SESSION['lista_tareas_memoria'] = $gestor->ordenarTarea(true, $_SESSION['lista_tareas_memoria']);
            $mensaje_accion = "Lista de tareas ordenada de mayor a menor (alta -> baja).";
        } elseif ($orden === 'menorMayor') {
            $_SESSION['lista_tareas_memoria'] = $gestor->ordenarTarea(false, $_SESSION['lista_tareas_memoria']);
            $mensaje_accion = "Lista de tareas ordenada de menor a mayor (baja -> alta).";
        } else {
            $mensaje_accion = "No has seleccionado ningún tipo de orden.";
        }
    }
    
    elseif (str_starts_with($accion, 'borrarTarea')) {
        $idABorrar = filter_var($accion, FILTER_SANITIZE_NUMBER_INT);

        foreach ($_SESSION['lista_tareas_memoria'] as $indice => $tarea) {
            if ($tarea->id == $idABorrar) {
                unset($_SESSION['lista_tareas_memoria'][$indice]);
                break;
            }
        }

        // Reindexar después de borrar
        $_SESSION['lista_tareas_memoria'] = array_values($_SESSION['lista_tareas_memoria']);

        $mensaje_accion = "Tarea con ID $idABorrar eliminada correctamente.";
    }

    // Redirigimos para limpiar el POST y mostrar el mensaje de confirmación
    // Guardamos el mensaje en la sesión para que sobreviva a la redirección
    $_SESSION['mensaje_accion'] = $mensaje_accion;
    //preparamos la redirección y justo despues terminamos el scrit
    //con exit para evitar fallos
    header('Location: index.php');
    exit;
}   //aquí termina la lógica que maneja el formulario 

/**
 * Esta es la lógica para cargar la página la primera vez y 
 * en los sucesivos envios del formulario
 */

 

 // Recuperamos el mensaje de la sesión (si existe) y lo borramos

if (isset($_SESSION['mensaje_accion'])) {
    $mensaje_accion = $_SESSION['mensaje_accion'];
    unset($_SESSION['mensaje_accion']);
}


// Si la lista de tareas no existe en la sesión, la inicializamos.
if (!isset($_SESSION['lista_tareas_memoria'])) {
    // La primera vez, intentamos cargarla desde el fichero
    $_SESSION['lista_tareas_memoria'] = $gestor->cargarTareas();
}

// La lista que mostramos SIEMPRE es la que está en la sesión
$listaTareas = $_SESSION['lista_tareas_memoria'];

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas (con Sesión)</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: auto; padding: 20px; }
        h1, h2 { text-align: center; }
        form { background: #f0f0f0; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        form div { margin-bottom: 15px; }
        form label { display: block; margin-bottom: 5px; font-weight: bold; }
        form input[type=text], form textarea { width: 95%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        form button { background: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        
        .acciones { border-top: 2px solid #ccc; border-bottom: 2px solid #ccc; padding: 15px 0; margin: 20px 0; text-align: center; }
        .acciones form { display: inline-block; background: none; padding: 0; margin: 0 5px; }
        .acciones button { padding: 10px 20px; }
        .btn-guardar { background: #28a745; } /* Verde */
        .btn-cargar { background: #ffc107; color: black; } /* Amarillo */
        .btn-reiniciar { background: #dc3545; } /* Rojo */

        .mensaje { background: #e0f7fa; border: 1px solid #007bff; padding: 10px; border-radius: 5px; text-align: center; margin: 10px 0; }
        
        .lista-tareas { margin-top: 20px; }
        .tarea { background: #fff; border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 8px; }
        .tarea h3 { margin-top: 0; }
        .radio-group {display: flex;align-items: center;gap: 15px; justify-content: center;
}
    </style>
</head>
<body>

    <h1>Gestor de Tareas (en Memoria)</h1>

    <form action="index.php" method="POST">
        <h2>Nueva Tarea</h2>
        <input type="hidden" name="action" value="añadir">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="3"></textarea>
        </div>
        <div>
            <label for="prioridad">Tipo de prioridad:</label>
            <select id="prioridad" name="prioridad">
                <option value="alta">Alta</option>
                <option value="media" selected>Media</option>
                <option value="baja">Baja</option>
            </select>
        </div>
        <button type="submit">Añadir Tarea (a la lista)</button>
    </form>

    <div class="acciones">
        <form action="index.php" method="POST">
            <input type="hidden" name="action" value="guardar">
            <button type="submit" class="btn-guardar">Guardar tareas en el fichero</button>
        </form>

        <form action="index.php" method="POST">
            <input type="hidden" name="action" value="cargar">
            <button type="submit" class="btn-cargar">Cargar tareas desde el fichero</button>
        </form>
        
        <form action="index.php" method="POST">
            <input type="hidden" name="action" value="reiniciar">
            <button type="submit" class="btn-reiniciar">Limpiar la lista de tareas en memoria</button>
        </form>

        <form action="index.php" method="POST">
            <label>Ordenar por:</label>

            <div class="radio-group">
                <input type="radio" id="mayorMenor" name="orden" value="mayorMenor">
                <label for="mayorMenor">Mayor a menor (alta -> baja)</label>

                <input type="radio" id="menorMayor" name="orden" value="menorMayor">
                <label for="menorMayor">Menor a mayor (baja -> alta)</label>
            </div>

            <input type="hidden" name="action" value="ordenar">
            <button type="submit">Ordenar</button>
        </form>
    </div>


    <?php if ($mensaje_accion) {    ?>
        <div class="mensaje"><?php echo htmlspecialchars($mensaje_accion); ?></div>
    <?php }    ?>
    

    <div class="lista-tareas">
        <h2>Tareas en Memoria (<?php echo count($listaTareas); ?>)</h2>

        <?php if (empty($listaTareas)): ?>
            <p style="text-align: center;">¡No hay tareas en memoria! Añade una nueva o carga desde el fichero.</p>
        <?php endif; ?>
        
        <?php foreach ($listaTareas as $tarea): ?>
            <div class="tarea">
                <p><?php echo htmlspecialchars($tarea->prioridad["Prioridad"]); ?></p>
                <h3><?php echo htmlspecialchars($tarea->nombre); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($tarea->descripcion)); ?></p>
                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="borrarTarea<?php echo $tarea->id;?>">
                    <button type="submit" class="btn-reiniciar">Borrar tarea</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>