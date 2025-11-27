<?php

    require_once 'rectangulo.php';
    echo "<h2>Ejercicio 1: Rectangulo</h2>";
    $rectangulo = new Rectangulo(10, 5);
    echo "Área del rectángulo: " . $rectangulo->calcularArea() . "<br>";
    echo "Perímetro del rectángulo: " . $rectangulo->calcularPerimetro() . "<br>";
    echo "<hr>";

    require_once 'termostato.php';
    echo "<h2>Ejercicio 2: Termostato</h2>";
    $termostato = new Termostato(20);
    echo "Temperatura inicial: " . $termostato->obtenerTemperatura() . "<br>";
    echo "Sumar temperatura:<br>"; 
    $termostato->calentar();
    echo "Temperatura después de calentar: " . $termostato->obtenerTemperatura() . "<br>";
    echo "Restar temperatura:<br>";
    $termostato->enfriar();
    echo "Temperatura después de enfriar: " . $termostato->obtenerTemperatura() . "<br>";
    echo "<hr>";

    require_once 'banco.php';
    echo "<h2>Ejercicio 3: Cuenta bancaria</h2>";
    $cuenta = new Banco("Juan Pérez", "Ahorros", 1000);
    echo "La cuenta de " . $cuenta->titular . " tiene como saldo inicial: " . $cuenta->mostrarSaldo() . "<br>";
    echo "Ingresar 500 a la cuenta<br>";
    $cuenta->ingresar(500);
    echo "La cuenta de " . $cuenta->titular . " tiene como saldo: " . $cuenta->mostrarSaldo() . " despues del ingreso<br>";
    echo "Retirar 250 a la cuenta<br>";
    $cuenta->retirar(250);
    echo "La cuenta de " . $cuenta->titular . " tiene como saldo: " . $cuenta->mostrarSaldo() . " despues del retiro<br>";
    echo "<hr>";

    require_once 'personaje.php';
    echo "<h2>Ejercicio 4: Personaje</h2>";
    $protagonista = new Personaje("Prota", 10);
    $enemigo = new Personaje("Enemigo", 20);
    $protagonista->obtenerDatos();
    $enemigo->obtenerDatos();
    $protagonista->atacar($enemigo);
    $protagonista->atacar($enemigo);
    $enemigo->obtenerDatos();
    $enemigo->curarse();
    $enemigo->obtenerDatos();
    echo "<hr>";

    require_once 'tareas.php';
    echo "<h2>Ejercicio 5: Lista de tareas</h2>";
    $listaTarea = new Tarea();
    $listaTarea->agregarTarea("Ir al mercadona");
    $listaTarea->agregarTarea("Comprar agua");
    $listaTarea->agregarTarea("Salir");
    $listaTarea->mostrarTareas();
    echo "<hr>";

    require_once 'dado.php';
    echo "<h2>Ejercicio : Dado</h2>";
    $dado = new Dado();
    $totalTiradaDado = 0;
    for ($i = 0; $i < 10; $i++) {
        $totalTiradaDado += $dado->tirar();
    }
    echo "Total: " . $totalTiradaDado;
    
?>