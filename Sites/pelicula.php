<?php
require_once "./__init__.php";
?>


<?php include('./templates/header.php'); ?>

<?php
    if(isset($_GET["id_pelicula"]))
    {
        $id_pelicula = (int)$_GET["id_pelicula"];
    }

    $query = "SELECT titulo FROM peliculas WHERE id_pelicula = $id_pelicula;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $titulo = $result -> fetch();
?>

<section class="hero is-success is-halfheight banner">
  <div class="hero-body">
    <h1 class="title" ><?php echo $titulo[0]; ?></h1>
  </div>
</section>

<section class="section" >
  <?php if (isset($_SESSION['user_name'])){ 
    $id = $_SESSION['user_id'];
    $query = $db2 -> prepare("SELECT * FROM peliculas WHERE id_pelicula = $id_pelicula;");
    $query -> execute();
    $data = $query -> fetch(PDO::FETCH_ASSOC);

    $query2 = $db2 -> prepare("SELECT DISTINCT proveedores.nombre, peliculas_proveedores.precio 
    FROM proveedores, peliculas_proveedores 
    WHERE proveedores.id = peliculas_proveedores.id_proveedor 
    AND peliculas_proveedores.id_pelicula = $id_pelicula;");
    $query2 -> execute();
    $data2 = $query2 -> fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table class="center" align='center'>
      <tr>
        <th>Id</th>
        <th>Título</th>
        <th>Duración</th>
        <th>Calificación</th>
        <th>Puntuación</th>
        <th>Año</th>
        <th>Género</th>
      </tr>
      <?php
        echo "<tr><td style='margin: 10px; padding: 20px;'>$data[id_pelicula]</td>
        <td style='margin: 10px; padding: 20px;'>$data[titulo]</td>
        <td style='margin: 10px; padding: 20px;'>$data[duracion]</td>
        <td style='margin: 10px; padding: 20px;'>$data[clasificacion]</td>
        <td style='margin: 10px; padding: 20px;'>$data[puntuacion]</td>
        <td style='margin: 10px; padding: 20px;'>$data[ano]</td>
        <td style='margin: 10px; padding: 20px;'>$data[genero]</td></tr>";
      ?>
    </table>
    <br>
    <table class="center" align='center'>
        <tr>
          <th>Proveedor</th>
          <th>Precio</th>
        </tr>
        <?php
        foreach($data2 as $proveedor){
            echo "<tr><td style='margin: 10px; padding: 10px;'>$proveedor[nombre]</td>
          <td style='margin: 10px; padding: 10px;'>$proveedor[precio]</td></tr>";
        }
        ?>
    </table>

    <div class="dropdown my-menu">
    <form action="/comprar.php">
      <label for="proveedores">Elige un proveedor:</label>
      <select name="proveedor">
      <?php
      foreach($data2 as $proveedor){
          echo "<option value=$proveedor[nombre]>$proveedor[nombre]</option>}";
      }
        ?>
      </select>
      <br><br>
      <input type="submit" value="Arrendar">
    </form>
    </div>
<br>
<br>

    <div class="buttons">
      <a href="/~grupo122/index.php" class="button is-light">
        Volver
      </a>
    </div>
  <?php } ?>
</section>
</main>

<?php include('./templates/footer.php'); ?>
