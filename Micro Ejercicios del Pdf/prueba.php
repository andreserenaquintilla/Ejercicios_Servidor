<?php
$variableWhile = 1;

while ($variableWhile <= 5) {
  echo $variableWhile+1;
  $variableWhile++;
}

for ($i = 1; $i <= 5; $i++) {
    echo $i+5;
}

$colores = ["rojo", "verde", "azul"];
foreach ($colores as $color) {
  echo $color;
}