<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../src/datos.php';
require __DIR__ . '/../src/utilidades.php';
require __DIR__ . '/../src/auth.php';

arrancarSesion();

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

if (!is_string($username) || $username === '' || !is_string($password) || $password === '') {
    guardarFlash('Introduce usuario y contraseña.');
    redirigir('index.php');
}

$usuario = buscarUsuario($usuarios, $username);

// Mismo mensaje en los dos casos para no dar pistas
if ($usuario === null || !password_verify($password, $usuario['password'])) {
    guardarFlash('Usuario o contraseña incorrectos.');
    redirigir('index.php');
}

loguearUsuario($usuario);
redirigir('index.php');