<?php

    require_once 'NotificacionAbstracta.php';
    require_once './interface/Notificable.php';

    class NotificacionEmail extends NotificacionAbstracta implements INotificable {

        public function __construct(string $mensaje) {
            parent::__construct($mensaje);
        }

        public function enviar(string $destinatario): bool {
            echo "Enviando Email con mensaje: '{$this->mensaje}' a: {$destinatario}";
            return true;
        }
        
    }

?>