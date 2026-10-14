<?php
/*
function sumar(int $a, int $b): int
{
  return $a + $b;
}

function resta(int $a, int $b): int
{
  return $a + $b;
}

$resultadoSuma = sumar(5, 5);

echo $resultadoSuma;

$resultadoResta = resta(8, 5);

echo $resultadoResta;

*/

declare(strict_types=1);

function sumar(float $a, float $b): float
{
    return $a + $b;
}

function restar(float $a, float $b): float
{
    return $a - $b;
}

function multiplicar(float $a, float $b): float
{
    return $a * $b;
}

function dividir(float $a, float $b): float
{
    if ($b === 0.0) {
        throw new InvalidArgumentException("No es posible dividir entre cero.");
    }
    return $a / $b;
}

// Pruebas:
echo "Suma: " . sumar(10.5, 4.5) . "<br>";
echo "Resta: " . restar(10, 3) . "<br>";
echo "Multiplicación: " . multiplicar(6, 7) . "<br>";
echo "División: " . dividir(15, 3) . "<br>";
?>