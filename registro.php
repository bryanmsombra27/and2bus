<?php

  require 'conexion.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO `usuario`(`nombre`, `apellidoPaterno`, `apellidoMaterno`, `telefono`, `correoElectronico`, `contrasena`)
            VALUES (:nombre,:apellidoPat,:apellidoMat,:telefono,:email,:password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':apellidoPat', $_POST['apellidoPat']);
    $stmt->bindParam(':apellidoMat', $_POST['apellidoMat']);
    $stmt->bindParam(':telefono', $_POST['telefono']);
    $stmt->bindParam(':email', $_POST['email']);  
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Registro Exitoso';
    } else {
      $message = 'Ha fallado su registro';
    }
  }
?>
<?php include'layouts/header.php'; ?>

        <?php if(!empty($message)): ?>
        <p><?= $message ?></p>
        <?php endif; ?>

    <head><title>registro</title></head>

    <main class="contenedor">
        <form class="formulario" action="registro.php" method="POST">
            <h2 class="reg"><span><i>Reg</i></span>istro</h2>
            <input type="text" name="nombre" placeholder="Nombre.." >
            <input type="text" name="apellidoPat" placeholder="Apellido Paterno.." >
            <input type="text" name="apellidoMat" placeholder="Apellido Materno.." >
            <input type="tel" name="telefono" placeholder="Teléfono.." >
            <input type="text" placeholder="Correo.." name="email">
            <input type="password" name="password" placeholder="Contraseña.." >
            <div class="enviar">
                <input type="submit" value="Enviar" class="btn"><br><br>
            </div>
            <a class="regresar-a centrado" href="index.php">Volver al menu principal</a>
        </form>
    </main>

    <?php include'layouts/footer.php'; ?>
