<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificador de Números Primos</title>
    <style>
        body { font-family: sans-serif; max-width: 500px; margin: 40px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; text-align: center; }
        input[type="number"] { padding: 8px; font-size: 1.2em; }
        input[type="submit"] { padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; font-size: 1em; }
        .resultado { margin-top: 25px; font-size: 1.5em; font-weight: bold; }
        .es-primo { color: #28a745; }
        .no-es-primo { color: #dc3545; }
    </style>
</head>
<body>

    <h1>Verificador de Números Primos</h1>
    <p>Introduce un número entero para saber si es primo.</p>

    <!-- formulario para introducir los datos --> 

    <form action="verificar_primo.php" method="post"> <!-- este es el fichero que contiene el codigo php y va a usar el metodo post-->
        <input type="number" name="numero" placeholder="Ej: 17" required>  <!-- required bloquea el envio si no se pone un numero -->
        <br><br>

        <input type="submit" value="Verificar">
        <br><br>
    </form>

    <h1>Verificador de varios números primos</h1>
    <p>Introduce un número entero sus numeros primos</p>
    <form action="verificar_primo.php" method="post"> <!-- este es el fichero que contiene el codigo php y va a usar el metodo post-->
        <input type="number" name="numIterable" placeholder="Ej: 10" required>  <!-- required bloquea el envio si no se pone un numero -->
        <br><br>

        <input type="submit" value="Verificar primos">
    </form>

    <div class="resultado">
        <?php
        // 1. FUNCIÓN PARA DETERMINAR SI UN NÚMERO ES PRIMO
        function esPrimo($num) {
            // Los números menores o iguales a 1 no son primos.
            if ($num <= 1) {
                return false;
            }
            // Comprobamos divisores desde 2 hasta la raíz cuadrada del número.
            // no es necesario comprobrobar si todos los numeros son divisores
            for ($i = 2; $i <= sqrt($num); $i++) {
                if ($num % $i == 0) {
                    return false; // No es primo si encuentra un divisor.
                }
            }
            return true; // Es primo si antes no ha encontrado un dividsor
        }

        function verificarVariosPrimos($numIterable) {
            for ($num = 1; $num <= $numIterable; $num++) {
                if (esPrimo($num)) {
                    echo $num . "-";
                } 
            }
        }

        // 2. VERIFICAR SI EL FORMULARIO HA SIDO ENVIADO
        // usamos $_SERVER["REQUEST_METHOD"] para comprobar si el metodo es post o get
        // haremos algo solamente si se le ha pedido al servidor , no siempre que cargue
        // la pagina
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            // 3. OBTENER EL NÚMERO DEL FORMULARIO
            // Buscamos que se haya enviado algo en el metodo post
            // el metodo post crea un array asociativo (pares clave valor)
            // la funcion de php isset() comprueba que una variable 
            // tiene un valor y que no es null
            // Como el metodo post SIEMPRE recibe una cadena de texto,
            // la funcion intval convierte esa cadena a un entero    

            $numero_usuario = isset($_POST['numero']) ? intval($_POST['numero']) : 0;

            // 4. LLAMAR A LA FUNCIÓN Y MOSTRAR EL RESULTADO
            if ($numero_usuario != 0) {
                if (esPrimo($numero_usuario)) {
                echo "<p class='es-primo'>El número $numero_usuario ¡es primo! ✅</p>";
                } else {
                    echo "<p class='no-es-primo'>El número $numero_usuario no es primo. ❌</p>";
                }
            }

            $numIterable = isset($_POST['numIterable']) ? intval($_POST['numIterable']) : 0;
            verificarVariosPrimos($numIterable);
        }
        ?>
    </div>

</body>
</html>