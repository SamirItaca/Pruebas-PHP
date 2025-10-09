<?php

    $numeros = [1, 25, 40, 60, 75, 50];
    echo "La cantidad de numeros que hay son: " . count($numeros) . "<br>";

    $clave = 0;

    foreach ($numeros as $num) {
        if ($num == 50) {
            $clave = array_search($num, $numeros);
        }
    }

    if ($clave != 0) {
        echo "Existe el numero 50 en el Array y su clave es: " . $clave;
    } else {
        echo "No existe el numero 50 en el Array";
    }
    
?>