<?php

require_once 'Gestor.php';
require_once 'Alumno.php';
require_once 'Modulo.php';
require_once 'Mensaje.php';

session_start();

// Variable para definir el nombre del atributo "name" de los input de acciones
$_SESSION['nameInputAccion'] = "accion";

// Variables globales para definir el valor del atributo "value" de los input
$_SESSION['valueInputEliminarTodo'] = "eliminarTodo";

$_SESSION['valueInputCrearAlumno'] = "crearAlumno";
$_SESSION['valueInputEliminarAlumno'] = "eliminarAlumno";
$_SESSION['valueInputConsultarAlumno'] = "consultarAlumno";
$_SESSION['valueInputActualizarAlumno'] = "actualizarAlumnos";
$_SESSION['valueInputLeerAlumno'] = "leerAlumnos";
$_SESSION['valueInputEscribirAlumno'] = "escribirAlumnos";

$_SESSION['valueInputCrearModulo'] = "crearModulo";
$_SESSION['valueInputEliminarModulo'] = "eliminarModulo";
$_SESSION['valueInputConsultarModulo'] = "consultarModulo";
$_SESSION['valueInputActualizarModulo'] = "actualizarModulos";
$_SESSION['valueInputLeerModulo'] = "leerModulos";
$_SESSION['valueInputEscribirModulo'] = "escribirModulos";

if (!isset($_SESSION['gestor'])) {
    $_SESSION['gestor'] = new Gestor();
}

$gestor = $_SESSION['gestor'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    $accion = $_POST[$_SESSION['nameInputAccion']] ?? null;

    switch($accion) {
        case $_SESSION['valueInputEliminarTodo']: 
            $gestor -> eliminarTodo();
            break;
        case $_SESSION['valueInputCrearAlumno']: 
            $gestor -> crearAlumno();
            break;
        case $_SESSION['valueInputEliminarAlumno']: 
            $gestor -> eliminarAlumno($id);
            break;
        case $_SESSION['valueInputConsultarAlumno']: 
            $gestor -> consultarAlumno($id);
            break;
        case $_SESSION['valueInputActualizarAlumno']: 
            $gestor -> actualizarAlumno($id);
            break;
        case $_SESSION['valueInputLeerAlumno']: 
            $gestor -> leerAlumno();
            break;
        case $_SESSION['valueInputEscribirAlumno']: 
            $gestor -> escribirAlumno();
            break;
        case $_SESSION['valueInputCrearModulo']: 
            $gestor -> crearModulo();
            break;
        case $_SESSION['valueInputEliminarModulo']: 
            $gestor -> eliminarModulo($id);
            break;
        case $_SESSION['valueInputConsultarModulo']: 
            $gestor -> consultarModulo($id);
            break;
        case $_SESSION['valueInputActualizarModulo']: 
            $gestor -> actualizarModulo($id);
            break;
        case $_SESSION['valueInputLeerModulo']: 
            $gestor -> leerModulo();
            break;
        case $_SESSION['valueInputEscribirModulo']: 
            $gestor -> escribirModulo();
            break;
    }

    header('Location: index.php');
    exit;
}

$mensaje = $gestor->mensajeEstado;

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Add bootstrap library -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

        <link rel="stylesheet" href="style.css">

        <title>Gestor de Modulos de Alumnos</title>
    </head>

    <body>

        <div class="container">

            <?php //echo print_r($gestor) ?>

            <div class="content">
                <div class="alert <?php echo $mensaje->claseCss?>" role="alert"><?php echo $mensaje->texto?></div> 
                
                <form action="index.php" method="post">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-danger" type="submit" 
                                name="<?php echo $_SESSION['nameInputAccion'];?>"
                                value="<?php echo $_SESSION['valueInputEliminarTodo'];?>">
                            Eliminar todo
                        </button>
                    </div>
                </form>
            </div>

            <div class="row content">

                <!-- CREAR ALUMNO O MODULO -->
                <div class="col">

                    <h2>Crear alumno</h2>

                    <!-- Crear alumno -->
                    <div class="card">

                        <form action="index.php" method="post" class="item_lista">

                            <div>
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>

                            <div>
                                <label for="apellido" class="form-label">Apellido:</label>
                                <input type="text" class="form-control" id="apellido" name="apellido">
                            </div>

                            <div>
                                <label class="form-label">Modulos:</label>
              
                                <?php if (count($gestor->listaModulos) <= 0): ?>
                                    <span>No hay módulos disponibles</span>
                                <?php else: ?>
                                    <!-- Contenido cuando si hay módulos -->
                                    <?php foreach ($gestor->listaModulos as $modulo): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                type="checkbox" 
                                                name="modulos[]" 
                                                value="<?php echo $modulo->id; ?>" 
                                                id="modulo_<?php echo $modulo->id; ?>">
                                            <label class="form-check-label" for="modulo_<?php echo $modulo->id; ?>">
                                                <?php echo htmlspecialchars($modulo->nombre); ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>

                            <div class="d-grid gap-2">
                                <input type="hidden" 
                                    name="<?php echo $_SESSION['nameInputAccion'];?>" 
                                    value="<?php echo $_SESSION['valueInputCrearAlumno'];?>">
                                <button class="btn btn-primary" type="submit">Crear alumno</button>
                            </div>
                    
                        </form>

                    </div>

                    <h2>Crear modulo</h2>

                    <!-- Crear modulo -->
                    <div class="card">

                        <form action="index.php" method="post" class="item_lista">
                            <div>
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>

                            <div>
                                <div>
                                    <label class="form-label">Curso:</label>
                            
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="curso" id="primero1" value="primero" checked>
                                        <label class="form-check-label" for="primero1">Primero</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="curso" id="segundo2" value="segundo">
                                        <label class="form-check-label" for="segundo2">Segundo</label>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="d-grid gap-2">
                                <input type="hidden" 
                                    name="<?php echo $_SESSION['nameInputAccion'];?>" 
                                    value="<?php echo $_SESSION['valueInputCrearModulo'];?>">
                                <button class="btn btn-primary" type="submit">Crear modulo</button>
                            </div>
                        </form>

                    </div>

                </div>

                <!-- LISTA DE ALUMNOS -->
                <div class="col">

                    <h2>Lista de alumnos</h2>

                    <div class="card">

                        <div class="item_lista">

                            <?php if (count($gestor->listaAlumnos) <= 0): ?>
                                <h4>No hay alumnos creados</h4>
                            <?php else: ?>
                                <?php foreach ($gestor->listaAlumnos as $alumno): ?>
                                    <h5>#<?php echo $alumno->id ?></h5>

                                    <span>Alumno: <?php echo $alumno->nombre . " " . $alumno->apellido?></span>

                                    <span>Modulos:
                                        <?php foreach ($alumno->modulos as $modulo): ?>
                                            <?php echo $modulo->nombre . "," ?>
                                        <?php endforeach; ?>
                                    </span>

                                    <form action="index.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $alumno->id; ?>">
                                        <div class="btn-group" role="group" aria-label="Acciones">
                                            <button type="submit" class="btn btn-primary" 
                                                name="<?php echo $_SESSION['nameInputAccion'];?>"
                                                value="<?php echo $_SESSION['valueInputConsultarAlumno'];?>">Consultar
                                            </button>

                                            <button type="submit" class="btn btn-primary" 
                                                name="<?php echo $_SESSION['nameInputAccion'];?>"
                                                value="<?php echo $_SESSION['valueInputActualizarAlumno'];?>">Actualizar
                                            </button>

                                            <button type="submit" class="btn btn-primary" 
                                                name="<?php echo $_SESSION['nameInputAccion'];?>"
                                                value="<?php echo $_SESSION['valueInputLeerAlumno'];?>">Leer
                                            </button>

                                            <button type="submit" class="btn btn-primary" 
                                                name="<?php echo $_SESSION['nameInputAccion'];?>"
                                                value="<?php echo $_SESSION['valueInputEscribirAlumno'];?>">Escribir
                                            </button>

                                            <button type="submit" class="btn btn-danger"  
                                                name="<?php echo $_SESSION['nameInputAccion'];?>"
                                                value="<?php echo $_SESSION['valueInputEliminarAlumno'];?>">Eliminar
                                            </button>
                                        </div>
                                    </form>

                                    <hr>
                                <?php endforeach; ?>
                            <?php endif; ?>  

                        </div>

                    </div>

                </div>

                <!-- LISTA DE MODULOS -->
                <div class="col">

                    <h2>Lista de modulos</h2>

                    <div class="card">

                        <div class="item_lista">

                            <?php if (count($gestor->listaModulos) <= 0): ?>
                                <h4>No hay modulos creados</h4>
                            <?php else: ?>
                                <?php foreach ($gestor->listaModulos as $modulo): ?>
                                    <h5>#<?php echo $modulo->id ?></h5>

                                    <span>Nombre: <?php echo $modulo->nombre?></span>

                                    <span>Curso: <?php echo $modulo->curso?></span>

                                    <form action="index.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $modulo->id; ?>">
                                        <div class="btn-group" role="group" aria-label="Acciones">
                                            <button type="submit" class="btn btn-primary" 
                                                name="<?php echo $_SESSION['nameInputAccion'];?>"
                                                value="<?php echo $_SESSION['valueInputConsultarModulo'];?>">Consultar
                                            </button>

                                            <button type="submit" class="btn btn-primary" 
                                                name="<?php echo $_SESSION['nameInputAccion'];?>"
                                                value="<?php echo $_SESSION['valueInputActualizarModulo'];?>">Actualizar
                                            </button>

                                            <button type="submit" class="btn btn-primary" 
                                                name="<?php echo $_SESSION['nameInputAccion'];?>"
                                                value="<?php echo $_SESSION['valueInputLeerModulo'];?>">Leer
                                            </button>

                                            <button type="submit" class="btn btn-primary" 
                                                name="<?php echo $_SESSION['nameInputAccion'];?>"
                                                value="<?php echo $_SESSION['valueInputEscribirModulo'];?>">Escribir
                                            </button>

                                            <button type="submit" class="btn btn-danger"  
                                                name="<?php echo $_SESSION['nameInputAccion'];?>"
                                                value="<?php echo $_SESSION['valueInputEliminarModulo'];?>">Eliminar
                                            </button>
                                        </div>
                                    </form>

                                    <hr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <!-- 
        <div>
            <h1>Crear alumno</h1>

            <form action="index.php" method="post">
                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <div>
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" required>
                </div>

                <div>
                    <label for="modulos">Modulos:</label>
                    <input type="checkbox" name="" id="">
                    <input type="checkbox" name="" id="">
                </div>

                <input type="hidden" 
                    name="<?php echo $_SESSION['nameInputAccion'];?>" 
                    value="<?php echo $_SESSION['valueInputCrearAlumno'];?>">
                <button type="submit">Crear</button>
            </form>
        </div>

        <div>
            <h1>Crear modulos</h1>

            <form action="index.php" method="post">
                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <div>
                    <label>Curso:</label>

                    <div>
                        <input type="radio" id="primero" name="curso" value="primero">
                        <label for="mayorMenor">Primero</label>

                        <input type="radio" id="segundo" name="curso" value="segundo">
                        <label for="menorMayor">Segundo</label>
                    </div>
                </div>

                <input type="hidden" 
                    name="<?php echo $_SESSION['nameInputAccion'];?>" 
                    value="<?php echo $_SESSION['valueInputCrearModulo'];?>">
                <button type="submit">Crear</button>
            </form>
        </div>

       
        <div>
            <div>
                <h1>Lista de alumnos</h1>

                <div>
                    <form action="index.php" method="post">
                        <input type="hidden" 
                            name="<?php echo $_SESSION['nameInputAccion'];?>" 
                            value="<?php echo $_SESSION['valueInputConsultarAlumno'];?>">
                        <button type="submit">Consultar</button>

                        <input type="hidden" 
                            name="<?php echo $_SESSION['nameInputAccion'];?>" 
                            value="<?php echo $_SESSION['valueInputActualizarAlumno'];?>">
                        <button type="submit">Actualizar</button>

                        <input type="hidden" 
                            name="<?php echo $_SESSION['nameInputAccion'];?>" 
                            value="<?php echo $_SESSION['valueInputLeerAlumno'];?>">
                        <button type="submit">Leer</button>

                        <input type="hidden" 
                            name="<?php echo $_SESSION['nameInputAccion'];?>" 
                            value="<?php echo $_SESSION['valueInputEscribirAlumno'];?>">
                        <button type="submit">Escribir</button>
                    </form>
                </div>
            </div>

            <div>
                <ul>
                    <li>Alumno 1</li>
                    <li>Alumno 2</li>
                    <li>Alumno 3</li>
                </ul>
            </div>
        </div>

        <div>
            <div>
                <h1>Lista de modulos</h1>

                <div>
                    <form action="index.php" method="post">
                        <input type="hidden" 
                            name="<?php echo $_SESSION['nameInputAccion'];?>" 
                            value="<?php echo $_SESSION['valueInputConsultarModulo'];?>">
                        <button type="submit">Consultar</button>

                        <input type="hidden" 
                            name="<?php echo $_SESSION['nameInputAccion'];?>" 
                            value="<?php echo $_SESSION['valueInputActualizarModulo'];?>">
                        <button type="submit">Actualizar</button>

                        <input type="hidden" 
                            name="<?php echo $_SESSION['nameInputAccion'];?>" 
                            value="<?php echo $_SESSION['valueInputLeerModulo'];?>">
                        <button type="submit">Leer</button>

                        <input type="hidden" 
                            name="<?php echo $_SESSION['nameInputAccion'];?>" 
                            value="<?php echo $_SESSION['valueInputEscribirModulo'];?>">
                        <button type="submit">Escribir</button>
                    </form>
                </div>
            </div>

            <div>
                <ul>
                    <li>Modulo 1</li>
                    <li>Modulo 2</li>
                    <li>Modulo 3</li>
                </ul>
            </div>
        </div>
        -->
    </body>

</html>