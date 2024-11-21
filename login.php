<!-- hos --><?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /An2Bus');
  }
  require 'conexion.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT idUsuario, correoElectronico, contrasena FROM usuario WHERE correoElectronico = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (!empty($results) && password_verify($_POST['password'], $results['contrasena'])) {
      $_SESSION['user_id'] = $results['idUsuario'];
      header("Location: /An2Bus/index.php");
    } else {
      $message = 'Algo anda mal.';
    }
  }

?>

<?php include'layouts/header.php'; ?>
    <?php if(!empty($message)): ?>
    <p><?= $message ?></p>
    <?php endif; ?>

<head><title>login</title></head>

<main class="contenedor centrar-top">
    <div class="flex">
        <form class="formulario login" action="login.php" method="POST">
            <h2 class="reg"><span><i>Log</i></span>in</h2>
            <input type="email" name="email" placeholder="Correo.." required/>
            <input type="password" name="password" placeholder="Contraseña.." required />
            <div class="enviar">
                <input type="submit" value="Enviar" class="btn">
            </div>
            <a class="regresar-a" href="index.php">Volver al menu principal</a>
        </form>
        <div class="imagen-login">
            <img src="img/bus.png" alt="Imagen Bus">
        </div>
    </div>
</main>
<?php include'layouts/footer.php'; ?>
