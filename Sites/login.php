<?php
require_once './__init__.php';

// Vemos si se esta mandando el form o se está recibiendo
$request_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

if ($request_method  === 'POST') {
  // Se está recibiendo datos para el login

  // Aquí se tendría que buscar el id del usuario en la BDD con el mail y la contraseña

  $mail = $_POST["mail"];
  $pass = $_POST["pass"];


  $query = "SELECT Usuarios.id , Usuarios.username FROM Usuarios WHERE Usuarios.mail =:mail AND Usuarios.password = :pass;";
  //$query = "SELECT Usuarios.id , Usuarios.username FROM Usuarios WHERE Usuarios.mail = 'llowe@yahoo.com' AND Usuarios.password = 'tfqeushoywnfeec';";
  $result = $db2 -> prepare($query);
  $result -> execute(array(':mail' => $mail, ':pass' => $pass));
  $data = $result -> fetchAll();

  $user_id = $data[0][0];
  $user_name = $data[0][1];

  // Se guardan estos valores en la sesión
  $_SESSION['user_id'] = $user_id;
  $_SESSION['user_name'] = $user_name;

  // Mandamos al usuario al inicio
  go_home();
} elseif ($request_method === 'GET') {
  // En este caso, que se trata de obtener la página de inicio de sesión
  // y no hay una sesión iniciada, se muestra el form

  include './templates/header.php'; ?>
  <!-- https://bulma.io/documentation/columns -->
  <section class="section">

    <div class="columns is-mobile is-centered is-vcentered cover-all">
      <div class="column is-half">
        <!-- https://bulma.io/documentation/form/general/ -->
        <form method="POST">
          <div class="field">
            <label class="label">Mail</label>
            <div class="control">
              <input class="input" type="text" name="mail" value="mail">
            </div>
          </div>
          <div class="field">
            <label class="label">Password</label>
            <div class="control">
              <input class="input" type="text" name="pass" value="pass">
            </div>
          </div>
          <button class="button is-primary" type="submit" name="login">Login</button>
        </form>
      </div>
    </div>
  </section>
<?php include './templates/footer.php';
} ?>
