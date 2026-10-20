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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AulaFix - Iniciar sesión</title>
    <link rel="stylesheet" href="CSS/login.css">
</head>
<body>

<div class="login-container">

    <h1>AulaFix</h1>

    <p class="subtitulo">
        Gestión de incidencias de aulas
    </p>

    <?php if (!empty($error)): ?>
        <p style="color: red; text-align: center;">
            <?php echo $error; ?>
        </p>
    <?php endif; ?>

    <form action="" method="POST">

        <input
            type="text"
            name="nombre"
            placeholder="Nombre de usuario"
            required
        >

        <input
            type="password"
            name="contraseña"
            placeholder="Contraseña"
            required
        >

        <button type="submit">
            Iniciar sesión
        </button>

    </form>

</div>

</body>
</html>