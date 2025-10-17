<?php

// 1. Comprobar si los datos han sido enviados por el método POST


// 2. Recoger y limpiar los datos del formulario
// htmlspecialchars() evita ataques XSS (Cross-Site Scripting)
// 3. Validar los datos
 
// Validar nombre
   
// Validar email
  
// Validar mensaje
   
// 4. Procesar los datos (si no hay errores)
  
// Si hay errores, los mostramos
       
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $erroresMsg[] = [];
    $datos[] = [];
 
    $nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : null;
    $email = !empty($_POST['email']) ? $_POST['email'] : null;   
    $mensaje = !empty($_POST['mensaje']) ? $_POST['mensaje'] : null;

    if (!is_null($nombre)) {
        htmlspecialchars($nombre);
        trim($nombre);
        //echo "El nombre escrito es: $nombre <br>";
        $datos[] = $nombre; 
    } else {
        unset($nombre);
        $erroresMsg[] = "No se ha escrito ningun nombre <br>";
    }

    if (!is_null($email)) {
        htmlspecialchars($email);
        trim($email);
        //echo "El correo electronico escrito es: $email <br>";

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //echo "El correo electronico esta escrito correctamente <br>";
            $datos[] = $email; 
        } else {
            $erroresMsg[] = "El correo electronico esta mal escrito <br>";
        }
    } else {
        unset($email);
        $erroresMsg[] = "No se ha escrito ningun correo electronico <br>";
    }

    if (!is_null($mensaje)) {
        htmlspecialchars($mensaje);
        trim($mensaje);
        //echo "El mensaje escrito es: $mensaje <br>";
        $datos[] = $mensaje; 
    } else {
        unset($mensaje);
        $erroresMsg[] = "No se ha escrito ningun mensaje <br>";
    }

    if (count($erroresMsg) > 1) {
        echo "Errores: <br>";
        foreach ($erroresMsg as $error) {
            print_r($error);
        }
        //var_dump($erroresMsg);
    } else {
        echo "Datos: <br>";
        foreach ($datos as $data) {
            print_r($data);
        }
        //var_dump($datos);
    }

} else {
    echo "Formulario con no POST <br>";
}

?>