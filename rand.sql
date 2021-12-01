CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
rand()

-- declaramos lo que retorna
RETURNS void AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE



-- definimos nuestra función
BEGIN  -- https://stackoverflow.com/questions/1324063/generating-random-strings-with-t-sql



SELECT * FROM dblink('dbname=grupo143 user=grupo143 password=grupo143 port=5432','SELECT * FROM Usuarios') AS f(id int, nombre varchar, mail varchar, password varchar, username varchar);

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql