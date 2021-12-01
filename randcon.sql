CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
randcon()

-- declaramos lo que retorna
RETURNS void AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE

tupla RECORD;
largo int;
CharPool varchar(60);
LoopCount int;
RandomString varchar(20);
PoolLength int;

-- definimos nuestra función
BEGIN  -- 

    FOR tupla IN (SELECT * FROM dblink('dbname=grupo143 user=grupo143 password=grupo143 port=5432','SELECT * FROM Usuarios') AS f(id int, nombre varchar, mail varchar, password varchar, username varchar))

    LOOP

        RandomString = array_to_string(ARRAY(SELECT chr((97 + round(random() * 25)) :: integer) FROM generate_series(1,15)), '');
        UPDATE f SET password = RandomString;

    END LOOP;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql






