<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel - DevLevel</title>
</head>
<body>
  <h1>Hola, <?= escapar($usuario['nombre']) ?></h1>
  <p>
    <?= escapar($usuario['rol']) ?> · Nivel <?= $usuario['nivel'] ?> · <?= $usuario['puntos'] ?> XP
  </p>

  <?php require __DIR__ . '/mensajes_flash.php'; ?>
    <?php if ($usuario['rol'] === ROL_PM) { ?>
    <p><a href="index.php?pagina=admin">Gestionar tareas</a></p>
  <?php } ?>

  <h2>Tareas disponibles</h2>

  <?php if ($tareas === []) { ?>
    <p>No hay tareas para tu nivel ahora mismo.</p>
  <?php } else { ?>
    <?php foreach ($tareas as $tarea) { ?>
      <article class="tarea">
        <h3><?= escapar($tarea['titulo']) ?></h3>
        <p><?= escapar($tarea['descripcion']) ?></p>
        <p>Skills: <?= escapar(nombresSkills($tarea['skills'], $skills)) ?></p>
        <p>
          <?= $tarea['puntos'] ?> XP · Nivel mínimo <?= $tarea['nivel_minimo'] ?> · <?= escapar($tarea['dificultad']) ?>
        </p>

        <?php if (tareaCompletada($tarea['id'])) { ?>
          <p>✔ Completada</p>
        <?php } elseif ($usuario['rol'] !== ROL_PM) { ?>
          <form method="post" action="procesar_tarea.php">
            <input type="hidden" name="tarea_id" value="<?= $tarea['id'] ?>">
            <button type="submit">Completar</button>
          </form>
        <?php } ?>
      </article>
    <?php } ?>
  <?php } ?>

  <p><a href="logout.php">Cerrar sesión</a></p>
</body>
</html>