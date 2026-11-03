<?php

/**
 * Funciones reutilizables del servidor para la autenticación
 * de usuarios y la gestión de incidencias.
 */

/**
 * Comprueba si un texto cumple una longitud mínima.
 * Se eliminan los espacios al inicio y al final antes de validar.
 */
function cumpleLongitudMinima(string $valor, int $minimo): bool
{
    return mb_strlen(trim($valor)) >= $minimo;
}

/**
 * Verifica si existe un usuario con las credenciales indicadas.
 * Utiliza consultas preparadas para evitar inyecciones SQL.
 */
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

    // Comprueba si se ha encontrado al menos un usuario coincidente
    $autenticado = $stmt->get_result()->num_rows >= 1;

    $stmt->close();

    return $autenticado;
}

/**
 * Valida los datos introducidos al crear una incidencia.
 * Devuelve un array con los errores encontrados.
 */
function validarIncidencia(string $titulo, string $ubicacion, string $descripcion): array
{
    $errores = [];

    // El título debe contener al menos 3 caracteres
    if (!cumpleLongitudMinima($titulo, 3)) {
        $errores[] = 'el título debe tener al menos 3 caracteres';
    }

    // La ubicación debe contener al menos 2 caracteres
    if (!cumpleLongitudMinima($ubicacion, 2)) {
        $errores[] = 'la ubicación debe tener al menos 2 caracteres';
    }

    // La descripción debe contener información suficiente
    if (!cumpleLongitudMinima($descripcion, 10)) {
        $errores[] = 'la descripción debe tener al menos 10 caracteres';
    }

    return $errores;
}

/**
 * Inserta una nueva incidencia en la base de datos.
 * Todas las incidencias se crean inicialmente con estado "Abierta".
 */
function crearIncidencia(
    mysqli $conexion,
    string $titulo,
    string $ubicacion,
    string $descripcion
): bool
{
    $stmt = $conexion->prepare(
        'INSERT INTO incidencias (titulo, ubicacion, descripcion, estado)
         VALUES (?, ?, ?, "Abierta")'
    );

    $stmt->bind_param('sss', $titulo, $ubicacion, $descripcion);

    // Ejecuta la inserción y almacena si la operación tuvo éxito
    $exito = $stmt->execute();

    $stmt->close();

    return $exito;
}