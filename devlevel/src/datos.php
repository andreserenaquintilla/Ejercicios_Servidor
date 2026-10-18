<?php
declare(strict_types=1);

$skills = [
    1 => ['id' => 1, 'nombre' => 'PHP Backend', 'categoria' => 'backend'],
    2 => ['id' => 2, 'nombre' => 'HTML5 Semántico', 'categoria' => 'frontend'],
    3 => ['id' => 3, 'nombre' => 'CSS Moderno (Flex & Grid)', 'categoria' => 'frontend'],
    4 => ['id' => 4, 'nombre' => 'Control de Versiones Git', 'categoria' => 'herramientas'],
    5 => ['id' => 5, 'nombre' => 'Seguridad Web & OWASP', 'categoria' => 'seguridad'],
];

$tareasIniciales = [
    [
        'id' => 101,
        'titulo' => 'Procesar formulario con sanitización estricta',
        'descripcion' => 'Implementar captura segura con filter_input y escape XSS.',
        'skills' => [1, 2],
        'puntos' => 100,
        'nivel_minimo' => 1,
        'dificultad' => 'facil',
    ],
    [
        'id' => 102,
        'titulo' => 'Implementar autenticación y hash de contraseñas',
        'descripcion' => 'Construir login con password_verify y regeneración de sesión.',
        'skills' => [1, 5],
        'puntos' => 250,
        'nivel_minimo' => 3,
        'dificultad' => 'media',
    ],
    [
        'id' => 103,
        'titulo' => 'Arquitectura de control de accesos por rol (RBAC)',
        'descripcion' => 'Desarrollar middlewares y guards para proteger rutas de administración.',
        'skills' => [1, 5],
        'puntos' => 400,
        'nivel_minimo' => 4,
        'dificultad' => 'dificil',
    ],
];

$usuarios = [
    [
        'id' => 1,
        'nombre' => 'Laura Manager',
        'username' => 'manager',
        'password' => password_hash('Manager2026!', PASSWORD_DEFAULT),
        'rol' => 'PROJECT_MANAGER',
        'puntos' => 0,
        'nivel' => 5,
    ],
    [
        'id' => 2,
        'nombre' => 'Carlos Senior',
        'username' => 'senior',
        'password' => password_hash('Senior2026!', PASSWORD_DEFAULT),
        'rol' => 'DEVELOPER_SENIOR',
        'puntos' => 500,
        'nivel' => 4,
    ],
    [
        'id' => 3,
        'nombre' => 'Ana Junior',
        'username' => 'junior',
        'password' => password_hash('Junior2026!', PASSWORD_DEFAULT),
        'rol' => 'DEVELOPER_JUNIOR',
        'puntos' => 0,
        'nivel' => 1,
    ],
];