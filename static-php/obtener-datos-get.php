<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/table.css">
</head>
<body>
    
    <?php
        session_start();

        if(!isset($_SESSION['datos_totales'])){
            $_SESSION['datos_totales'] = [];
        }

        function imprimirTabla($datos) {
            $contenido = '';
            $id;
            
            foreach ($datos as $fila) { // cada fila es [number, name, lastname]
                $contenido .= "<tr>";
                foreach ($fila as $columna) {
                    $contenido .= "<td>{$columna}</td>";

                    if (is_int($columna)) {
                        $id = $columna;
                    }
                }

                $button = ' <form action="obtener-datos-post.php" method="post">
                                <input type="submit" name="' . $id . '" value="Eliminar">
                            </form>'; 

                $contenido .= "<td>{$button}</td>";
                $contenido .= "</tr>";
            }
            return $contenido;
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
                
            $number = isset($_GET['number']) ? intval($_GET['number']) : 0;
            $name = $_GET['name'] ?? '';
            $lastname = $_GET['lastname'] ?? '';

            $_SESSION['datos_totales'][] = [$number, $name, $lastname];
        }

        if (count($_SESSION['datos_totales']) > 0) {
            $tabla = "
                <table>
                    <tr>
                        <th>Numero</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                    </tr>
                    <tr>"  
                        . imprimirTabla($_SESSION['datos_totales']) .
                    "</tr>
                </table>
            ";

            echo $tabla;
        }
    ?>

</body>
</html>