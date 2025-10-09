<?php 
    $alumnos = [
        ["nombre" => "Mike", "edad" => "26", "curso" => "Biologia"],
        ["nombre" => "Ashly", "edad" => "20", "curso" => "Fisica"],
        ["nombre" => "Alex", "edad" => "34", "curso" => "Quimica"]
    ];

    print_r($alumnos[1]["nombre"] . "<br>");
    
    foreach ($alumnos as $alum) {
        echo "Alumno " . $alum["nombre"] . " tiene como edad " . $alum["edad"] . " y cursa " . $alum["curso"] . "<br>";
    }
    
?>