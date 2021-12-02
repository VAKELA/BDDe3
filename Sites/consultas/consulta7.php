<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
  $query = "SELECT Usuarios.username , (SUM(greatest(0, (DATE_PART('year', COALESCE(sus.fecha_termino, CURRENT_DATE) ) - DATE_PART('year',  sus.fecha_inicio) )* 12 +  (DATE_PART('month', COALESCE(sus.fecha_termino, CURRENT_DATE)) - DATE_PART('month',  sus.fecha_inicio)))*Videojuegos.mensualidad)) as gasto_total FROM sus, Videojuegos, Usuarios  WHERE sus.id_videojuegos = Videojuegos.id AND sus.id_usuarios = Usuarios.id GROUP BY Usuarios.username;";
	$result = $db -> prepare($query);
	$result -> execute();
	$data = $result -> fetchAll();

  ?>
<div align="center">
<table>
    <tr>
      <th>Usuario</th>
      <th>gasto total</th>
    </tr>
  <?php
	foreach ($data as $dato) {
  		echo "<tr> <td>$dato[0]</td> <td>$dato[1]</td></tr>";
	}
  ?>
	</table>
</div>
<?php include('../templates/footer.html'); ?>
