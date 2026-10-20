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