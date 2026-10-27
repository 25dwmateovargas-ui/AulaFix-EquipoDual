<?php
require 'CONFIG/conexion.php';

$incidencia = null;
$error = '';

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $id = (int)$_GET['id'];

    $stmt = $conexion->prepare(
        'SELECT id, titulo, descripcion, estado 
         FROM incidencias 
         WHERE id = ?'
    );

    $stmt->bind_param('i', $id);
    $stmt->execute();

    $incidencia = $stmt->get_result()->fetch_assoc();

    if (!$incidencia) {
        $error = 'No se encontró ninguna incidencia.';
    }
}
?>

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AulaFix — Buscar ticket</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
<link rel="stylesheet" href="frontend/css/style.css">
</head>

<body>

<div class="bg-glow"></div>

<div class="page">

<header class="topbar">
    <div class="brand">
        <span class="brand-mark">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="#0b0c10" stroke-width="2" stroke-linejoin="round"/>
                <path d="M2 17l10 5 10-5M2 12l10 5 10-5"
                      stroke="#0b0c10"
                      stroke-width="2"
                      stroke-linejoin="round"
                      stroke-linecap="round"/>
            </svg>
        </span>
        AulaFix
    </div>

    <div class="topbar-right">
        <a href="incidencias.php" class="btn btn-ghost">
            Volver atrás
        </a>
    </div>
</header>

<main class="content">

    <div class="search-hero">
        <h1>Buscar un ticket</h1>
        <p>Introduce el número de ticket (ej. 1, 2, 3...)</p>

        <form class="search-box" method="GET">

            <div class="search-wrap">

                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
                    <path d="M21 21l-4.3-4.3"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"/>
                </svg>

                <input
                    type="number"
                    name="id"
                    placeholder="Introduce el nº de ticket..."
                    value="<?= htmlspecialchars($_GET['id'] ?? '') ?>"
                >

            </div>

            <button type="submit" class="btn btn-primary">
                Buscar
            </button>

        </form>
    </div>

    <div id="result-area" class="result-area">

        <?php if ($incidencia): ?>

            <?php
$estado = strtolower($incidencia['estado']);

$badgeClass = match($estado) {
    'abierta' => 'badge-open',
    'en proceso' => 'badge-progress',
    'cerrada' => 'badge-closed',
    default => 'badge-open'
};
?>

<div class="result-card">

    <div class="detail-head">

        <div>
            <h2>Ticket #<?= $incidencia['id'] ?></h2>

            <p>
                <strong>Título:</strong>
                <?= htmlspecialchars($incidencia['titulo']) ?>
            </p>
        </div>

        <span class="badge <?= $badgeClass ?>">
            <?= htmlspecialchars($incidencia['estado']) ?>
        </span>

    </div>

    <div class="detail-body">
        <strong>Descripción:</strong><br>
        <?= nl2br(htmlspecialchars($incidencia['descripcion'])) ?>
    </div>

</div>

        <?php elseif ($error): ?>

            <div class="result-card">
                <p><?= $error ?></p>
            </div>

        <?php endif; ?>

    </div>

</main>

</div>

</body>
</html>