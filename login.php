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
                    AulaFix
                </div>

                <p>Gestión de incidencias del aula</p>
            </div>

            <?php if (!empty($error)): ?>
                <p style="color:red;text-align:center;">
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

                <button
                    type="submit"
                    class="btn btn-primary"
                    style="width:100%;">

                    Iniciar sesión

                </button>

            </form>

        </div>

    </div>
</div>

<script src="frontend/js/script.js"></script>

</body>
</html>