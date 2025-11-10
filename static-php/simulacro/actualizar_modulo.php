<?php
require_once 'Gestor.php';
require_once 'Alumno.php';
require_once 'Modulo.php';
require_once 'Mensaje.php';

session_start();

if (!isset($_SESSION['gestor']) || !isset($_SESSION['moduloSeleccionadoId'])) {
    echo "No hay datos disponibles.";
    exit;
}

$gestor = $_SESSION['gestor'];
$id = $_SESSION['moduloSeleccionadoId'];

// Buscar el modulo por ID
$modulo = null;
foreach ($gestor->listaModulos as $m) {
    if ($m->id == $id) {
        $modulo = $m;
        break;
    }
}

if (!$modulo) {
    echo "Modulo no encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $btnVolver = $_POST['volver'] ?? null;
    $btnActualizar = $_POST['actualizar'] ?? null;

    if (!empty($btnActualizar)) {
        $nombre = $_POST['nombre'] ?? null;
        $curso = $_POST['curso'] ?? null;

        if (!empty($nombre)) {
            $gestor -> actualizarModulo($modulo->id, $nombre, $curso);
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
        <title>Actualizar Modulo</title>
        <!-- Add bootstrap library -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>

    <body style="padding: 16px">

        <div class="alert alert-primary" role="alert">

            <form action="actualizar_modulo.php" method="post">
                
                <div>
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $modulo->nombre; ?>">
                </div>

                <div>
                    <label class="form-label">Curso:</label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="curso" id="primero1" value="primero" <?php echo $modulo->curso == 'primero' ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="primero1">Primero</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="curso" id="segundo2" value="segundo" <?php echo $modulo->curso == 'segundo' ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="segundo2">Segundo</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="volver" value="volver">Volver</button>

                <button type="submit" class="btn btn-success" name="actualizar" value="actualizar">Actualizar</button>
            </form>

        </div>

    </body>

</html>
