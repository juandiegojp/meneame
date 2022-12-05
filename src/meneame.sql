DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios (
    id       bigserial    PRIMARY KEY,
    usuario  varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL
);

DROP TABLE IF EXISTS noticias CASCADE;

CREATE TABLE noticias (
    id       bigserial    PRIMARY KEY,
    titular  varchar(255) NOT NULL,
    cantidad  numeric(9) NOT NULL,
    noticias_usuarios bigserial NOT NULL REFERENCES usuarios (id)
);

-- carga incial

INSERT INTO usuarios (usuario, password)
    VALUES ('admin', crypt('admin', gen_salt('bf', 10))),
           ('pepe', crypt('pepe', gen_salt('bf', 10)));

INSERT INTO noticias (titular, cantidad, noticias_usuarios)
    VALUES ('Pepito aprueba php',0, 2),
           ('Pepito tiene depresión',10, 2);
