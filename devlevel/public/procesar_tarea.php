<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../src/datos.php';
require __DIR__ . '/../src/utilidades.php';
require __DIR__ . '/../src/auth.php';
require __DIR__ . '/../src/tareas.php';
require __DIR__ . '/../src/gamificacion.php';

arrancarSesion();
comprobarTimeout();
requiereLogin();

// El PM gestiona tareas, no las completa
if ($_SESSION['usuario']['rol'] === ROL_PM) {
    guardarFlash('El Project Manager no completa tareas.');
    redirigir('index.php');
}

$id = filter_input(INPUT_POST, 'tarea_id', FILTER_VALIDATE_INT);

if ($id === null || $id === false) {
    guardarFlash('Tarea no válida.');
    redirigir('index.php');
}

$catalogo = obtenerCatalogo($tareasIniciales);
$tarea = buscarTarea($catalogo, $id);

// Vuelvo a comprobar el nivel aquí: el id se puede cambiar desde DevTools
if ($tarea === null || $tarea['nivel_minimo'] > $_SESSION['usuario']['nivel']) {
    guardarFlash('No puedes completar esa tarea.');
    redirigir('index.php');
}

if (tareaCompletada($id)) {
    guardarFlash('Ya habías completado esa tarea.');
    redirigir('index.php');
}

$_SESSION['usuario']['completadas'][] = $id;
$ascendido = sumarPuntos($tarea['puntos']);

if ($ascendido) {
    guardarFlash('¡Enhorabuena! Has ascendido a Senior Developer.');
} else {
    guardarFlash('Tarea completada: +' . $tarea['puntos'] . ' XP.');
}
redirigir('index.php');