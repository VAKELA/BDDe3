<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $genero = $_POST["genero"];

  $query = "SELECT DISTINCT Videojuegos.titulo, Generos.nombre FROM Videojuegos, genero_videojuego, Generos, genero_subgenero, Generos as Subgeneros WHERE Videojuegos.id = genero_videojuego.id_videojuegos AND Generos.nombre LIKE '%$genero%' AND ((genero_videojuego.id_generos = Generos.id) OR (genero_subgenero.id_subgeneros = Subgeneros.id AND genero_subgenero.id_generos = Generos.id AND genero_videojuego.id_generos = Subgeneros.id));";
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
