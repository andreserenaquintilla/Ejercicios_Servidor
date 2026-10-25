<?php
// Si hay cookie de recordar, saco el usuario para precargarlo
$usuarioRecordado = filter_input(INPUT_COOKIE, COOKIE_RECORDAR, FILTER_UNSAFE_RAW) ?? '';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - DevLevel</title>
</head>

<body>
  <h1>Iniciar Sesión</h1>
  <?php require __DIR__ . '/mensajes_flash.php'; ?>
  <form method="post" action="procesar_login.php">
    <label for="username">
      Usuario
    </label>
    <input type="text" id="username" name="username" value="<?= escapar($usuarioRecordado) ?>" required>
    <label for="password">
      Contraseña
    </label>
    <input type="password" id="password" name="password" required>
    <input type="checkbox" id="recordar" name="recordar" <?php if ($usuarioRecordado !== '') {
      echo 'checked';
    } ?>>
    <label for="recordar">
      Recordar Usuario
    </label>
    <button type="submit">Entrar</button>
  </form>
</body>

</html>