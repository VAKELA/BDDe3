CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
test()

-- declaramos lo que retorna, en este caso un booleano
RETURNS void AS $$

-- declaramos las variables a utilizar
DECLARE

tupla RECORD;

-- RECORD es un tipo (en realidad placeholder) que permite almacenar filas
-- más información sobre variables en https://www.postgresql.org/docs/9.1/plpgsql-declarations.html

-- definimos nuestra función
BEGIN

    FOR tupla IN (SELECT * FROM dblink('dbname=grupo143e3 user=grupo143 password=grupo143 port=143','SELECT * FROM usuarios') AS f(id int, nombre varchar, mail varchar, password varchar, username varchar))
    LOOP
    END LOOP;

-- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql
