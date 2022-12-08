DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios (
    id bigserial PRIMARY KEY,
    usuario varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL
);

DROP TABLE IF EXISTS noticias CASCADE;

CREATE TABLE noticias (
    id bigserial PRIMARY KEY,
    titular varchar(255) NOT NULL,
    cantidad numeric(9) NOT NULL DEFAULT 0,
    created_at timestamp  NOT NULL DEFAULT localtimestamp(0),
    noticias_usuarios bigserial NOT NULL REFERENCES usuarios (id)
);

DROP TABLE IF EXISTS favoritos CASCADE;

CREATE TABLE favoritos (
    id_usuarios bigserial NOT NULL REFERENCES usuarios (id),
    id_noticias bigserial NOT NULL REFERENCES noticias (id)
);

-- carga incial
INSERT INTO usuarios (usuario, PASSWORD)
    VALUES ('admin', crypt('admin', gen_salt('bf', 10))), 
    ('pepe', crypt('pepe', gen_salt('bf', 10))), 
    ('juan diego', crypt('juan diego', gen_salt('bf', 10)));

INSERT INTO noticias (titular, cantidad, created_at, noticias_usuarios)
    VALUES ('Its Britney, b*tch', DEFAULT, '2007-7-7 23:26:11', 2), 
    ('Rata inmunda, animal rastrero', DEFAULT,'2017-10-10 23:26:11', 3),
    ('in the end it doesnt even matter', DEFAULT,'2012-12-12 12:12:12', 1); 
