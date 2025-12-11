<?php

    require_once './traits/Logeable.php';

    class NotificacionAbstracta {
        protected string $mensaje;
        use TLogeable;
        
        public function __construct(string $mensaje) {
            $this->mensaje = $mensaje;
        }
    }

?>