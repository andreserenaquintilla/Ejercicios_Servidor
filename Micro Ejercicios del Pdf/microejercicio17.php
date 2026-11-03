<?php
declare(strict_types=1);

$catalogo = [
  ["id" => 1, "nombre" => "Botella", "precio" => 1.5],
  ["id" => 2, "nombre" => "Mochila", "precio" => 32.99],
  ["id" => 3, "nombre" => "Sudadera", "precio" => 54.99],
  ["id" => 4, "nombre" => "Ratón", "precio" => 16.49],
  ["id" => 5, "nombre" => "Bolígrafo", "precio" => 0.99],
  ["id" => 6, "nombre" => "Estuche", "precio" => 5.49],
];

// He creado cópias de mi array principal para trabajar sobre el, ya que usort me altera el array que le pongo, no crea uno nuevo
$alfabetico = $catalogo;
$menorMayor = $catalogo;
$mayorMenor = $catalogo;

// Este usort organiza el array en orden alfabetico de la "a" a la "z"
usort(
  $alfabetico,
  fn(array $a, array $b): int =>
    $a["nombre"] <=> $b["nombre"]
);

// Este usort organiza el array de menor precio a mayor precio
usort(
  $menorMayor,
  fn(array $a, array $b): int =>
    $a["precio"] <=> $b["precio"]
);

// Este usort organiza el array de mayor a menor precio
usort(
  $mayorMenor,
  fn(array $a, array $b): int =>
  $b["precio"] <=> $a["precio"]
);

echo "<p>En este primer var_dump muestro el array original, tal cual lo había escrito yo:</p>";

echo "<pre>";
var_dump($catalogo);
echo "</pre>";

echo "<p>En este segundo var_dump muestro el array ordenado alfabeticamente:</p>";

echo "<pre>";
var_dump($alfabetico);
echo "</pre>";

echo "<p>En este tercer var_dump muestro el array ordenado de menor a mayor precio:</p>";

echo "<pre>";
var_dump($menorMayor);
echo "</pre>";

echo "<p>En este cuarto var_dump muestro el array ordenado de mayor a menor precio:</p>";

echo "<pre>";
var_dump($mayorMenor);
echo "</pre>";