<?php
declare(strict_types=1);

/**
 * Escapa un texto para pintarlo en HTML sin que se ejecute nada (XSS).
 *
 * @param string $texto Texto que viene del usuario
 * @return string Texto seguro para imprimir
 */
function escapar(string $texto): string
{
  return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

/**
 * Guarda un mensaje en sesión para enseñarlo en la siguiente página.
 *
 * @param string $mensaje Texto del aviso
 * @return void
 */
function guardarFlash(string $mensaje): void
{
  $_SESSION['flash'] = $mensaje;
}

/**
 * Redirige a otra página y corta la ejecución.
 *
 * @param string $url Página destino
 * @return void
 */
function redirigir(string $url): void
{
  header('Location: ' . $url);
  exit;
}
/**
 * Crea o borra la cookie de "Recordar usuario".
 *
 * @param bool $recordar Si ha marcado la casilla
 * @param string $username Usuario que ha entrado
 * @return void
 */
function gestionarCookieRecordar(bool $recordar, string $username): void
{
  $opciones = [
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Strict',
  ];

  if ($recordar) {
    // 30 días a partir de ahora
    $opciones['expires'] = time() + DURACION_COOKIE;
    setcookie(COOKIE_RECORDAR, $username, $opciones);
  } else {
    // Fecha en el pasado = el navegador la borra
    $opciones['expires'] = time() - 3600;
    setcookie(COOKIE_RECORDAR, '', $opciones);
  }
}