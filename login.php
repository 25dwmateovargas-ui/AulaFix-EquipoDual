<?php

session_start();

if (isset($_SESSION["usuario"])) {
    header("Location: incidencias.php");
    exit();
}

require_once("CONFIG/conexion.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $contraseña = $_POST["contraseña"];

    $sql = "SELECT *
            FROM usuarios
            WHERE nombre = ?
            AND contraseña = ?";

    $stmt = mysqli_prepare($conexion, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ss",
        $nombre,
        $contraseña
    );

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) === 1) {

        $_SESSION["usuario"] = $nombre;

        header("Location: incidencias.php");
        exit();

    } else {

        $error = "Usuario o contraseña incorrectos";

    }

    mysqli_stmt_close($stmt);
}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AulaFix - Iniciar sesión</title>

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">

    <link rel="stylesheet" href="frontend/css/style.css">
</head>

<body>

<div class="bg-glow"></div>

<div class="page">
    <div class="center-shell">

        <div class="card login-card">

            <div class="login-head">

                <div class="brand" style="margin-bottom:10px;">
                    <span class="brand-mark">

                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"
                                  stroke="#0b0c10"
                                  stroke-width="2"
                                  stroke-linejoin="round"/>

                            <path d="M2 17l10 5 10-5M2 12l10 5 10-5"
                                  stroke="#0b0c10"
                                  stroke-width="2"
                                  stroke-linejoin="round"
                                  stroke-linecap="round"/>
                        </svg>

                    </span>

                    AulaFix
                </div>

                <p>Gestión de incidencias del aula</p>

            </div>

            <?php if (!empty($error)): ?>
                <p style="color:#ff6b6b; text-align:center; margin-bottom:20px;">
                    <?php echo $error; ?>
                </p>
            <?php endif; ?>

            <form method="POST">

                <div class="field">
                    <label for="nombre">Usuario</label>

                    <input
                        id="nombre"
                        name="nombre"
                        type="text"
                        placeholder="Nombre de usuario"
                        required>
                </div>

                <div class="field">
                    <label for="contraseña">Contraseña</label>

                    <input
                        id="contraseña"
                        name="contraseña"
                        type="password"
                        placeholder="••••••••"
                        required>
                </div>

                <div class="row-between" style="margin-bottom:22px;">

                    <label class="checkbox-label">
                        <input type="checkbox" name="recordar">
                        Recordarme
                    </label>

                    <a href="#" class="link-accent">
                        ¿Olvidaste tu contraseña?
                    </a>

                </div>

                <button type="submit"
                        class="btn btn-primary"
                        style="width:100%;">

                    Iniciar sesión

                    <svg width="16"
                         height="16"
                         viewBox="0 0 24 24"
                         fill="none"
                         aria-hidden="true">

                        <path d="M5 12h14M13 6l6 6-6 6"
                              stroke="#0b0c10"
                              stroke-width="2.2"
                              stroke-linecap="round"
                              stroke-linejoin="round"/>

                    </svg>

                </button>

            </form>

            <p class="demo-hint">
                Cuenta de demostración · alumno / 1234
            </p>

        </div>

    </div>
</div>

<script src="frontend/js/script.js"></script>

</body>
</html>