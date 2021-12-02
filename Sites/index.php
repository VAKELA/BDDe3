<?php
require_once "./__init__.php";
?>

<?php include('./templates/header.php'); ?>

<section class="hero is-success is-halfheight banner">
  <div class="hero-body">
    <h1 class="title">Series y videojuegos</h1>
  </div>
</section>

<section class="section">
  <?php if (isset($_SESSION['user_name'])) { ?>
    <!-- Se muestra un mensaje si hay una sesión de usuario -->
    <h2 class="title is-1"> Hola <?php echo $_SESSION['user_name'] ?></h2>
    <a href="/~grupo122/profile.php" class="button is-light">
        Ver perfil
      </a>
    <form class="buttons" action="/~grupo122/logout.php">
      <input class="button" type="submit" value="Cerrar Sesión">
    </form>
  <?php } else { ?>
    <!-- En el caso que no, se muestran los botones para iniciar sesión -->
    <div class="buttons">
      <a href="/~grupo122/register.php" class="button is-light">
        Registrarse
      </a>
      <a href="/~grupo122/login.php" class="button is-light">
        Iniciar sesión
      </a>
    </div>
  <?php } ?>
</section>
</main>

<?php include('./templates/footer.php'); ?>
