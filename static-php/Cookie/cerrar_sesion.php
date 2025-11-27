<?php
// Iniciar la sesión
session_start();

// Asignar un array vacio a la sesion (borra la sesión)
$_SESSION = array(); 

// Si la cookie de sesion existe, le damos un tiempo en el pasado para destruirla
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir la sesión en el servidor.
session_destroy();

// Eliminar la cookie despues de 5 mi
setcookie("formularios_enviados", "", time() - 3600, "/"); 

// Redirigir al usuario a la página principal.
header("Location: contador_form.php");
exit;
?>