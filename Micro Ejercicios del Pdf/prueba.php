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

$colores = ["rojo", "verde", "azul"];

[$primero, $segundo, $tercero] = $colores;

echo "- " . $primero . "<br>";
echo "- " . $segundo . "<br>";
echo "- " . $tercero . "<br>";

echo "<br>";

foreach ($colores as $color) {
  echo "- " . $color . "<br>";
}