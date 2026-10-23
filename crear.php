<?php
require 'CONFIG/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Crear una Incidencia</h1>
    <form method="post">
        <label for="titulo">Titulo</label>
        <input type="text" id="titulo" name="titulo"><br>
        <label for="descripcion">Descripción</label>
        <input type="text" id="descripcion" name="descripcion">
    </form>
</body>
</html>

<?php
$titulo = trim($_POST['titulo'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');

$stmt = $conexion->prepare(
'INSERT INTO incidencias (titulo, descripcion, estado) VALUES (?, ?, "Nuevo")'
);
$stmt->bind_param('ss', $titulo, $descripcion);
$stmt->execute();
?>