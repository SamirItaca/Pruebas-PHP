<?php

class Gestor{

    public $listaAlumnos;
    public $listaModulos;
    public $mensajeEstado;

    public function __construct() {
        $this->listaAlumnos = [];
        $this->listaModulos = [];
        $this->mensajeEstado = new Mensaje("Elige una accion a realizar", "");
    }

    public function eliminarTodo() {
        // Vaciar listas internas
        $this->listaAlumnos = [];
        $this->listaModulos = [];

        // Limpiar todas las variables de sesión
        session_unset();   // Elimina todas las variables de sesión
        session_destroy(); // Destruye la sesión completa

        // Iniciar una nueva sesión para poder seguir trabajando
        session_start();

        // Crear un nuevo Gestor y guardarlo en la sesión
        $_SESSION['gestor'] = new Gestor();

        $this -> mensajeEstado = new Mensaje("Se ha eliminado todo correctamente", "correcto");
    }
    
    // ACCIONES PARA EL ALUMNO
    public function crearAlumno() {
        $nombre = $_POST['nombre'] ?? null;
        $apellido = $_POST['apellido'] ?? null;
        $modulosSeleccionados = $_POST['modulos'] ?? [];

        $modulosObjetos = [];

        // Convertir IDs a objetos Modulo
        foreach ($this->listaModulos as $modulo) {
            if (in_array($modulo->id, $modulosSeleccionados)) {
                $modulosObjetos[] = $modulo;
            }
        }

        if (!empty($nombre)) {
            $this -> listaAlumnos[] = new Alumno($nombre, $apellido, $modulosObjetos);
            $this -> mensajeEstado = new Mensaje("Alumno " . $nombre . " creado correctamente", "correcto");
        } else {
            $this -> mensajeEstado = new Mensaje("No ha escrito un nombre para el alumno", "error");
        }
    }

    public function eliminarAlumno($id) {
        if ($this->existeAlumno($id)) {
            // Buscamos el indice del alumno en el array
            foreach ($this->listaAlumnos as $index => $alumno) {
                if ($alumno->id == $id) {
                    // Eliminamos el alumno del array
                    unset($this->listaAlumnos[$index]);

                    // Reordenamos el array para que no queden "huecos"
                    $this->listaAlumnos = array_values($this->listaAlumnos);

                    $this->mensajeEstado = new Mensaje("Alumno eliminado correctamente", "correcto");
                }
            }
        } 
    }

    public function consultarAlumno($id) {
        if ($this->existeAlumno($id)) {
            $_SESSION['alumnoSeleccionadoId'] = $id;

            header("Location: detalle_alumno.php");
            exit;
        }
    }

    public function irActualizarAlumno($id) {
        if ($this->existeAlumno($id)) {
            $_SESSION['alumnoSeleccionadoId'] = $id;

            header("Location: actualizar_alumno.php");
            exit;
        }
    }

    public function actualizarAlumno($id, $nuevoNombre, $nuevoApellido, $modulosSeleccionados) {

        if (!$this->existeAlumno($id)) {
            return;
        }

        // Buscar el alumno en la lista
        foreach ($this->listaAlumnos as $alumno) {
            if ($alumno->id == $id) {

                // Actualizar nombre y apellido
                $alumno->nombre = $nuevoNombre;
                $alumno->apellido = $nuevoApellido;

                // Convertir IDs a objetos Modulo
                $nuevosModulos = [];
                foreach ($this->listaModulos as $modulo) {
                    if (in_array($modulo->id, $modulosSeleccionados)) {
                        $nuevosModulos[] = $modulo;
                    }
                }

                // Asignar los nuevos módulos
                $alumno->modulos = $nuevosModulos;

                $this->mensajeEstado = new Mensaje("Alumno actualizado correctamente", "correcto");
                return;
            }
        }

        $this->mensajeEstado = new Mensaje("No se encontró el alumno a actualizar", "error");
    }


    public function leerAlumno() {
        
    }

    public function escribirAlumno() {
        
    }


    // ACCIONES PARA EL MODULO
    public function crearModulo() {
        $nombre = $_POST['nombre'] ?? null;
        $curso = $_POST['curso'] ?? null;

        if (!empty($nombre)) {
            $this -> listaModulos[] = new Modulo($nombre, $curso);
            $this -> mensajeEstado = new Mensaje("Modulo " . $nombre . " creado correctamente", "correcto");
        } else {
            $this -> mensajeEstado = new Mensaje("No ha escrito un nombre para el modulo", "error");
        }
    }

    public function eliminarModulo($id) {
        if ($this->existeModulo($id)) {
            // Buscamos el indice del modulo en el array
            foreach ($this->listaModulos as $index => $modulo) {
                if ($modulo->id == $id) {
                    // Eliminamos el modulo del array
                    unset($this->listaModulos[$index]);

                    // Reordenamos el array para que no queden "huecos"
                    $this->listaModulos = array_values($this->listaModulos);

                    $this->mensajeEstado = new Mensaje("Modulo eliminado correctamente", "correcto");
                }
            }
        } else {

        }
    }

    public function consultarModulo($id) {
        if ($this->existeModulo($id)) {
            $_SESSION['moduloSeleccionadoId'] = $id;

            header("Location: detalle_modulo.php");
            exit;
        }
    }

    public function irActualizarModulo($id) {
        if ($this->existeModulo($id)) {
            $_SESSION['moduloSeleccionadoId'] = $id;

            header("Location: actualizar_modulo.php");
            exit;
        }
    }

    public function actualizarModulo($id, $nuevoNombre, $nuevoCurso) {
        if (!$this->existeModulo($id)) {
            return;
        }

        // Buscar el alumno en la lista
        foreach ($this->listaModulos as $modulo) {
            if ($modulo->id == $id) {

                // Actualizar nombre y curso
                $modulo->nombre = $nuevoNombre;
                $modulo->curso = $nuevoCurso;

                $this->mensajeEstado = new Mensaje("Modulo actualizado correctamente", "correcto");
                return;
            }
        }

        $this->mensajeEstado = new Mensaje("No se encontró el modulo a actualizar", "error");
    }

    public function leerModulo() {
        
    }

    public function escribirModulo() {
        
    }

    private function existeId($id) {
        if (!empty($id)) {
            return true;
        } else {
            $this -> mensajeEstado = new Mensaje("Existe un problema para encontrar el elemento", "error");
            return false;
        }
    }

    private function existeAlumno($id) {
        if (!$this->existeId($id)) {
            return false;
        }

        foreach ($this->listaAlumnos as $alumno) {
            if ($alumno->id == $id) {
                return true; // sí existe
            }
        }

        $this->mensajeEstado = new Mensaje("No se encontró un alumno con ese ID", "error");
        return false;
    }

    private function existeModulo($id) {
        if (!$this->existeId($id)) {
            return false;
        }

        foreach ($this->listaModulos as $modulo) {
            if ($modulo->id == $id) {
                return true; // sí existe
            }
        }

        $this->mensajeEstado = new Mensaje("No se encontró un módulo con ese ID", "error");
        return false;
    }
}

?>