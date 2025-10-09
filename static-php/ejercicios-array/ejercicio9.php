<?php

    $numeros_a = [1, 2, 3, 4, 5];
    $numeros_b = [3, 4, 5, 6, 7];

    $numerosDiferentes = array_diff($numeros_a, $numeros_b);
    $numerosComunes = array_intersect($numeros_a, $numeros_b);

    print_r($numerosDiferentes);
    print_r($numerosComunes);
    
?>