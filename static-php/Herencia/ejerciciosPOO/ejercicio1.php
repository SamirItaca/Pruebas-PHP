<?php 

    interface IAlmacenamiento {
        public function guardar(string $datos): bool;
        public function recuperar(string $clave): string;
    }

    class AlmacenamientoEnFichero implements IAlmacenamiento {

        public function guardar(string $datos): bool {
            echo "Dato nuevo: " . $datos . "<br>";
            echo "Se guardo el dato en un fichero <hr>";
            return true;
        }

        public function recuperar(string $clave): string {
            return "Dato recuperado del fichero <hr>";
        }

    }

    class AlmacenamientoEnMemoria implements IAlmacenamiento {

        public function guardar(string $datos): bool {
            echo "Dato nuevo: " . $datos . "<br>";
            echo "Se guardo el dato en memoria <hr>";
            return true;
        }

        public function recuperar(string $clave): string {
            return "Dato recuperado de la memoria: <hr>";
        }
        
    }

    class ProcesarDatos {

        public $almacenamiento;

        public function __construct(IAlmacenamiento $almacenamiento) {
            $this->almacenamiento = $almacenamiento;
        }

        public function procesarYguardar(string $datos): void {
            $this->almacenamiento->guardar($datos);
        }
    }

    $alcmFichero = new AlmacenamientoEnFichero();
    $alcmMemoria = new AlmacenamientoEnMemoria();

    $procFichero = new ProcesarDatos($alcmFichero);
    $procMemoria = new ProcesarDatos($alcmMemoria);

    $procFichero->procesarYguardar("'para guardar en el fichero'");
    echo $procFichero->almacenamiento->recuperar("clave");

    $procMemoria->procesarYguardar("'esto se guardara en memoria'");
    echo $procMemoria->almacenamiento->recuperar("clave");


?>