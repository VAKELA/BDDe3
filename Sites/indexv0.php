<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Entrega 2 </h1>
  <p style="text-align:center;">Vicente Akel - José Tomas Rebolledo</p>

  <br>

  <h3 align="center"> Primera consulta</h3>

  <form align="center" action="consultas/consulta1.php" method="post">
    <input type="submit" value="Buscar">
  </form>

  <h3 align="center"> Segunda consulta</h3>

  <form align="center" action="consultas/consulta2.php" method="post">
    <br/> 
    n:
    <input type="string" name="n">
    <br/>
    <br/> 
    <input type="submit" value="Buscar">
  </form>

  <h3 align="center"> Tercera consulta</h3>

  <form align="center" action="consultas/consulta3.php" method="post">
    <br/> 
    Titulo:
    <input type="string" name="titulo">
    <br/>
    <br/> 
    <input type="submit" value="Buscar">
  </form>

  <h3 align="center"> Cuarta consulta</h3>
  
  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT nombre FROM Generos;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta4.php" method="post">
    Seleccinar un genero:
    <select name="genero">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar">
  </form>

  <h3 align="center"> Quinta consulta</h3>

  <form align="center" action="consultas/consulta5.php" method="post">
    <br/> 
    Username:
    <input type="string" name="username">
    <br/>
    <br/> 
    <input type="submit" value="Buscar">
  </form>

  <h3 align="center"> Sexta consulta</h3>

  <form align="center" action="consultas/consulta6.php" method="post">
    <br/> 
    Username:
    <input type="string" name="username">
    <br/>
    <br/> 
    <input type="submit" value="Buscar">
  </form>

  <h3 align="center"> Septima consulta</h3>

  <form align="center" action="consultas/consulta7.php" method="post">
    <br/> 
    <input type="submit" value="Buscar">
  </form>
  
  <br>
  <br>
  <br>
</body>
</html>
