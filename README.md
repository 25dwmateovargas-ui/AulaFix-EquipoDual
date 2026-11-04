# AulaFix

Aplicación web desarrollada para la gestión de incidencias en aulas e instalaciones del centro educativo.

## Descripción

AulaFix permite registrar, consultar y gestionar incidencias de forma sencilla mediante una interfaz web conectada a una base de datos MySQL.

Los usuarios pueden crear incidencias, consultar el listado, filtrar la información y actualizar el estado de cada incidencia.

## Tecnologías utilizadas

- HTML5
- CSS3
- JavaScript
- PHP
- MySQL
- Git y GitHub

## Funcionalidades

- Inicio y cierre de sesión.
- Creación de incidencias.
- Listado de incidencias.
- Búsqueda o filtrado por estado.
- Cambio de estado de incidencias.
- Eliminación de incidencias.
- Validación tanto en cliente (JavaScript) como en servidor (PHP).

## Estados de incidencias

- Abierta
- En proceso
- Resuelta

## Instalación

> **Importante:** si ya tenías el proyecto clonado de antes, al hacer `git pull` `CONFIG/conexion.php` dejará de estar en el repositorio (ahora está en `.gitignore`). Tu copia local no se borra sola, pero si clonas el proyecto desde cero no vendrá incluida: sigue el paso 5 para crearla a partir de `conexion.example.php`, si no la aplicación no podrá conectar con la base de datos.

1. Clonar el repositorio:

bash
git clone https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual

2. Copiar el proyecto dentro de la carpeta htdocs de XAMPP.

3. Iniciar Apache desde XAMPP.

4. Crear la base de datos ejecutando el script SQL incluido en el proyecto.

5. Copiar `CONFIG/conexion.example.php` como `CONFIG/conexion.php` y ajustar ahí tus credenciales locales de MySQL (este archivo no se sube al repositorio, está en `.gitignore`):

CONFIG/conexion.php

6. Acceder desde el navegador: http://localhost/AulaFix-EquipoDual

## Base de datos

AulaFix utiliza una base de datos MySQL denominada `aulafix`, creada para gestionar los usuarios de la aplicación y las incidencias registradas.

La base de datos está compuesta por dos tablas principales:

### Usuarios

La tabla `usuarios` almacena la información necesaria para la autenticación de los usuarios. Cada usuario dispone de un identificador único, un nombre de usuario y una contraseña almacenada de forma segura.

### Incidencias

La tabla `incidencias` contiene toda la información relacionada con las incidencias registradas en el sistema. Para cada incidencia se almacena un identificador único, un título descriptivo, la ubicación donde se ha detectado el problema, una descripción detallada, el estado actual de la incidencia y la fecha de creación.

Por defecto, una incidencia nueva se registra con el estado **"Abierta"**, permitiendo posteriormente su gestión y actualización a través de la aplicación.

La conexión entre la aplicación y la base de datos se realiza mediante PHP y MySQL, permitiendo almacenar, consultar, modificar y eliminar información de manera persistente.

## Cuenta de demostracion

Para poder utilizar la aplicacion y navegar libremente por ella para probar las distintas funcionalidades que han sido desarrolladas, hemos creado un usuario de prueba que puede ser utilizado por cualquier persona. Se debe de importar el script sql de datos_ficticios.sql que se encuentra dentro de la carpeta sql\ para que este login funcione:

usuario: alumno   contraseña: 1234

## Integrantes y reparto de tareas

- Ivan Dobarrio: Desarrollo inicial en Figma de los prototipos de las diferentes partes de la aplicación; desarrollo del frontend; integración de htmls previos en archivos .php, implementación en rama de cambios para implementar lo visto en clase 
en el proyecto.
  - Commits/PRs: [historial completo de commits](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commits/main?author=ivandobarriocordon)
    - Rama `backend` (estructura inicial del proyecto):
      [Creación de carpetas del proyecto y archivos iniciales](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/274920e),
      [Creación de carpeta includes y archivos header y footer de PHP](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/11c23dc)
    - Rama `frontend` (diseño de las pantallas):
      [Diseño de frontend (login, lobby, listar, crear, buscar)](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/b8c8e99),
      [Juntar .htmls con archivos .php con la lógica del backend](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/531c5af)
    - Integración de `frontend` y `backend` en `main`/`new_develop` (resolución de conflictos):
      [Resolver conflicto login.html](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/63ffb52),
      [Resolver conflictos en login.php e incidencias.php](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/bac5863),
      [Resolver conflictos de merge](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/566eb48)
    - Requisitos R01-R07 en `main`/`new_develop` (acceso, campos, búsqueda, interfaz, cookie, validación):
      [R01: proteger crear.php, listar.php y buscar.php con sesión](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/4d6e04a),
      [R02: añadir campo ubicación a las incidencias](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/648df96),
      [R03: búsqueda y filtro reales en el listado](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/ccb1fb1),
      [R04: mejora de interfaz con JavaScript](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/d53cd0d),
      [R06: preferencia de densidad del listado en cookie](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/c83cab0),
      [R07: validación coherente en JS y PHP](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/0564dc8),
      [Arreglos de integraciones](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/9866b33),
      [Corrección listar.php](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/52c3b06)
    - Rama `cambios` (adaptación a la teoría vista en clase: POO, MySQLi, cookies, sesiones y eventos JS — *desarrollados con apoyo de IA*):
      [Unificar conexión MySQLi a estilo OOP y cookie "recordar usuario"](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/7ec8861),
      [Reescribir script.js con clases ES6 y validación nativa](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/54db509),
      [Calcular los contadores del lobby desde la base de datos](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/db5011d),
      [Añadir campo ubicación y scripts SQL de instalación](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/76c1052),
      [Extraer funciones PHP reutilizables](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/5ff2aa7),
      [FiltroTickets trabaja sobre un array de objetos](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/cc1e281),
      [README actualizado](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/d335434)
    - Directamente en `main`, tras fusionar `cambios` (también con apoyo de IA):
      [Añadir .gitignore y corregir estado inconsistente en el README](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/b1be391),
      [Avisar sobre conexion.php tras excluirlo del repositorio](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/255c78d),
      [Preparar plantillas de evidencias en el README](https://github.com/25dwmateovargas-ui/AulaFix-EquipoDual/commit/683f625)

- Mateo Vargas: Desarrollo de backend en listar.php, crear.php, buscar.php y crear la base de datos inicial en MySql workbench, Importar el header y footer a todas las páginas y que los enlaces de abajo tengan las rutas bien hechas para evitar errores. 
  - Commits/PRs: _(pegar aquí los enlaces de GitHub a tus commits o PRs principales)_

- Aritz Pinilla: Desarrollo de backend tanto de login, como de logout e incidencias php. Desarrollo del script conexion.php para la conexion con la base de datos. Unir el frontend de crear e incidencias con el backend. Por ultimo, desarrollo de el README, en el que se explica todo lo relacionado con como funciona el proyecto.
  - Commits/PRs: _(pegar aquí los enlaces de GitHub a tus commits o PRs principales)_

> Para cada persona, añade el enlace a sus commits (pestaña **Commits** del repo, filtrando por autor) o a las Pull Requests que abrió/revisó. Sirve como evidencia de aportación y de revisión del trabajo de otros compañeros.

## Evidencias de pruebas

Recorrido y casos probados antes de la entrega. Marcar el resultado real tras probarlo en vuestro XAMPP.

| Prueba | Qué se esperaba | Qué ocurrió |
|---|---|---|
| Acceder a `listar.php` / `crear.php` / `buscar.php` sin haber iniciado sesión | Redirige a `login.php` | ✅ Correcto: redirige a `login.php` |
| Login con usuario o contraseña incorrectos | Muestra "Usuario o contraseña incorrectos" y no entra | ✅ Correcto |
| Login correcto con "Recordarme" marcado, cerrar sesión y volver a `login.php` | El campo usuario aparece relleno y la casilla marcada | ✅ Correcto |
| Crear ticket con título de menos de 3 caracteres (con JavaScript activo) | El navegador bloquea el envío y muestra el aviso de validación | ✅ Correcto: aparece el globo nativo "Este campo necesita al menos 3 caracteres." |
| Crear ticket inválido saltándose la validación JS (petición `fetch` directa a `crear.php`) | PHP debe rechazarlo igualmente y mostrar el mensaje de error | ✅ Correcto: devuelve "Revisa estos campos: el título debe tener al menos 3 caracteres; la ubicación debe tener al menos 2 caracteres; la descripción debe tener al menos 10 caracteres." |
| Crear ticket válido (título, ubicación y descripción correctos) | Se guarda en MySQL y aparece en `listar.php` | ✅ Correcto: apareció como ticket nuevo en el listado (se eliminó después, era de prueba) |
| Buscar un texto que no coincide con ninguna incidencia | Mensaje "No hay incidencias que coincidan con la búsqueda" | ✅ Correcto |
| Cambiar el estado de una incidencia y recargar la página | El nuevo estado se mantiene (persistencia en MySQL) | ✅ Correcto: comprobado también directamente en la tabla de phpMyAdmin |
| Eliminar una incidencia | Pide confirmación antes de borrar y desaparece del listado | ✅ Correcto: sin aceptar el diálogo de confirmación, el ticket no se borra |
| Cambiar la densidad del listado (cookie) y recargar o volver más tarde | La preferencia se mantiene entre visitas | ✅ Correcto: se mantuvo "Compacta" al navegar a otra página y volver sin el parámetro en la URL |
| Instalar el proyecto desde cero siguiendo este README | Queda funcionando sin pasos adicionales | ✅ Correcto: depende de la contraseña que tenga configurada el root de MySQL/MariaDB en cada equipo; ajustad `$contrasena` en `CONFIG/conexion.php` según vuestra instalación local |

