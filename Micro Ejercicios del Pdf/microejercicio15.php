<?php
declare(strict_types= 1);

$productos = [
  ["id" => 1, "nombre" => "Ratón", "precio" => 16.99],
  ["id" => 2, "nombre" => "Teclado", "precio" => 89.99],
  ["id" => 3, "nombre" => "Monitor", "precio" => 149.99],
  ["id" => 4, "nombre" => "Almohadilla", "precio" => 2.99],
  ["id" => 5, "nombre" => "Altavoz", "precio" => 59.99],
];

$caros = array_filter(
  $productos,
  fn(array $valor): bool => $valor["precio"] >= 50
);
echo "<pre>";
var_dump( $caros );
echo "</pre>";