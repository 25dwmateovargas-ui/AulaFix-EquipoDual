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

   <?php include 'includes/header.php'; ?>

    <main class="content">

        <div class="hero">

            <h1>
                ¡Bienvenido, <?php echo htmlspecialchars($_SESSION["usuario"]); ?>! 👋
            </h1>

            <p>
                ¿Qué quieres hacer hoy?
            </p>

        </div>

        <div class="action-grid">

            <a class="action-card" href="crear.php">

                <span class="action-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                        <path d="M12 5v14M5 12h14"
                              stroke="currentColor"
                              stroke-width="2.2"
                              stroke-linecap="round"/>
                    </svg>
                </span>

                <h3>Crear ticket</h3>

                <p>
                    Registra una nueva incidencia indicando título,
                    ubicación y descripción.
                </p>

                <span class="action-arrow">
                    Empezar
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                        <path d="M5 12h14M13 6l6 6-6 6"
                              stroke="currentColor"
                              stroke-width="2.2"
                              stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </span>

            </a>

            <a class="action-card" href="listar.php">

                <span class="action-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                        <path d="M4 6h16M4 12h16M4 18h10"
                              stroke="currentColor"
                              stroke-width="2.2"
                              stroke-linecap="round"/>
                    </svg>
                </span>

                <h3>Listar tickets</h3>

                <p>
                    Consulta todas las incidencias,
                    filtra por estado y actualiza su situación.
                </p>

                <span class="action-arrow">
                    Ver listado
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                        <path d="M5 12h14M13 6l6 6-6 6"
                              stroke="currentColor"
                              stroke-width="2.2"
                              stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </span>

            </a>

            <a class="action-card" href="buscar.php">

                <span class="action-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                        <circle cx="11"
                                cy="11"
                                r="7"
                                stroke="currentColor"
                                stroke-width="2.2"/>

                        <path d="M21 21l-4.3-4.3"
                              stroke="currentColor"
                              stroke-width="2.2"
                              stroke-linecap="round"/>
                    </svg>
                </span>

                <h3>Buscar ticket</h3>

                <p>
                    Localiza una incidencia concreta a partir
                    de su número o su título.
                </p>

                <span class="action-arrow">
                    Buscar
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                        <path d="M5 12h14M13 6l6 6-6 6"
                              stroke="currentColor"
                              stroke-width="2.2"
                              stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </span>

            </a>

        </div>

        <div class="stats-row">

            <div class="stat-pill">
                <div class="n" style="color:var(--danger)">2</div>
                <div class="l">Abiertas</div>
            </div>

            <div class="stat-pill">
                <div class="n" style="color:var(--warning)">2</div>
                <div class="l">En progreso</div>
            </div>

            <div class="stat-pill">
                <div class="n" style="color:var(--success)">2</div>
                <div class="l">Cerradas</div>
            </div>

        </div>

    </main>
    <?php include 'includes/footer.php'; ?>
</div>

<script src="frontend/js/script.js"></script>

</body>
</html>