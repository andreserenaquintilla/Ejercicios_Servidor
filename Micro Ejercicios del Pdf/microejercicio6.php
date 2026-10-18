<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Andrés Serena Quintilla">
    <title>Micro Ejercicio 6 - Menú de opciones</title>
    <link rel="stylesheet" href="">
    <script src=""></script>
</head>
<body>
    <?php
    $opcion = 47;

    $menuOpciones = match ($opcion) {
    1 => "1 -> Alta de usuario",
    2 => "2 -> Listado de usuarios",
    3 => "3 -> Cerrar Sesión",
    default => "Opción incorrecta."
    };
echo "Has seleccionado: " . $menuOpciones;
    ?>
</body>
</html>