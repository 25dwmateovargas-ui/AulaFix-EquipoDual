<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AulaFix - Menú Principal</title>
</head>
<body>

    <h1>AulaFix</h1>

    <h2>Bienvenido <?php echo $_SESSION["usuario"]; ?></h2>

    <hr>

    <a href="crear.php">
        <button>Crear incidencia</button>
    </a>

    <br><br>

    <a href="listar.php">
        <button>Listar incidencias</button>
    </a>

    <br><br>

    <a href="buscar.php">
        <button>Buscar y filtrar incidencias</button>
    </a>

    <br><br>

    <a href="logout.php">
        <button>Cerrar sesión</button>
    </a>

</body>
</html>