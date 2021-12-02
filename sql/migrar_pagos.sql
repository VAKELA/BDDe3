CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
migrar_pagos()

-- declaramos lo que retorna
RETURNS void AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE

tupla RECORD;
insert_statement TEXT;
res TEXT;


-- definimos nuestra función
BEGIN  -- 
    PERFORM dblink_connect('db2','dbname=grupo143 user=grupo143 password=grupo143');
    FOR tupla IN (SELECT id, monto, fecha, id_usuarios FROM pagos) 
    LOOP
        insert_statement = 'INSERT INTO pagos VALUES ('||tupla.id||','||tupla.monto||','''||tupla.fecha||''','||tupla.id_usuarios||')';
        res := dblink_exec('db2', insert_statement, true);
        RAISE INFO '%', res;

    END LOOP;

PERFORM dblink_disconnect('db2');

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql