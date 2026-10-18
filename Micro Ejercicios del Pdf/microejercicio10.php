<?php

$catalogo = [
  [
    "id" => 1,
    "nombre" => "Teclado",
    "precio" => 28.99,
    "categoria" => "Periféricos",
  ],
  [
    "id" => 2,
    "nombre" => "Ratón",
    "precio" => 18.99,
    "categoria" => "Periféricos",
  ],
  [
    "id" => 3,
    "nombre" => "Monitor",
    "precio" => 247.99,
    "categoria" => "Monitores",
  ],
  [
    "id" => 4,
    "nombre" => "Teclado Bluetooth",
    "precio" => 48.99,
    "categoria" => "Periféricos",
  ],
  [
    "id" => 5,
    "nombre" => "USB 64gb",
    "precio" => 32.99,
    "categoria" => "Almacenamiento",
  ],
];

echo "<table border='1' cellpadding='8'>";
echo "<tr><th>ID</th><th>Nombre</th><th>Categoría</th><th>Precio</th></tr>";

foreach ($catalogo as $prod) {
    echo "<tr>";
    echo "<td>{$prod['id']}</td>";
    echo "<td>{$prod['nombre']}</td>";
    echo "<td>{$prod['categoria']}</td>";
    echo "<td>" . number_format($prod['precio'], 2, ',', '.') . " €</td>";
    echo "</tr>";
}

echo "</table>";
?>