<?php
/*
$idiomasProgramacion = ["PHP", "JavaScript", "HTML", "CSS", "SQL"];

echo $idiomasProgramacion[0] . "<br>";
echo $idiomasProgramacion[1] . "<br>";
echo $idiomasProgramacion[2] . "<br>";
echo $idiomasProgramacion[3] . "<br>";
echo $idiomasProgramacion[4] . "<br>";

foreach ($idiomasProgramacion as $idioma) {
  echo $idioma . "<br>";
}

No está mal hecho entre comillas, solo que yo no estoy pensando en la parte de aplicar PHP a HTML, el profesor sí. Pero bueno, el foreach funciona.
*/

$lenguajes = ["PHP", "JavaScript", "HTML", "CSS", "SQL"];

echo "<ul>";
foreach ($lenguajes as $lenguaje) {
    echo "<li>Lenguaje: $lenguaje</li>";
}
echo "</ul>";
?>