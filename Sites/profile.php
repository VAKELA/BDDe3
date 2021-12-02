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
    ?>


    <h2 class="title is-1"> Nombre:<?php echo $data['nombre'] ?></h2>
    <h2 class="title is-1"> email:<?php echo $data['mail'] ?></h2>
    <h2 class="title is-1"> Usuario:<?php echo $data['username'] ?></h2>
    <a href="/~grupo122/change_pass.php" class="button is-light">
        cambiar contraseña
      </a>  
  
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
