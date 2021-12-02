<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $username = $_POST["username"];

  require("../config/conexion.php");
  $query = "SELECT Proveedores.nombre FROM Usuarios, Proveedores, Preordenes WHERE UPPER(Usuarios.username) LIKE UPPER('%$username%') AND Preordenes.id_usuarios = Usuarios.id  AND Proveedores.id = Preordenes.id_proveedores GROUP BY Proveedores.nombre HAVING COUNT(Preordenes.id_videojuegos) > 1;";
	$result = $db -> prepare($query);
	$result -> execute();
	$data = $result -> fetchAll();

  ?>
<div align="center">
<table>
    <tr>
      <th>Proveedor</th>
    </tr>
  <?php
	foreach ($data as $dato) {
  		echo "<tr> <td>$dato[0]</td> </tr>";
	}
  ?>
	</table>
</div>
<?php include('../templates/footer.html'); ?>
