<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

require 'CONFIG/conexion.php';

$estadosPermitidos = [
    'Abierta',
    'En proceso',
    'Resuelta'
];

if (
    isset($_POST['accion']) &&
    $_POST['accion'] === 'eliminar' &&
    isset($_POST['id'])
) {
    $id = (int) $_POST['id'];

    $stmtDelete = $conexion->prepare("
        DELETE FROM incidencias
        WHERE id = ?
    ");

    $stmtDelete->bind_param("i", $id);
    $stmtDelete->execute();

    header("Location: listar.php");
    exit;
}
if (
    isset($_POST['accion']) &&
    $_POST['accion'] === 'cambiar_estado' &&
    isset($_POST['id']) &&
    isset($_POST['estado'])
) {

    $id = (int) $_POST['id'];
    $estado = $_POST['estado'];

    if (in_array($estado, $estadosPermitidos)) {

        $stmtEstado = $conexion->prepare("
            UPDATE incidencias
            SET estado = ?
            WHERE id = ?
        ");

        $stmtEstado->bind_param("si", $estado, $id);
        $stmtEstado->execute();
    }

    header("Location: listar.php?id=" . $id);
    exit;
}
if (isset($_GET['densidad']) && in_array($_GET['densidad'], ['comoda', 'compacta'])) {

    setcookie('densidad', $_GET['densidad'], time() + (60 * 60 * 24 * 365), '/');

    $paramsSinDensidad = $_GET;
    unset($paramsSinDensidad['densidad']);

    $destino = 'listar.php';
    if (!empty($paramsSinDensidad)) {
        $destino .= '?' . http_build_query($paramsSinDensidad);
    }

    header("Location: $destino");
    exit;
}

$densidad = ($_COOKIE['densidad'] ?? 'comoda') === 'compacta' ? 'compacta' : 'comoda';

$busqueda = trim($_GET['q'] ?? '');
$filtroEstado = $_GET['estado'] ?? '';

if (!in_array($filtroEstado, $estadosPermitidos)) {
    $filtroEstado = '';
}

$sql = "SELECT id, titulo,descripcion, estado FROM incidencias WHERE 1=1";
$tipos = '';
$parametros = [];

if ($busqueda !== '') {
    $sql .= " AND (titulo LIKE ? OR descripcion LIKE ?)";
    $comodin = '%' . $busqueda . '%';
    $tipos .= 'sss';
    $parametros[] = $comodin;
    $parametros[] = $comodin;
    $parametros[] = $comodin;
}

if ($filtroEstado !== '') {
    $sql .= " AND estado = ?";
    $tipos .= 's';
    $parametros[] = $filtroEstado;
}

$sql .= " ORDER BY id DESC";

$stmt = $conexion->prepare($sql);

if ($tipos !== '') {
    $referencias = [];
    foreach ($parametros as $clave => $valor) {
        $referencias[$clave] = &$parametros[$clave];
    }
    array_unshift($referencias, $tipos);
    call_user_func_array([$stmt, 'bind_param'], $referencias);
}

$stmt->execute();

$resultado = $stmt->get_result();
$totalTickets = $resultado->num_rows;

$queryFiltros = http_build_query(array_filter([
    'q' => $busqueda,
    'estado' => $filtroEstado,
]));
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

        <form class="ticket-toolbar" method="GET">

            <div class="search-wrap">

                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"></circle>
                    <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2"></path>
                </svg>

                <input
                    type="text"
                    name="q"
                    id="buscador-texto"
                    placeholder="Buscar por título, ubicación o descripción..."
                    value="<?php echo htmlspecialchars($busqueda); ?>">
            </div>

            <select class="filter-select" name="estado" onchange="this.form.submit()">
                <option value="" <?php echo $filtroEstado === '' ? 'selected' : ''; ?>>Todos los estados</option>
                <?php foreach ($estadosPermitidos as $estadoOpcion): ?>
                    <option value="<?php echo htmlspecialchars($estadoOpcion); ?>" <?php echo $filtroEstado === $estadoOpcion ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($estadoOpcion); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="btn btn-secondary">Buscar</button>

            <?php if ($busqueda !== '' || $filtroEstado !== ''): ?>
                <a href="listar.php" class="btn btn-ghost">Limpiar</a>
            <?php endif; ?>

            <?php
            $otraDensidad = $densidad === 'compacta' ? 'comoda' : 'compacta';
            $queryDensidad = http_build_query(array_merge($_GET, ['densidad' => $otraDensidad]));
            ?>
            <a href="listar.php?<?php echo $queryDensidad; ?>" class="btn btn-ghost">
                Vista: <?php echo $densidad === 'compacta' ? 'Compacta' : 'Cómoda'; ?>
            </a>

        </form>

        <div class="listar-shell">

            <ul class="ticket-list <?php echo $densidad === 'compacta' ? 'densidad-compacta' : ''; ?>" id="lista-tickets">

                <?php if ($resultado->num_rows > 0): ?>

                    <?php while ($incidencia = $resultado->fetch_assoc()): ?>

                        <li>
    <a href="listar.php?id=<?php echo $incidencia['id']; ?><?php echo $queryFiltros !== '' ? '&' . $queryFiltros : ''; ?>"
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
            </div>
        </div>

    </a>
</li>

                    <?php endwhile; ?>

                <?php else: ?>

                    <li class="empty-list">
                        <?php if ($busqueda !== '' || $filtroEstado !== ''): ?>
                            No hay incidencias que coincidan con la búsqueda.
                        <?php else: ?>
                            No hay incidencias registradas.
                        <?php endif; ?>
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
<<<<<<< HEAD
=======
                
>>>>>>> 1975ce1f0f723dab51cc375fa7b7a3b1bec0e329
            </div>
        </div>

        <?php

$claseEstado = 'badge-abierta';

if($detalle['estado'] == 'En proceso'){
    $claseEstado = 'badge-progress';
}

if($detalle['estado'] == 'Resuelta'){
    $claseEstado = 'badge-closed';
}

?>

<span class="badge <?php echo $claseEstado; ?>">
    <?php echo htmlspecialchars($detalle['estado']); ?>
</span>

    </div>

    <div class="detail-body">

        <h3>Descripción</h3>

        <p>
            <?php echo nl2br(htmlspecialchars($detalle['descripcion'])); ?>
        </p>

    </div>
    <div class="detail-footer">

    <form method="post" class="estado-form">



    <input type="hidden" name="accion" value="cambiar_estado">
    <input type="hidden" name="id" value="<?php echo $detalle['id']; ?>">

    <button
    type="submit"
    name="estado"
    value="Abierta"
    class="estado-btn abierta <?php echo $detalle['estado']=='Abierta' ? 'active' : ''; ?>">
    Abierta
</button>

    <button
        type="submit"
        name="estado"
        value="En proceso"
        class="estado-btn proceso <?php echo $detalle['estado']=='En proceso' ? 'active' : ''; ?>">
        En proceso
    </button>

    <button
        type="submit"
        name="estado"
        value="Resuelta"
        class="estado-btn resuelta <?php echo $detalle['estado']=='Resuelta' ? 'active' : ''; ?>">
        Resuelta
    </button>
</form>

    <form
    method="post"
    onsubmit="return confirm('¿Seguro que deseas eliminar esta incidencia?');">

    <input
        type="hidden"
        name="accion"
        value="eliminar">

    <input
        type="hidden"
        name="id"
        value="<?php echo $detalle['id']; ?>">

    <button
        type="submit"
        class="delete-btn">
        🗑 Eliminar incidencia
    </button>

</form>

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

<script src="frontend/js/script.js"></script>

</body>
</html>

<?php
$stmt->close();
$conexion->close();
?>