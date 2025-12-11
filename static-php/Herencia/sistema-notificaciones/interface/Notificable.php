<?php

    interface INotificable {
        public function enviar(string $destinatario): bool;
    }

?>