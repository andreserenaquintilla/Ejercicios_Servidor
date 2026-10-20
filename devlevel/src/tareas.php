<?php
declare(strict_types=1);

/**
 * Junta las tareas iniciales con las que ha creado el PM en esta sesión.
 *
 * @param array $tareasIniciales Tareas de datos.php
 * @return array Catálogo completo
 */
function obtenerCatalogo(array $tareasIniciales): array
{
    $catalogo = $tareasIniciales;
    $creadas = $_SESSION['tareas_creadas'] ?? [];

    foreach ($creadas as $tarea) {
        $catalogo[] = $tarea;
    }
    return $catalogo;
}

/**
 * Filtra las tareas que puede ver alguien de ese nivel.
 *
 * @param array $tareas Catálogo completo
 * @param int $nivel Nivel del usuario
 * @return array Solo las tareas permitidas
 */
function tareasDisponibles(array $tareas, int $nivel): array
{
    $disponibles = [];
    foreach ($tareas as $tarea) {
        if ($tarea['nivel_minimo'] <= $nivel) {
            $disponibles[] = $tarea;
        }
    }
    return $disponibles;
}

/**
 * Busca una tarea por su id.
 *
 * @param array $tareas Catálogo completo
 * @param int $id Id de la tarea
 * @return array|null La tarea o null si no existe
 */
function buscarTarea(array $tareas, int $id): ?array
{
    foreach ($tareas as $tarea) {
        if ($tarea['id'] === $id) {
            return $tarea;
        }
    }
    return null;
}

/**
 * Dice si el usuario logueado ya completó esa tarea.
 *
 * @param int $id Id de la tarea
 * @return bool
 */
function tareaCompletada(int $id): bool
{
    $completadas = $_SESSION['usuario']['completadas'] ?? [];
    foreach ($completadas as $idCompletada) {
        if ($idCompletada === $id) {
            return true;
        }
    }
    return false;
}

/**
 * Convierte los ids de skills de una tarea en sus nombres separados por comas.
 *
 * @param array $idsSkills Ids de la tarea, por ejemplo [1, 5]
 * @param array $skills Lista de skills de datos.php
 * @return string
 */
function nombresSkills(array $idsSkills, array $skills): string
{
    $texto = '';
    foreach ($idsSkills as $id) {
        if (isset($skills[$id])) {
            if ($texto !== '') {
                $texto .= ', ';
            }
            $texto .= $skills[$id]['nombre'];
        }
    }
    return $texto;
}
/**
 * Dice si un número está dentro de una lista.
 *
 * @param int $valor Número a buscar
 * @param array $lista Lista donde buscarlo
 * @return bool
 */
function estaEnLista(int $valor, array $lista): bool
{
    foreach ($lista as $elemento) {
        if ($elemento === $valor) {
            return true;
        }
    }
    return false;
}
/**
 * Valida los datos del formulario de nueva tarea.
 *
 * @param array $datos Lo que ha enviado el PM
 * @param array $skills Lista de skills de datos.php
 * @return array Errores por campo (vacío si todo está bien)
 */
function validarNuevaTarea(array $datos, array $skills): array
{
    $errores = [];

    if ($datos['titulo'] === '') {
        $errores['titulo'] = 'Escribe un título.';
    } elseif (strlen($datos['titulo']) > 100) {
        $errores['titulo'] = 'El título no puede pasar de 100 caracteres.';
    }

    if ($datos['descripcion'] === '') {
        $errores['descripcion'] = 'Escribe una descripción.';
    }

    if ($datos['skills'] === []) {
        $errores['skills'] = 'Marca al menos una skill.';
    } else {
        foreach ($datos['skills'] as $id) {
            if (!is_int($id) || !isset($skills[$id])) {
                $errores['skills'] = 'Hay una skill que no existe.';
            }
        }
    }

    $puntos = filter_var($datos['puntos'], FILTER_VALIDATE_INT);
    if ($puntos === false || $puntos < 1 || $puntos > 1000) {
        $errores['puntos'] = 'Los puntos tienen que ser un número entre 1 y 1000.';
    }

    $nivel = filter_var($datos['nivel_minimo'], FILTER_VALIDATE_INT);
    if ($nivel === false || $nivel < 1 || $nivel > 5) {
        $errores['nivel_minimo'] = 'El nivel tiene que estar entre 1 y 5.';
    }

    if ($datos['dificultad'] !== 'facil' && $datos['dificultad'] !== 'media' && $datos['dificultad'] !== 'dificil') {
        $errores['dificultad'] = 'Elige una dificultad válida.';
    }

    return $errores;
}

/**
 * Añade una tarea nueva al catálogo de la sesión.
 *
 * @param array $datos Datos ya validados
 * @param array $tareasIniciales Tareas de datos.php (para calcular el id)
 * @return void
 */
function crearTarea(array $datos, array $tareasIniciales): void
{
    // El id nuevo es el más alto que haya + 1
    $idMaximo = 0;
    foreach (obtenerCatalogo($tareasIniciales) as $tarea) {
        if ($tarea['id'] > $idMaximo) {
            $idMaximo = $tarea['id'];
        }
    }

    $_SESSION['tareas_creadas'][] = [
        'id' => $idMaximo + 1,
        'titulo' => $datos['titulo'],
        'descripcion' => $datos['descripcion'],
        'skills' => $datos['skills'],
        'puntos' => (int) $datos['puntos'],
        'nivel_minimo' => (int) $datos['nivel_minimo'],
        'dificultad' => $datos['dificultad'],
    ];
}