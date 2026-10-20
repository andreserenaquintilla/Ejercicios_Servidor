<?php
declare(strict_types=1);

/**
 * Escapa un texto para pintarlo en HTML sin que se ejecute nada (XSS).
 *
 * @param string $texto Texto que viene del usuario
 * @return string Texto seguro para imprimir
 */
function e(string $texto): string
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
 * @return never
 */
function redirigir(string $url): never
{
    header('Location: ' . $url);
    exit;
}