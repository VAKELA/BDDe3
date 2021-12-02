CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
cambiar_pass(id int, pass varchar, new_pass varchar)

-- declaramos lo que retorna
RETURNS BOOLEAN AS $guardado$

-- declaramos las variables a utilizar si es que es necesario
DECLARE

tupla RECORD;
usuarios_143 RECORD;
update_statement TEXT;
res TEXT;
esta BOOLEAN;


-- definimos nuestra función
-- SELECT id FROM usuarios ORDER BY id DESC LIMIT 1;
-- ESTAN EN USUARIOS2 HAY 3
BEGIN  -- 
    PERFORM dblink_connect('db2','dbname=grupo143 user=grupo143 password=grupo143');
    esta = false;
    SELECT * INTO usuarios_143 FROM dblink('dbname=grupo143 user=grupo143 password=grupo143 port=5432', 'SELECT password FROM usuarios2 WHERE id = '||id||'') AS f(pass_usuario varchar);
    IF usuarios_143.pass_usuario = pass THEN
        esta = true;
        update_statement = 'UPDATE usuarios2 SET password ='''||new_pass||''' WHERE id = '''||id||''';';
        res := dblink_exec('db2', update_statement, true);
        RAISE INFO '%', res;
    END IF;

PERFORM dblink_disconnect('db2');

RETURN esta;


-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$guardado$ language plpgsql