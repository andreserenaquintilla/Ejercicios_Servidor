<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar tareas - DevLevel</title>
</head>
<body>
  <h1>Gestionar tareas</h1>
  <p><a href="index.php">Volver al panel</a></p>

  <?php require __DIR__ . '/mensajes_flash.php'; ?>

  <h2>Nueva tarea</h2>

  <form method="post" action="procesar_nueva_tarea.php">
    <div>
      <label for="titulo">Título</label>
      <input type="text" id="titulo" name="titulo" value="<?= escapar($viejos['titulo'] ?? '') ?>">
      <?php if (isset($errores['titulo'])) { ?>
        <p class="error"><?= escapar($errores['titulo']) ?></p>
      <?php } ?>
    </div>

    <div>
      <label for="descripcion">Descripción</label>
      <textarea id="descripcion" name="descripcion"><?= escapar($viejos['descripcion'] ?? '') ?></textarea>
      <?php if (isset($errores['descripcion'])) { ?>
        <p class="error"><?= escapar($errores['descripcion']) ?></p>
      <?php } ?>
    </div>

    <fieldset>
      <legend>Skills</legend>
      <?php foreach ($skills as $skill) { ?>
        <label>
          <input type="checkbox" name="skills[]" value="<?= $skill['id'] ?>"
            <?php if (estaEnLista($skill['id'], $viejos['skills'] ?? [])) { echo 'checked'; } ?>>
          <?= escapar($skill['nombre']) ?>
        </label>
      <?php } ?>
      <?php if (isset($errores['skills'])) { ?>
        <p class="error"><?= escapar($errores['skills']) ?></p>
      <?php } ?>
    </fieldset>

    <div>
      <label for="puntos">Puntos (XP)</label>
      <input type="text" id="puntos" name="puntos" value="<?= escapar($viejos['puntos'] ?? '') ?>">
      <?php if (isset($errores['puntos'])) { ?>
        <p class="error"><?= escapar($errores['puntos']) ?></p>
      <?php } ?>
    </div>

    <div>
      <label for="nivel_minimo">Nivel mínimo</label>
      <select id="nivel_minimo" name="nivel_minimo">
        <?php for ($i = 1; $i <= 5; $i++) { ?>
          <option value="<?= $i ?>" <?php if (($viejos['nivel_minimo'] ?? '1') === (string) $i) { echo 'selected'; } ?>>
            Nivel <?= $i ?>
          </option>
        <?php } ?>
      </select>
      <?php if (isset($errores['nivel_minimo'])) { ?>
        <p class="error"><?= escapar($errores['nivel_minimo']) ?></p>
      <?php } ?>
    </div>

    <div>
      <label for="dificultad">Dificultad</label>
      <select id="dificultad" name="dificultad">
        <option value="facil" <?php if (($viejos['dificultad'] ?? '') === 'facil') { echo 'selected'; } ?>>Fácil</option>
        <option value="media" <?php if (($viejos['dificultad'] ?? '') === 'media') { echo 'selected'; } ?>>Media</option>
        <option value="dificil" <?php if (($viejos['dificultad'] ?? '') === 'dificil') { echo 'selected'; } ?>>Difícil</option>
      </select>
      <?php if (isset($errores['dificultad'])) { ?>
        <p class="error"><?= escapar($errores['dificultad']) ?></p>
      <?php } ?>
    </div>

    <button type="submit">Crear tarea</button>
  </form>
</body>
</html>