<?php 

    class Usuario {

        const ROL_ADMIN = 'Admin';
        const ROL_USER = 'User';

        private $username;
        private $email;
        private $password;
        private $rol;

        public function __construct($username, $email, $password) {
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->rol = self::ROL_USER; 
        }

        public function cambiarContraseña($actual, $nueva) {
            if ($actual !== $this->password) {
                echo "No se puede cambiar: contraseña actual incorrecta";
                return;
            }

            $this->password = $nueva;
        }

        public function getUsername() {
            return $this->username;
        }

        public function esAdmin() {
            return $this->rol === self::ROL_ADMIN ? true : false;
        }

        public function obtenerDatos() {
            echo "El usuario " . $this->username . " tiene como email: " . $this->email . " y contraseña: **** <br>";
        }

    }

?>