<?php

/**
 * Funciones reutilizables del servidor (acceso y gestión de incidencias).
 */

function cumpleLongitudMinima(string $valor, int $minimo): bool
{
    return mb_strlen(trim($valor)) >= $minimo;
}

function autenticarUsuario(mysqli $conexion, string $nombre, string $contrasena): bool
{
    $stmt = $conexion->prepare(
        "SELECT id
         FROM usuarios
         WHERE nombre = ?
         AND contraseña = ?"
    );

    $stmt->bind_param("ss", $nombre, $contrasena);
    $stmt->execute();

    $autenticado = $stmt->get_result()->num_rows >= 1;

    $stmt->close();

    return $autenticado;
}

function validarIncidencia(string $titulo, string $ubicacion, string $descripcion): array
{
    $errores = [];

    if (!cumpleLongitudMinima($titulo, 3)) {
        $errores[] = 'el título debe tener al menos 3 caracteres';
    }

    if (!cumpleLongitudMinima($ubicacion, 2)) {
        $errores[] = 'la ubicación debe tener al menos 2 caracteres';
    }

    if (!cumpleLongitudMinima($descripcion, 10)) {
        $errores[] = 'la descripción debe tener al menos 10 caracteres';
    }

    return $errores;
}

function crearIncidencia(mysqli $conexion, string $titulo, string $ubicacion, string $descripcion): bool
{
    $stmt = $conexion->prepare(
        'INSERT INTO incidencias (titulo, ubicacion, descripcion, estado)
         VALUES (?, ?, ?, "Abierta")'
    );

    $stmt->bind_param('sss', $titulo, $ubicacion, $descripcion);
    $exito = $stmt->execute();

    $stmt->close();

    return $exito;
}
