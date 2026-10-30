<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

require 'CONFIG/conexion.php';

$mensaje = '';
$color = '';

$tituloInvalido = false;
$descripcionInvalida = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = trim($_POST['titulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');

    $errores = [];

    if (mb_strlen($titulo) < 3) {
        $errores[] = 'el título debe tener al menos 3 caracteres';
        $tituloInvalido = true;
    }

    

    if (mb_strlen($descripcion) < 10) {
        $errores[] = 'la descripción debe tener al menos 10 caracteres';
        $descripcionInvalida = true;
    }

    if (empty($errores)) {

        $stmt = $conexion->prepare(
            'INSERT INTO incidencias (titulo, descripcion, estado)
             VALUES (?, ?, "Abierta")'
        );
        
        $stmt->bind_param('ss', $titulo, $descripcion);

        if ($stmt->execute()) {
            $mensaje = '¡Incidencia creada con éxito!';
            $color = '#22c55e';
        } else {
            $mensaje = 'Error al guardar en la base de datos.';
            $color = '#ef4444';
        }

        $stmt->close();

    } else {
        $mensaje = 'Revisa estos campos: ' . ucfirst(implode('; ', $errores)) . '.';
        $color = '#ef4444';
    }
}
?>

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AulaFix — Crear ticket</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
<link rel="stylesheet" href="frontend/css/style.css">

</head>

<body>

<div class="bg-glow"></div>

<div class="page">

    <header class="topbar">

        <div class="brand">
            <span class="brand-mark">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="#0b0c10" stroke-width="2" stroke-linejoin="round"/>
                    <path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke="#0b0c10" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"/>
                </svg>
            </span>
            AulaFix
        </div>

        <div class="topbar-right">
            <a href="incidencias.php" class="btn btn-ghost">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                    <path d="M19 12H5M11 18l-6-6 6-6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Volver atrás
            </a>
        </div>

    </header>

    <div class="center-shell">

        <div class="card" style="width:520px;padding:36px 40px;">

            <div class="login-head">

                <div style="display:flex;align-items:center;gap:10px;">

                    <span class="action-icon" style="width:38px;height:38px;">

                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                        </svg>

                    </span>

                    <h2 style="margin:0;font-size:20px;">
                        Nuevo ticket
                    </h2>

                </div>

                <p>Describe la incidencia con el mayor detalle posible.</p>

            </div>

            <?php if (!empty($mensaje)): ?>

                <div style="
                    margin-bottom:20px;
                    padding:12px;
                    border-radius:8px;
                    font-weight:600;
                    color:white;
                    background-color: <?= $color ?>;
                ">
                    <?= htmlspecialchars($mensaje) ?>
                </div>

            <?php endif; ?>

            <form method="POST" id="crear-form">

                <div class="field <?= $tituloInvalido ? 'has-error' : '' ?>">

                    <label for="titulo">Título</label>

                    <input
                        id="titulo"
                        name="titulo"
                        type="text"
                        placeholder="Ej. Proyector no enciende"
                        required
                        minlength="3"
                        value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>">

                    <div class="field-error">
                        El título debe tener al menos 3 caracteres.
                    </div>

                </div>


                <div class="field">

                    <label for="estado">Estado inicial</label>

                    <select id="estado" disabled>
                        <option selected>Nuevo</option>
                    </select>

                </div>

                <div class="field <?= $descripcionInvalida ? 'has-error' : '' ?>">

                    <label for="descripcion">Descripción</label>

                    <textarea
                        id="descripcion"
                        name="descripcion"
                        placeholder="Cuerpo de la incidencia..."
                        required
                        minlength="10"><?= htmlspecialchars($_POST['descripcion'] ?? '') ?></textarea>

                    <div class="field-error">
                        Describe la incidencia con al menos 10 caracteres.
                    </div>

                    <div id="contador-descripcion" style="margin-top:6px;font-size:12.5px;color:var(--text-dim);">
                        0 caracteres
                    </div>

                </div>

                <div style="display:flex;gap:10px;margin-top:10px;">

                    <a href="incidencias.php"
                       class="btn btn-secondary"
                       style="flex:1;">
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                        style="flex:1;">
                        Crear ticket
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="frontend/js/script.js"></script>

</body>
</html>