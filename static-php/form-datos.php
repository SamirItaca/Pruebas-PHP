<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div>
        <h1>Obtener datos via GET</h1>
        <form action="obtener-datos-get.php" method="get">
            <input type="number" name="number">
            <input type="text" name="name">
            <input type="text" name="lastname">
            <input type="submit" name="Ver datos">
        </form>
    </div>

    <div>
        <h1>Obtener datos via POST</h1>
        <form action="obtener-datos-post.php" method="post">
            <input type="number" name="number">
            <input type="text" name="name">
            <input type="text" name="lastname">
            <input type="submit" name="Ver datos">
        </form>
    </div>
    elseif (str_contains($acction, 'borrarTarea')) {
        // Obtener solo el numero (el id) de la variable accion
        $idABorrar = filter_var($acction, FILTER_SANITIZE_NUMBER_INT);

        unset($_SESSION['lista_tareas_memoria'][$idABorrar]);

        $mensaje_accion = "MENSAJE DE ACCION DE BORRAR";
    }
</body>
</html>