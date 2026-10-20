<?php

$host = "localhost";
$usuario = "root";
$contrasena = "root";
$baseDatos = "aulafix";

$conexion = mysqli_connect(
    $host,
    $usuario,
    $contrasena,
    $baseDatos
);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8");