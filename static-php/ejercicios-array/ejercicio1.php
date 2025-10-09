<?php

    $dias_semana = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes");
    echo "El tercer dia de la semana es: " . $dias_semana[2] . "<br> <br>";

    array_push($dias_semana, "Sabado", "Domingo");

    echo "Dias de la semana: <br>";
    foreach ($dias_semana as $dias) {
        echo $dias . "<br>";
    }

?>