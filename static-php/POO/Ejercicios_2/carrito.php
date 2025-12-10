<?php
    require_once 'producto.php';

    class Carrito {
        private $listaProducto = [];

        public function __construct() { }

        public function agregarProducto($productos) {
            foreach ($productos as $p) {
                $this->listaProducto[] = $p; 
                echo "Se ha agregado el productos con nombre " . $p->nombre . "<br>";
            }      
        }

        public function eliminarProducto($producto) {
            $listaProductosActualizados = array_filter($this->listaProducto, fn($p) => $p->nombre !== $producto->nombre);

            if (count($listaProductosActualizados) !== count($this->listaProducto)) {
                echo "Se han borrado todos los productos con nombre " . $producto->nombre . "<br>";
                $this->listaProducto = array_values($listaProductosActualizados);
            } else {
                echo "Estos productos no existen en el carrito <br>";
            }
        }

        public function calcularTotal() {
            $total = 0;

            foreach ($this->listaProducto as $producto) {
                $total += $producto->precio * (1 + Producto::IVA);
            }

            return $total;
        }

        public function obtenerDatos() {
            foreach ($this->listaProducto as $producto) {
                echo "Producto: " . $producto->nombre . " con precio: " . $producto->precio . "<br>";
            }  
        }
    }

?>
