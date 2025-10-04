<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <?php
        // Iniciamos la sesion y el array de datos para la tabla
        session_start();

        // Archivo con las funciones necesarias
        include 'datos.php';

        // Acciones de guardado o eliminacion
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['name'])) {
            saveDataForGet();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['id'])) {
                deleteData();
            } else {
                saveDataForPost();
            }
        }
    ?>

    <div class="container text-center">

        <div class="row">

            <!-- Columna izquierda -->
            <div class="col">

                <!-- Formulario GET -->
                <div style="padding: 24px;">
                    <h1>Guardar datos via GET</h1>
                    <form action="tabla.php" method="get">

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="number" name="number" placeholder="Ej 1">
                            <label for="number">Numero ID</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Juan">
                            <label for="name">Nombre</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Pérez">
                            <label for="lastname">Apellido</label>
                        </div>

                        <button type="submit" class="btn btn-success">Guardar datos</button>

                    </form>
                </div>
                
                <!-- Formulario POST -->
                <div style="padding: 24px;">
                    <h1>Guardar datos via POST</h1>
                    <form action="tabla.php" method="post">

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="number" name="number" placeholder="Ej 1">
                            <label for="number">Numero ID</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Juan">
                            <label for="name">Nombre</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Pérez">
                            <label for="lastname">Apellido</label>
                        </div>

                        <button type="submit" class="btn btn-success">Guardar datos</button>

                    </form>
                </div>

            </div>

            <!-- Columna derecha -->
            <div class="col">

                <!-- Tabla de datos -->
                <div style="padding: 24px;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Numero ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php printTable(); ?>
                        </tbody>
                    </table>

                    <?php if (!empty($_SESSION['datos_totales'])): ?>
                        <form method="post" action="tabla.php">
                            <input type="hidden" name="clear" value="1">
                            <button type="submit" class="btn btn-outline-danger">Vaciar todo</button>
                        </form>
                    <?php endif; ?>
                </div>

            </div>

        </div>

    </div>

    <?php
        // Botón de "Vaciar todo"
        if (isset($_POST['clear'])) {
            $_SESSION['datos_totales'] = [];
            header("Location: tabla.php");
            exit;
        }
    ?>
    
</body>
</html>