<?php
// Página de inicio para localhost
// Va en la raíz de htdocs. Muestra las carpetas como tarjetas
// y también sirve para navegar dentro de ellas (?ruta=carpeta/subcarpeta)

$base = realpath(__DIR__);

// Carpetas y archivos de XAMPP que no quiero ver en la raíz
$ocultas = ['dashboard', 'img', 'webalizer', 'xampp', 'forbidden', 'restricted'];

// Iconos según el nombre de la carpeta (gana la primera que coincide)
$iconosCarpeta = [
    'login'    => '🔐',
    'servidor' => '🐘',
    'php'      => '🐘',
    'cliente'  => '⚡',
    'js'       => '⚡',
    'diw'      => '🎨',
    'css'      => '🎨',
    'html'     => '📄',
    'bd'       => '🗄️',
    'sql'      => '🗄️',
    'big'      => '📊',
    'data'     => '📊',
    'gym'      => '💪',
    'juego'    => '🎮',
    'game'     => '🎮',
];

// Iconos según la extensión del archivo
$iconosArchivo = [
    'php'  => '🐘',
    'html' => '📄',
    'htm'  => '📄',
    'css'  => '🎨',
    'js'   => '⚡',
    'json' => '🧾',
    'sql'  => '🗄️',
    'md'   => '📝',
    'txt'  => '📃',
    'pdf'  => '📕',
    'rar'  => '📦',
    'zip'  => '📦',
    '7z'   => '📦',
    'png'  => '🖼️',
    'jpg'  => '🖼️',
    'jpeg' => '🖼️',
    'gif'  => '🖼️',
    'svg'  => '🖼️',
    'webp' => '🖼️',
];

function iconoCarpeta($nombre, $iconos) {
    $nombre = strtolower($nombre);
    foreach ($iconos as $palabra => $icono) {
        if (str_contains($nombre, $palabra)) {
            return $icono;
        }
    }
    return '📁';
}

function iconoArchivo($nombre, $iconos) {
    $ext = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));
    return $iconos[$ext] ?? '📄';
}

function tamano($bytes) {
    if ($bytes < 1024) return $bytes . ' B';
    if ($bytes < 1048576) return round($bytes / 1024) . ' KB';
    return round($bytes / 1048576, 1) . ' MB';
}

// Enlace "real" a un archivo o carpeta (para abrirlo con Apache)
function enlace($ruta) {
    if ($ruta === '') return '/';
    return '/' . implode('/', array_map('rawurlencode', explode('/', $ruta)));
}

// Enlace para navegar con esta página
function navegar($ruta) {
    return $ruta === '' ? '/' : '/?ruta=' . rawurlencode($ruta);
}

// Saco la carpeta que hay que mostrar. Primero del ?ruta=,
// y si no viene, de la URL (por si Apache me manda aquí desde otra carpeta)
$pedida = $_GET['ruta'] ?? urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Paso todo a barras normales (en Windows vienen con \) y quito las de los lados
$base   = str_replace('\\', '/', $base);
$pedida = trim(str_replace('\\', '/', $pedida), '/');

// Separo la ruta por trozos y quito los vacíos y los "."
// Si alguien mete ".." para salirse de htdocs, no le dejo
$trozos = array_values(array_filter(explode('/', $pedida), fn($t) => $t !== '' && $t !== '.'));
$intentaSalir = in_array('..', $trozos);

$ruta = implode('/', $trozos);
$actual = $ruta === '' ? $base : $base . '/' . $ruta;

// Si no existe, vuelvo al inicio pero aviso de qué carpeta no ha encontrado
$noEncontrada = '';
if ($intentaSalir || !is_dir($actual)) {
    // Solo aviso si venía del ?ruta= (si entras por /index.php no hace falta)
    $noEncontrada = isset($_GET['ruta']) ? $ruta : '';
    $ruta = '';
    $actual = $base;
}

$enRaiz = ($ruta === '');

// Recorro el contenido de la carpeta
$carpetas = [];
$archivos = [];

foreach (scandir($actual) ?: [] as $elemento) {
    if ($elemento[0] === '.') continue; // fuera ocultos (.git, .gitignore...)

    $completo = $actual . '/' . $elemento;
    $rutaElemento = $enRaiz ? $elemento : $ruta . '/' . $elemento;

    if (is_dir($completo)) {
        if ($enRaiz && in_array(strtolower($elemento), $ocultas)) continue;

        $subcarpetas = [];
        foreach (scandir($completo) ?: [] as $sub) {
            if ($sub[0] !== '.' && is_dir($completo . '/' . $sub)) {
                $subcarpetas[] = $sub;
            }
        }

        $tieneIndex = file_exists($completo . '/index.php') || file_exists($completo . '/index.html');

        $carpetas[] = [
            'nombre'      => $elemento,
            'ruta'        => $rutaElemento,
            'icono'       => iconoCarpeta($elemento, $iconosCarpeta),
            'esRepo'      => is_dir($completo . '/.git'),
            'tieneIndex'  => $tieneIndex,
            'numPhp'      => count(glob($completo . '/{,*/}*.php', GLOB_BRACE) ?: []),
            'subcarpetas' => $subcarpetas,
            'fecha'       => @filemtime($completo) ?: 0,
        ];
    } elseif (!$enRaiz) {
        // En la raíz no enseño archivos sueltos (son los de XAMPP)
        $archivos[] = [
            'nombre' => $elemento,
            'ruta'   => $rutaElemento,
            'icono'  => iconoArchivo($elemento, $iconosArchivo),
            'tamano' => tamano(@filesize($completo) ?: 0),
            'fecha'  => @filemtime($completo) ?: 0,
        ];
    }
}

// Carpetas: más recientes primero. Archivos: por nombre
usort($carpetas, fn($a, $b) => $b['fecha'] <=> $a['fecha']);
usort($archivos, fn($a, $b) => strnatcasecmp($a['nombre'], $b['nombre']));

// Migas de pan (Inicio > Carpeta > Subcarpeta)
$migas = [];
$acumulada = '';
if (!$enRaiz) {
    foreach (explode('/', $ruta) as $parte) {
        $acumulada = $acumulada === '' ? $parte : $acumulada . '/' . $parte;
        $migas[] = ['nombre' => $parte, 'ruta' => $acumulada];
    }
}

$titulo = $enRaiz ? 'localhost' : basename($actual);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo) ?> · localhost</title>
    <style>
        :root {
            --fondo: #f4f5f7;
            --tarjeta: #ffffff;
            --texto: #1d1f23;
            --suave: #6b7280;
            --borde: #e3e5e9;
            --acento: #7b5cff;
            --chip: #eeebff;
        }
        @media (prefers-color-scheme: dark) {
            :root {
                --fondo: #121318;
                --tarjeta: #1c1e25;
                --texto: #eceef2;
                --suave: #9097a3;
                --borde: #2b2e37;
                --acento: #9d86ff;
                --chip: #2a2645;
            }
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
            background: var(--fondo);
            color: var(--texto);
            padding: 40px 20px;
        }
        a { color: inherit; }
        .contenedor { max-width: 1100px; margin: 0 auto; }

        header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 20px;
        }
        h1 { font-size: 2rem; word-break: break-word; }
        h1 span { color: var(--acento); }
        .info { color: var(--suave); font-size: 0.9rem; margin-top: 4px; }

        .accesos { display: flex; gap: 8px; flex-wrap: wrap; }
        .accesos a {
            text-decoration: none;
            background: var(--tarjeta);
            border: 1px solid var(--borde);
            padding: 8px 14px;
            border-radius: 10px;
            font-size: 0.9rem;
        }
        .accesos a:hover { border-color: var(--acento); }

        .migas {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 6px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            color: var(--suave);
        }
        .migas a { text-decoration: none; color: var(--acento); }
        .migas a:hover { text-decoration: underline; }

        #buscador {
            width: 100%;
            padding: 12px 16px;
            font-size: 1rem;
            border-radius: 12px;
            border: 1px solid var(--borde);
            background: var(--tarjeta);
            color: var(--texto);
            margin-bottom: 24px;
            outline: none;
        }
        #buscador:focus { border-color: var(--acento); }

        h2 { font-size: 1rem; color: var(--suave); font-weight: 600; margin: 8px 0 12px; }

        .rejilla {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }
        .tarjeta {
            position: relative;
            cursor: pointer;
            background: var(--tarjeta);
            border: 1px solid var(--borde);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: transform 0.15s, border-color 0.15s;
        }
        .tarjeta:hover { transform: translateY(-3px); border-color: var(--acento); }

        .cabecera { display: flex; align-items: center; gap: 12px; text-decoration: none; }

        /* Truco para que toda la tarjeta sea clicable: el enlace de arriba
           se estira por encima de toda la tarjeta */
        .cabecera::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 16px;
        }
        /* Los botones de dentro van por encima para que sigan funcionando */
        .subs, .abrir { position: relative; z-index: 1; }
        .icono {
            font-size: 1.6rem;
            width: 48px; height: 48px;
            display: grid; place-items: center;
            background: var(--chip);
            border-radius: 12px;
            flex-shrink: 0;
        }
        .nombre { font-weight: 600; font-size: 1.05rem; word-break: break-word; }
        .datos { color: var(--suave); font-size: 0.8rem; }

        .etiqueta {
            display: inline-block;
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 20px;
            background: var(--acento);
            color: white;
            margin-left: 6px;
            vertical-align: middle;
        }

        .subs { display: flex; flex-wrap: wrap; gap: 6px; }
        .subs a {
            font-size: 0.78rem;
            text-decoration: none;
            background: var(--chip);
            padding: 4px 10px;
            border-radius: 8px;
        }
        .subs a:hover { background: var(--acento); color: white; }

        .abrir {
            align-self: flex-start;
            font-size: 0.8rem;
            text-decoration: none;
            background: var(--acento);
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
        }

        /* Lista de archivos */
        .lista {
            background: var(--tarjeta);
            border: 1px solid var(--borde);
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 32px;
        }
        .fila {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 18px;
            text-decoration: none;
            border-bottom: 1px solid var(--borde);
        }
        .fila:last-child { border-bottom: none; }
        .fila:hover { background: var(--chip); }
        .fila .icono { width: 36px; height: 36px; font-size: 1.1rem; border-radius: 9px; }
        .fila .nombre { flex: 1; font-weight: 500; font-size: 0.95rem; }
        .fila .datos { text-align: right; white-space: nowrap; }

        .aviso {
            background: #ffb02033;
            border: 1px solid #ffb020;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        .vacio { color: var(--suave); text-align: center; padding: 40px; display: none; }
        .carpetaVacia { color: var(--suave); text-align: center; padding: 40px; }
        footer { margin-top: 20px; text-align: center; color: var(--suave); font-size: 0.8rem; }

        @media (max-width: 500px) {
            .fila .datos { display: none; }
        }
    </style>
</head>
<body>
<div class="contenedor">

    <header>
        <div>
            <?php if ($enRaiz): ?>
                <h1>🖥️ local<span>host</span></h1>
                <p class="info"><?= count($carpetas) ?> proyectos · PHP <?= PHP_VERSION ?> · <?= date('d/m/Y H:i') ?></p>
            <?php else: ?>
                <h1><?= iconoCarpeta(basename($actual), $iconosCarpeta) ?> <?= htmlspecialchars(basename($actual)) ?></h1>
                <p class="info"><?= count($carpetas) ?> carpetas · <?= count($archivos) ?> archivos</p>
            <?php endif; ?>
        </div>
        <nav class="accesos">
            <a href="/phpmyadmin/" target="_blank">🗄️ phpMyAdmin</a>
            <a href="/dashboard/">⚙️ XAMPP</a>
            <a href="https://github.com/andreserenaquintilla" target="_blank">🐙 GitHub</a>
        </nav>
    </header>

    <?php if ($noEncontrada !== ''): ?>
        <p class="aviso">⚠️ No encuentro la carpeta <strong><?= htmlspecialchars($noEncontrada) ?></strong> dentro de htdocs</p>
    <?php endif; ?>

    <?php if (!$enRaiz): ?>
        <nav class="migas">
            <a href="/">🏠 Inicio</a>
            <?php foreach ($migas as $i => $miga): ?>
                <span>›</span>
                <?php if ($i === count($migas) - 1): ?>
                    <span><?= htmlspecialchars($miga['nombre']) ?></span>
                <?php else: ?>
                    <a href="<?= navegar($miga['ruta']) ?>"><?= htmlspecialchars($miga['nombre']) ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </nav>
    <?php endif; ?>

    <input type="text" id="buscador" placeholder="🔍 Buscar..." autofocus>

    <?php if (!empty($carpetas)): ?>
        <?php if (!$enRaiz): ?><h2>Carpetas</h2><?php endif; ?>
        <main class="rejilla">
            <?php foreach ($carpetas as $c): ?>
                <article class="tarjeta buscable" data-buscar="<?= htmlspecialchars(strtolower($c['nombre'] . ' ' . implode(' ', $c['subcarpetas']))) ?>">
                    <a class="cabecera" href="<?= navegar($c['ruta']) ?>">
                        <div class="icono"><?= $c['icono'] ?></div>
                        <div>
                            <div class="nombre">
                                <?= htmlspecialchars($c['nombre']) ?>
                                <?php if ($c['esRepo']): ?><span class="etiqueta">git</span><?php endif; ?>
                            </div>
                            <div class="datos"><?= $c['numPhp'] ?> archivos .php · <?= date('d/m/Y', $c['fecha']) ?></div>
                        </div>
                    </a>

                    <?php if (!empty($c['subcarpetas'])): ?>
                        <div class="subs">
                            <?php foreach ($c['subcarpetas'] as $sub): ?>
                                <a href="<?= navegar($c['ruta'] . '/' . $sub) ?>"><?= htmlspecialchars($sub) ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($c['tieneIndex']): ?>
                        <a class="abrir" href="<?= enlace($c['ruta']) ?>/">▶ Abrir proyecto</a>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </main>
    <?php endif; ?>

    <?php if (!empty($archivos)): ?>
        <h2>Archivos</h2>
        <section class="lista">
            <?php foreach ($archivos as $a): ?>
                <a class="fila buscable" href="<?= enlace($a['ruta']) ?>" data-buscar="<?= htmlspecialchars(strtolower($a['nombre'])) ?>">
                    <div class="icono"><?= $a['icono'] ?></div>
                    <div class="nombre"><?= htmlspecialchars($a['nombre']) ?></div>
                    <div class="datos"><?= $a['tamano'] ?> · <?= date('d/m/Y H:i', $a['fecha']) ?></div>
                </a>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>

    <?php if (empty($carpetas) && empty($archivos)): ?>
        <p class="carpetaVacia">Esta carpeta está vacía 🫥</p>
    <?php endif; ?>

    <p class="vacio" id="vacio">No hay nada con ese nombre 🤷</p>

    <footer>Andrés Serena Quintilla · DAW</footer>
</div>

<script>
    // Filtro del buscador (tarjetas y archivos)
    const buscador = document.getElementById('buscador');
    const elementos = document.querySelectorAll('.buscable');
    const vacio = document.getElementById('vacio');

    buscador.addEventListener('input', () => {
        const texto = buscador.value.toLowerCase().trim();
        let visibles = 0;

        elementos.forEach(el => {
            const coincide = el.dataset.buscar.includes(texto);
            el.style.display = coincide ? '' : 'none';
            if (coincide) visibles++;
        });

        vacio.style.display = visibles === 0 && elementos.length > 0 ? 'block' : 'none';
    });
</script>
</body>
</html>
