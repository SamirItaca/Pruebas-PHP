<?php

    $productos = [];

    $leche = ["name" => "Leche", "precio" => "0.30"];
    $pan = ["name" => "Pan", "precio" => "0.75"];

    echo "Precio del Pan es: " . $pan["precio"] . "<br><br>";
    
    $agua = ["name" => "agua", "precio" => "0.10"];

    array_push($productos, $leche, $pan, $agua);

    foreach ($productos as $prod) {
        echo "Producto: " . $prod["name"] . " y su precio es: " . $prod["precio"] . "<br>";
    }

?>