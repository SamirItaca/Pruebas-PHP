<?php

    $numeros = [10, 20, 30, 40, 50];
    $numerosDuplicados = [];

    foreach ($numeros as $num) {
        $numerosDuplicados[] = $num * 2;
    }

    print_r($numerosDuplicados);
?>