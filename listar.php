<?php
require 'CONFIG/conexion.php';

$stmt = $conexion->prepare("
    SELECT id, titulo, descripcion, estado
    FROM incidencias
    ORDER BY id DESC
");

$stmt->execute();

$resultado = $stmt->get_result();
$totalTickets = $resultado->num_rows;
?>
<?php
$detalle = null;

if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $stmtDetalle = $conexion->prepare("
        SELECT id, titulo, descripcion, estado
        FROM incidencias
        WHERE id = ?
    ");

    $stmtDetalle->bind_param("i", $id);
    $stmtDetalle->execute();

    $detalle = $stmtDetalle->get_result()->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AulaFix - Listado de Incidencias</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="frontend/css/style.css">
</head>

<body>

<div class="bg-glow"></div>

<div class="page">

    <header class="topbar">

        <div class="brand">
            <span class="brand-mark">
                AF
            </span>
            AulaFix
        </div>

        <div class="topbar-right">
            <a href="incidencias.php" class="back-link">
                ← Volver atrás
            </a>
        </div>

    </header>

    <main class="content">

        <div class="hero">
            <h1>Listado de incidencias</h1>
            <p>Consulta todas las incidencias registradas en el sistema.</p>
        </div>

        <div class="ticket-toolbar">

            <div class="search-wrap">

                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"></circle>
                    <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2"></path>
                </svg>

                <input
                    type="text"
                    placeholder="Búsqueda (próximamente)"
                    disabled>
            </div>

            <select class="filter-select" disabled>
                <option>Todos los estados</option>
            </select>

        </div>

        <div class="listar-shell">

            <ul class="ticket-list">

                <?php if ($resultado->num_rows > 0): ?>

                    <?php while ($incidencia = $resultado->fetch_assoc()): ?>

                        <li>
    <a href="listar.php?id=<?php echo $incidencia['id']; ?>"
       class="ticket-item
       <?php echo (isset($_GET['id']) && $_GET['id'] == $incidencia['id']) ? 'active' : ''; ?>">

        <div class="t-id">
            #<?php echo $incidencia['id']; ?>
        </div>

        <div class="t-info">
            <div class="t-title">
                <?php echo htmlspecialchars($incidencia['titulo']); ?>
            </div>

            <div class="t-loc">
                Estado: <?php echo htmlspecialchars($incidencia['estado']); ?>
            </div>
        </div>

    </a>
</li>

                    <?php endwhile; ?>

                <?php else: ?>

                    <li class="empty-list">
                        No hay incidencias registradas.
                    </li>

                <?php endif; ?>

            </ul>

            <div class="card detail-card">

<?php if ($detalle): ?>

    <div class="detail-head">

        <div>
            <h2>
                <?php echo htmlspecialchars($detalle['titulo']); ?>
            </h2>

            <div class="detail-meta">
                <span>ID #<?php echo $detalle['id']; ?></span>
            </div>
        </div>

        <span class="badge badge-open">
            <?php echo htmlspecialchars($detalle['estado']); ?>
        </span>

    </div>

    <div class="detail-body">

        <h3>Descripción</h3>

        <p>
            <?php echo nl2br(htmlspecialchars($detalle['descripcion'])); ?>
        </p>

    </div>

<?php else: ?>

    <div class="detail-head">
        <h2>Información general</h2>
    </div>

    <div class="detail-body">
        <p>
            Selecciona una incidencia de la lista para ver sus detalles.
        </p>
    </div>

<?php endif; ?>

</div>

        </div>

    </main>

</div>

</body>
</html>

<?php
$stmt->close();
$conexion->close();
?>