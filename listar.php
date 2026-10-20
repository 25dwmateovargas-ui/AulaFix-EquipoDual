<?php
require 'CONFIG/conexion.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $conexion -> prepare(
'SELECT id, titulo, descripcion, estado FROM incidencias WHERE id = ?'
);
$stmt->bind_param('i', $id);
$stmt->execute();
$incidencia = $stmt->get_result()->fetch_assoc();
if ($incidencia) {
echo json_encode($incidencia, JSON_UNESCAPED_UNICODE);
} else {
http_response_code(404);
echo 'No encontrado';
}
?>