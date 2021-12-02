<?php
require_once "./__init__.php";
?>

<?php include('./templates/header.php'); ?>

<section class="hero is-success is-halfheight banner">
  <div class="hero-body">
    <h1 class="title">Bienvenido a tu perfil</h1>
  </div>
</section>

<section class="section">
  <?php if (isset($_SESSION['user_name'])){ 
    $id = $_SESSION['user_id'];
    $query = $db2 -> prepare("SELECT * FROM Usuarios WHERE Usuarios.id = :id;");
    $query -> execute(array(':id' => $id));
    $data = $query -> fetch(PDO::FETCH_ASSOC);
    $id = 12;
    $querySUM1 = $db2 -> prepare("SELECT SUM(peliculas.duracion) FROM Usuarios, Visualizaciones_peliculas, peliculas WHERE usuarios.id = Visualizaciones_peliculas.id_usuario AND Visualizaciones_peliculas.id_pelicula = peliculas.id_pelicula AND Usuarios.id = :id;");
    $querySUM2 = $db2 -> prepare("SELECT SUM(capitulos.duracion) FROM Usuarios, Visualizaciones_capitulos, capitulos WHERE usuarios.id = Visualizaciones_capitulos.id_usuario AND Visualizaciones_capitulos.id_capitulo = capitulos.id_capitulo AND Usuarios.id = :id;");
    $querySUM3 = $db -> prepare("SELECT SUM(horas_juego.horas) FROM Usuarios, horas_juego WHERE Usuarios.id = horas_juego.id_usuarios AND Usuarios.id = :id;");
    $querySUM1 -> execute(array(':id' => $id));
    $dataSUM1 = $querySUM1 -> fetch(PDO::FETCH_ASSOC);
    $querySUM2 -> execute(array(':id' => $id));
    $dataSUM2 = $querySUM2 -> fetch(PDO::FETCH_ASSOC);
    $querySUM3 -> execute(array(':id' => $id));
    $dataSUM3 = $querySUM3 -> fetch(PDO::FETCH_ASSOC);
    $SUM = $dataSUM1['sum'] + $dataSUM2['sum'] + $dataSUM3['sum'];

    $querySus1 = $db -> prepare("SELECT Videojuegos.titulo FROM Sus, Usuarios, Videojuegos WHERE Usuarios.id = Sus.id_usuarios AND Sus.id_videojuegos = Videojuegos.id AND Sus.sus = 'active' AND Usuarios.id = :id;");
    $querySus1 -> execute(array(':id' => $id));
    $querySus2 = $db2 -> prepare("SELECT Proveedores.nombre FROM Proveedores, Usuarios, Suscripciones WHERE Usuarios.id = Suscripciones.id_usuario AND Proveedores.id = Suscripciones.id_proveedor AND Suscripciones.estado = 'activa' AND Usuarios.id = :id;");
    $querySus2 -> execute(array(':id' => $id));
    //table_from_query($querySus1);
    //table_from_query($querySus2);
    ?>


    <h2 class="title is-1"> Nombre: <?php echo $data['nombre'] ?></h2>
    <h2 class="title is-1"> email: <?php echo $data['mail'] ?></h2>
    <h2 class="title is-1"> Usuario: <?php echo $data['username'] ?></h2>
    <h2 class="title is-1"> Horas totales: <?php echo $SUM  ?></h2>
    <a href="/~grupo122/change_pass.php" class="button is-light">
        cambiar contraseña
    </a>  
    <h2 class="title is-1"> Suscripciones activas</h2>

    <div class="table-container">
    <table class="table">
      <thead>
        <tr>
            <th><?php echo htmlentities('suscripcion') ?></th>
        </tr>
      </thead>
      <tbody>
        <!-- Mostrar una celda por cada valor de cada resultado -->
        <!-- hmtlentities se utiliza para evitar XXS, vulnerabilidad que no se pasa en este ramo -->
        <!-- https://es.wikipedia.org/wiki/Cross-site_scripting => insertar código HTML peligroso en sitios que lo permitan -->
        <?php while ($row = $querySus1->fetch(PDO::FETCH_ASSOC)) { ?>
          <tr>
            <?php foreach ($row as $value) { ?>
              <th><?php echo htmlentities($value) ?></th>
            <?php } ?>
          </tr>
        <?php } ?>
        <?php while ($row = $querySus2->fetch(PDO::FETCH_ASSOC)) { ?>
          <tr>
            <?php foreach ($row as $value) { ?>
              <th><?php echo htmlentities($value) ?></th>
            <?php } ?>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  
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
