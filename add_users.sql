CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
add_users()

-- declaramos lo que retorna
RETURNS void AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE

tupla RECORD;
id int;
horas varchar(60);
RandomString varchar(20);
pass varchar(50);


-- definimos nuestra función
BEGIN  -- 
    id = 147;
    FOR tupla IN (SELECT usuarios.nombre, SUM(horas_juego.horas) AS horas_jugadas, usuarios.id FROM usuarios, horas_juego WHERE usuarios.id = horas_juego.id_usuarios GROUP BY usuarios.id) 
    LOOP
        horas = substring((tupla.horas_jugadas::numeric)::varchar, 1, 3);
        RandomString = array_to_string(ARRAY(SELECT chr((97 + round(random() * 25)) :: integer) FROM generate_series(1,5)), '');
        pass = horas || RandomString || split_part(tupla.nombre, ' ', 1);
        UPDATE usuarios SET contrasena = substring(pass, 1, 20) WHERE usuarios.id = tupla.id;


    END LOOP;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql
