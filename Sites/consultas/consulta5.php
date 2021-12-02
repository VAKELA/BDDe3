<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $username = $_POST["username"];

  require("../config/conexion.php");
  $query = "SELECT Videojuegos.titulo, Proveedores.nombre FROM Horas_juego, Usuarios, Proveedores, Videojuegos WHERE UPPER(Usuarios.username) LIKE UPPER('%$username%') AND Usuarios.id = Horas_juego.id_usuarios AND Videojuegos.id = Horas_juego.id_videojuegos AND Proveedores.id = Horas_juego.id_proveedores;";
	$result = $db -> prepare($query);
	$result -> execute();
	$data = $result -> fetchAll();

  ?>
<div align="center">
<table>
    <tr>
      <th>Juego</th>
      <th>Proveedor</th>
    </tr>
  <?php
	foreach ($data as $dato) {
  		echo "<tr> <td>$dato[0]</td> <td>$dato[1]</td></tr>";
	}
  ?>
	</table>
</div>
<?php include('../templates/footer.html'); ?>
