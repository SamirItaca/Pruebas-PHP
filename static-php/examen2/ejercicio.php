<?php

    $productoStock = ["Portatil", "Teclado", "Raton", "Portatil", "Portatil"];
    $productoNuevos = ["SSD", "Monitor", "Portatil", "Portatil", "Portatil"];

    $productoRepetido;

    $productos;

    // Guardar los productos repetidos (solo guarda uno)
    foreach ($productoStock as $stock) {
        $productoGuardado = false;

        foreach ($productoNuevos as $nuevo) {

            //echo $stock . " - " . $nuevo . " : " . ($stock === $nuevo) . "<br>";

            if ($stock === $nuevo) {
                $productoRepetido[] = $nuevo;
                $productoGuardado = true;
                break;
            }

        }

        if ($productoGuardado) {
            break;
        }

    }

    // Añadir todos los productos en stock menos los repetidos.
    foreach ($productoRepetido as $repetido) {

        foreach ($productoStock as $stock) {
            
            if ($repetido !== $stock) {
                $productos[] = $stock;
            }

        }

    }

    // Añadir todos los productos nuevos menos los repetidos.
    foreach ($productoRepetido as $repetido) {

        foreach ($productoNuevos as $nuevo) {
            
            if ($repetido !== $nuevo) {
                $productos[] = $nuevo;
            }

        }

    }

    // Añadir los productos repetidos
    foreach ($productoRepetido as $repetido) {
        $productos[] = $repetido;
    }

    echo "<pre>";
    print_r($productos);
    echo "</pre>";

?>