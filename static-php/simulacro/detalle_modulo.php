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
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detalle Modulo</title>
        <!-- Add bootstrap library -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>

    <body style="padding: 16px">

        <div class="alert alert-primary" role="alert">

            <h1>Detalle del Modulo</h1>

            <p>Nombre: <?php echo $modulo->nombre; ?></p>

            <p>Curso: <?php echo $modulo->curso; ?></p>

            <form action="detalle_alumno.php" method="post">
                <button type="submit" class="btn btn-primary" name="volver" value="volver">Volver</button>
            </form>

        </div>

        
        
    </body>

</html>
