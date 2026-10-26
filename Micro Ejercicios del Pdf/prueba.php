<?php
/*
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
*/

/*
$usuario = [
    "nombre" => "Ana",
    "edad" => 20,
    "email" => "ana@example.com"
];

echo $usuario["nombre"] . "<br>";
echo $usuario["email"] . "<br>";

$usuario["edad"] = 21;

foreach ($usuario as $clave => $valor) {
    echo "$clave: $valor" . "<br>";
}
*/
/*
$colores = ["rojo", "verde", "azul"];

[$primero, $segundo, $tercero] = $colores;

echo "- " . $primero . "<br>";
echo "- " . $segundo . "<br>";
echo "- " . $tercero . "<br>";

echo "<br>";

foreach ($colores as $color) {
  echo "- " . $color . "<br>";
}
*/
/*
$numeros = [1, 2, 3];
$numerosMultiplicados = [];

foreach ($numeros as $numero) {
  $numerosMultiplicados[] = $numero * 2; 
}

$numerosMultiplicados = array_map(fn(int $n): int => $n * 2, $numeros);
*/
$numeros = [3, 8, 12, 5, 20];

$grandes = array_filter($numeros, fn(int $n): bool => $n > 6);

echo "<pre>";
echo var_dump($grandes);
echo "<pre>";