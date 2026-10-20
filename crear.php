<?php
require 'CONFIG/conexion.php';

$titulo = trim($_POST['titulo'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');
$estado = trim($_POST['estado'] ?? '');

$stmt = $conexion->prepare(
'INSERT INTO alumnos (titulo, descripcion, estado) VALUES (?, ?, ?)'
);
$stmt->bind_param('sss', $titulo, $descripcion, $estado);
$stmt->execute();
?>