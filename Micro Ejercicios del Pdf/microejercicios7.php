<?php

$numero = 7;

echo "<h3>Tabla de multiplicar del $numero</h3>";

for($i = 1; $i <=10; $i++) {
  $resultado = $numero * $i;
  echo "$numero x $i = $resultado<br>";
}