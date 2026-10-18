<?php
declare(strict_types=1);
require(__DIR__ . '/../src/datos.php');
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);

$password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

if ($username === "" || $username === null || $password === "" || $password === null) {
  echo "Introduce un valor valido.";
  exit;
}

foreach ($usuarios as $usuario) {
  echo $usuario['username'] . "\n";
}