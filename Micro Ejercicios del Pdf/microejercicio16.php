<?php
declare(strict_types=1);
$precios = [10, 25, 30, 15];

$suma = array_reduce(
  $precios,
  fn(int $total, int $n): int => $total + $n,
  0
);

function calcularIVA(float $sumaIVA): float
{
  return $sumaIVA * 1.21;
}
/*
echo '<pre>';
var_dump($suma);
echo '</pre>';
*/
echo '<pre>';
echo "El resultado del array reduce es este: " . $suma;
echo '</pre>';

echo '<pre>';
echo "El resultado de añadirle el IVA al resultado del otro array es: " . calcularIVA($suma);
echo '</pre>';