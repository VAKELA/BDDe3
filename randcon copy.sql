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
RandomString varchar(60);
PoolLength int;

-- definimos nuestra función
BEGIN  -- https://stackoverflow.com/questions/1324063/generating-random-strings-with-t-sql

    FOR tupla IN (SELECT * FROM dblink('dbname=grupo143 user=grupo143 password=grupo143 port=5432','SELECT * FROM Usuarios') AS f(id int, nombre varchar, mail varchar, password varchar, username varchar))

    LOOP
        -- min_length = 8, max_length = 12
        largo = random() * 5 + 8;
        -- SET @Length = RAND() * (max_length - min_length + 1) + min_length

        -- define allowable character explicitly - easy to read this way an easy to 
        -- omit easily confused chars like l (ell) and 1 (one) or 0 (zero) and O (oh)
        CharPool = 'abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ23456789';
        PoolLength = length(CharPool);

        LoopCount = 0;
        RandomString = '';

        WHILE (LoopCount < largo) LOOP
            SELECT RandomString = RandomString + SUBSTRING(Charpool, CONVERT(int, random() * PoolLength) + 1, 1);
            SELECT LoopCount = LoopCount + 1;
        END LOOP;

        tupla.password = RandomString;
    END LOOP;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql






