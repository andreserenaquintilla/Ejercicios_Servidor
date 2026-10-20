<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../src/utilidades.php';
require __DIR__ . '/../src/auth.php';

arrancarSesion();

if (estaLogueado()) {
    require __DIR__ . '/../views/dashboard.php';
} else {
    require __DIR__ . '/../views/login.php';
}