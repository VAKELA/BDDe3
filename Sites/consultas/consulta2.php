<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $n = $_POST["n"];

  $query = "SELECT Videojuegos.titulo FROM Resenas, Videojuegos WHERE resenas.veredicto LIKE '%positivo%'  AND resenas.id_videojuegos = Videojuegos.id GROUP BY Videojuegos.titulo HAVING ($n <= COUNT(resenas.veredicto));";
	$result = $db -> prepare($query);
	$result -> execute();
	$data = $result -> fetchAll();

  ?>
<div align="center">
<table>
    <tr>
      <th>Juego</th>
    </tr>
  <?php
	foreach ($data as $dato) {
  		echo "<tr> <td>$dato[0]</td> </tr>";
	}
  ?>
	</table>
</div>
<?php include('../templates/footer.html'); ?>
