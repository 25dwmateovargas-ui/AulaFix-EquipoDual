 <header class="topbar">

        <div class="brand">

            <span class="brand-mark">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
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