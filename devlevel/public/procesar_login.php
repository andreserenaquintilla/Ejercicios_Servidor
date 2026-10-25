<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../src/datos.php';
require __DIR__ . '/../src/utilidades.php';
require __DIR__ . '/../src/auth.php';

arrancarSesion();

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

if ($username === null || $username === '' || $password === null || $password === '') {
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

// Si la casilla viene marcada llega "on", si no, no llega nada (null)
$recordar = filter_input(INPUT_POST, 'recordar') !== null;
gestionarCookieRecordar($recordar, $username);

redirigir('index.php');