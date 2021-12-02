<?php
require_once './__init__.php';

// Vemos si se esta mandando el form o se está recibiendo
$request_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

if ($request_method  === 'POST') {
  // Se está recibiendo datos para el login

  // Aquí se tendría que buscar el id del usuario en la BDD con el mail y la contraseña
  $id = $_SESSION['user_id'];
  $new = $_POST["new"];
  $old = $_POST["old"];
  

  $query = $db -> prepare("SELECT * FROM cambiar_pass(:id, :old, :new);");
  //$query = "SELECT Usuarios.id , Usuarios.username FROM Usuarios WHERE Usuarios.mail = 'llowe@yahoo.com' AND Usuarios.password = 'tfqeushoywnfeec';";
  $query -> execute(array(':id' => $id, ':old' => $old, ':new' => $new));
  $data = $query -> fetch(PDO::FETCH_ASSOC);

  //print_r($data, gettype($id));

  //$user_id = $data[0];
  //$user_name = $data[1];

  // Se guardan estos valores en la sesión
  //$_SESSION['user_id'] = $user_id;
  //$_SESSION['user_name'] = $user_name;

  // Mandamos al usuario al inicio
  go_home();
} elseif ($request_method === 'GET') {
  // En este caso, que se trata de obtener la página de inicio de sesión
  // y no hay una sesión iniciada, se muestra el form

  include './templates/header.php'; ?>
  <!-- https://bulma.io/documentation/columns -->
  <?php if (isset($_SESSION['user_name'])) { ?>
  <section class="section">
    <div class="columns is-mobile is-centered is-vcentered cover-all">
      <div class="column is-half">
        <!-- https://bulma.io/documentation/form/general/ -->
        <form method="POST">
          <div class="field">
            <label class="label"> New Password</label>
            <div class="control">
              <input class="input" type="text" name="new" value="new">
            </div>
          </div>
          <label class="label"> Old Password</label>
            <div class="control">
              <input class="input" type="text" name="old" value="old">
            </div>
          </div>
          <button class="button is-primary" type="submit" name="login">update</button>
        </form>
      </div>
    </div>
  </section>
  <?php } ?>
<?php include './templates/footer.php';
} ?>
