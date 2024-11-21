<?php

require 'conexion.php';
session_start();
$_SESSION['user_id'];
 
 $mods = $conn->prepare('SELECT * FROM usuario WHERE idUsuario = :id ');
 $mods->bindParam(':id', $_SESSION['user_id']);
 $mods->execute();
 $res = $mods->fetch(PDO::FETCH_ASSOC);

?>

<br>

<?php require 'layouts/header.php' ?>

    <main class="contenedor">
        <form class="modificar" action="modificacionhecha.php" method="POST">
        <label>Nombre:
            <input type="text" name="modnombre" value="<?= $res['nombre'];?>">
        </label>

        <label>Apellido Paterno:
            <input type="text" name="modaP" value="<?= $res['apellidoPaterno'];?>">
        </label>

        <label>Apellido Materno:
            <input type="text" name="modaM" value="<?= $res['apellidoMaterno'];?>">
        </label>

        <label>Telefono:
            <input type="tel" name="modtel" value="<?= $res['telefono'];?>">
        </label>

        <label>Correo:
            <input type="text" name="modcorreo" value="<?= $res['correoElectronico'];?>">
        </label><br><br>

        <!--Intento de recuperación de foto de perfil del usuario-->
        
        <!--<img height="50" src="data:imagen/jpeg;base64,<?php //echo base64_encode($res['fotoUsuario']);?>">-->
        <!--Termina intento de recuperación de foto de perfil del usuario-->

        <input class="btn centrar" type="submit" value="ACTUALIZAR" name="mod">

        </form>

        <div class="cancelar">
            <a class="cancelar-modificacion" href="index.php">Volver</a>
        </div>
    </main>
<center>
    <?php
    require"funcion.php";

    if(isset($_SESSION['exito'])){
    echo $_SESSION['exito'];
    }else{
        if(isset($_SESSION['error']))
        echo $_SESSION['error'];
    }
    borrarErrores();
    ?>
</center> 
<?php require 'layouts/footer.php' ?>
