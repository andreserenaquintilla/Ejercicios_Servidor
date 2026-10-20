<?php
declare(strict_types=1);

/**
 * Calcula el nivel que corresponde a unos puntos según la tabla NIVELES.
 *
 * @param int $puntos XP total del usuario
 * @return int Nivel del 1 al 5
 */
function calcularNivel(int $puntos): int
{
    $nivel = 1;
    foreach (NIVELES as $numeroNivel => $xpMinima) {
        if ($puntos >= $xpMinima) {
            $nivel = $numeroNivel;
        }
    }
    return $nivel;
}

/**
 * Suma puntos al usuario logueado, recalcula su nivel y le asciende si toca.
 *
 * @param int $puntos XP de la tarea completada
 * @return bool true si acaba de ascender a senior
 */
function sumarPuntos(int $puntos): bool
{
    $_SESSION['usuario']['puntos'] = $_SESSION['usuario']['puntos'] + $puntos;
    $_SESSION['usuario']['nivel'] = calcularNivel($_SESSION['usuario']['puntos']);

    // Promoción automática: junior que llega al umbral pasa a senior
    if ($_SESSION['usuario']['rol'] === ROL_JUNIOR && $_SESSION['usuario']['puntos'] >= UMBRAL_SENIOR) {
        $_SESSION['usuario']['rol'] = ROL_SENIOR;
        return true;
    }
    return false;
}