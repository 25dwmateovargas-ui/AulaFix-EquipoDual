<?php 
require 'CONFIG/conexion.php';

$stmt = $conexion->prepare(
	'SELECT id, titulo, descripcion, estado, created_at FROM incidencias'
);
$stmt->execute();
$incidencia = $stmt->get_result();
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Listado de incidencias</title>
</head>
<body>
<h1>Incidendias:</h1>
<table border="1" cellpadding="6">
<tr><th>ID</th><th>Titulo</th><th>descripcion</th><th>Estado</th><th>Alta</th></tr>
<?php while ($incidencias = $incidencia->fetch_assoc()): ?>
<tr>
<td><?= (int)$incidencias['id'] ?></td>
<td><?= htmlspecialchars($incidencias['titulo'], ENT_QUOTES, 'UTF-8') ?></td>
<td><?= htmlspecialchars($incidencias['descripcion'], ENT_QUOTES, 'UTF-8') ?></td>
<td><?= htmlspecialchars($incidencias['estado'],ENT_QUOTES, 'UTF-8' ) ?></td>
<td><?= htmlspecialchars($incidencias['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
