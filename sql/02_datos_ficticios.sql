-- AulaFix · Datos ficticios de prueba
-- Ejecutar despues de 01_esquema.sql

USE aulafix;

-- Cuenta de demostracion usada en login.php (alumno / 1234)
INSERT INTO usuarios (nombre, contraseña) VALUES
    ('alumno', '1234');

INSERT INTO incidencias (titulo, ubicacion, descripcion, estado) VALUES
    ('Proyector no enciende', 'Aula 101', 'El proyector del aula no responde al mando ni al boton frontal.', 'Abierta'),
    ('Silla rota', 'Biblioteca', 'Una silla de la zona de lectura tiene una pata partida.', 'Abierta'),
    ('Ordenador muy lento', 'Aula 204', 'El equipo tarda varios minutos en arrancar y se queda colgado.', 'En proceso'),
    ('Enchufe sin corriente', 'Taller de electronica', 'El enchufe junto a la ventana no da corriente a los soldadores.', 'En proceso'),
    ('Grifo goteando', 'Baños planta baja', 'El grifo del lavabo central gotea de forma continua.', 'Resuelta'),
    ('Puerta no cierra bien', 'Sala de profesores', 'La puerta no encaja y se queda entreabierta.', 'Resuelta');
