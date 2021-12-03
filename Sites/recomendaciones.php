<?php
require_once "./__init__.php";
?>

<?php include('./templates/header.php'); ?>

<section class="section">
  <?php if (isset($_SESSION['user_name'])){ 
          $id = $_SESSION['user_id'];
          $query_genero = $db2 -> prepare("SELECT peliculas.genero FROM Usuarios, visualizaciones_peliculas, peliculas WHERE Usuarios.id = :id AND Usuarios.id = visualizaciones_peliculas.id_usuario AND visualizaciones_peliculas.id_pelicula = peliculas.id_pelicula GROUP BY Peliculas.genero LIMIT 1;");
          $query_genero -> execute(array(':id' => $id));
          $data_genero = $query_genero -> fetch(PDO::FETCH_ASSOC);
          $genero= $data_genero['genero'];
          $query_Pelicula = $db2 -> prepare("SELECT DISTINCT Peliculas.id_pelicula, Peliculas.titulo, Peliculas.duracion, Peliculas.clasificacion,Peliculas.puntuacion, Peliculas.ano, Peliculas.genero FROM Usuarios, visualizaciones_peliculas, peliculas WHERE Usuarios.id = visualizaciones_peliculas.id_usuario AND visualizaciones_peliculas.id_pelicula <> peliculas.id_pelicula AND Usuarios.id = :id AND Peliculas.genero = :genero ORDER BY Peliculas.puntuacion DESC LIMIT 1;");
          $query_Pelicula -> execute(array(':id' => $id, ':genero' => $genero));
          $data = $query_Pelicula -> fetch(PDO::FETCH_ASSOC);
    ?>
    
    <h2 class="title is-1"> Como tu género favorito es: <?php echo $data['genero'] ?></h2>
    <h2 class="title is-1"> Puede que te guste la siguiente película:</h2>
    <h2 class="title is-1"> Título: <?php echo $data['titulo'] ?></h2>
    <h2 class="title is-1"> Duración: <?php echo $data['duracion'] ?></h2>
    <h2 class="title is-1"> Clasificación: <?php echo $data['clasificacion'] ?></h2>
    <h2 class="title is-1"> Puntuación: <?php echo $data['puntuacion'] ?></h2>
    <h2 class="title is-1"> Año de salida: <?php echo $data['ano'] ?></h2>
    <h2 class="title is-1"> género: <?php echo $data['genero'] ?></h2>
  
    <?php } else { ?>
    No deberías estar aquí
    <div class="buttons">
      <a href="/~grupo122/index.php" class="button is-light">
        Volver
      </a>
    </div>
  <?php } ?>
</section>
</main>

<?php include('./templates/footer.php'); ?>
