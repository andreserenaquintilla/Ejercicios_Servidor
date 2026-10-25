<?php
declare(strict_types=1);
require __DIR__ . '/../src/utilidades.php';
require __DIR__ . '/../src/auth.php';

arrancarSesion();
cerrarSesionConservandoTareas();
redirigir('index.php');