<?php 
    $numerosDesornados = [4, 2, 7, 1, 3, 9];

    // Orden ascendente
    sort($numerosDesornados);
    echo "Numero ordenador ascendente: ";
    print_r($numerosDesornados);
    echo "<br>";

    // Orden desendente
    rsort($numerosDesornados);
    echo "Numero ordenador descendente: ";
    print_r($numerosDesornados);


?>