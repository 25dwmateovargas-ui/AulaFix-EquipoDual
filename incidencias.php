<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AulaFix - Lobby</title>

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">

    <link rel="stylesheet" href="frontend/css/style.css">
</head>

<body>

<div class="bg-glow"></div>

<div class="page">

    <header class="topbar">

        <div class="brand">
            AulaFix
        </div>

        <div class="topbar-right">

            <div class="user-pill">

                <span class="user-avatar">
                    <?php echo strtoupper(substr($_SESSION["usuario"], 0, 1)); ?>
                </span>

                <?php echo htmlspecialchars($_SESSION["usuario"]); ?>

            </div>

            <a href="logout.php" class="btn btn-ghost">
                Cerrar sesión
            </a>

        </div>

    </header>

    <main class="content">

        <div class="hero">

            <h1>
                ¡Bienvenido,
                <?php echo htmlspecialchars($_SESSION["usuario"]); ?>! 👋
            </h1>

            <p>
                ¿Qué quieres hacer hoy?
            </p>

        </div>

        <div class="action-grid">

            <a class="action-card" href="crear.php">
                <h3>Crear ticket</h3>

                <p>
                    Registra una nueva incidencia indicando título,
                    ubicación y descripción.
                </p>
            </a>

            <a class="action-card" href="listar.php">
                <h3>Listar tickets</h3>

                <p>
                    Consulta todas las incidencias,
                    filtra por estado y actualiza su situación.
                </p>
            </a>

            <a class="action-card" href="buscar.php">
                <h3>Buscar ticket</h3>

                <p>
                    Localiza una incidencia concreta
                    a partir de su número o título.
                </p>
            </a>

        </div>

        <div class="stats-row">

            <div class="stat-pill">
                <div class="n">2</div>
                <div class="l">Abiertas</div>
            </div>

            <div class="stat-pill">
                <div class="n">2</div>
                <div class="l">En progreso</div>
            </div>

            <div class="stat-pill">
                <div class="n">2</div>
                <div class="l">Cerradas</div>
            </div>

        </div>

    </main>

</div>

<script src="frontend/js/script.js"></script>

</body>
</html>