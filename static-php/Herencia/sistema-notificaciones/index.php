<?php

    require_once 'class/NotificacionEmail.php';
    require_once 'class/NotificacionSMS.php';

    $notSMS = new NotificacionSMS("mensaje desde el SMS");
    $notEmail = new NotificacionEmail("mensaje desde el Email");

    /**
    * Procesa el envío de cualquier objeto que cumpla el contrato INotificable.
    * @param INotificable $notificacion Objeto a enviar.
    * @param string $receptor Dirección/Número al que se envía.
    * @return void
    */
    function procesarEnvio(INotificable $notificacion, string $receptor) {
        if ($notificacion->enviar($receptor)) {
            echo "Envío finalizado con éxito.\n";
        } else {
            echo "Error en el envío.\n";
        }
    }

    procesarEnvio($notSMS, "1243243213245");
    echo '<br>';
    procesarEnvio($notEmail, "usuario@correo.com");

?>