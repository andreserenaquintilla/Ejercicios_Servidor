<?php

$productos = [
  [
    "id" => 1,
    "nombre" => "Tetera",
    "precio" => 15.99,
    "categoria" => "Vajilla",
  ],
  [
    "id" => 2,
    "nombre" => "Taza",
    "precio" => 5.99,
    "categoria" => "Vajilla",
  ],
  [
    "id" => 3,
    "nombre" => "Cafe",
    "precio" => 8.99,
    "categoria" => "Bebida",
  ],
  [
    "id" => 4,
    "nombre" => "Toyota Corolla",
    "precio" => 18889,
    "categoria" => "Automovil"
  ],
];

function buscarProducto(array $productos, int $id): array|null {
  foreach ($productos as $producto) {
    if ($producto["id"] === $id) {
      return $producto;
    }
  }
  return null; // Esto es lo único que no había escrito
}

$p1 = buscarProducto($productos, 2);
var_dump($p1);

$p99 = buscarProducto($productos, 99);
var_dump($p99); // Devuelve NULL

/*
$catalogo = [
    ["id" => 1, "nombre" => "Teclado", "precio" => 29.99],
    ["id" => 2, "nombre" => "Ratón", "precio" => 19.99],
    ["id" => 3, "nombre" => "Monitor", "precio" => 149.00]
];

function buscarProducto(int $id, array $productos): ?array
{
    foreach ($productos as $producto) {
        if ($producto["id"] === $id) {
            return $producto;
        }
    }
    return null; // Si no se encuentra ninguna coincidencia
}

// Y esta parte tampoco
$p1 = buscarProducto(2, $catalogo);
var_dump($p1); // Devuelve el array del ratón

$p99 = buscarProducto(99, $catalogo);
var_dump($p99); // Devuelve NULL

*/