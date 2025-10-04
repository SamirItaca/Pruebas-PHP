<?php

    function printTable() {
        if (empty($_SESSION['datos_totales'])) return;

        foreach ($_SESSION['datos_totales'] as $index => $fila) {
            echo "<tr>";
            foreach ($fila as $columna) {
                echo "<td>" . htmlspecialchars($columna) . "</td>";
            }
            echo "<td>
                    <form action='tabla.php' method='post' style='display:inline;'>
                        <input type='hidden' name='id' value='{$index}'>
                        <button type='submit' class='btn btn-danger btn-sm'>Eliminar</button>
                    </form>
                </td>";
            echo "</tr>";
        }
    }

    function saveDataForPost() {
        $number = isset($_POST['number']) ? intval($_POST['number']) : 0;
        $name = $_POST['name'] ?? '';
        $lastname = $_POST['lastname'] ?? '';

        $_SESSION['datos_totales'][] = [$number, $name, $lastname];
    }

    function saveDataForGet() {
        $number = isset($_GET['number']) ? intval($_GET['number']) : 0;
        $name = $_GET['name'] ?? '';
        $lastname = $_GET['lastname'] ?? '';

        $_SESSION['datos_totales'][] = [$number, $name, $lastname];
    }

    function deleteData() {
        if (isset($_POST['id']) && is_numeric($_POST['id'])) {
            $id = intval($_POST['id']);

            // Verificamos que el índice exista antes de eliminar
            if (isset($_SESSION['datos_totales'][$id])) {
                unset($_SESSION['datos_totales'][$id]);

                // Reindexamos el array para evitar huecos
                $_SESSION['datos_totales'] = array_values($_SESSION['datos_totales']);
            }
        }
    }

?>