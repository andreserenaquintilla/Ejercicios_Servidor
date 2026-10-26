<?php
declare(strict_types= 1);

$precios = [10, 20, 50, 100];

$preciosConIVA = array_map(
  fn(float $precio): float => $precio * 1.21,
  $precios
);
echo "<pre>";
var_dump( $preciosConIVA );
echo "</pre>";