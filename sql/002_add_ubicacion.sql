-- Active: 1780469770190@@127.0.0.1@3306@aulafix
-- R02: añade el campo "ubicación" a las incidencias (pedido por el enunciado).
-- Ejecutar una sola vez contra la base de datos "aulafix" (phpMyAdmin o `mysql -u root -p aulafix < sql/002_add_ubicacion.sql`).

ALTER TABLE incidencias
    ADD COLUMN ubicacion VARCHAR(100) NOT NULL DEFAULT '' AFTER titulo;
