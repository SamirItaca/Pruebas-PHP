<?php

    $numeros = [10, 20, 30, 40, 50];

    foreach ($numeros as $num) {
        $numeros[] = $num;
    }

    print_r($numeros);
?>