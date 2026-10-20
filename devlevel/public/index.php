<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../src/datos.php';
require __DIR__ . '/../src/utilidades.php';
require __DIR__ . '/../src/auth.php';
require __DIR__ . '/../src/tareas.php';

arrancarSesion();
comprobarTimeout();

// Sin login, solo se puede ver el formulario de entrada
if (!estaLogueado()) {
    require __DIR__ . '/../views/login.php';
    exit;
}

$usuario = $_SESSION['usuario'];

// Qué pantalla me piden: index.php?pagina=...
$pagina = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'dashboard';

if ($pagina === 'admin') {
    // Solo el Project Manager
    requiereRol(ROL_PM);

    // Errores y valores anteriores si falló la validación (se usan una vez)
    $errores = $_SESSION['errores_tarea'] ?? [];
    $viejos = $_SESSION['viejos_tarea'] ?? [];
    unset($_SESSION['errores_tarea'], $_SESSION['viejos_tarea']);

    require __DIR__ . '/../views/admin_tareas.php';
} else {
    $catalogo = obtenerCatalogo($tareasIniciales);
    $tareas = tareasDisponibles($catalogo, $usuario['nivel']);
    require __DIR__ . '/../views/dashboard.php';
}