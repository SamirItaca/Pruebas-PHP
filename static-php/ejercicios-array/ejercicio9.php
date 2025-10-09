<?php

    $numeros_a = [1, 2, 3, 4, 5];
    $numeros_b = [3, 4, 5, 6, 7];

    $estanEnAyNoB = array_diff($numeros_a, $numeros_b); // 3, 4, 5
    $numerosComunes = array_intersect($numeros_a, $numeros_b); // 1, 2, 6, 7

    print_r($estanEnAyNoB);
    print_r($numerosComunes);
    
?>