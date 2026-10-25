<?php
declare(strict_types=1);

/**
 * Arranca la sesión con cookies seguras (HttpOnly y SameSite).
 *
 * @return void
 */
function arrancarSesion(): void
{
  if (session_status() === PHP_SESSION_NONE) {
    session_start([
      'cookie_httponly' => true,
      'cookie_samesite' => 'Strict',
    ]);
  }
}

/**
 * Busca un usuario por su username.
 *
 * @param array $usuarios Lista de usuarios de datos.php
 * @param string $username Lo que ha escrito en el login
 * @return array|null El usuario si existe, null si no
 */
function buscarUsuario(array $usuarios, string $username): ?array
{
  foreach ($usuarios as $usuario) {
    if ($usuario['username'] === $username) {
      return $usuario;
    }
  }
  return null;
}

/**
 * Guarda al usuario en sesión tras un login correcto.
 *
 * @param array $usuario Usuario ya comprobado
 * @return void
 */
function loguearUsuario(array $usuario): void
{
  // ID nuevo para evitar la fijación de sesión
  session_regenerate_id(true);

  $_SESSION['usuario'] = [
    'id' => $usuario['id'],
    'nombre' => $usuario['nombre'],
    'username' => $usuario['username'],
    'rol' => $usuario['rol'],
    'puntos' => $usuario['puntos'],
    'nivel' => $usuario['nivel'],
    'completadas' => [],
  ];
  $_SESSION['ultimo_acceso'] = time();
}

/**
 * Cierra la sesión del todo: datos, cookie y sesión del servidor.
 *
 * @return void
 */
function cerrarSesion(): void
{
  $_SESSION = [];
  setcookie(session_name(), '', time() - 42000, '/');
  session_destroy();
}

/**
 * Dice si hay alguien logueado.
 *
 * @return bool
 */
function estaLogueado(): bool
{
  return isset($_SESSION['usuario']);
}
/**
 * Si la sesión lleva más de TIMEOUT_SESION sin uso, la cierra y avisa.
 * Si no, actualiza la hora del último acceso.
 *
 * @return void
 */
function comprobarTimeout(): void
{
  if (!estaLogueado()) {
    return;
  }

  $ultimoAcceso = $_SESSION['ultimo_acceso'] ?? time();

  if (time() - $ultimoAcceso > TIMEOUT_SESION) {
    cerrarSesionConservandoTareas();
    guardarFlash('Tu sesión ha caducado por inactividad. Vuelve a entrar.');
    redirigir('index.php');
  }

  $_SESSION['ultimo_acceso'] = time();
}

/**
 * Guard: si no hay nadie logueado, lo manda al login.
 *
 * @return void
 */
function requiereLogin(): void
{
  if (!estaLogueado()) {
    guardarFlash('Tienes que iniciar sesión para entrar ahí.');
    redirigir('index.php');
  }
}

/**
 * Guard: si el usuario no tiene el rol pedido, lo echa al panel.
 *
 * @param string $rol Rol necesario (usar las constantes de config.php)
 * @return void
 */
function requiereRol(string $rol): void
{
  requiereLogin();

  if ($_SESSION['usuario']['rol'] !== $rol) {
    guardarFlash('No tienes permiso para entrar en esa sección.');
    redirigir('index.php');
  }
}
/**
 * Cierra la sesión del usuario pero conserva las tareas que creó el PM.
 * Decisión de diseño: las tareas son de la sesión del navegador,
 * no del usuario (si no, el junior nunca podría verlas).
 *
 * @return void
 */
function cerrarSesionConservandoTareas(): void
{
  $tareasCreadas = $_SESSION['tareas_creadas'] ?? [];

  // Primero se destruye todo, como pide el enunciado
  cerrarSesion();

  // Después, sesión nueva con otro ID y solo las tareas
  arrancarSesion();
  session_regenerate_id(true);
  if ($tareasCreadas !== []) {
    $_SESSION['tareas_creadas'] = $tareasCreadas;
  }
}