<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Andrés Serena Quintilla">
    <title>Micro Ejercicios 4 - ¿Es mayor de edad?</title>
    <link rel="stylesheet" href="">
    <script src=""></script>
</head>
<body>
    <?php
    $edad = 18;
    if ($edad >= 18) {
        echo "El usuario es mayor de edad (tiene $edad años).";
    } else {
        echo "El usuario es menor de edad (tiene $edad años),";
    }
    ?>
</body>
</html>