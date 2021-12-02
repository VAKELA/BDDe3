CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
add_users()

-- declaramos lo que retorna
RETURNS void AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE

tupla RECORD;
usuarios_143 RECORD;
id int;
horas varchar(60);
RandomString varchar(20);
pass varchar(50);
insert_statement TEXT;
res TEXT;
esta BOOLEAN;


-- definimos nuestra función
BEGIN  -- 
    PERFORM dblink_connect('db2','dbname=grupo143 user=grupo143 password=grupo143');
    id = 147;
    FOR tupla IN (SELECT usuarios.nombre, SUM(horas_juego.horas) AS horas_jugadas, usuarios.id, usuarios.mail, usuarios.username FROM usuarios, horas_juego WHERE usuarios.id = horas_juego.id_usuarios GROUP BY usuarios.id) 
    LOOP
        esta = false;
        FOR usuarios_143 IN (SELECT * FROM dblink('dbname=grupo143 user=grupo143 password=grupo143 port=5432', 'SELECT username FROM usuarios2') AS f(username varchar))
        LOOP 
            IF usuarios_143.username = tupla.username THEN
                esta = true;
            END IF;
        END LOOP;
        IF NOT esta THEN
            horas = substring((tupla.horas_jugadas::numeric)::varchar, 1, 3);
            RandomString = array_to_string(ARRAY(SELECT chr((97 + round(random() * 25)) :: integer) FROM generate_series(1,5)), '');
            pass = horas || RandomString || split_part(tupla.nombre, ' ', 1);
            insert_statement = 'INSERT INTO usuarios VALUES ('||id||','''||tupla.nombre||''','''||tupla.mail||''','''||pass||''','''||tupla.username||''')';
            res := dblink_exec('db2', insert_statement, true);
            RAISE INFO '%', res;
            id = id + 1;
        END IF;

        
    

    END LOOP;

PERFORM dblink_disconnect('db2');

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql
