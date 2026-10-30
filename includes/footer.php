<!-- footer.php -->
    <footer style="background-color: #121214; color: #c4c4cc; padding: 40px 20px; font-family: system-ui, -apple-system, sans-serif; border-top: 1px solid #202024; margin-top: 60px;">
        <div style="max-width: 1100px; margin: 0 auto; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 30px;">
            
            <!-- Columna Izquierda: Identidad -->
            <div style="flex: 1; min-width: 250px;">
                <h3 style="color: #ffffff; margin: 0 0 10px 0; font-size: 18px; display: flex; align-items: center; gap: 8px;">
                    <span style="color: #ff5757;">●</span> AulaFix
                </h3>
                <p style="font-size: 14px; color: #8d8d99; margin: 0; line-height: 1.5;">
                    Gestión eficiente de incidencias para equipos y aulas de forma centralizada.
                </p>
            </div>

            <!-- Columna Centro: Accesos rápidos -->
            <div style="flex: 1; min-width: 180px;">
                <h4 style="color: #ffffff; margin: 0 0 15px 0; font-size: 15px; text-transform: uppercase; letter-spacing: 0.5px;">Plataforma</h4>
                <ul style="list-style: none; padding: 0; margin: 0; font-size: 14px; display: flex; flex-direction: column; gap: 10px;">
                    <li><a href="crear.php" style="color: #c4c4cc; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#ff5757'" onmouseout="this.style.color='#c4c4cc'">Crear nuevo ticket</a></li>
                    <li><a href="listar.php" style="color: #c4c4cc; text-decoration: none;" onmouseover="this.style.color='#ff5757'" onmouseout="this.style.color='#c4c4cc'">Historial de incidencias</a></li>
                    <li><a href="faq.php" style="color: #c4c4cc; text-decoration: none;" onmouseover="this.style.color='#ff5757'" onmouseout="this.style.color='#c4c4cc'">Preguntas frecuentes</a></li>
                </ul>
            </div>

            <!-- Columna Derecha: Soporte y Estado -->
            <div style="flex: 1; min-width: 180px;">
                <h4 style="color: #ffffff; margin: 0 0 15px 0; font-size: 15px; text-transform: uppercase; letter-spacing: 0.5px;">Soporte Técnico</h4>
                <ul style="list-style: none; padding: 0; margin: 0; font-size: 14px; display: flex; flex-direction: column; gap: 10px;">
                    <li style="display: flex; align-items: center; gap: 8px;">
                        <span style="color: #00b37e; font-size: 12px;">●</span> Estado: <strong style="color: #ffffff;">Operativo</strong>
                    </li>
                    <li><a href="documentacion.php" style="color: #c4c4cc; text-decoration: none;" onmouseover="this.style.color='#ff5757'" onmouseout="this.style.color='#c4c4cc'">Manual de usuario</a></li>
                </ul>
            </div>

        </div>

        <!-- Línea divisoria y Copyright inferior -->
        <div style="max-width: 1100px; margin: 30px auto 0 auto; padding-top: 20px; border-top: 1px solid #202024; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 15px; font-size: 13px; color: #7c7c8a;">
            <div>
                &copy; <?php echo date('Y'); ?> AulaFix. Todos los derechos reservados.
            </div>
            <div>
                Desarrollado para EquipoDual | <span style="color: #ff5757;">v1.0.0</span>
            </div>
        </div>
    </footer>
</body>
</html>
