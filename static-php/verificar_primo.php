<?php
        function esPrimo($num) {
            if ($num <= 1) {
                return false;
            }

            for ($i = 2; $i <= sqrt($num); $i++) {
                if ($num % $i == 0) {
                    return false; 
                }
            }
            return true;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
             
            $numero_usuario = isset($_POST['numero']) ? intval($_POST['numero']) : 0;

            if ($numero_usuario != 0) {
                if (esPrimo($numero_usuario)) {
                    echo "<p class='es-primo'>El número $numero_usuario ¡es primo! ✅</p>";
                } else {
                    echo "<p class='no-es-primo'>El número $numero_usuario no es primo. ❌</p>";
                }
            }
        }
?>