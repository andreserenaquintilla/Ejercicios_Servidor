<?php
declare(strict_types=1);
require(__DIR__ . '/../src/datos.php');
session_start();
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
if ($username === "" || $username === null || $password === "" || $password === null) {
  echo "Introduce un valor valido.";
  exit;
}
$usuarioEncontrado = null;
foreach ($usuarios as $usuario) {
  if ($usuario['username'] === $username) {
    $usuarioEncontrado = $usuario;
    break;
  }
}
if ($usuarioEncontrado === null) {
  echo "Usuario o contraseña incorrectos";
  exit;
}
if (!password_verify($password, $usuarioEncontrado['password'])) {
  echo "Usuario o contraseña incorrectos";
  exit;
}
session_regenerate_id(true);
$_SESSION['usuario'] = [
  'id' => $usuarioEncontrado['id'],
  'nombre' => $usuarioEncontrado['nombre'],
  'username' => $usuarioEncontrado['username'],
  'rol' => $usuarioEncontrado['rol'],
  'puntos' => $usuarioEncontrado['puntos'],
  'nivel' => $usuarioEncontrado['nivel'],
];
header('Location: index.php');
exit;
#echo "Bienvenido, " . $usuarioEncontrado['username'] . ".";
