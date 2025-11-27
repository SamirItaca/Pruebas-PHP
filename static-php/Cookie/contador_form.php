<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1 - Formularios</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <h1>Log In</h1>
        <form action="contador_form.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <br>
            <label for="apellido1">Apellido 1:</label>
            <input type="text" id="apellido1" name="apellido1" required>
            <br>
            <label for="apellido2">Apellido 2:</label>
            <input type="text" id="apellido2" name="apellido2">
            <label for="correo">correo electronico 2:</label>
            <input type="text" id="correo" name="correo">
            <label for="edad">Edad :</label>
            <input type="number" id="edad" name="edad" required>
            <label for="aficiones">Aficiones :</label>
            <input type="text" id="aficiones" name="aficiones" required>
            <br>
            <input type="submit" name="añadir" value="Añadir a la lista">
        </form>
    </div>

    <?php
    $archivo = "datosPedro.txt";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["añadir"])) {

        $nombre_cookie = "form_count";
        $contador_forms = 0;

        // 1. Leer el valor actual de la cookie
        if (isset($_COOKIE[$nombre_cookie])) {
            // Se asegura de que el valor es un número entero
            $contador_forms = (int)$_COOKIE[$nombre_cookie];
        }

        // 2. Incrementar el contador
        $contador_forms++;

        /**
         * 3. Establecer la cookie con el nuevo valor.
         * Para cumplir con "se eliminará pasado un tiempo desde que cierres la sesión",
         * la opción más común es:
         * a) Usar 0 como tiempo de expiración (pure Session Cookie) -> Recomendado.
         * b) Usar un tiempo determinado corto (e.g., 1 hora) -> Para el requerimiento "tiempo determinado".
         *
         * Usaremos una hora (3600 segundos) para el "tiempo determinado":
         */
        $tiempo_expiracion = time() + (10); // Cookie caduca en 1 hora

        // setcookie(nombre, valor, tiempo_expiracion, ruta)
        setcookie($nombre_cookie, $contador_forms, $tiempo_expiracion, "/");

        $archivof = fopen($archivo, "a") or die("No se puede abrir el archivo ");
        $nombre = $_POST["nombre"];
        $apellido1 = $_POST["apellido1"];
        $apellido2 = $_POST["apellido2"];
        $correo = $_POST["correo"];
        $edad = $_POST["edad"];
        $aficiones = $_POST["aficiones"];
        $texto = " Nombre : " . $nombre . "| Apellido 1 : " . $apellido1 . "| Apellido2 : " . $apellido2 . "| Correo : " . $correo . "|Edad : " . $edad . "| Aficiones : " . $aficiones . "\n";
        fwrite($archivof, $texto);

        fclose($archivof);
        // Para que la pagina rediriga al  html 
        header("Location:contador_form.php");
        exit;
    }

    if (file_exists($archivo)) {

        // 2. Leer el contenido del archivo completo
        $contenido = file_get_contents($archivo);

        if ($contenido !== false && $contenido !== "") {
            // 3. Mostrar el contenido usando la etiqueta <pre>
            //    <pre> mantiene el formato original, incluidos los saltos de línea (\n).
            echo "<pre>";
            echo htmlspecialchars($contenido);
            echo "</pre>";
        } else {
            echo "<p>El archivo existe, pero está vacío.</p>";
        }
    } else {
        echo "<p>Aún no hay datos guardados.</p>";
    }


    ?>

</body>