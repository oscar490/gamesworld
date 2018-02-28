------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios
(
      id       BIGSERIAL    PRIMARY KEY
    , nombre   VARCHAR(255) NOT NULL UNIQUE
    , password VARCHAR(255) NOT NULL
    , email    VARCHAR(255) NOT NULL

);

INSERT INTO usuarios (nombre, password, email)
    VALUES ('oscar', crypt('oscar', gen_salt('bf', 13)), 'oscar@gmail.com'),
            ('pepe', crypt('pepe', gen_salt('bf', 13)), 'pepe@gmail.com'),
            ('manolo', crypt('manolo', gen_salt('bf', 13)), 'manolo@gmail.com');




DROP TABLE IF EXISTS plataformas CASCADE;

CREATE TABLE plataformas
(
      id           BIGSERIAL     PRIMARY KEY
    , denominacion VARCHAR(255)  NOT NULL
);

INSERT INTO plataformas (denominacion)
    VALUES ('Playstation 3'), ('Playstation 4'), ('Nintendo DS'), ('Wii'),
            ('PC'), ('Nintendo Switch'), ('PSP Vita'), ('XBOX ONE');




DROP TABLE IF EXISTS generos CASCADE;

CREATE TABLE generos
(
      id     BIGSERIAL    PRIMARY KEY
    , nombre VARCHAR(255) NOT NULL
);

INSERT INTO generos (nombre)
    VALUES ('Lucha'), ('Acción'), ('Aventuras'), ('Rol'), ('Anime'),
            ('Terror');


DROP TABLE IF EXISTS videojuegos CASCADE;

CREATE TABLE videojuegos
(
      id            BIGSERIAL     PRIMARY KEY
    , codigo        NUMERIC(4)    NOT NULL
    , titulo        VARCHAR(255)  NOT NULL
    , descripcion   VARCHAR(255)
    , plataforma_id BIGINT        NOT NULL REFERENCES plataformas (id) ON DELETE
                                  NO ACTION ON UPDATE CASCADE
    , genero_id     BIGINT        NOT NULL REFERENCES generos (id) ON DELETE
                                  NO ACTION ON UPDATE CASCADE
    , precio        NUMERIC (5,2) NOT NULL
    , unidades      NUMERIC(5)    NOT NULL
    , created_at    TIMESTAMP(0)  NOT NULL DEFAULT localtimestamp
);

INSERT INTO videojuegos (codigo, titulo, descripcion, plataforma_id, genero_id, precio, unidades)
    VALUES (1000, 'Dragon Ball Fighter Z', 'Lucha de personajes de DBZ.', 2, 1, 50.00, 10),
            (2000, 'Grand Theft Auto 5', 'Tres amigos haciendo misiones.', 1, 2, 25.00, 5),
            (3000, 'Far Cry 5', 'Acción, armas, persecuciones, etc.', 8, 3, 56.50, 7);


DROP TABLE IF EXISTS comentarios CASCADE;

CREATE TABLE comentarios
(
      id            BIGSERIAL    PRIMARY KEY
    , texto         VARCHAR(255) NOT NULL
    , videojuego_id BIGINT       NOT NULL REFERENCES videojuegos (id) ON DELETE
                                 NO ACTION ON UPDATE CASCADE
    , usuario_id    BIGINT       NOT NULL REFERENCES usuarios (id) ON DELETE
                                 NO ACTION ON UPDATE CASCADE
    , created_at    TIMESTAMP(0) NOT NULL DEFAULT localtimestamp
);

INSERT INTO comentarios (texto, videojuego_id, usuario_id)
    VALUES ('¡Me encanta, lo recomiendo!', 1, 1),
            ('¡Muy bueno!', 1, 2),
            ('!El mejor Far Cry del año!', 3, 1);


DROP TABLE IF EXISTS compras CASCADE;

CREATE TABLE compras
(
      id            BIGSERIAL    PRIMARY KEY
    , usuario_id    BIGINT       NOT NULL REFERENCES usuarios (id) ON DELETE
                                 NO ACTION ON UPDATE CASCADE
    , videojuego_id BIGINT       NOT NULL REFERENCES videojuegos (id) ON DELETE
                                 NO ACTION ON UPDATE CASCADE
    , created_at    TIMESTAMP(0) NOT NULL DEFAULT localtimestamp

);

/* INSERT INTO compras (usuario_id, videojuego_id, created_at)
    VALUES (1, 1, default), (3, 3, localtimestamp - '2 days'::interval); */
