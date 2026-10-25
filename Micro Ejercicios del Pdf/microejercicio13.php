<?php
declare(strict_types=1);

$colores = [
  [
    "nombre" => "rojo",
    "id" => 1,
  ],
  [
    "nombre" => "verde",
    "id" => 2,
  ],
  [
    "nombre" => "azul",
    "id" => 3,
  ],
  [
    "nombre" => "naranja",
    "id" => 4,
  ],
  [
    "nombre" => "blanco",
    "id" => 5,
  ],
  [
    "nombre" => "negro",
    "id" => 6,
  ]
];
function buscarColor(array $colores, int $id): ?array
{
  foreach ($colores as $color) {
    if ($color["id"] === $id) {
      return $color;
    }
  }
  return null;
}

$resultado = buscarColor($colores, 88);

if ($resultado !== null) {
  echo "El resultado de la busqueda es el siguiente: <br><br>Nombre: " . $resultado["nombre"] . "<br><br>id: " . $resultado["id"];
} else {
  echo "El número introducido no existe dentro de este array.";
}