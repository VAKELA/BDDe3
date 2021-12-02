CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
revisar_usuarios(new_nombre varchar, new_mail varchar, new_pass varchar, new_username varchar, OUT guardado boolean)
    LANGUAGE plpgsql AS $$
-- declaramos lo que retorna


-- declaramos las variables a utilizar si es que es necesario
DECLARE

tupla RECORD;
usuarios_143 RECORD;
insert_statement TEXT;
res TEXT;
esta BOOLEAN;


-- definimos nuestra función
-- SELECT id FROM usuarios ORDER BY id DESC LIMIT 1;
-- ESTAN EN USUARIOS2 HAY 3
BEGIN  -- 
    PERFORM dblink_connect('db2','dbname=grupo143 user=grupo143 password=grupo143');
    esta = false;
    FOR usuarios_143 IN (SELECT * FROM dblink('dbname=grupo143 user=grupo143 password=grupo143 port=5432', 'SELECT mail FROM usuarios') AS f(mail varchar))
    LOOP 
        IF usuarios_143.mail = new_mail THEN
            esta = true;
        END IF;
    END LOOP;
    IF NOT esta THEN
        SELECT * INTO tupla FROM dblink('dbname=grupo143 user=grupo143 password=grupo143 port=5432', 'SELECT id FROM usuarios ORDER BY id DESC LIMIT 1;') AS f(id int);
        insert_statement = 'INSERT INTO usuarios VALUES ('||tupla.id + 1||','''||new_nombre||''','''||new_mail||''','''||new_pass||''','''||new_username||''')';
        res := dblink_exec('db2', insert_statement, true);
        RAISE INFO '%', res;
    END IF;

guardado = NOT esta;

PERFORM dblink_disconnect('db2');



-- -- finalizamos la definición de la función y declaramos el lenguaje
END $$