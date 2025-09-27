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

        function verificarPrimosEntreDosEnteros($num1, $num2) {
            echo "Los numeros primos entre $num1 y $num2 son: <br>";
            for ($num = $num1; $num <= $num2; $num++) {
                if (esPrimo($num)) {
                    echo $num . "-";
                } 
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $num1 = isset($_POST['num1']) ? intval($_POST['num1']) : 0;
            $num2 = isset($_POST['num2']) ? intval($_POST['num2']) : 0;

            verificarPrimosEntreDosEnteros($num1, $num2);
        }
?>