<?php
require_once 'Gestor.php';
require_once 'Alumno.php';
require_once 'Modulo.php';
require_once 'Mensaje.php';

session_start();

if (!isset($_SESSION['gestor']) || !isset($_SESSION['alumnoSeleccionadoId'])) {
    echo "No hay datos disponibles.";
    exit;
}

$gestor = $_SESSION['gestor'];
$id = $_SESSION['alumnoSeleccionadoId'];

// Buscar el alumno por ID
$alumno = null;
foreach ($gestor->listaAlumnos as $a) {
    if ($a->id == $id) {
        $alumno = $a;
        break;
    }
}

if (!$alumno) {
    echo "Alumno no encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $btnVolver = $_POST['volver'] ?? null;
    $btnActualizar = $_POST['actualizar'] ?? null;

    if (!empty($btnActualizar)) {
        $nombre = $_POST['nombre'] ?? null;
        $apellido = $_POST['apellido'] ?? null;
        $modulosSeleccionados = $_POST['modulos'] ?? [];

        if (!empty($nombre)) {
            $gestor -> actualizarAlumno($alumno->id, $nombre, $apellido, $modulosSeleccionados);
        }

    }

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Actualizar Alumno</title>
        <!-- Add bootstrap library -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>

    <body style="padding: 16px">

        <div class="alert alert-primary" role="alert">

            <form action="actualizar_alumno.php" method="post">
                
                <div>
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $alumno->nombre; ?>">
                </div>

                <div>
                    <label for="apellido" class="form-label">Apellido:</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $alumno->apellido; ?>">
                </div>

                <div>
                    <label class="form-label">Módulos:</label>

                    <?php if (count($gestor->listaModulos) <= 0): ?>
                        <span>No hay módulos disponibles</span>
                    <?php else: ?>

                        <?php foreach ($gestor->listaModulos as $modulo): ?>
                            <?php
                                // Verificamos si este módulo ya lo tiene el alumno
                                $checked = false;
                                foreach ($alumno->modulos as $m) {
                                    if ($m->id == $modulo->id) {
                                        $checked = true;
                                        break;
                                    }
                                }
                            ?>

                            <div class="form-check">
                                <input class="form-check-input" 
                                    type="checkbox" 
                                    name="modulos[]" 
                                    value="<?php echo $modulo->id; ?>" 
                                    id="modulo_<?php echo $modulo->id; ?>"
                                    <?php echo $checked ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="modulo_<?php echo $modulo->id; ?>">
                                    <?php echo htmlspecialchars($modulo->nombre); ?>
                                </label>
                            </div>

                        <?php endforeach; ?>

                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary" name="volver" value="volver">Volver</button>

                <button type="submit" class="btn btn-success" name="actualizar" value="actualizar">Actualizar</button>
            </form>

        </div>

    </body>

</html>
