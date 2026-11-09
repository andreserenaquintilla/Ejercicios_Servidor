<?php

// Es necesario, no cuestionarlo ya que hace que PHP no convierta tipos por su cuenta
declare(strict_types=1);

$nombre = "Sara";
$puntos = 80;
$activa = true;

// Este si imprime el mensaje con el valor declarado
echo "Hola, $nombre" . "<br>";

// Este no, porque las comillas simples no sustituyen las variables, muestra $nombre como un texto
echo 'Hola, $nombre' . "<br>";

/*
// En este if comprobamos los diferentes niveles con distintos elseif
if ($puntos >= 100 && $activa) {
  echo "Nivel alto" . "<br>";
} elseif ($puntos >= 50) {
  echo "Nivel medio" . "<br>";
} else {
  echo "Nivel bajo" . "<br>";
}
*/

// Este bloque es lo mismo que el de arriba, pero en una función, que si tengo que usarla más veces, solo cambio datos aquí, no en 20 ifs
function calcularNiveles(int $puntos, bool $activa): string {
  if ($puntos >= 100 && $activa) {
    return "Nivel alto";
  } elseif ($puntos >= 50) {
    return "Nivel medio";
  } else {
    return "Nivel bajo";
  }
}

echo calcularNiveles($puntos, $activa) . "<br>";