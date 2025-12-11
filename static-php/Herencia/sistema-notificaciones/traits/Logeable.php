<?php

    trait TLogeable {
        protected function registrar(string $mensaje): void {
            $timestamp = date("Y-m-d H:i:s");
            echo "[$timestamp] LOG: $mensaje - ";
        }
    }

?>