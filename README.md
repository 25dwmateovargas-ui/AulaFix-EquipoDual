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

- Mateo Vargas: Desarrollo de backend en listar.php, crear.php, buscar.php y crear la base de datos inicial en MySql workbench, Importar el header y footer a todas las páginas y que los enlaces de abajo tengan las rutas bien hechas para evitar errores. 

- Aritz Pinilla: Desarrollo de backend tanto de login, como de logout e incidencias php. Desarrollo del script conexion.php para la conexion con la base de datos. Unir el frontend de crear e incidencias con el backend. Por ultimo, desarrollo de el README, en el que se explica todo lo relacionado con como funciona el proyecto.

