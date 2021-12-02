<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
  $query = "SELECT Videojuegos.titulo, Proveedores.nombre FROM Videojuegos, Proveedores, juegos_proveedores WHERE Videojuegos.id = juegos_proveedores.id_videojuegos AND juegos_proveedores.id_proveedores = Proveedores.id;";
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
