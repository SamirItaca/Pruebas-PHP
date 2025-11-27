<?php

session_start();

//Leer el nombre de usuario del post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre_usuario'])) {
    $nombre = trim($_POST['nombre_usuario']);

    if (!empty($nombre)) {
        // Guardar el nombre en la sesión
        $_SESSION['usuario'] = $nombre;
        // Prevenir reenvío del formulario al recargar
        header("Location: index.php");
        exit;
    }
}

// Obtener formulario, guardar los datos en un fichero, y actualizar el contador
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['set_tema'])) {


    // Tiempo en segundos que la cookie existira despues de cerrar sesión, ejemplo: 30 minutos
    $tiempo_cookie = 1800;

    // Si la cookie existe, aumentamos su valor
    if (isset($_COOKIE['formularios_enviados'])) {
        $contador = (int)$_COOKIE['formularios_enviados'] + 1;
    } else {
        $contador = 1;
    }

    // Crear/actualizar cookie
    setcookie(
        'formularios_enviados',
        $contador,
        time() + $tiempo_cookie, // expira 30 min después de cerrar sesión
    );
    
}

$logueado = isset($_SESSION['usuario']);
$nombre_usuario = $logueado ? htmlspecialchars($_SESSION['usuario']) : '';

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: <?php echo $color_fondo; ?>; 
            color: <?php echo $color_texto; ?>;
            transition: background-color 0.5s;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: <?php echo ($tema === 'oscuro') ? '#444' : '#fff'; ?>;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .tema-form button {
            padding: 10px 15px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <?php if ($logueado): ?>
                <h2>¡Hola, <?php echo $nombre_usuario; ?>!</h2>
                <p>Tu tema actual es: **<?php echo ucfirst($tema); ?>**</p>
                <p><a href="cerrar_sesion.php">Cerrar Sesión</a></p>
            <?php else: ?>
                <h2>Iniciar Sesión</h2>
            <?php endif; ?>
        </header>

        <hr>

        <?php if (!$logueado): ?>
            <h3>Paso 1: Identificación (Sesión)</h3>
            <p>Introduce tu nombre para iniciar la sesión.</p>
            <form method="POST" action="index.php">
                <input type="text" name="nombre_usuario" placeholder="Tu Nombre" required>
                <button type="submit">Guardar Nombre en Sesión</button>
            </form>
        <?php else: ?>

            <p>Rellena el formulario.</p>

            <form method="POST" action="index.php" class="tema-form">
                
            </form>
            
            <hr>
            
            <p>El nombre **<?php echo $nombre_usuario; ?>** persiste gracias a la **Sesión**.</p>
        <?php endif; ?>
    </div>
</body>
</html>