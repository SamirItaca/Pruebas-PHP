<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sobrescribir fichero con POO</title>
    </head>

    <body>
        <!-- Crear el formulario   -->
        <form action="writeFile.php" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="apellido1">Apellido 1</label>
            <input type="text" id="apellido1" name="apellido1" required> <br>

            <!-- No añadimos el required aqui para que no sea obligatorio este campo  -->
            <label for="apellido2">Apellido 2</label>
            <input type="text" id="apellido2" name="apellido2"> <br>

            <label for="edad">Edad </label>
            <input type="number" id="edad" name="edad" required> <br>

            <!-- type email para ahorrarnos la comprobacionen php  -->
            <label for="correo">Correo electronico </label>
            <input type="email" id="email" name="email" required> <br>

            <label for="aficiones">Aficiones</label>
            <select name="aficiones" id="aficiones">
                <option value="viajar">viajar</option>
                <option value="pescar">pescar</option>
                <option value="futbol">futbol</option>
            </select>

            <br><br>

            <button type="submit">Enviar datos al fichero</button>
        </form>

        <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                class Fichero {
                    public $nombre;
                    public $apellido1;
                    public $apellido2;
                    public $edad;
                    public $email;
                    public $aficion;
                    public $contentFile;

                    public function __construct($nombre, $apellido1, $apellido2, $edad, $email, $aficion) {
                        $this -> nombre = $nombre;
                        $this -> apellido1 = $apellido1;
                        $this -> apellido2 = $apellido2;
                        $this -> edad = $edad;
                        $this -> email = $email;
                        $this -> aficion = $aficion;
                        $this -> contentFile = "";
                    }
                        
                    public function writeFile($nameFile) {
                        $file = fopen($nameFile, "w") or die("No se pudo abrir el fichero");

                        $this -> contentFile .= isset($this -> nombre) ? "Nombre: " . $this -> nombre . PHP_EOL : "";
                        $this -> contentFile .= isset($this -> apellido1) ? "Apellido 1: " . $this -> apellido1 . PHP_EOL : "";
                        $this -> contentFile .= isset($this -> apellido2) ? "Apellido 2: " . $this -> apellido2 . PHP_EOL : "";
                        $this -> contentFile .= isset($this -> edad) ? "Edad: " . $this -> edad . PHP_EOL : "";
                        $this -> contentFile .= isset($this -> email) ? "Correo electronico: " . $this -> email . PHP_EOL : "";
                        $this -> contentFile .= isset($this -> aficion) ? "Aficion: " . $this -> aficion . PHP_EOL : "";

                        fwrite($file, $this -> contentFile);
                        fclose($file);
                    }

                }

                $dato = new Fichero($_POST["nombre"], $_POST["apellido1"], $_POST["apellido2"], $_POST["edad"], $_POST["email"], $_POST["aficiones"]);
                $dato -> writeFile("usuario.txt");

            }
        ?>

    </body>
</html>
