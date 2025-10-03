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
        $datos = array();

        function imprimirTabla($datos) {
            $contenido = '';
            for ($i = 0; $i < count($datos); $i++) {
                $contenido .= "<td>{$datos[$i]}</td>";
            }
            return $contenido;
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
                
            $number = isset($_GET['number']) ? intval($_GET['number']) : 0;
            $name = $_GET['name'] ?? '';
            $lastname = $_GET['lastname'] ?? '';

            $datos[] = $number;
            $datos[] = $name;
            $datos[] = $lastname;
            
            //print_r($datos);
        }

        if (count($datos) > 0) {
            $tabla = "
                <table>
                    <tr>
                        <th>Numero</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                    </tr>
                    <tr>"  
                        . imprimirTabla($datos) .
                    "</tr>
                </table>
            ";

            echo $tabla;
        }
    ?>

</body>
</html>