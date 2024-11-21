<?php
  session_start();

  require 'conexion.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT * FROM usuario WHERE idUsuario = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (!empty($results)) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>An2Bus</title>
    <link rel="icon" href="img/logo.ico"/>
    <link rel="stylesheet" href="css/normalize.css"/>
    <link rel="stylesheet" href="css/estilos.css"/>
  </head>
  <body>
    <!--<?php //require 'partials/header.php' ?>-->

    <?php if(!empty($user)): ?>

      <?php require 'perfil.php';?>

    <?php else: ?>

      <main class="principal contenedor subir">
        <div class="candado">
          <div class="logo-principal">
            <p class="texto-principal1"><i>Bienvenido</i> a</p>
            <img src="img/logo.png" alt="logo">
          </div>
          <!--<p class="texto-principal">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reiciendis nesciunt amet quisquam temporibus adipisci debitis ad sint ipsam mollitia officia. Optio animi magni rem architecto. Saepe fugit doloremque nostrum eaque?</p>-->
          <div class="botones-principal">
            <a href="login.php">Inicia sesión</a>
            <a href="registro.php">Regístrate</a> 
          </div>
        </div>
        <img class="parada" src="img/laparada.jpg" alt="">
      </main>
      
    <?php endif; ?>

  </body>
</html>
