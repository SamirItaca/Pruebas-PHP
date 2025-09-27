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

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// POST - Verificar primos
if ($request === '/api/verificar-primo' && $method === "POST") {
    $numero_usuario = isset($_POST['numero']) ? intval($_POST['numero']) : 0;

    if ($numero_usuario != 0) {
        if (esPrimo($numero_usuario)) {
            echo "<p class='es-primo'>El número $numero_usuario ¡es primo! ✅</p>";
        } else {
            echo "<p class='no-es-primo'>El número $numero_usuario no es primo. ❌</p>";
        }
    }

    exit;
}

// POST - Verificar primos entre 2 enteros
if ($request === '/api/verificar-primo-entre-dos' && $method === "POST") {
    $num1 = isset($_POST['num1']) ? intval($_POST['num1']) : 0;
    $num2 = isset($_POST['num2']) ? intval($_POST['num2']) : 0;

    verificarPrimosEntreDosEnteros($num1, $num2);

    exit;
}

http_response_code(404);
echo json_encode(["error" => "Not Found"]);
exit;