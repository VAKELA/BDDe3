CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
randcon(input_1 varchar)

-- declaramos lo que retorna
RETURNS void AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE

update_statement TEXT;
res TEXT;
tupla RECORD;
largo int;
CharPool varchar(60);
LoopCount int;
RandomString varchar(20);
PoolLength int;

-- definimos nuestra función
BEGIN  -- https://www.dbrnd.com/2016/04/postgresql-how-to-generate-a-random-token-string/

    PERFORM dblink_connect('db2','dbname=grupo143 user=grupo143 password=grupo143');    

    FOR tupla IN (SELECT * FROM dblink('dbname=grupo143 user=grupo143 password=grupo143 port=5432','SELECT id FROM usuarios ORDER BY id ASC;') AS f(id int))

    LOOP
        update_statement = 'UPDATE Usuarios SET password ='''||RandomString||''' WHERE Usuarios.id = '''||tupla.id||''';';
        RandomString = array_to_string(ARRAY(SELECT chr((97 + round(random() * 25)) :: integer) FROM generate_series(1,15)), '');
        res := dblink_exec('db2', update_statement, true);
        RAISE INFO '%', res;

    END LOOP;
    PERFORM dblink_disconnect('db2');

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql
