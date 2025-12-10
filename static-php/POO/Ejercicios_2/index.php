<?php

    require_once 'login.php';
    echo "<h2>Sistema de login</h2>";
    $user = new Usuario('Ronny', 'ron@gmail.com', '1234');
    $user->obtenerDatos();
    $mensaje = "El usuario " . $user->getUsername();
    $mensaje .= $user->esAdmin() ? " es Admin" : " no es Admin";
    echo $mensaje;
    echo "<hr>";

    require_once 'coche.php';
    require_once 'gasolinera.php';
    echo "<h2>Coche y Gasolinera</h2>";
    $coche = new Coche(50);
    $gasolinera = new Gasolinera(200);
    $gasolinera->surtir($coche, 25);
    echo "<hr>";

    require_once 'producto.php';
    require_once 'carrito.php';
    echo "<h2>Carrito de la compra</h2>"; 
    $producto1 = new Producto("Cereal", 2);
    $producto2 = new Producto("Pan", 7);
    $producto3 = new Producto("Donas", 4);
    $carritoCompra = new Carrito();
    $carritoCompra->agregarProducto([$producto1, $producto2, $producto3]);
    $carritoCompra->obtenerDatos();
    $carritoCompra->eliminarProducto($producto2);
    $carritoCompra->obtenerDatos();
    echo "De todos los productos el total con IVA es: " . $carritoCompra->calcularTotal() . "<br>";
    echo "<hr>";

?>