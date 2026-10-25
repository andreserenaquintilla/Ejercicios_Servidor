<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../src/datos.php';
require __DIR__ . '/../src/utilidades.php';
require __DIR__ . '/../src/auth.php';
require __DIR__ . '/../src/tareas.php';

arrancarSesion();
comprobarTimeout();
requiereRol(ROL_PM);

// Las skills llegan como array: skills[]
$skillsMarcadas = filter_input(INPUT_POST, 'skills', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
if (!is_array($skillsMarcadas)) {
    $skillsMarcadas = [];
}

// Lo que ha escrito, tal cual. Se escapa al pintarlo, no aquí
$datos = [
    'titulo' => trim(filter_input(INPUT_POST, 'titulo', FILTER_UNSAFE_RAW) ?? ''),
    'descripcion' => trim(filter_input(INPUT_POST, 'descripcion', FILTER_UNSAFE_RAW) ?? ''),
    'skills' => $skillsMarcadas,
    'puntos' => trim(filter_input(INPUT_POST, 'puntos', FILTER_UNSAFE_RAW) ?? ''),
    'nivel_minimo' => filter_input(INPUT_POST, 'nivel_minimo', FILTER_UNSAFE_RAW) ?? '',
    'dificultad' => filter_input(INPUT_POST, 'dificultad', FILTER_UNSAFE_RAW) ?? '',
];

$errores = validarNuevaTarea($datos, $skills);

if ($errores !== []) {
    // Vuelvo al formulario con los errores y lo que había escrito
    $_SESSION['errores_tarea'] = $errores;
    $_SESSION['viejos_tarea'] = $datos;
    guardarFlash('Revisa los campos marcados.');
    redirigir('index.php?pagina=admin');
}

crearTarea($datos, $tareasIniciales);
guardarFlash('Tarea creada correctamente.');
redirigir('index.php?pagina=admin');