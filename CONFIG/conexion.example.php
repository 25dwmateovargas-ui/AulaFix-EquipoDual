<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$usuario = "root";
$contrasena = "";
$baseDatos = "aulafix";

try {
    $conexion = new mysqli($host, $usuario, $contrasena, $baseDatos);
    $conexion->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    exit("Error de conexión a la base de datos.");
}
