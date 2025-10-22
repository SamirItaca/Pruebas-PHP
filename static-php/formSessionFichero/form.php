<?php
session_start();

// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre_fichero = 'datos.txt';

    $btnEnviar = isset($_POST['enviar']) ? true : false;
    $btnCerrarSesion = isset($_POST['cerrarSesion']) ? true : false;
    $btnBorrarDatosFichero = isset($_POST['borrarDatosFichero']) ? true : false;

    if ($btnEnviar) {
        // Obtemos los datos
        $userSelected = $_POST['userSelected'] ?? '';
        $edad = $_POST['edad'] ?? '';
        $mensaje = $_POST['mensaje'] ?? '';

        // Guardar usuario en sesión
        $_SESSION['user'] = $userSelected;

        // Guardar los datos en el fichero
        $text = "El usuario $userSelected tiene como edad $edad y su mensaje es: $mensaje" . PHP_EOL;

        $fichero = fopen($nombre_fichero, "a") or die("No se pudo abrir el fichero.");
        fwrite($fichero, $text);
    }

    if ($btnCerrarSesion) {
        session_unset();     // Borra todas las variables de sesión
        session_destroy();   // Destruye la sesión
        header("Location: form.php"); // Redirige para limpiar POST y mostrar estado sin usuario
        exit;
    }

    if ($btnBorrarDatosFichero) {
        $fichero = fopen($nombre_fichero, "a") or die("No se pudo abrir el fichero.");
        file_put_contents($nombre_fichero, ""); // Sobrescribe con contenido vacío
        header("Location: form.php"); // Redirigir para actualizar la vista
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de mensaje y edad</title>
</head>
<body>

    <?php
        if (isset($_SESSION['user'])) {
            echo "<h1>El ultimo usuario que mando un mensaje fue: " . $_SESSION['user'] . "</h1>";
        } else {
            echo "<h1>No ha iniciado sesion con ningun usuario</h1>";
        }
    ?>

    <h2>Formulario de mensaje y edad</h2>

    <form action="form.php" method="post">
        <label>Selecciona un usuario existente:</label><br>

        <select name="userSelected">
            <option value="Dabi">Dabi</option>
            <option value="Jonnatan">Jonnatan</option>
            <option value="Samir">Samir</option>
        </select>

        <br><br>

        <label>Edad:</label><br>
        <input type="number" name="edad">
        <br><br>

        <label>Mensaje:</label><br>
        <textarea name="mensaje" rows="4" cols="40"></textarea>
        <br><br>

        <input type="submit" value="Enviar" name="enviar">
        <input type="submit" value="Cerrar sesion" name="cerrarSesion">
        <input type="submit" value="Borrar datos del fichero" name="borrarDatosFichero">
    </form>

    <hr>

    <h3>Contenido del fichero:</h3>
    <pre>
        <?php
        if (file_exists("datos.txt")) {
            echo htmlspecialchars(file_get_contents("datos.txt"));
        } else {
            echo "Aún no hay datos guardados.";
        }
        ?>
    </pre>

</body>
</html>
