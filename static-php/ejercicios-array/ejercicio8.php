<?php 
    $paisesCapital = [
        ["pais" => "Venezuela", "capital" => "Caracas"],
        ["pais" => "España", "capital" => "Madrid"],
        ["pais" => "Colombia", "capital" => "Bogota"]
    ];

    foreach ($paisesCapital as $paisCapital) {
        print_r($paisCapital["pais"] . " y su capital es: " . $paisCapital["capital"] . "<br>");
    }
?>