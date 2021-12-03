<?php
require_once "./__init__.php";
?>

<?php include('./templates/header.php'); ?>

<section class="hero is-success is-halfheight banner">
  <div class="hero-body">
    <h1 class="title">One time purchases</h1>
  </div>
</section>

<div class="hero-body">
  <h1 class="title" align='center'>Películas</h1>
</div>

<section class="section" >
  <?php if (isset($_SESSION['user_name'])){ 
    $id = $_SESSION['user_id'];
    $query = $db2 -> prepare("SELECT DISTINCT peliculas.titulo, peliculas.id_pelicula 
    FROM peliculas, suscripciones, usuarios, peliculas_proveedores, proveedores 
    WHERE usuarios.id = 17 AND peliculas_proveedores.id_proveedor = proveedores.id 
    AND peliculas_proveedores.id_pelicula = peliculas.id_pelicula;");
    $query -> execute();
    $data = $query -> fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table class="center" align='center'>
      <tr>
        <th>Título</th>
        <th>Detalles</th>
      </tr>
      <?php
      foreach($data as $pelicula){
        echo "<tr><td style='margin: 10px; padding: 10px;'>$pelicula[titulo]</td>
        <td style='margin: 10px; padding: 10px;'><a href='/~grupo122/pelicula.php?id_pelicula=$pelicula[id_pelicula]' class='button is-light'>
        Ver detalles</a></td></tr>";
      }
      ?>
    </table>
 
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
