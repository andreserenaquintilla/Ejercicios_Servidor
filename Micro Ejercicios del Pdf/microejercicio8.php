<?php
// Este es el primer input, el nombre con espacios y sin normalizar.
$nombre = "   ana garcía   ";

// Aquí pruebo la función strlen para que me dé los caracteres totales, el número.
echo strlen($nombre) . "<br>";

// Aquí uso trim para quitar los espacios y luego muestro con el strlen los caracteres, lo cual, el acento cuenta como uno extra.
$limpio = trim($nombre);
echo strlen($limpio) . "<br>";
echo $limpio . "<br>";

// Aquí pruebo la función strtoupper, para ver que hace.
$limpioMayus = strtoupper($limpio);
echo $limpioMayus . "<br>";

// Aquí pruebo la función ucfirst que solo cambia la primera letra del string a mayus.
$mayusPrimera = ucfirst($limpio);
echo $mayusPrimera . "<br>";

// Y por último, uso la función correcta, ucwords, que convierte a mayus la primera de cada palabra del string.
$mayusAmbasIniciales = ucwords($limpio);
echo "Nombre sin espacios y normalizado: " . $mayusAmbasIniciales . "<br>";