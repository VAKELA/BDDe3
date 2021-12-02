<?php

// Este proyecto de PHP utiliza 1 sola base de datos
// Para tener 2 a la vez puedes guiarte con la wiki:
// https://github.com/IIC2413/Syllabus-2021-2/wiki/Conexi%C3%B3n-a-m%C3%BAltiples-bases-de-datos-de-PSQL-a-trav%C3%A9s-de-PHP

  try {
    $user = 'grupo122';
    $password = 'DNR';
    $databaseName = 'grupo122e3';
    $db = new PDO("pgsql:dbname=$databaseName;host=localhost;port=5432;user=$user;password=$password");
    $user2 = 'grupo143';
    $password2 = 'grupo143';
    $databaseName2 = 'grupo143';
    $db2 = new PDO("pgsql:dbname=$databaseName2;host=localhost;port=5432;user=$user2;password=$password2");
  } catch (Exception $e) {
    echo "No se pudo conectar a la base de datos: $e";
  }
?>