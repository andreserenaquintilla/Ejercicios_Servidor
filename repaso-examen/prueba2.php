<?php
declare(strict_types=1);

$juegos = [
  ['id' => 1, 'titulo' => 'Tetris', 'puntos' => 20],
  ['id' => 2, 'titulo' => 'Portal 2', 'puntos' => 80],
  ['id' => 3, 'titulo' => 'Minecraft', 'puntos' => 120],
];

echo $juegos[1]['titulo'] . "<br>";

function recorrerArray(array $juegos): string {
  $inicio = Null;
  foreach ($juegos as $juego) {
    if ($juego['puntos'] >= 50) { 
    }
  }
}

// Esta función calcula el total de la suma de los puntos del array $juegos
function calcularTotal(array $juegos): int {
  // Fallo anterior, puse el $total fuera y claro, la función no podía trabajar con el, yo pensaba que si
  $total = 0;
  // Aqui recorro el array y guardo cada valor en uno individual para trabajar con el, si pusiera $juego[1]['titulo'] me daría Tetris, o debería
  foreach ($juegos as $juego) {
    $total += $juego['puntos'];
  } 
  // Este return tiene que ir fuera del bucle para que devuelva la info una vez terminado
  return $total;
}

echo "Total: " . calcularTotal($juegos) . "<br>";